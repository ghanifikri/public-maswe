<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeaderSectionRequest;
use App\Http\Requests\UpdateHeaderSectionRequest;
use App\Models\admin\SectionFont;
use App\Models\admin\SectionHeader;

class SectionHeaderController extends Controller
{
    public function valuesPeople()
    {
        $headerSection = SectionHeader::where('id_section', 'headerPeople')->count();
        if ($headerSection < 1) {
            return view('admin.AboutPage.valuesPeople.headerSection.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeaderValues')->first();
            $fontSubTitle = SectionFont::where('name_values', 'titleHeaderDescription')->first();
            $headerSection = SectionHeader::where('id_section', 'headerPeople')->first();
            return view('admin.AboutPage.valuesPeople.headerSection.index', compact('headerSection','fontTitle','fontSubTitle'));
        }
    }

    public function fieldFasilitas()
    {
        $headerSection = SectionHeader::where('id_section', 'fieldFasilitas')->count();
        if ($headerSection < 1) {
            return view('admin.AboutPage.field.headerFasilitasProduksi.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeaderField')->first();
            $fontSubTitle = SectionFont::where('name_values', 'titleSubHeaderField')->first();
            $headerSection = SectionHeader::where('id_section', 'fieldFasilitas')->first();
            return view('admin.AboutPage.field.headerFasilitasProduksi.index', compact('headerSection','fontTitle','fontSubTitle'));
        }
    }
    public function fieldTeam()
    {
        $headerSection = SectionHeader::where('id_section', 'fieldTeam')->count();
        if ($headerSection < 1) {
            return view('admin.AboutPage.field.headerTeam.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeaderTeam')->first();
            $fontSubTitle = SectionFont::where('name_values', 'titleSubHeaderTeam')->first();
            $headerSection = SectionHeader::where('id_section', 'fieldTeam')->first();
            return view('admin.AboutPage.field.headerTeam.index', compact('headerSection','fontTitle','fontSubTitle'));
        }
    }

    public function research()
    {
        $headerSection = SectionHeader::where('id_section', 'research')->count();
        if ($headerSection < 1) {
            return view('admin.AboutPage.research.headerResearch.create');
        } else {
            // $fontTitle = SectionFont::where('name_values','titleNews')->first();
            // $fontSubTitle = SectionFont::where('name_values','subTitleNews')->first();
            $headerSection = SectionHeader::where('id_section', 'research')->first();
            return view('admin.AboutPage.research.headerResearch.index', compact('headerSection'));
        }
    }

    public function store(StoreHeaderSectionRequest $request)
    {
        SectionHeader::create([
            'id_section' => $request->id_section,
            'title' => $request->title,
            'sub_title' => $request->sub_title
        ]);

        return redirect()->back()->with(['success' => 'data berhasil ditambahkan!']);
    }

    public function editValuesPeople($id)
    {
        $headerSection = SectionHeader::findOrFail($id);
        return view('admin.AboutPage.valuesPeople.headerSection.edit', compact('headerSection'));
    }

    public function editFieldFasilitas($id)
    {
        $headerSection = SectionHeader::findOrFail($id);
        return view('admin.AboutPage.field.headerFasilitasProduksi.edit', compact('headerSection'));
    }

    public function editFieldTeam($id)
    {
        $headerSection = SectionHeader::findOrFail($id);
        return view('admin.AboutPage.field.headerTeam.edit', compact('headerSection'));
    }

    public function editResearch($id)
    {
        $headerSection = SectionHeader::findOrFail($id);
        return view('admin.AboutPage.research.headerResearch.edit', compact('headerSection'));
    }

    public function update(UpdateHeaderSectionRequest $request, $id)
    {
        $headerSection = SectionHeader::findOrFail($id);
        $headerSection->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title
        ]);

        return redirect()->back()->with(['success' => 'data berhasil diubah!']);
    }
}
