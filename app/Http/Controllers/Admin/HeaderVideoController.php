<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\HeaderVideo;
use App\Http\Requests\StoreHeaderVideoRequest;
use App\Http\Requests\UpdateHeaderVideoRequest;
use App\Models\admin\SectionFont;
use Illuminate\Support\Facades\DB;

class HeaderVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $headerVideo = DB::table('header_videos')->count();
        if ($headerVideo < 1) {
            return view('admin.HomePage.headerVideo.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeaderVideo')->first();
            $fontSubTitle = SectionFont::where('name_values','subTitleHeaderVideo')->first();
            $headerVideo = HeaderVideo::get();
            return view('admin.HomePage.headerVideo.index', compact('headerVideo','fontTitle','fontSubTitle'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHeaderVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHeaderVideoRequest $request)
    {
        HeaderVideo::create([
            'title' => $request->title,
            'sub_title' => $request-> sub_title,
            'video' => parse_url($request->video)['path']
        ]);

        return redirect()->route('header-video.index')->with(['success' => 'video header berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function show(HeaderVideo $headerVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(HeaderVideo $headerVideo)
    {
        return view('admin.HomePage.headerVideo.edit', compact('headerVideo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHeaderVideoRequest  $request
     * @param  \App\Models\admin\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHeaderVideoRequest $request, HeaderVideo $headerVideo)
    {
        $headerVideo->update([
            'title' => $request->title,
            'sub_title' => $request-> sub_title,
            'video' => parse_url($request->video)['path']
        ]);

        return redirect()->route('header-video.index')->with(['success' => 'header video berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeaderVideo $headerVideo)
    {
        //
    }
}
