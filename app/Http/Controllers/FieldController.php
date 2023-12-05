<?php

namespace App\Http\Controllers;

use App\Models\admin\FasilitasProduksi;
use App\Models\admin\KapasitasProduksi;
use App\Models\admin\SectionHeader;
use App\Models\admin\SectionHero;
use App\Models\admin\Teams;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $heroSection = SectionHero::where('id_section', 'field')->first();
        $headerFP = SectionHeader::where('id_section','fieldFasilitas')->first();
        $headerTeam = SectionHeader::where('id_section','fieldTeam')->first();
        $fasilitasProduksi = FasilitasProduksi::all();
        $kapasitasProduksi = KapasitasProduksi::get();
        $teams = Teams::all();
        $linkImage = SectionHero::where('id_section','history')->orWhere('id_section', 'values')->orWhere('id_section','research')->get();
        return view('frontend.about.field.index',[
            'fasilitasProduksi' => $fasilitasProduksi,
            'kapasitasProduksi' => $kapasitasProduksi,
            'heroSection' => $heroSection,
            'linkImage' => $linkImage,
            'headerFP' => $headerFP,
            'teams' => $teams,
            'headerTeam' => $headerTeam
        ]);
    }

    public function show($id)
    {
        $data = FasilitasProduksi::findOrFail($id);
        return view('frontend.about.field.show')->with([
            'data' => $data
        ]);
    }
}
