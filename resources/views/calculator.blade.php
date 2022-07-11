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
    <form>
      <div class="flex gap-4 md:w-2/3">
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="interest" value="{{ __('Roczna stopa procentowa pożyczki/kredytu (%)') }}" />
          <x-jet-input id="interest" class="block mt-1 w-full" type="number" name="interest" onchange="MonthlyInterest()"/>
        </div>
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="monthlyInterest" value="{{ __('Miesięczna stopa procentowa pożyczki/kredytu (%)') }}" />
          <x-jet-input id="monthlyInterest" class="block mt-1 w-full" type="number" name="monthlyInterest" required autofocus />
        </div>
      </div>
      <div class="flex gap-4 md:w-2/3">
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="terms" value="{{ __('Liczba miesięcznych rat') }}" />
          <x-jet-input id="terms" class="block mt-1 w-full" type="number" name="terms" required autofocus />
        </div>
        <div class="md:w-1/2 mt-4">
          <x-jet-label for="amount" value="{{ __('Kwota kredytu') }}" />
          <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="amount" required autofocus onchange="avgInstallment()"/>
        </div>
      </div>
      <div class="footer-form mt-4 flex justify-end">
        <button type="submit" class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
    </div>
    </form>
    <script>
      function MonthlyInterest()
      {
        let interest = Number(document.getElementById('interest').value == "" ? 0 : document.getElementById('interest').value);
        let monthlyInterest = document.getElementById('monthlyInterest');
        
        let operation = interest / 12;
        
        monthlyInterest.value = (Math.round(operation * 100) / 100).toFixed(2);
      }

      function avgInstallment()
      {
        let oprocentowanie = Number(document.getElementById('interest').value == "" ? 0 : document.getElementById('interest').value) / 100;
        let liczba_rat = Number(document.getElementById('terms').value == "" ? 0 : document.getElementById('terms').value);
        let kwota_kredytu = Number(document.getElementById('amount').value == "" ? 0 : document.getElementById('amount').value);

        let rata_kredytu = kwota_kredytu * (((oprocentowanie / 12) * Math.pow((1 + oprocentowanie / 12),liczba_rat)) / (Math.pow((1 + (oprocentowanie / 12)), liczba_rat) - 1));
        console.log("rata: " + rata_kredytu);

        let odestki = (oprocentowanie / 12) * kwota_kredytu;
        console.log("odsetki: " + odestki);

        let kapitał = rata_kredytu - odestki;
        console.log("kapitał: " + kapitał);

        let kredytWartosc = kwota_kredytu;
        var i = 0;

        while(kredytWartosc > 0)
        {
          ++i;
          let bilans = kredytWartosc * (((oprocentowanie / 12) * Math.pow((1 + oprocentowanie / 12),liczba_rat)) / (Math.pow((1 + (oprocentowanie / 12)), liczba_rat) - 1));
          let rata = kredytWartosc - bilans;
          let odsetkiWartosc = (oprocentowanie / 12) * kredytWartosc;
          let kapitałWartosc = kredytWartosc - odestki;
          console.log(i + ". " + "rata: " + rata + " kapitał: " + kapitałWartosc + " odsetki: " + odsetkiWartosc);
        }
      }
    </script>
    <?php 
    /**
     * AMORTIZATION CALCULATOR
     * @author PRANEETH NIDARSHAN
     * @version V1.0
     */
    class Amortization
    {
      private $loan_amount;
      private $term_years;
      private $interest;
      private $terms;
      private $period;
      private $currency = "XXX";
      private $principal;
      private $balance;
      private $term_pay;
  
      public function __construct($data)
      {
        if($this->validate($data)) {
  
          
          $this->loan_amount 	= (float) $data['loan_amount'];
          $this->term_years 	= (int) $data['term_years'];
          $this->interest 	= (float) $data['interest'];
          $this->terms 		= (int) $data['terms'];
          
          $this->terms = ($this->terms == 0) ? 1 : $this->terms;
  
          $this->period = $this->terms * $this->term_years;
          $this->interest = ($this->interest/100) / $this->terms;
  
          $results = array(
            'inputs' => $data,
            'summary' => $this->getSummary(),
            'schedule' => $this->getSchedule(),
            );
  
          $this->getJSON($results);
        }
      }
  
      private function validate($data) {
        $data_format = array(
          'loan_amount' 	=> 0,
          'term_years' 	=> 0,
          'interest' 		=> 0,
          'terms' 		=> 0
          );
  
        $validate_data = array_diff_key($data_format,$data);
        
        if(empty($validate_data)) {
          return true;
        }else{
          echo "<div style='background-color:#ccc;padding:0.5em;'>";
          echo '<p style="color:red;margin:0.5em 0em;font-weight:bold;background-color:#fff;padding:0.2em;">Missing Values</p>';
          foreach ($validate_data as $key => $value) {
            echo ":: Value <b>$key</b> is missing.<br>";
          }
          echo "</div>";
          return false;
        }
      }
  
      private function calculate()
      {
        $deno = 1 - 1 / pow((1+ $this->interest),$this->period);
  
        $this->term_pay = ($this->loan_amount * $this->interest) / $deno;
        $interest = $this->loan_amount * $this->interest;
  
        $this->principal = $this->term_pay - $interest;
        $this->balance = $this->loan_amount - $this->principal;
  
        return array (
          'payment' 	=> $this->term_pay,
          'interest' 	=> $interest,
          'principal' => $this->principal,
          'balance' 	=> $this->balance
          );
      }
  
      public function getSummary()
      {
        $this->calculate();
        $total_pay = $this->term_pay *  $this->period;
        $total_interest = $total_pay - $this->loan_amount;
  
        return array (
          'total_pay' => $total_pay,
          'total_interest' => $total_interest,
          );
      }
  
      public function getSchedule ()
      {
        $schedule = array();
        
        while  ($this->balance >= 0) { 
          array_push($schedule, $this->calculate());
          $this->loan_amount = $this->balance;
          $this->period--;
        }
  
        return $schedule;
  
      }
  
      private function getJSON($data)
      {
        header('Content-Type: application/json');
        $js_code = '<script> console.log(' . json_encode($data) . ');</script>';
        echo $js_code;
      }
    }
  
    $data = array(
      'loan_amount' 	=> 40000,
      'term_years' 	=> 1,
      'interest' 		=> 10,
      'terms' 		=> 120
      );
  
    $amortization = new Amortization($data);
  
  
    ?>
  </div>
</x-app-layout>