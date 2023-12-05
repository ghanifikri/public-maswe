<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\FasilitasProduksi;
use App\Http\Requests\StoreFasilitasProduksiRequest;
use App\Http\Requests\UpdateFasilitasProduksiRequest;
use App\Models\admin\SectionFont;

class FasilitasProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fontTitle = SectionFont::where('name_values','titleFasilitasProduksi')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleSubFasilitasProduksi')->first();
        $fasilitasProduksi = FasilitasProduksi::all();
        return view('admin.AboutPage.field.fasilitasProduksi.index', compact('fasilitasProduksi','fontTitle','fontSubTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutPage.field.fasilitasProduksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFasilitasProduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFasilitasProduksiRequest $request)
    {
        FasilitasProduksi::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'image' => parse_url($request->image)['path'],
            'description' => $request->description
        ]);

        return redirect()->route('fasilitasProduksi.index')->with(['success' => 'data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\FasilitasProduksi  $fasilitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function show(FasilitasProduksi $fasilitasProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\FasilitasProduksi  $fasilitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function edit(FasilitasProduksi $fasilitasProduksi)
    {
        return view('admin.AboutPage.field.fasilitasProduksi.edit', compact('fasilitasProduksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFasilitasProduksiRequest  $request
     * @param  \App\Models\admin\FasilitasProduksi  $fasilitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFasilitasProduksiRequest $request, FasilitasProduksi $fasilitasProduksi)
    {
        $fasilitasProduksi->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'image' => parse_url($request->image)['path'],
            'description' => $request->description
        ]);

        return redirect()->route('fasilitasProduksi.index')->with(['success' => 'data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\FasilitasProduksi  $fasilitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasilitasProduksi = FasilitasProduksi::findOrFail($id);
        $fasilitasProduksi->delete();
        if($fasilitasProduksi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
