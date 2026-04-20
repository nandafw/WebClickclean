<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Pesanan;
use App\Models\User;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    { 
        $totalProduct = Product::count();
        $totalOrder = Pesanan::count();
        $totalCustomer = User::where('role', 'user')->count();
        $totalUser = User::count();

        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];

        foreach ($users as $user) {
            $months[] = 'Bulan ' . $user->month;
            $totals[] = $user->total;
        }

        $userThisMonth = User::whereMonth('created_at', now()->month)->count();
        $userLastMonth = User::whereMonth('created_at', now()->subMonth()->month)->count();

        $growth = $userLastMonth > 0
            ? (($userThisMonth - $userLastMonth) / $userLastMonth) * 100
            : 0;

        return view('admin.backend.index', compact(
            'totalProduct',
            'totalOrder',
            'totalCustomer',
            'totalUser',
            'months',
            'totals',
            'userThisMonth',
            'growth'
        ));
    }
}