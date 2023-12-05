<?php

namespace App\Http\Controllers;

use App\Models\admin\SectionTitle;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $heroSection = SectionTitle::where('id_title','gallery')->first();
        return view('frontend.gallery.index',[
            'heroSection' => $heroSection
        ]);
    }
}
