<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\StoreSectionTitleRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Http\Requests\UpdateSectionTitleRequest;
use App\Models\admin\Attribute;
use App\Models\admin\Product;
use App\Models\admin\ProductAttribute;
use App\Models\admin\ProductImage;
use App\Models\admin\SectionTitle;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.ProductPage.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ProductPage.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'kategori' => $request->kategori,
            'summary' => $request->summary,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return redirect()->route('prod.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributes = Attribute::all();
        $product = Product::findOrFail($id);
        $productImages = ProductImage::where('product_id', $id)->get();
        $productAttributes = ProductAttribute::where('product_id', $id)->get();
        return view('admin.ProductPage.product.edit', compact('product','productImages','attributes','productAttributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'kategori' => $request->kategori,
            'summary' => $request->summary,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return redirect()->route('prod.index')->with(['success' => 'data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        if($product){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function hero()
    {
        $titleProduct = SectionTitle::where('id_title','product')->count();
        if ($titleProduct < 1) {
            return view('admin.ProductPage.hero.create');
        } else {
            $titleProduct = SectionTitle::where('id_title', 'product')->first();
            return view('admin.ProductPage.hero.index', compact('titleProduct'));
        }
    }

    public function heroStore(StoreSectionTitleRequest $request)
    {
        SectionTitle::create([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('productHero.index')->with(['success' => 'data berhasil ditambahkan']);
    }

    public function heroEdit($id)
    {
        $titleProduct = SectionTitle::findOrFail($id);
        return view('admin.ProductPage.hero.edit', compact('titleProduct'));
    }

    public function heroUpdate(UpdateSectionTitleRequest $request, $id)
    {
        $titleProduct = SectionTitle::findOrFail($id);
        $titleProduct->update([
            'title' => $request->title,
            'id_title' => Str::slug($request->title),
            'sub_title' => $request-> sub_title,
            'background' => parse_url($request->background)['path']
        ]);

        return redirect()->route('productHero.index')->with(['success' => 'data berhasil diubah']);
    }
}
