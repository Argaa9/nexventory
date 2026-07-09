<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // KPI

        $totalBarang = Product::count();

        $totalKategori = Category::count();

        $totalDipinjam = Borrowing::where(
            'status',
            'Dipinjam'
        )->count();

        $totalRiwayat = Borrowing::count();

        // Ringkasan Inventaris

        $barangTersedia = Product::where(
            'status',
            'Tersedia'
        )->count();

        $barangDipinjam = Product::where(
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

        // Barang stok menipis

        $stokMenipisList = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->get();

        // Riwayat terbaru

        $riwayat = Borrowing::latest()
            ->take(10)
            ->get();

        // Grafik

        $grafikPeminjaman = Borrowing::select(
                DB::raw('MONTH(borrow_date) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view(
            'reports',
            compact(
                'totalBarang',
                'totalKategori',
                'totalDipinjam',
                'totalRiwayat',
                'barangTersedia',
                'barangDipinjam',
                'maintenance',
                'rusak',
                'stokMenipisList',
                'riwayat',
                'grafikPeminjaman'
            )
        );
    }

    public function exportPdf()
    {
        // Statistik
        $totalBarang = Product::count();

        $totalKategori = Category::count();

        $totalDipinjam = Borrowing::where(
            'status',
            'Dipinjam'
        )->count();

        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        // Data Barang
        $products = Product::with('category')->get();

        // Data Peminjaman Aktif
        $borrowings = Borrowing::with([
                'user',
                'product'
            ])
            ->where('status', 'Dipinjam')
            ->get();

        // Barang Stok Menipis
        $lowStocks = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->get();

        $pdf = Pdf::loadView(
            'pdf.inventory-report',
            compact(
                'totalBarang',
                'totalKategori',
                'totalDipinjam',
                'stokMenipis',
                'products',
                'borrowings',
                'lowStocks'
            )
        );

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download(
            'Inventory_Report.pdf'
        );
    }

    public function exportExcel()
    {
        $fileName = 'laporan_inventaris.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
                'attachment; filename="'.$fileName.'"',
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Kode Barang',
                'Nama Barang',
                'Kategori',
                'Stok',
                'Lokasi',
                'Status'
            ]);

            foreach (Product::with('category')->get() as $product)
            {
                fputcsv($file, [
                    $product->product_code,
                    $product->product_name,
                    optional($product->category)->name,
                    $product->stock,
                    $product->location,
                    $product->status
                ]);
            }

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }
}