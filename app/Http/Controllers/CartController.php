<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\admin\Product;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with(['product','user'])->where('user_id', Auth::user()->id)->get();
        $provinces = Province::all();
        return view('frontend.cart.index', compact('carts','provinces'));
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
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        $already_cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->where('size', $request->size)->first();
        if($already_cart) {
            $already_cart->quant = $already_cart->quant + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($request->price * $request->quant[1]) + $already_cart->amount;

            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->size = $request->size;
            $cart->price = $request->price;
            $cart->quant = $request->quant[1];
            $cart->amount=($request->price * $request->quant[1]);
            $cart->save();
        }

        return back();     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        if($cart){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function cartUpdate(Request $request)
    {
        if($request->quant){
            foreach ($request->quant as $k=>$quant) {
                $id = $request->qty_id[$k];
                $cart = Cart::find($id);
                
                if ($quant > 0  && $cart) {
                    $cart->quant = $quant;
                    $cart->amount = $cart->price * $quant;
        
                    $cart->save();
                }
                
            }
            return back();
        }else{
            return back()->with('Cart Invalid!');
        }    
    }

    public function success()
    {
        return view('frontend.success');
    }
}
