<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('users.booking');
    }

    public function create()
    {
        return view('users.booking');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'paket_layanan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'wilayah' => 'required'
        ]);

        Booking::create([
            'nama' => $request->nama,
            'paket_layanan' => $request->paket_layanan,
            'wilayah' => $request->wilayah,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('user.booking.index')
            ->with('success', 'Booking berhasil disimpan!');
    }

    public function history()
    {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('users.riwayat_booking', compact('bookings'));
    }
}