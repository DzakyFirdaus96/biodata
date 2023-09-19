<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaDidikM;
use PDF;


class PesertaDidikPDF extends Controller
{
     public function pdf(){
        $pesertaM = PesertaDidikM::all();
        // return view('pesertadidik_pdf', compact('pesertaM'));
       
        $pdf = PDF::loadview('pesertadidik_pdf', ['pesertaM' => $pesertaM]);
        return $pdf->stream('pesertadidik.pdf');
    }
}
