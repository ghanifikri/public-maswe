<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product_reviews;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $review = Product_reviews::whereUserId(Auth::user()->id)->count();
        $transactionsCount = Transaction::where('payment_status','waiting')->whereUserId(Auth::user()->id)->count(); 
        $transactions = Transaction::where('payment_status','waiting')->whereUserId(Auth::user()->id)->get(); 
        return view('user.index', compact('transactions','review', 'transactionsCount'));
    }
}
