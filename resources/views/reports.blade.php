<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Inventaris - Nexventory</title>

<script src="https://cdn.tailwindcss.com"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
background:radial-gradient(circle at top,#0b0f1a,#05060a);
}
</style>

</head>

<body class="text-white min-h-screen">

@include('layouts.header')

<!-- BACKGROUND -->
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-1/2 -translate-x-1/2
                w-[700px] h-[700px]
                bg-red-500/10 blur-[180px] rounded-full">
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5 mb-8">

        <div>
            <h1 class="text-5xl font-bold">
                Laporan Inventaris
            </h1>

            <p class="text-white/50 mt-3">
                Analisis inventaris dan aktivitas peminjaman barang.
            </p>
        </div>

<div class="flex flex-wrap gap-4">

@if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')

<a href="{{ route('reports.pdf') }}"
   class="inline-flex items-center gap-2
          px-6 py-3 rounded-2xl
          bg-gradient-to-r from-red-500 via-pink-500 to-red-600
          text-white font-semibold
          shadow-xl shadow-red-500/20
          hover:scale-105 transition">

    📄 <span>Export PDF</span>

</a>

<a href="{{ route('reports.excel') }}"
   class="inline-flex items-center gap-2
          px-6 py-3 rounded-2xl
          bg-gradient-to-r from-green-500 via-emerald-500 to-green-600
          text-white font-semibold
          shadow-xl shadow-green-500/20
          hover:scale-105 transition">

    📊 <span>Export Excel</span>

</a>

@endif

</div>

    </div>

    <!-- KPI -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">📦</div>

            <p class="text-white/50 mt-3">
                Total Barang
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalBarang }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">🏷️</div>

            <p class="text-white/50 mt-3">
                Total Kategori
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalKategori }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">🔄</div>

            <p class="text-white/50 mt-3">
                Sedang Dipinjam
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalDipinjam }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-gradient-to-r from-red-500 to-pink-500">

            <div class="text-4xl">📜</div>

            <p class="mt-3">
                Riwayat Peminjaman
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalRiwayat }}
            </h2>

        </div>

    </div>

    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8">

    <h2 class="text-2xl font-bold mb-6">
        Grafik Peminjaman Barang
    </h2>

    <div style="height:400px">

        <canvas id="borrowChart"></canvas>

    </div>

</div>

    <!-- 2 KOLOM -->
    <div class="grid lg:grid-cols-3 gap-6 mb-8">

        <!-- KIRI -->
        <div class="lg:col-span-2 bg-white/5 rounded-2xl border border-white/10 p-6">

            <h2 class="text-2xl font-bold mb-5">
                Ringkasan Inventaris
            </h2>

            <table class="w-full">

                <tr class="border-b border-white/10">
                    <td class="py-4">Barang Tersedia</td>
                    <td class="text-right font-bold">
                        {{ $barangTersedia }}
                    </td>
                </tr>

                <tr class="border-b border-white/10">
                    <td class="py-4">Barang Dipinjam</td>
                    <td class="text-right font-bold">
                        {{ $barangDipinjam }}
                    </td>
                </tr>

                <tr class="border-b border-white/10">
                    <td class="py-4">Maintenance</td>
                    <td class="text-right font-bold">
                        {{ $maintenance }}
                    </td>
                </tr>

                <tr>
                    <td class="py-4">Rusak</td>
                    <td class="text-right font-bold">
                        {{ $rusak }}
                    </td>
                </tr>

            </table>

        </div>

        <!-- KANAN -->
        <div class="bg-white/5 rounded-2xl border border-white/10 p-6">

            <h2 class="text-xl font-bold mb-5">
                Statistik Cepat
            </h2>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20">
                    <p class="text-green-400 text-sm">
                        Barang Aktif
                    </p>

                    <h3 class="text-2xl font-bold">
                        {{ $barangTersedia }}
                    </h3>
                </div>

                <div class="p-4 rounded-xl bg-yellow-500/10 border border-yellow-500/20">
                    <p class="text-yellow-400 text-sm">
                        Stok Menipis
                    </p>

                    <h3 class="text-2xl font-bold">
                        {{ count($stokMenipisList) }}
                    </h3>
                </div>

                <div class="p-4 rounded-xl bg-blue-500/10 border border-blue-500/20">
                    <p class="text-blue-400 text-sm">
                        Total Transaksi
                    </p>

                    <h3 class="text-2xl font-bold">
                        {{ $totalRiwayat }}
                    </h3>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK MENIPIS -->
    <div class="bg-white/5 rounded-2xl border border-white/10 p-6 mb-8">

        <h2 class="text-2xl font-bold mb-5">
            Barang Stok Menipis
        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b border-white/10">

                    <th class="py-3 text-left">Kode</th>
                    <th class="py-3 text-left">Nama Barang</th>
                    <th class="py-3 text-left">Stok</th>

                </tr>

            </thead>

            <tbody>

            @forelse($stokMenipisList as $item)

                <tr class="border-b border-white/5">

                    <td class="py-3">
                        {{ $item->product_code }}
                    </td>

                    <td>
                        {{ $item->product_name }}
                    </td>

                    <td class="text-yellow-400 font-bold">
                        {{ $item->stock }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="text-center py-6 text-green-400">

                        Tidak ada stok menipis

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <!-- RIWAYAT -->
    <div class="bg-white/5 rounded-2xl border border-white/10 p-6">

        <h2 class="text-2xl font-bold mb-5">
            Riwayat Peminjaman Terbaru
        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b border-white/10">

                    <th class="py-3 text-left">Kode</th>
                    <th class="py-3 text-left">Peminjam</th>
                    <th class="py-3 text-left">Tanggal</th>
                    <th class="py-3 text-left">Status</th>

                </tr>

            </thead>

            <tbody>

            @foreach($riwayat as $item)

                <tr class="border-b border-white/5">

                    <td class="py-3">
                        {{ $item->borrow_code }}
                    </td>

                    <td>
                        {{ $item->borrower_name }}
                    </td>

                    <td>
                        {{ $item->borrow_date }}
                    </td>

                    <td>

                        <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400">

                            {{ $item->status }}

                        </span>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

<script>

const monthNames = {
    1:'Jan',
    2:'Feb',
    3:'Mar',
    4:'Apr',
    5:'Mei',
    6:'Jun',
    7:'Jul',
    8:'Agu',
    9:'Sep',
    10:'Okt',
    11:'Nov',
    12:'Des'
};

new Chart(
    document.getElementById('borrowChart'),
    {
        type:'line',

        data:{

            labels:[
                @foreach($grafikPeminjaman as $item)
                    monthNames[{{ $item->bulan }}],
                @endforeach
            ],

            datasets:[{

                label:'Total Peminjaman',

                data:[
                    @foreach($grafikPeminjaman as $item)
                        {{ $item->total }},
                    @endforeach
                ],

                borderColor:'#ef4444',
                backgroundColor:'rgba(239,68,68,.15)',
                fill:true,
                tension:.4

            }]
        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{
                legend:{
                    labels:{
                        color:'white'
                    }
                }
            },

            scales:{

                x:{
                    ticks:{
                        color:'white'
                    }
                },

                y:{
                    beginAtZero:true,
                    ticks:{
                        color:'white'
                    }
                }

            }

        }

    }
);

</script>

</body>
</html>