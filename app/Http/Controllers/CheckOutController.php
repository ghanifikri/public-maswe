<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Midtrans\Notification;
use Midtrans\Transaction as MidtransTransaction;

class CheckOutController extends Controller
{
    public function __construct()
    {
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'provinces_id' => $request->province_id,
            'regencies_id' => $request->city_id,
            'districts_id' => $request->district_id,
        ]);

        $code = 'STORE-' . mt_rand(0000,9999);
        $carts = Cart::where('user_id', Auth::user()->id)
                        ->get();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'code' => $code,
            'total_price' => $request->total_price,
        ]);

        foreach($carts as $cart){
            $trx = 'TRX-' . mt_rand(0000,9999);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product->id,
                'quant' => $cart->quant,
                'price' => $cart->price,
                'amount' => $cart->amount,
                'size' => $cart->size,
                'code' => $trx
            ]);

        }

        Cart::where('user_id', Auth::user()->id)->delete();

        $this->getSnapRedirect($transaction);

        return redirect(route('success'));

    }

    public function getSnapRedirect(Transaction $transaction)
    {
        $orderId = $transaction->id.'-'.Str::random(5);
        $price = $transaction->total_price;

        $transaction->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$transaction->midtrans_booking_code}"
        ];

        $userData = [
            "first_name" => $transaction->User->name,
            "last_name" => "",
            "address" => $transaction->User->address,
            "city" => "",
            "postal_code" => "",
            "phone" => $transaction->User->phone_number,
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $transaction->User->name,
            "last_name" => "",
            "email" => $transaction->User->email,
            "phone" => $transaction->User->phone_number,
            "billing_address" => $userData,
            "shipping_address" => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'enabled_payments' => ['gopay','shopeepay','bank_transfer']
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();

            return $paymentUrl;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request)
    {
        $notif = $request->method() == 'POST' ? new Notification() : MidtransTransaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $transaction_id = explode('-', $notif->order_id)[0];
        $transaction = Transaction::find($transaction_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->payment_status = 'pending';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->payment_status = 'paid';
            }
        }
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'failed';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'failed';
            }
        }
        else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->payment_status = 'failed';
        }
        else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaction->payment_status = 'paid';
        }
        else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaction->payment_status = 'pending';
        }
        else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaction->payment_status = 'failed';
        }

        $transaction->save();
        return view('frontend.success');
    }
}
