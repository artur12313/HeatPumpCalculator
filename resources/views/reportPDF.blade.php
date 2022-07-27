<html style="font-family: DejaVu Sans; font-size: 10px;">
    <head>
      <meta charset="UTF-8"/>
      <meta http-equiv="Content-Type" content="text/html;"/>
    <style>
      .title{
        text-align: center;
      }
      table, tr, td, {
        border: 1px solid gray;
      }
      .bgGray {
        background-color: gray;
      }
      .box {
        display: flex;
        justify-content: space-around;
        width: 100%;
      }
      td {
        padding: 1rem;
      }
      </style>
    </head>
    <body>
      <div class="title">
        <h1>Kalkulacja doboru Pompy Ciepła</h1>
        <h2>{{ $pump->name }}</h2>
      </div>
      <div class="box">
        <div>
          <table>
            <thead>
              <tr><td>Przygotowano dla:</td></tr>
            </thead>
            <tbody>
              <tr><td>Imię i nazwisko:</td><td class="bgGray">{{ $clientName }}</td></tr>
              <tr><td>Ulica nr:</td><td class="bgGray">{{ $address }}</td></tr>
              <tr><td>Miejscowość:</td><td class="bgGray">{{ $city }}</td></tr>
              <tr><td>Telefon:</td><td class="bgGray">{{ $phone }}</td></tr>
            </tbody>
          </table>
        </div>
        <div>
          <table>
            <thead>
              <tr><td>Przedstawiciel:</td></tr>
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
            <tr><td><h3>Szacunkowy dobór mocy pompy ciepła*;</h3></td></tr>
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
              <td class="bgGray" style="font-size: 10px;">Obliczanie współczynnika strat ciepła wg. wytycznych VDI 2067</td>
            </tr>
            <tr>
              <td>Model proponowanej pompy ciepła:</td>
              <td>{{ $pump->name }}</td>
            </tr>
            <tr>
              <td>Typ sprężarki: </td>
              <td>{{-- TODO --}}</td> 
            </tr>
            <tr>
              <td>Pobór Mocy:</td>
              <td>{{-- TODO --}}</td>
            </tr>
            <tr>
              <td>Temperatura biwalentna do jakiej PC może być jedynym źródłem ciepła:</td>
              <td>{{ $minimalTemperature }} <sup>o</sup>C</td>
            </tr>
            <tr>
              <td>Przybliżona wielkość Mikroinstalacji fotowoltaicznej na potrzeby PC*</td>
              <td>{{ round($sizeFV, 1) }} kWp</td>
            </tr>
          </tbody>
        </table>
      </div>
    </body>
</html>