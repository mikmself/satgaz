<?php

namespace App\Http\Controllers;

use App\Mail\RecivePaymentEmail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            $order = Order::find($request->order_id);
            $user = User::find($order->owner_id);
            if ($request->transaction_status == 'capture') {
                $order->update(['payment_status' => "paid"]);
                $data_order = [
                    'order_id' => $order->id,
                    'customer_name' => $user->name,
                    'total_payment' => $order->total_price,
                    'order_date' => $order->created_at,
                    'text_style' => 'text-black-600',
                    'bg_body' => 'bg-white',
                    'bg_card' => 'bg-white-500',
                    'title' => 'Pembayaran Bouquet Satgaz Sukses!',
                    'text_header' => 'Pembayran Bouquet Satgaz Sukses.',
                    'text_desc' => 'Terimakasih telah mempercayakan Bouquet Satgaz sebagai solusi bouquet acaramu.',
                    'text_closing' => 'Bouquetmu akan segera kami proses dan online dalam waktu yang dekat!',
                ];
                Mail::to($user->email)->send(new RecivePaymentEmail($data_order));
            } elseif ($request->transaction_status == 'expire') {
                $order->update(['payment_status' => "expired"]);
                $data_order = [
                    'order_id' => $order->id,
                    'customer_name' => $user->name,
                    'total_payment' => $order->total_price,
                    'order_date' => $order->created_at,
                    'text_style' => 'text-white',
                    'bg_body' => 'bg-red-500',
                    'bg_card' => 'bg-red-700',
                    'title' => 'Pembayaran Bouquet Satgaz Kedaluwarsa!',
                    'text_header' => 'Pembayaran Bouquet Satgaz Kedaluwarsa.',
                    'text_desc' => 'Maaf, pembayaran anda telah kedaluarsa.',
                    'text_closing' => 'Silahkan buat transaksi ulang dan melakukan pembayaran sebelum jatuh tempo!',
                ];
                Mail::to($user->email)->send(new RecivePaymentEmail($data_order));
            } elseif ($request->transaction_status == 'cancel') {
                $order->update(['payment_status' => "cancel"]);
                $data_order = [
                    'order_id' => $order->id,
                    'customer_name' => $user->name,
                    'total_payment' => $order->total_price,
                    'order_date' => $order->created_at,
                    'text_style' => 'text-black-600',
                    'bg_body' => 'bg-red-500',
                    'bg_card' => 'bg-red-700',
                    'title' => 'Pembayaran Telah Dibatalkan!',
                    'text_header' => 'Pembayaran Bouquet Satgaz Dibatalkan.',
                    'text_desc' => 'Maaf, pembayaran anda telah dibatalkan.',
                    'text_closing' => 'Silahkan buat transaksi ulang dan melakukan pembayaran dengan transaksi yang sah',
                ];
                Mail::to($user->email)->send(new RecivePaymentEmail($data_order));
            } elseif ($request->transaction_status == 'pending') {
                $order->update(['payment_status' => "pending"]);
            } else {
                $order->update(['payment_status' => "cancel"]);
                $data_order = [
                    'order_id' => $order->id,
                    'customer_name' => $user->name,
                    'total_payment' => $order->total_price,
                    'order_date' => $order->created_at,
                    'text_style' => 'text-black-600',
                    'bg_body' => 'bg-red-500',
                    'bg_card' => 'bg-red-700',
                    'title' => 'Pembayaran gagal karena suatu hal',
                    'text_header' => 'Pembayaran Bouquet Satgaz gagal karena suatu hal.',
                    'text_desc' => 'Maaf, pembayaran anda gagal karena suatu hal.',
                    'text_closing' => 'Silahkan buat transaksi ulang!',
                ];
                Mail::to($user->email)->send(new RecivePaymentEmail($data_order));
            }
        } else {
            Log::error('hash key not valid');
        }
    }
}
