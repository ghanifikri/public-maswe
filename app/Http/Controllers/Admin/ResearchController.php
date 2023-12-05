<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Research;
use App\Http\Requests\StoreResearchRequest;
use App\Http\Requests\UpdateResearchRequest;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $research = Research::all();
        return view('admin.AboutPage.research.dataResearch.index', compact('research'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutPage.research.dataResearch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResearchRequest $request)
    {
        Research::create([
            'nama_research' => $request->nama_research,
            'image' => parse_url($request->image)['path'],
            'description' => $request->description
        ]);

        return redirect()->route('dataResearch.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        return view('admin.AboutPage.research.dataResearch.edit', compact('research'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResearchRequest  $request
     * @param  \App\Models\admin\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResearchRequest $request, Research $research)
    {
        $research->update([
            'nama_research' => $request->nama_research,
            'image' => parse_url($request->image)['path'],
            'description' => $request->description
        ]);

        return redirect()->route('dataResearch.index')->with(['success' => 'data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $research = Research::findOrFail($id);
        $research->delete();
        if($research){
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
