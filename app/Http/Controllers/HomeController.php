<?php

namespace App\Http\Controllers;

use App\Models\admin\About;
use App\Models\admin\HeaderVideo;
use App\Models\admin\Post;
use App\Models\admin\SectionTitle;
use App\Models\admin\sectionVideo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $headerVideo = HeaderVideo::get();
        $titleNews = SectionTitle::where('id_title', 'news')->first();
        $abouts = About::get();
        $news = Post::publish()->latest()->take(3)->get();
        $aboutKaligandu = sectionVideo::where('id_section', 'aboutKaligandu')->first();
        return view('frontend.home.index',[
            'headerVideo' => $headerVideo,
            'abouts' => $abouts,
            'titleNews' => $titleNews,
            'news' => $news,
            'aboutKaligandu' => $aboutKaligandu
        ]);
    }
}
