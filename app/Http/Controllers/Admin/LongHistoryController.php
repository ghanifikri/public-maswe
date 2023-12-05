<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\admin\LongHistory;
use App\Http\Requests\StoreLongHistoryRequest;
use App\Http\Requests\UpdateLongHistoryRequest;
use App\Models\admin\SectionFont;

class LongHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $longHistory = LongHistory::all();
        $fontTitle = SectionFont::where('name_values','titleLongHistories')->first();
        $fontSubTitle = SectionFont::where('name_values', 'titleDescription')->first();
        return view('admin.AboutPage.history.longHistory.index', compact('longHistory','fontTitle','fontSubTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutPage.history.longHistory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLongHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLongHistoryRequest $request)
    {
        LongHistory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => parse_url($request->image)['path']
        ]);

        return redirect()->route('longHistory.index')->with(['success' => 'long history berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\LongHistory  $longHistory
     * @return \Illuminate\Http\Response
     */
    public function show(LongHistory $longHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\LongHistory  $longHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(LongHistory $longHistory)
    {
        return view('admin.AboutPage.history.longHistory.edit', compact('longHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLongHistoryRequest  $request
     * @param  \App\Models\admin\LongHistory  $longHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLongHistoryRequest $request, LongHistory $longHistory)
    {
        $longHistory->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => parse_url($request->image)['path']
        ]);

        return redirect()->route('longHistory.index')->with(['success' => 'long history berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\LongHistory  $longHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $longHistory = LongHistory::findOrFail($id);
        $longHistory->delete();
        if($longHistory){
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
