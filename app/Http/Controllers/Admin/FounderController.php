<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Founder;
use App\Http\Requests\StoreFounderRequest;
use App\Http\Requests\UpdateFounderRequest;
use App\Models\admin\SectionFont;

class FounderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $founderCount = Founder::count();
        $founder = Founder::all();
        $fontName = SectionFont::where('name_values','titleNameFounder')->first();
        $fontJabatan = SectionFont::where('name_values', 'titleJabatan')->first();
        return view('admin.AboutPage.valuesPeople.founder.index', compact('founder', 'founderCount','fontName','fontJabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $founderCount = Founder::count();
        if ($founderCount < 2) {
            return view('admin.AboutPage.valuesPeople.founder.create');
        } else {
            return redirect()->route('founder.index');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFounderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFounderRequest $request)
    {
        Founder::create([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('founder.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Founder  $founder
     * @return \Illuminate\Http\Response
     */
    public function show(Founder $founder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Founder  $founder
     * @return \Illuminate\Http\Response
     */
    public function edit(Founder $founder)
    {
        return view('admin.AboutPage.valuesPeople.founder.edit', compact('founder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFounderRequest  $request
     * @param  \App\Models\admin\Founder  $founder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFounderRequest $request, Founder $founder)
    {
        $founder->update([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('founder.index')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Founder  $founder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $founder = Founder::findOrFail($id);
        $founder->delete();
        if($founder){
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
