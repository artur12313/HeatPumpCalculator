<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;
use Dompdf\Dompdf;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function createPDF(Request $request)
    {
        $oprocentowanie = $request->interest;
        $bill = $request->bill;
        $liczba_rat = $request->terms;
        $kwota_kredytu = $request->amount;
        $stala_rata_kredytu = $kwota_kredytu * ((($oprocentowanie / 12) * pow((1 + $oprocentowanie / 12), $liczba_rat)) / (pow((1 + ($oprocentowanie / 12)), $liczba_rat) - 1));
        $malejaca_rata_kredytu = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie / 12) * $kwota_kredytu);
        $odsetki = ($oprocentowanie / 12) * $kwota_kredytu;
        $kapital_stalej_raty = $stala_rata_kredytu - $odsetki;
        $kapital_malejacej_raty = $malejaca_rata_kredytu - $odsetki;

        $bilans = 0;
        $bilans_mal = 0;
        $i = 0;
        $rataWartosc = $kwota_kredytu;
        $rataWartosc_mal = $kwota_kredytu;
        $raty_stałe = [];
        $raty_mal = [];
        $odsetkiWartosc = 0;
        $odsetkiWartosc_mal = 0;
        $kapitałWartosc = 0;
        $kapitałWartosc_mal = 0;
        $sum = 0;

        while($rataWartosc >= 0)
        {
            $bilans = $stala_rata_kredytu + ($oprocentowanie / 12) * $rataWartosc;
            $bilans_mal = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie / 12) * $rataWartosc_mal);
            $rataWartosc -= ($kwota_kredytu / $liczba_rat);
            $rataWartosc_mal -= ($kwota_kredytu / $liczba_rat);
            $odsetkiWartosc = ($oprocentowanie / 12) * $rataWartosc;
            $odsetkiWartosc_mal = ($oprocentowanie / 12) * $rataWartosc_mal;
            $kapitałWartosc = ($stala_rata_kredytu - $odsetkiWartosc);
            $kapitałWartosc_mal = ($malejaca_rata_kredytu - $odsetkiWartosc_mal);
    //     raty_stałe[i] = [
    //       {stala_rata_kredytu: (stala_rata_kredytu).toFixed(2)},
    //       {KapitalWartosc: (kapitałWartosc).toFixed(2)},
    //       {odsetkiWartosc: (odsetkiWartosc).toFixed(2)}];
    //     raty_mal[i] = [
    //       {bilans_mal: (bilans_mal).toFixed(2)},
    //       {kapitałWartosc_mal: (kapitałWartosc_mal).toFixed(2)},
    //       {odsetkiWartosc_mal: (odsetkiWartosc_mal).toFixed(2)}
    //     ];
    //     sum = ((bill / 1000) - bilans_mal);
        
    //     // console.log(i + ". " + "rata: " + (stala_rata_kredytu).toFixed(2) + " kapitał: " + (kapitałWartosc).toFixed(2) + " odsetki: " + (odsetkiWartosc).toFixed(2));
    //     termsBody.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">' + i +'</td><td class="py-2 text-center border-r">' + (stala_rata_kredytu).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (kapitałWartosc).toFixed(2) + 'zł</td><td class="py-2 text-center">' + (odsetkiWartosc).toFixed(2) +'zł</td></tr>';
    //     // console.log("pozostało do spłaty: " + (rataWartosc).toFixed(2));
    //     decTerms.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">' + i +'</td><td class="py-2 text-center border-r">' + (bilans_mal).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (kapitałWartosc_mal).toFixed(2) + 'zł</td><td class="py-2 text-center">' + (odsetkiWartosc_mal).toFixed(2) +'zł</td></tr>';
    //     energyBody.innerHTML +='<tr class="border-b"><td class="py-2 text-center border-r">'+ bill + 'zł</td><td class="py-2 text-center border-r">'+ (bilans_mal).toFixed(2) + 'zł</td><td class="py-2 text-center border-r">' + (sum).toFixed(2) + 'zł</td></tr>'
    //     i++;
    //   }
    //     console.log(raty_stałe);
    //     console.log(raty_mal);
    //   // console.log("bilans po " + bilans);
        }
        
        // $ratyStale = [];
        // $ratyStale = $request->ratyStale;
        // $ratyMal = $request->ratyMal;

        // $pdf = PDF::loadView('PDF', ['ratyStale' => $ratyStale]);
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);

        $pdf = PDF::loadView('PDF');

        return $pdf->stream();
    }
}
