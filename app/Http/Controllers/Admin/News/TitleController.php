<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSectionTitleRequest;
use App\Http\Requests\UpdateSectionTitleRequest;
use App\Models\admin\SectionFont;
use App\Models\admin\SectionTitle;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function index()
    {
        $titleNews = SectionTitle::where('id_title', 'news')->count();
        if ($titleNews < 1) {
            return view('admin.HomePage.news.title.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleNews')->first();
            $fontSubTitle = SectionFont::where('name_values','subTitleNews')->first();
            $titleNews = SectionTitle::where('id_title', 'news')->first();
            return view('admin.HomePage.news.title.index', compact('titleNews', 'fontTitle', 'fontSubTitle'));
        }

    }

    public function store(StoreSectionTitleRequest $request)
    {
        SectionTitle::create([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('title.index')->with(['success' => 'judul berita berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $titleNews = SectionTitle::findOrFail($id);
        return view('admin.HomePage.news.title.edit', compact('titleNews'));
    }

    public function update(UpdateSectionTitleRequest $request, $id)
    {
        $titleNews = SectionTitle::findOrFail($id);
        $titleNews->update([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('title.index')->with(['success' => 'judul berita berhasil diubah']);
    }
}
