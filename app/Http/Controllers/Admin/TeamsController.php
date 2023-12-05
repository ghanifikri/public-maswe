<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Teams;
use App\Http\Requests\StoreTeamsRequest;
use App\Http\Requests\UpdateTeamsRequest;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Teams::all();
        return view('admin.AboutPage.field.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutPage.field.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamsRequest $request)
    {
        Teams::create([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('teams.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function show(Teams $teams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams)
    {
        return view('admin.AboutPage.field.team.edit', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamsRequest  $request
     * @param  \App\Models\admin\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamsRequest $request, Teams $teams)
    {
        $teams->update([
            'nama' => $request->nama,
            'image' => parse_url($request->image)['path'],
            'jabatan' => $request->jabatan,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'gmail' => $request->gmail
        ]);

        return redirect()->route('teams.index')->with(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teams = Teams::findOrFail($id);
        $teams->delete();
        if($teams){
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
