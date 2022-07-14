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
        $oprocentowanie = (($request->interest / 100) / 12);
        $bill = ($request->bill) / 1000;
        $liczba_rat = $request->terms;
        $kwota_kredytu = ($request->amount);
        $stala_rata_kredytu = (($kwota_kredytu * $oprocentowanie * pow((1 + $oprocentowanie), $liczba_rat)) / (pow((1 + $oprocentowanie), $liczba_rat) - 1));
        $malejaca_rata_kredytu = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie * $kwota_kredytu));

        $rataWartosc = $kwota_kredytu;
        $rataWartosc_mal = $kwota_kredytu;
        $bilans = $stala_rata_kredytu + ($oprocentowanie * $rataWartosc);
        $bilans_mal = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie * $rataWartosc_mal));
        $raty_stale = array();
        $raty_mal = array();
        $odsetki = $oprocentowanie * $rataWartosc;
        $odsetki_mal = $oprocentowanie * $rataWartosc_mal;
        $kapitałWartosc = ($stala_rata_kredytu - $odsetki);
        $kapitałWartosc_mal = ($malejaca_rata_kredytu - $odsetki_mal);
        $sum = 0;
        $energy = array();
        $saldo = 0;

        while($rataWartosc >= 0)
        {
            array_push($raty_stale, [
                'stala_rata_kredytu' => $stala_rata_kredytu,
                'kapitalWartosc' => $kapitałWartosc,
                'odsetkiWartosc' => $odsetki]);
            array_push($raty_mal, [
                'bilans_mal' => $bilans_mal,
                'kapitałWartosc_mal' => $kapitałWartosc_mal,
                'odsetkiWartosc_mal' => $odsetki_mal]);
            array_push($energy, [
                'bill' => $bill,
                'bilans_mal' => $bilans_mal,
                'sum' => $sum
            ]);
            $bilans = $stala_rata_kredytu + $oprocentowanie * $rataWartosc;
            $bilans_mal = (($kwota_kredytu / $liczba_rat) + ($oprocentowanie * $rataWartosc_mal));
            $rataWartosc -= ($kwota_kredytu / $liczba_rat);
            $rataWartosc_mal -= ($rataWartosc_mal / $liczba_rat);
            $odsetki = $oprocentowanie * $rataWartosc;
            $odsetki_mal = $oprocentowanie * $rataWartosc_mal;
            $kapitałWartosc = ($stala_rata_kredytu - $odsetki);
            $kapitałWartosc_mal = ($malejaca_rata_kredytu - $odsetki_mal);
            $sum = (($bill / 1000) - $bilans_mal);
            $saldo += $sum; 
        }
        $pdf = PDF::loadView('PDF', ['raty_stale' => $raty_stale, 'raty_mal' => $raty_mal, 'energy' => $energy, 'saldo' => $saldo]);
        return $pdf->stream();
    }
}
