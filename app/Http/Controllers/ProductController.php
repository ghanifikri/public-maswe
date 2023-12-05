<?php

namespace App\Http\Controllers;

use App\Models\admin\Attribute;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.produk.index', compact('products'));
    }

    public function detail($slug)
    {
        $attributes = Attribute::orderBy('id','DESC')->get();
        $product = Product::where('slug', $slug)->first();
        return view('frontend.produk.detail', compact('product','attributes'));
    }
}
