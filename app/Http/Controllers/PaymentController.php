<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetails;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    public function payment($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $details = PesananDetails::where('pesanan_id', $id)->get();

        // MIDTRANS CONFIG
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'INV-' . $pesanan->id . '-' . time(),
                'gross_amount' => $pesanan->jumlah_harga,
            ],
                'customer_details' => [
                'first_name' => $pesanan->nama,
                'phone' => $pesanan->no_hp,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('users.payment', compact('pesanan', 'details', 'snapToken'));
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan_details = PesananDetails::where('pesanan_id', $id)->get();

        return view('users.invoice', compact('pesanan', 'pesanan_details'));
    }

    // CALLBACK MIDTRANS
   public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $signature = hash("sha512",
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature == $request->signature_key) {

            // ambil ID dari order_id
            $explode = explode('-', $request->order_id);
            $pesanan_id = $explode[1];

            $pesanan = Pesanan::find($pesanan_id);

            if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $pesanan->update(['status' => 'success']);
            } elseif ($request->transaction_status == 'pending') {
                $pesanan->update(['status' => 'pending']);
            } else {
                $pesanan->update(['status' => 'failed']);
            }
        }
    }

    public function success($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'success']); 

        return redirect()->route('invoice', $id);
    }

    public function pending($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'pending']);

        return redirect()->route('invoice', $id);
    }

    public function failed($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'failed']);

        return redirect()->route('invoice', $id);
    }
}