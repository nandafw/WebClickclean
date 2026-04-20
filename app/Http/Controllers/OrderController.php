<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
            ->where('status', '!=', 'unpaid') // hanya exclude keranjang aktif
            ->latest()
            ->get();

        return view('users.riwayat_pesanan', compact('pesanans'));
    }
}