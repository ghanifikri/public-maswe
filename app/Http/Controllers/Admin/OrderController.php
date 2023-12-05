<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order_show', ['only' => ['index','show']]);
        $this->middleware('permission:order_update', ['only' => ['edit','update']]);
        $this->middleware('permission:order_delete', ['only' => 'destroy']);
    }
    public function index()
    {
        $orders = Transaction::orderBy('id','DESC')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Transaction::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Transaction::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Transaction::findOrFail($id);
        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->route('order.show', $order->id)->with(['success' > 'Status Order Berhasil Dirubah']);
    }

    public function destroy($id)
    {
        $order = Transaction::findOrFail($id);
        $order->delete();
        if ($order) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
        
    }
}
