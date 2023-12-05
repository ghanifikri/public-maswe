<?php

namespace App\Http\Controllers;

use App\Models\admin\Research;
use App\Models\admin\SectionHeader;
use App\Models\admin\SectionHero;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index()
    {
        $heroSection = SectionHero::where('id_section','research')->first();
        $headerResearch = SectionHeader::where('id_section','research')->first();
        $research = Research::all();
        $linkImage = SectionHero::where('id_section','history')->orWhere('id_section', 'values')->orWhere('id_section','field')->get();
        return view('frontend.about.research.index',[
            'heroSection' => $heroSection,
            'headerResearch' => $headerResearch,
            'research' => $research,
            'linkImage' => $linkImage
        ]);
    }
}
