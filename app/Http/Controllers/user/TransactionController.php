<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with('transaction.user')
                                            ->whereHas('transaction', function($transaction){
                                                $transaction->where('user_id', Auth::user()->id);
                                            })->get();
        
        return view('user.transactions.index', compact('transactions'));
    }
}
