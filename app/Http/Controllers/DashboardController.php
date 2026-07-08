<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Product::count();

        $totalKategori = Category::count();

        $sedangDipinjam = Borrowing::where(
            'status',
            'Dipinjam'
        )->count();

        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        $aktivitas = Borrowing::latest()
            ->take(5)
            ->get();

        $kembaliHariIni = Borrowing::whereDate(
            'return_date',
            now()
        )
        ->where('status', 'Dipinjam')
        ->get();

        $tersedia = Product::where(
            'status',
            'Tersedia'
        )->count();

        $dipinjam = Product::where(
            'status',
            'Dipinjam'
        )->count();

        $maintenance = Product::where(
            'status',
            'Maintenance'
        )->count();

        $rusak = Product::where(
            'status',
            'Rusak'
        )->count();

        return view(
            'dashboard',
            compact(
                'totalBarang',
                'totalKategori',
                'sedangDipinjam',
                'stokMenipis',
                'aktivitas',
                'kembaliHariIni',
                'tersedia',
                'dipinjam',
                'maintenance',
                'rusak'
            )
        );
    }
}