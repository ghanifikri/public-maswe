<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMasweRequest;
use App\Http\Requests\UpdateMasweRequest;
use App\Models\admin\SectionFont;
use App\Models\admin\sectionVideo;

class AboutMasweController extends Controller
{
    public function index()
    {
        $aboutKaligandu = sectionVideo::where('id_section', 'aboutMaswe')->count();
        if ($aboutKaligandu < 1) {
            return view('admin.AboutPage.history.aboutMaswe.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleAboutMaswe')->first();
            $fontOther = SectionFont::where('name_values','titleOther')->first();
            $fontDescription = SectionFont::where('name_values','titleDescriptionAboutMaswe')->first();
            $aboutMaswe = sectionVideo::where('id_section', 'aboutMaswe')->first();
            return view('admin.AboutPage.history.aboutMaswe.index', compact('aboutMaswe', 'fontTitle', 'fontOther','fontDescription'));
        }

    }

    public function store(StoreMasweRequest $request)
    {
        sectionVideo::create([
            'id_section' => $request->id_section,
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'video_url' => $request->video_url,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('aboutMaswe.index')->with(['success' => 'about maswe berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $aboutMaswe = sectionVideo::findOrFail($id);
        return view('admin.AboutPage.history.aboutMaswe.edit', compact('aboutMaswe'));
    }

    public function update(UpdateMasweRequest $request, $id)
    {
        $aboutMaswe = sectionVideo::findOrFail($id);
        $aboutMaswe->update([
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'video_url' => $request->video_url,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('aboutMaswe.index')->with(['success' => 'about maswe berhasil diubah']);
    }
}
