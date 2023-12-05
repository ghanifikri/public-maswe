<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\KapasitasProduksi;
use App\Http\Requests\StoreKapasitasProduksiRequest;
use App\Http\Requests\UpdateKapasitasProduksiRequest;

class KapasitasProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kapasitasCount = KapasitasProduksi::count(); 
        $kapasitasProduksi = KapasitasProduksi::all();
        return view('admin.AboutPage.field.kapasitasProduksi.index', compact('kapasitasProduksi','kapasitasCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kapasitasCount = KapasitasProduksi::count();
        if ($kapasitasCount < 1) {
            return view('admin.AboutPage.field.kapasitasProduksi.create');
        } else {
            return redirect()->route('kapasitasProduksi.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKapasitasProduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKapasitasProduksiRequest $request)
    {
        KapasitasProduksi::create([
            'judul' => $request->judul,
            'description' => $request->description,
            'image' => parse_url($request->image)['path']
        ]);

        return redirect()->route('kapasitasProduksi.index')->with(['success' => 'data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\KapasitasProduksi  $kapasitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function show(KapasitasProduksi $kapasitasProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\KapasitasProduksi  $kapasitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function edit(KapasitasProduksi $kapasitasProduksi)
    {
        return view('admin.AboutPage.field.kapasitasProduksi.edit', compact('kapasitasProduksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKapasitasProduksiRequest  $request
     * @param  \App\Models\admin\KapasitasProduksi  $kapasitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKapasitasProduksiRequest $request, KapasitasProduksi $kapasitasProduksi)
    {
        $kapasitasProduksi->update([
            'judul' => $request->judul,
            'description' => $request->description,
            'image' => parse_url($request->image)['path']
        ]);

        return redirect()->route('kapasitasProduksi.index')->with(['success' => 'data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\KapasitasProduksi  $kapasitasProduksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kapasitasProduksi = KapasitasProduksi::findOrFail($id);
        $kapasitasProduksi->delete();
        if($kapasitasProduksi){
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
