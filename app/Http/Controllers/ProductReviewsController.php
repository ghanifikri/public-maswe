<?php
namespace App\Http\Controllers;
use App\Models\Product_reviews;
use App\Http\Requests\StoreProduct_reviewsRequest;
use App\Http\Requests\UpdateProduct_reviewsRequest;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Auth;

class ProductReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduct_reviewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct_reviewsRequest $request)
    {
        $product_info = Product::getProductBySlug($request->slug);
        $user = Auth::user()->id;
        $product = $product_info->id;
        $user_id = Product_reviews::where('user_id', $user)->count();
        $product_id = Product_reviews::where('product_id', $product)->count();

        if ($user_id && $product_id > 0) {
            return redirect()->back()->with('error', 'kamu sudah melakukan review');
        } else {
            Product_reviews::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_info->id,
                'status' => 'active',
                'review' => $request->review,
                'rate' => $request->rate
            ]);
            return redirect()->back()->with(['success' => 'Thank You!']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Product_reviews $product_reviews)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_reviews $product_reviews)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProduct_reviewsRequest  $request
     * @param  \App\Models\Product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct_reviewsRequest $request, Product_reviews $product_reviews)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_reviews $product_reviews)
    {
        //
    }
}
