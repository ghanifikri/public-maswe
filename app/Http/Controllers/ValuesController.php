<?php

namespace App\Http\Controllers;

use App\Models\admin\Founder;
use App\Models\admin\People;
use App\Models\admin\SectionHeader;
use App\Models\admin\SectionHero;
use Illuminate\Http\Request;

class ValuesController extends Controller
{
    public function index()
    {
        $heroSection = SectionHero::where('id_section', 'values')->first();
        $founder = Founder::all();
        $people = People::all();
        $headerSection = SectionHeader::where('id_section', 'headerPeople')->first();
        $linkImage = SectionHero::where('id_section','history')->orWhere('id_section', 'field')->orWhere('id_section','research')->get();
        return view('frontend.about.values.index',[
            'heroSection' => $heroSection,
            'founder' => $founder,
            'people' => $people,
            'linkImage' => $linkImage,
            'headerSection' => $headerSection
        ]);
    }
}
