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
        $oprocentowanie = ($request->interest) / 100;
        $bill = ($request->bill) / 1000;
        $liczba_rat = $request->terms;
        $kwota_kredytu = $request->amount;
        $stala_rata_kredytu = round($kwota_kredytu * ((($oprocentowanie / 12) * pow((1 + $oprocentowanie / 12), $liczba_rat)) / (pow((1 + ($oprocentowanie / 12)), $liczba_rat) - 1)),2);
        $malejaca_rata_kredytu = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie / 12) * $kwota_kredytu);
        $odsetki = ($oprocentowanie / 12) * $kwota_kredytu;
        $kapital_stalej_raty = $stala_rata_kredytu - $odsetki;
        $kapital_malejacej_raty = $malejaca_rata_kredytu - $odsetki;

        $bilans = 0;
        $bilans_mal = 0;
        $rataWartosc = $kwota_kredytu;
        $rataWartosc_mal = $kwota_kredytu;
        $raty_stale = array();
        $raty_mal = array();
        $odsetkiWartosc = 0;
        $odsetkiWartosc_mal = 0;
        $kapitałWartosc = 0;
        $kapitałWartosc_mal = 0;
        $sum = 0;
        $energy = array();
        $saldo = 0;

        while($rataWartosc >= 0)
        {
            $bilans = $stala_rata_kredytu + ($oprocentowanie / 12) * $rataWartosc;
            $bilans_mal = round((($kwota_kredytu / $liczba_rat) + ($oprocentowanie / 12) * $rataWartosc_mal),2);
            $rataWartosc -= ($kwota_kredytu / $liczba_rat);
            $rataWartosc_mal -= ($kwota_kredytu / $liczba_rat);
            $odsetkiWartosc = round(($oprocentowanie / 12) * $rataWartosc,2);
            $odsetkiWartosc_mal = round(($oprocentowanie / 12) * $rataWartosc_mal,2);
            $kapitałWartosc = round(($stala_rata_kredytu - $odsetkiWartosc),2);
            $kapitałWartosc_mal = round(($malejaca_rata_kredytu - $odsetkiWartosc_mal),2);
            $sum = (($bill / 1000) - $bilans_mal);
            $saldo += $sum; 
            array_push($raty_stale, [
                'stala_rata_kredytu' => $stala_rata_kredytu,
                'kapitalWartosc' => $kapitałWartosc,
                'odsetkiWartosc' => $odsetkiWartosc]);
            array_push($raty_mal, [
                'bilans_mal' => $bilans_mal,
                'kapitałWartosc_mal' => $kapitałWartosc_mal,
                'odsetkiWartosc_mal' => $odsetkiWartosc_mal]);
            array_push($energy, [
                'bill' => $bill,
                'bilans_mal' => $bilans_mal,
                'sum' => $sum
            ]);
        }
        $pdf = PDF::loadView('PDF', ['raty_stale' => $raty_stale, 'raty_mal' => $raty_mal, 'energy' => $energy, 'saldo' => $saldo]);
        return $pdf->stream();
    }
}
