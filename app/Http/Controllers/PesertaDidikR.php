<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaDidikM;
use PDF;

class PesertaDidikR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pesertaM = PesertaDidikM::all();
         $pesertaM = PesertadidikM::search(request('search'))->paginate(10);
         $vcari = request('search');
        return view('pesertadidik', compact('pesertaM', 'vcari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pesertadidik_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'namalengkap' => 'required',
            'jk' => 'required',
            'nilai' => 'required'
        ]);

    PesertadidikM::create($request->post());
    return redirect()->route('pesertadidik.index')->with('success', 'Peserta didik berhasil ditambahkan');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peserta = PesertadidikM::find($id);
        return view('pesertadidik_edit', compact('peserta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'namalengkap' => 'required',
            'jk' => 'required',
            'nilai' => 'required'
        ]);

        $data = request()->except(['_token', '_method', 'submit']);

    PesertadidikM::where('id', $id)->update($data);
    return redirect()->route('pesertadidik.index')->with('success', 'Peserta didik berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PesertadidikM::where('id', $id)->delete();
        return redirect()->route('pesertadidik.index')->with('success', 'Peserta didik berhasil dihapus');
    }

      public function pdf(){
        $pesertaM = PesertaDidikM::all();
        // return view('pesertadidik_pdf', compact('pesertaM'));
       
        $pdf = PDF::loadview('pesertadidik_pdf', ['pesertaM' => $pesertaM]);
        return $pdf->stream('pesertadidik.pdf');
    }
}
