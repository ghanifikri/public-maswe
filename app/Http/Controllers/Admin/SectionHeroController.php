<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionHero;
use App\Http\Requests\UpdateSectionHeroRequest;
use App\Models\admin\SectionFont;
use App\Models\admin\SectionHero;

class SectionHeroController extends Controller
{
    public function history()
    {
        $heroSection = SectionHero::where('id_section', 'history')->count();
        if ($heroSection < 1) {
            return view('admin.AboutPage.history.hero.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeroAboutPage')->first();
            $fontDescription = SectionFont::where('name_values','subTitleHeroAboutPage')->first();
            $fontTitleLink = SectionFont::where('name_values','titleHeroAboutPageLink')->first();
            $heroSection = SectionHero::where('id_section', 'history')->first();
            return view('admin.AboutPage.history.hero.index', compact(['heroSection','fontTitleLink','fontTitle','fontDescription']));
        }
    }

    public function valuesPeople()
    {
        $heroSection = SectionHero::where('id_section', 'values')->count();
        if ($heroSection < 1) {
            return view('admin.AboutPage.valuesPeople.hero.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeroValues')->first();
            $fontTitleLink = SectionFont::where('name_values','titleHeroValuesLink')->first();
            $fontDescription = SectionFont::where('name_values', 'subTitleHeroValues')->first();
            $heroSection = SectionHero::where('id_section', 'values')->first();
            return view('admin.AboutPage.valuesPeople.hero.index', compact('heroSection','fontTitleLink','fontTitle','fontDescription'));
        }
    }

    public function field()
    {
        $heroSection = SectionHero::where('id_section', 'field')->count();
        if ($heroSection < 1) {
            return view('admin.AboutPage.field.hero.create');
        } else {
            $fontTitle = SectionFont::where('name_values','titleHeroField')->first();
            $fontTitleLink = SectionFont::where('name_values','titleHeroFieldLink')->first();
            $fontDescription = SectionFont::where('name_values', 'subTitleField')->first();
            $heroSection = SectionHero::where('id_section', 'field')->first();
            return view('admin.AboutPage.field.hero.index', compact('heroSection','fontTitleLink','fontTitle','fontDescription'));
        }
    }

    public function research()
    {
        $heroSection = SectionHero::where('id_section', 'research')->count();
        if ($heroSection < 1) {
            return view('admin.AboutPage.research.hero.create');
        } else {
            // $fontTitle = SectionFont::where('name_values','titleNews')->first();
            // $fontSubTitle = SectionFont::where('name_values','subTitleNews')->first();
            $heroSection = SectionHero::where('id_section', 'research')->first();
            return view('admin.AboutPage.research.hero.index', compact('heroSection'));
        }
    }

    public function store(StoreSectionHero $request)
    {
        SectionHero::create([
            'id_section' => $request->id_section,
            'title' => $request->title,
            'title_link' => $request->title_link,
            'description' => $request->description,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->back()->with(['success' => 'Section Hero berhasil ditambahkan']);
    }

    public function editHeroHistory($id)
    {
        $heroSection = SectionHero::findOrFail($id);
        return view('admin.AboutPage.history.hero.edit', compact('heroSection'));
    }

    public function editValuesPeople($id)
    {
        $heroSection = SectionHero::findOrFail($id);
        return view('admin.AboutPage.valuesPeople.hero.edit', compact('heroSection'));
    }

    public function editField($id)
    {
        $heroSection = SectionHero::findOrFail($id);
        return view('admin.AboutPage.field.hero.edit', compact('heroSection'));
    }

    public function editResearch($id)
    {
        $heroSection = SectionHero::findOrFail($id);
        return view('admin.AboutPage.research.hero.edit', compact('heroSection'));
    }

    public function update(UpdateSectionHeroRequest $request, $id)
    {
        $heroSection = SectionHero::findOrFail($id);
        $heroSection->update([
            'title' => $request->title,
            'title_link' => $request->title_link,
            'description' => $request->description,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->back()->with(['success' => 'Section Hero berhasil diubah']);
    }
}
