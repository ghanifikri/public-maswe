<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $pendapatanPerbulan = Transaction::whereMonth('created_at', $month)->where('payment_status','paid')->sum('total_price');
        $pendapatanPertahun = Transaction::whereYear('created_at', $year)->where('payment_status','paid')->sum('total_price');

        $total_harga = Transaction::select(DB::raw("CAST(SUM(total_price)as int) as total_price"))
                                    ->GroupBy(DB::raw("Month(created_at)"))
                                    ->pluck('total_price');
        $bulan = Transaction::select(DB::raw("MONTHNAME(created_at) as bulan"))
                                ->GroupBy(DB::raw("MONTHNAME(created_at)"))
                                ->pluck('bulan');

        return view('admin.index', compact('pendapatanPerbulan','pendapatanPertahun','total_harga','bulan'));
    }
}
