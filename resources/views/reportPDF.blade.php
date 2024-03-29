<html style="font-family: DejaVu Sans; font-size: 11px;">
    <head>
      <meta charset="UTF-8"/>
      <meta http-equiv="Content-Type" content="text/html;"/>
      <title>{{ $reportID }} | {{ $clientName }}</title>
    <style>
      .title{
        text-align: center;
      }
      table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
      }
      thead {
        border-bottom: 1px solid black;
        width: 100%;
      }
      tr {
        border-bottom: 1px solid black;
      }
      tr td:last-child {
        border-right: 0;
      }
      .bgGray {
        background-color: #dadbdb;
      }
      .bgGreen {
        background-color: #b2e286;
      }
      td {
        padding: .5rem;
        border-right: 1px solid black;
        width: 100%;
      }
      .title {
        padding: 1rem 0;
      }
      </style>
    </head>
    <body>
      <span style="text-align: right;">Raport nr.: {{ $reportID }}</span><br><br>
      <img src="{{$pic}}" style="width: 180px; height: auto; margin-left: 35%;"/>
      <div class="title">
        <h1 style="color: #104ca5;">Kalkulacja doboru Pompy Ciepła</h1>
      </div>
      <div class="box">
        <div style="float: left; width: 50%; height: 20%;">
          <table>
            <thead>
              <tr>
                <td style="border-right: 0;">Przygotowano dla:</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr><td>Imię i nazwisko:</td><td class="bgGray">{{ $clientName }}</td></tr>
              <tr><td>Ulica nr:</td><td class="bgGray">{{ $address }}</td></tr>
              <tr><td>Miejscowość:</td><td class="bgGray">{{ $city }}</td></tr>
              <tr><td>Telefon:</td><td class="bgGray">{{ $phone }}</td></tr>
            </tbody>
          </table>
        </div>
        <div style="margin-left: 50%; width: 50%; height: 20%;">
          <table style="border-left: 0;">
            <thead>
              <tr>
                <td style="border-right: 0;">Przedstawiciel:</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr><td>Imię i nazwisko:</td><td class="bgGray">{{ $user->name }}</td></tr>
              <tr><td>Telefon:</td><td class="bgGray">{{ $user->phone }}</td></tr>
              <tr><td>Nr pełnomocnictwa:</td><td class="bgGray">{{ $user->specialNumber }}</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="content">
        <table>
          <thead>
            <tr>
              <td style="border-right: 0; color: #104ca5;"><h3>Szacunkowy dobór mocy pompy ciepła*;</h3></td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Wielkość powierzchni ogrzewanej:</td>
              <td>{{ $heatingArea }} m<sup>2</sup></td>
            </tr>
            <tr>
              <td>Kubatura:</td>
              <td>{{ $kubatura }} m<sup>3</sup></td>
            </tr>
            <tr>
              <td>Założone zapotrzebowanie na ciepło:</td>
              <td>{{ round($assumedHeatDemand, 0) }} W/m<sup>3</sup></td>
            </tr>
            <tr>
              <td>Przewidywane roczne zapotrzebowanie:</td>
              <td>{{ $annualEnergyExpenditure }} kWh/rok</td>
            </tr>
            <tr>
              <td class="bgGreen" style="font-size: 10px; border-right: 0;">Obliczanie współczynnika strat ciepła wg. wytycznych VDI 2067</td>
              <td class="bgGreen"></td>
            </tr>
            <tr>
              <td>Model proponowanej pompy ciepła:</td>
              <td>{{ $pump->name }}</td>
            </tr>
            <tr>
              <td>Temperatura do jakiej PC może być jedynym źródłem ciepła:</td>
              <td>{{ $minimalTemperature }} <sup>o</sup>C</td>
            </tr>
            <tr>
              <td>Przybliżona wielkość Mikroinstalacji fotowoltaicznej na potrzeby PC*</td>
              <td>{{ round($sizeFV, 1) }} kWp</td>
            </tr>
          </tbody>
        </table>
        <table style="border-top: 0;">
          <thead class="bgGray">
            <tr>
              <td class="bgGreen">Kalkulacja cenowa zestawu Pompy Ciepła**</td>
              <td class="bgGreen"></td>
            </tr>
            <tr>
              <td>Typ</td>
              <td>Wartość netto</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $pump->name }}</td>
              <td>{{ $pump->comma_price }} zł</td>
            </tr>
          </tbody>
        </table>
        <table style="border-top: 0;">
          <thead>
            <tr class="bgGreen">
              <td>Kalkulacja cenowa zestawu przyłączeniowego</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if($modules != null)
            @foreach($modules as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->comma_price }} zł</td>
              </tr>
            @endforeach
            @else
            <tr>
              <td></td>
              <td></td>
            </tr>
            @endif
            @if($tube != 0)
              <tr>
                <td>Rura preizolowana {{ $tube }}mb</td>
                <td>{{ $tubeSummary }} zł</td>
              </tr>
              @endif
          </tbody>
          <tfoot>
            <tr>
              <td> <strong>Razem</strong></td>
              <td><strong>{{ number_format($modulesTotalValue, 2, ',','') }} zł</strong></td></tr>
            </tfoot>
          </table>
        <table style="margin-top: 1rem;">
          <thead>
            <tr>
              <td style="border-right: 0; font-weight: bold;">Podsumowanie</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr><td>Wartość systemu netto</td><td><strong>{{ number_format($totalValue, 2, ',','') }} zł</strong></td></tr>
            <tr><td>VAT {{ ($taxValueInput * 100) }}%</td><td><strong>{{ number_format($tax, 2, ',','')}} zł</strong></td></tr>
            <tr><td>Cena zestawu brutto</td><td><strong>{{ number_format($grossTotalValue, 2, ',','')}} zł</strong></td></tr>
          </tbody>
        </table>
      </div>
    </body>
</html>