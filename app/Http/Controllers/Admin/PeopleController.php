<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\People;
use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;
use App\Models\admin\SectionFont;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::all();
        $fontName = SectionFont::where('name_values','titleNameFounder')->first();
        $fontJabatan = SectionFont::where('name_values', 'titleJabatan')->first();
        return view('admin.AboutPage.valuesPeople.people.index', compact('people','fontName','fontJabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutPage.valuesPeople.people.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePeopleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleRequest $request)
    {
        People::create([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('people.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        return view('admin.AboutPage.valuesPeople.people.edit', compact('people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleRequest  $request
     * @param  \App\Models\admin\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, People $people)
    {
        $people->update([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('people.index')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $people = People::findOrFail($id);
        $people->delete();
        if($people){
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
