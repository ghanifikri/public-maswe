<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product_reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{ 

    public function index()
    {
        $reviews = Product_reviews::where('user_id', Auth::user()->id)->get();
        return view('user.reviews.index', compact('reviews'));
    }

    public function edit($id)
    {
        $review = Product_reviews::findOrFail($id);
        return view('user.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Product_reviews::findOrFail($id);
        $review->update([
            'rate' => $request->rate,
            'review' => $request->review
        ]);

        return redirect()->route('reviews');
    }

    public function destroy($id)
    {
        $review = Product_reviews::findOrFail($id);
        $review->delete();

        if($review){
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
