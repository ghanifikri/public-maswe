<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\admin\SectionFont;
use App\Models\admin\sectionVideo;
use Illuminate\Http\Request;

class AboutKaliganduController extends Controller
{
    public function index()
    {
        $aboutKaligandu = sectionVideo::where('id_section', 'aboutKaligandu')->count();
        if ($aboutKaligandu < 1) {
            return view('admin.HomePage.aboutKaligandu.create');
        } else {
            $fontTitle1 = SectionFont::where('name_values','titleArea1')->first();
            $fontTitle2 = SectionFont::where('name_values','titleArea2')->first();
            $fontTitle3 = SectionFont::where('name_values','titleArea3')->first();
            $fontTitle4 = SectionFont::where('name_values','titleArea4')->first();
            $aboutKaligandu = sectionVideo::where('id_section', 'aboutKaligandu')->first();
            return view('admin.HomePage.aboutKaligandu.index', compact('aboutKaligandu', 'fontTitle1', 'fontTitle2','fontTitle3','fontTitle4'));
        }

    }

    public function store(StoreAreaRequest $request)
    {
        sectionVideo::create([
            'id_section' => $request->id_section,
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'title_four' => $request->title_four,
            'video_url' => $request->video_url,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('aboutKaligandu.index')->with(['success' => 'Judul area berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $aboutKaligandu = sectionVideo::findOrFail($id);
        return view('admin.HomePage.aboutKaligandu.edit', compact('aboutKaligandu'));
    }

    public function update(UpdateAreaRequest $request, $id)
    {
        $aboutKaligandu = sectionVideo::findOrFail($id);
        $aboutKaligandu->update([
            'title_one' => $request->title_one,
            'title_two' => $request->title_two,
            'title_three' => $request->title_three,
            'title_four' => $request->title_four,
            'video_url' => $request->video_url,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('aboutKaligandu.index')->with(['success' => 'Judul area berhasil diubah']);
    }
}
