<html style="font-family: DejaVu Sans; font-size: 10px;">
    <head>
      <meta charset="UTF-8"/>
      <meta http-equiv="Content-Type" content="text/html;"/>
    </head>
    <body>
              <div class="flex justify-center items-center">
                <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                    Raty stałe
                </h4>
              </div>
              <table id="Terms" style="width: 100%; border-collapse: collapse">
                <thead style="border: 1px solid black; border-bottom: 0;">
                  <tr style="border-bottom: 1px solid black;">
                    <th style="border-right: 1px solid black; padding: .5rem 0;">Miesiąc</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">rata</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">kapitał</th>
                    <th style="padding: .5rem 0;">odsedki</th>
                  </tr>
                </thead>
                <tbody id="TermsBody" style="border: 1px solid black;">
                  @foreach ($raty_stale as $row => $innerArray)
                    <tr style="border-bottom: 1px solid black;">
                      <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $loop->iteration }}</td>
                      <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $innerArray['stala_rata_kredytu']}}zł</td>
                      <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $innerArray['odsetkiWartosc']}}zł</td>
                      <td style="padding: .5rem 0; text-align: center;">{{ $innerArray['kapitalWartosc']}}zł</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </body>
            <body>
              <div class="flex justify-center items-center">
                <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Raty malejące') }}
                </h4>
              </div>
              <table id="decTerms" style="width: 100%; border-collapse: collapse">
                <thead style="border: 1px solid black; border-bottom: 0;">
                  <tr style="border-bottom: 1px solid black">
                    <th style="border-right: 1px solid black; padding: .5rem 0;">Miesiąc</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">rata</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">kapitał</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">odsedki</th>
                  </tr>
                </thead>
                <tbody id="decTermsBody" style="border:1px solid black;">
                  @foreach ($raty_mal as $row => $innerArray)
                  <tr style="border-bottom: 1px solid black;">
                    <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $loop->iteration }}</td>
                    <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $innerArray['bilans_mal']}}zł</td>
                    <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $innerArray['kapitałWartosc_mal']}}zł</td>
                    <td style="padding: .5rem 0; text-align: center;">{{ $innerArray['odsetkiWartosc_mal']}}zł</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
        </body>
        <body>
              <div class="flex justify-center items-center">
                <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Opłaty za energię') }}
                </h4>
              </div>
              <table id="energy" style="width: 100%; border-collapse: collapse;">
                <thead style="border: 1px solid black; border-bottom: 0;">
                  <tr style="border-bottom: 1px solid black;">
                    <th style="border-right: 1px solid black; padding: .5rem 0;">Rachunek</th>
                    <th style="border-right: 1px solid black; padding: .5rem 0;">rata</th>
                    <th style="padding: .5rem 0;">=</th>
                  </tr>
                </thead>
                <tbody id="energyBody" style="border:1px solid black;">
                  @foreach($energy as $row => $item)
                  <tr style="border-bottom: 1px solid black;">
                    <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $item['bill']}}zł</td>
                    <td style="border-right: 1px solid black; padding: .5rem 0; text-align: center;">{{ $item['bilans_mal']}}zł</td>
                    <td style="padding: .5rem 0; text-align: center;">{{ $item['sum']}}zł</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot style="border: 1px solid black; border-top: 0;">
                  <tr>
                    <th style="padding: .5rem 0;"></th>
                    <th style="padding: .5rem 0;">saldo:</th>
                    <th style="padding: .5rem 0;">{{ $saldo }}</th>
                  </tr>
                </tfoot>
              </table>
    </body>
</html>