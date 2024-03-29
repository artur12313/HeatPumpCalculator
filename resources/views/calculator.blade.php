<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kalkulator kredytowy') }}
            </h2>
        </div>
    
    </x-slot>
    <div class="container mx-auto" id="calculatorForm">
    @if ($errors->any())
    <div role="alert">
      <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
        Błąd
      </div>
      <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif
    <form action="{{route('calculator.createPDF')}}" method="GET">
      @method('GET')
      <div class="flex gap-4 w-full">
        <div class="md:w-1/3 mt-4">
          <x-jet-label for="interest" value="{{ __('Roczna stopa procentowa pożyczki/kredytu (%)') }}" />
          <x-jet-input id="interest" class="block mt-1 w-full" type="number" name="interest" onchange="MonthlyInterest()" step="any"/>
        </div>
        <div class="md:w-1/3 mt-4">
          <x-jet-label for="monthlyInterest" value="{{ __('Miesięczna stopa procentowa pożyczki/kredytu (%)') }}" />
          <x-jet-input id="monthlyInterest" class="block mt-1 w-full" type="number" name="monthlyInterest" step="any" required autofocus />
        </div>
        <div class="md:w-1/3 mt-4">
          <x-jet-label for="bill" value="{{ __('Wysokość rachunku') }}" />
          <x-jet-input id="bill" class="block mt-1 w-full" type="number" name="bill" step="any" required autofocus />
        </div>
      </div>
      <div class="flex gap-4 md:w-2/3">
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="terms" value="{{ __('Liczba miesięcznych rat') }}" />
          <x-jet-input id="terms" class="block mt-1 w-full" type="number" name="terms" step="any" required autofocus />
        </div>
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="amount" value="{{ __('Kwota kredytu') }}" />
          <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="amount" step="any" required autofocus onchange="avgInstallment()"/>
        </div>
      </div>
      <div class="footer-form mt-4 flex justify-between">
      <button type="button" class="bg-green-600/75 hover:bg-green-600/50 text-white py-1 px-4 text-lg" id="previewTrigger">Podgląd</button>
        <button type="submit" class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
    </div>
    </form>
    <div id="preview">
      <div class="flex justify-center items-center my-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Harmonogram spłat') }}
        </h2>
    </div>
    <div class="grid gap-4 grid-cols-3">
      <div>
        <div class="flex justify-center items-center">
          <h4 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Raty stałe') }}
          </h4>
      </div>
      <table id="Terms" class="w-full border my-4">
        <thead class="border-b">
          <tr>
            <th class="border-r py-4">Miesiąc</th>
            <th class="border-r py-4">rata</th>
            <th class="border-r py-4">kapitał</th>
            <th class="border-r py-4">odsedki</th>
          </tr>
        </thead>
        <tbody id="TermsBody">

        </tbody>
      </table>
      </div>
      <div>
        <div class="flex justify-center items-center">
          <h4 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Raty malejące') }}
          </h4>
        </div>
        <table id="decTerms" class="w-full border my-4">
          <thead class="border-b">
            <tr>
              <th class="border-r py-4">Miesiąc</th>
              <th class="border-r py-4">rata</th>
              <th class="border-r py-4">kapitał</th>
              <th class="border-r py-4">odsedki</th>
            </tr>
          </thead>
          <tbody id="decTermsBody">

          </tbody>
        </table>
      </div>
      <div>
        <div class="flex justify-center items-center">
          <h4 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Opłaty za energię') }}
          </h4>
        </div>
        <table id="energy" class="w-full border my-4">
          <thead class="border-b">
            <tr>
              <th class="border-r py-4">Rachunek</th>
              <th class="border-r py-4">rata</th>
              <th class="border-r py-4">saldo</th>
            </tr>
          </thead>
          <tbody id="energyBody">

          </tbody>
        </table>
      </div>
    </div>
      
    </div>
    <script>
      document.getElementById('previewTrigger').disabled = true;
      var content = document.getElementById('preview');
      content.style.display = "block";
      var previewTrigger = document.getElementById('previewTrigger').addEventListener("click", function () {
        if(content.style.display == 'none')
        {
            content.style.display = "block";
        }else{
            content.style.display = "none";
        }
        });

      function MonthlyInterest()
      {
        let interest = Number(document.getElementById('interest').value == "" ? 0 : document.getElementById('interest').value);
        let monthlyInterest = document.getElementById('monthlyInterest');
        
        let operation = interest / 12;
        
        monthlyInterest.value = (Math.round(operation * 100) / 100).toFixed(2);
      }

      function avgInstallment()
      {
        document.getElementById('previewTrigger').disabled = false;
        var i = 0;
        let oprocentowanie = Number(document.getElementById('interest').value == "" ? 0 : document.getElementById('interest').value) / 100;
        let bill = Number(document.getElementById('bill').value == "" ? 0 : document.getElementById('bill').value);
        var energyBody = document.getElementById('energyBody');
        var termsBody = document.getElementById('TermsBody');
        let liczba_rat = Number(document.getElementById('terms').value == "" ? 0 : document.getElementById('terms').value);
        let kwota_kredytu = Number(document.getElementById('amount').value == "" ? 0 : document.getElementById('amount').value);
        
        let stala_rata_kredytu = kwota_kredytu * (((oprocentowanie / 12) * Math.pow((1 + oprocentowanie / 12),liczba_rat)) / (Math.pow((1 + (oprocentowanie / 12)), liczba_rat) - 1));
        let malejaca_rata_kredytu = ((kwota_kredytu / liczba_rat) + (oprocentowanie / 12) * kwota_kredytu);

        let odsetki = (oprocentowanie / 12) * kwota_kredytu;

        let kapital_stalej_raty = stala_rata_kredytu - odsetki;
        let kapital_malejacej_raty = malejaca_rata_kredytu - odsetki;

        let rataWartosc = kwota_kredytu;
        let rataWartosc_mal = kwota_kredytu;
        let bilans = stala_rata_kredytu + (oprocentowanie / 12) * rataWartosc;;
        let bilans_mal =((kwota_kredytu / liczba_rat) + (oprocentowanie / 12) * rataWartosc_mal);
        let odsetkiWartosc = (oprocentowanie / 12) * rataWartosc;
        let odsetkiWartosc_mal = (oprocentowanie / 12) * rataWartosc_mal;
        let kapitałWartosc = (stala_rata_kredytu - odsetkiWartosc);
        let kapitałWartosc_mal = (stala_rata_kredytu - odsetkiWartosc_mal);
        let sum = 0;

        while(rataWartosc >= 0)
        {
          ++i;
          termsBody.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">' + i +'</td><td class="py-2 text-center border-r">' + (stala_rata_kredytu).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (kapitałWartosc).toFixed(2) + 'zł</td><td class="py-2 text-center">' + (odsetkiWartosc).toFixed(2) +'zł</td></tr>';
          decTerms.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">' + i +'</td><td class="py-2 text-center border-r">' + (bilans_mal).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (kapitałWartosc_mal).toFixed(2) + 'zł</td><td class="py-2 text-center">' + (odsetkiWartosc_mal).toFixed(2) +'zł</td></tr>';
          energyBody.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">'+ bill + 'zł</td><td class="py-2 text-center border-r">'+ (bilans_mal).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (sum).toFixed(2) + 'zł</td></tr>'
          
          bilans = stala_rata_kredytu + (oprocentowanie / 12) * rataWartosc;
          bilans_mal = ((kwota_kredytu / liczba_rat) + (oprocentowanie / 12) * rataWartosc_mal);
          rataWartosc -= (kwota_kredytu / liczba_rat);
          rataWartosc_mal -= (kwota_kredytu / liczba_rat);
          odsetkiWartosc = (oprocentowanie / 12) * rataWartosc;
          odsetkiWartosc_mal = (oprocentowanie / 12) * rataWartosc_mal;
          kapitałWartosc = (stala_rata_kredytu - odsetkiWartosc);
          kapitałWartosc_mal = (malejaca_rata_kredytu - odsetkiWartosc_mal);
          sum = ((bill / 1000) - bilans_mal);
        }
      }
    </script>
  </div>
</x-app-layout>