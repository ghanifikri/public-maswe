<?php

namespace App\Http\Controllers;

use App\Models\admin\LongHistory;
use App\Models\admin\SectionHeader;
use App\Models\admin\SectionHero;
use App\Models\admin\sectionVideo;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $heroSection = SectionHero::where('id_section', 'history')->first();
        $aboutMaswe = sectionVideo::where('id_section', 'aboutMaswe')->first();
        $histories = LongHistory::all();
        $linkImage = SectionHero::where('id_section','values')->orWhere('id_section', 'field')->orWhere('id_section','research')->get();
        return view('frontend.about.history.index',[
            'heroSection' => $heroSection,
            'aboutMaswe' => $aboutMaswe,
            'histories' => $histories,
            'linkImage' => $linkImage
        ]);
    }
}
