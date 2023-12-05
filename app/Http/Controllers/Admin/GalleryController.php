<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\admin\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\StoreSectionTitleRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Requests\UpdateSectionTitleRequest;
use App\Models\admin\SectionTitle;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('admin.GalleryPage.index', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $gallery = $request->image;
        $path = parse_url($gallery)['path'];
        $fileName = basename($path);

        Gallery::create([
            'image' => $path,
            'nama' => $fileName,
            
        ]);
        return redirect()->route('dataGallery.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }

    public function hero()
    {
        $titleGallery = SectionTitle::where('id_title','gallery')->count();
        if ($titleGallery < 1) {
            return view('admin.GalleryPage.hero.create');
        } else {
            $titleGallery = SectionTitle::where('id_title', 'gallery')->first();
            return view('admin.GalleryPage.hero.index', compact('titleGallery'));
        }
    }

    public function storeHero(StoreSectionTitleRequest $request)
    {
        SectionTitle::create([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('galleryHero.index')->with(['success' => 'data berhasil ditambahkan']);
    }

    public function editHero($id)
    {
        $titleGallery = SectionTitle::findOrFail($id);
        return view('admin.GalleryPage.hero.edit', compact('titleGallery'));
    }

    public function updateHero(UpdateSectionTitleRequest $request, $id)
    {
        $titleNews = SectionTitle::findOrFail($id);
        $titleNews->update([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('galleryHero.index')->with(['success' => 'data berhasil diubah']);
    }
}
