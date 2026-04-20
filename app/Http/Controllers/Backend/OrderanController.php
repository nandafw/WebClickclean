<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class OrderanController extends Controller
{
    public function index()
    {
        // ambil semua data hasil dari PaymentController (user flow)
        $pesanans = Pesanan::latest()->get();

        return view('admin.backend.orders.index', compact('pesanans'));
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Data Berhasil di Hapus');
    }
}