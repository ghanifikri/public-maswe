<?php

namespace App\Http\Controllers;

use App\Models\admin\Category;
use App\Models\admin\Post;
use App\Models\admin\SectionTitle;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->categories = Category::all();
        $this->recentPost = Post::publish()->latest()->take(10)->get();
    }

    public function index()
    {
        $recentPost = $this->recentPost;
        $categories = $this->categories;
        $heroSection = SectionTitle::where('id_title', 'news')->first();
        $posts = Post::publish()->latest()->paginate(10);
        return view('frontend.news.index',[
            'heroSection' => $heroSection,
            'posts' => $posts,
            'categories' => $categories,
            'recentPost' => $recentPost
        ]);
    }

    public function search(Request $request)
    {
        $recentPost = $this->recentPost;
        $categories = $this->categories;
        $heroSection = SectionTitle::where('id_title', 'news')->first();

        if (!$request->get('keyword')) {
            return redirect()->route('news');
        }

        return view('frontend.news.search', [
            'heroSection' => $heroSection,
            'recentPost' => $recentPost,
            'categories' => $categories,
            'posts' => Post::search($request->keyword)
                ->paginate(10)
                ->appends(['keyword' => $request->keyword])
        ]);
    }

    public function category($slug)
    {
        $recentPost = $this->recentPost;
        $categories = $this->categories;
        $heroSection = SectionTitle::where('id_title', 'news')->first();
        $posts = Post::publish()->whereHas('kategori', function($query) use ($slug){
            return $query->where('slug', $slug);
        })->latest()->paginate(10);
        $category = Category::where('slug', $slug)->first();

        return view('frontend.news.category',[
            'heroSection' => $heroSection,
            'posts' => $posts,
            'categories' => $categories,
            'recentPost' => $recentPost,
            'category' => $category
        ]);
    }

    public function show($slug)
    {
        $recentPost = $this->recentPost;
        $categories = $this->categories;
        $heroSection = SectionTitle::where('id_title', 'news')->first();
        $posts = Post::where('slug', $slug)->first();
        return view('frontend.news.show',[
            'heroSection' => $heroSection,
            'posts' => $posts,
            'categories' => $categories,
            'recentPost' => $recentPost
        ]);
    }
}
