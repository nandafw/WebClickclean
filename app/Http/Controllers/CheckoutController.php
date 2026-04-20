<?php

namespace App\Http\Controllers;

use App\Models\Backend\Product;
use App\Models\Pesanan;
use App\Models\PesananDetails;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->first();

        $pesanan_details = $pesanan ? PesananDetails::where('pesanan_id', $pesanan->id)->get() : [];

        return view('users.checkout', compact('pesanan', 'pesanan_details'));
    }

    public function process(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('payment', $pesanan->id);
    }

    public function buy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        Pesanan::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->delete();

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'tanggal' => now(),
            'status' => 'unpaid',
            'jumlah_harga' => $product->harga * $request->jumlah_pesan,
            'kode' => 'INV-' . $product->id . '-' . time() 
        ]);

        PesananDetails::create([
            'pesanan_id' => $pesanan->id,
            'product_id' => $product->id,
            'jumlah' => $request->jumlah_pesan,
            'jumlah_harga' => $product->harga * $request->jumlah_pesan
        ]);

        return redirect()->route('checkout.index');
    }

    public function direct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'tanggal' => now(),
            'status' => 'unpaid',
            'jumlah_harga' => $product->harga * $request->jumlah_pesan,
            'kode' => 'INV-' . time()
        ]);

        PesananDetails::create([
            'pesanan_id' => $pesanan->id,
            'product_id' => $product->id,
            'jumlah' => $request->jumlah_pesan,
            'jumlah_harga' => $product->harga * $request->jumlah_pesan
        ]);

        return redirect()->route('payment', $pesanan->id);
    }
}