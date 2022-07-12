<html>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="Content-Type" content="text/html;"/>
    </head>
    <body>
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
                    @foreach($ratyStale as $item)
                    <tr>
                        <td>{{$item->stala_rata_kredytu}}</td>
                        <td>{{$item->KapitalWartosc}}</td>
                        <td>{{$item->odsetkiWartosc}}</td>
                    </tr>
                    @endforeach
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
    </body>
</html>