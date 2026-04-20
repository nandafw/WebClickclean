<?php

namespace App\Http\Controllers;

use App\Models\Backend\Product;
use App\Models\Pesanan;
use App\Models\PesananDetails;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tambah ke keranjang
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $pesanan = Pesanan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'unpaid'
            ],
            [
                'tanggal' => now(),
                'jumlah_harga' => 0,
                'kode' => 'INV-' . time()
            ]
        );

        $detail = PesananDetails::where('product_id', $product->id)
            ->where('pesanan_id', $pesanan->id)
            ->first();

        if (!$detail) {
            PesananDetails::create([
                'product_id' => $product->id,
                'pesanan_id' => $pesanan->id,
                'jumlah' => $request->jumlah_pesan,
                'jumlah_harga' => $product->harga * $request->jumlah_pesan
            ]);
        } else {
            $detail->update([
                'jumlah' => $detail->jumlah + $request->jumlah_pesan,
                'jumlah_harga' => $detail->jumlah_harga + ($product->harga * $request->jumlah_pesan)
            ]);
        }

        $pesanan->update([
            'jumlah_harga' => $pesanan->jumlah_harga + ($product->harga * $request->jumlah_pesan)
        ]);

        return back()->with('success', 'Masuk keranjang');
    }

    // lihat cart
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->first();

        $pesanan_details = $pesanan ? PesananDetails::where('pesanan_id', $pesanan->id)->get() : [];

        $total = collect($pesanan_details)->sum('jumlah_harga');

        return view('users.cart', compact('pesanan', 'pesanan_details', 'total'));
    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->first();

        $pesanan_details = $pesanan ? PesananDetails::where('pesanan_id', $pesanan->id)->get() : [];
        
        $total = collect($pesanan_details)->sum('jumlah_harga');

        return view('users.checkout', compact('pesanan', 'pesanan_details'));
    }

    // hapus item
    public function delete($id)
    {
        $detail = PesananDetails::findOrFail($id);
        $pesanan = Pesanan::find($detail->pesanan_id);

        $pesanan->update([
            'jumlah_harga' => $pesanan->jumlah_harga - $detail->jumlah_harga
        ]);

        $detail->delete();

        return back()->with('success', 'Item dihapus');
    }
}