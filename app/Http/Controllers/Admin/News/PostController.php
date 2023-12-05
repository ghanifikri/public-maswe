<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;

use App\Models\admin\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\admin\Category;
use App\Models\admin\SectionFont;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : 'publish' ;
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();
        $fontTitle = SectionFont::where('name_values','titlePost')->first();
        $fontSubTitle = SectionFont::where('name_values','subTitlePost')->first();

        if ($request->get('keyword')) {
            $posts->Search($request->get('keyword'));
        }

        return view('admin.HomePage.news.post.index', [
            'posts' => $posts->paginate(5)->withQueryString(),
            'statusSelected' => $statusSelected,
            'fontTitle' => $fontTitle,
            'fontSubTitle' => $fontSubTitle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.HomePage.news.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->judul = $request->judul;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->thumbnail = parse_url($request->thumbnail)['path'];
        $post->content = $request->content;
        $post->status = $request->status;
        $post->user_id = Auth::user()->id;
        $post->save();

        foreach ($request->category as $categories_id) {
            $post->attachCategories($categories_id);
        }

        return redirect()->route('post.index')->with(['success' => 'berita berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $fontTitle = SectionFont::where('name_values','titlePost')->first();
        $fontSubTitle = SectionFont::where('name_values','subTitlePost')->first();
        return view('admin.HomePage.news.post.show', compact('post','fontTitle','fontSubTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.HomePage.news.post.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'description' => $request->description,
            'thumbnail' => parse_url($request->thumbnail)['path'],
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($post->kategori as $category) {
            $post->detachCategories($category->id);
        }

        foreach ($request->category as $categories_id) {
            $post->attachCategories($categories_id);
        }

        return redirect()->route('post.index')->with(['success' => 'berita berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if($post){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
