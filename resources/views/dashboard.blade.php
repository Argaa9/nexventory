<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard - Nexventory</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
background:radial-gradient(circle at top,#0b0f1a,#05060a);
}

</style>

</head>

<body class="text-white min-h-screen">

@include('layouts.header')

<div class="fixed inset-0 -z-10 overflow-hidden">

<div class="absolute top-0 left-1/2 -translate-x-1/2
w-[700px] h-[700px]
bg-red-500/10 blur-[180px] rounded-full">
</div>

</div>

<div class="max-w-7xl mx-auto px-6 py-10">

<div class="mb-10">

<h1 class="text-5xl font-bold">
Dashboard Nexventory
</h1>

<p class="text-white/50 mt-3">
Monitoring inventaris perusahaan secara realtime.
</p>

</div>

<!-- KPI -->

<div class="grid md:grid-cols-4 gap-6 mb-8">

<div class="p-6 rounded-2xl bg-white/5 border border-white/10">

<div class="text-4xl">📦</div>

<p class="text-white/50 mt-3">
Total Barang
</p>

<h2 class="text-3xl font-bold mt-2">
{{ $totalBarang }}
</h2>

</div>

<div class="p-6 rounded-2xl bg-white/5 border border-white/10">

<div class="text-4xl">📋</div>

<p class="text-white/50 mt-3">
Kategori
</p>

<h2 class="text-3xl font-bold mt-2">
{{ $totalKategori }}
</h2>

</div>

<div class="p-6 rounded-2xl bg-white/5 border border-white/10">

<div class="text-4xl">🔄</div>

<p class="text-white/50 mt-3">
Sedang Dipinjam
</p>

<h2 class="text-3xl font-bold mt-2">
{{ $sedangDipinjam }}
</h2>

</div>

<div class="p-6 rounded-2xl bg-gradient-to-r from-red-500 to-pink-500">

<div class="text-4xl">⚠️</div>

<p class="mt-3">
Stok Menipis
</p>

<h2 class="text-3xl font-bold mt-2">
{{ $stokMenipis }}
</h2>

</div>

</div>

<!-- QUICK ACTION -->

<div class="grid md:grid-cols-3 gap-6 mb-8">

<a href="/products"
class="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-red-500">

<h2 class="text-xl font-bold">
📦 Data Barang
</h2>

<p class="text-white/50 mt-2">
Kelola seluruh inventaris.
</p>

</a>

<a href="/borrowings"
class="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-red-500">

<h2 class="text-xl font-bold">
🔄 Peminjaman
</h2>

<p class="text-white/50 mt-2">
Kelola transaksi peminjaman.
</p>

</a>

<a href="/reports"
class="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-red-500">

<h2 class="text-xl font-bold">
📊 Laporan
</h2>

<p class="text-white/50 mt-2">
Lihat analisis inventaris.
</p>

</a>

</div>

<!-- AKTIVITAS -->

<div class="grid md:grid-cols-2 gap-6">

<div class="bg-white/5 border border-white/10 rounded-2xl p-6">

<h2 class="text-2xl font-bold mb-5">
Aktivitas Terbaru
</h2>

@foreach($aktivitas as $item)

<div class="border-b border-white/10 py-3">

<p class="font-semibold">
{{ $item->borrower_name }}
</p>

<p class="text-white/50 text-sm">
{{ $item->borrow_code }}
</p>

</div>

@endforeach

</div>

<div class="bg-white/5 border border-white/10 rounded-2xl p-6">

<h2 class="text-2xl font-bold mb-5">
Harus Kembali Hari Ini
</h2>

@forelse($kembaliHariIni as $item)

<div class="border-b border-white/10 py-3">

<p class="font-semibold">
{{ $item->borrower_name }}
</p>

<p class="text-white/50">
{{ $item->return_date }}
</p>

</div>

@empty

<p class="text-white/50">
Tidak ada pengembalian hari ini
</p>

@endforelse

</div>

</div>

<!-- STATUS -->

<div class="grid md:grid-cols-4 gap-6 mt-8">

<div class="p-5 rounded-2xl bg-green-500/20">
🟢 Tersedia : {{ $tersedia }}
</div>

<div class="p-5 rounded-2xl bg-yellow-500/20">
🟡 Dipinjam : {{ $dipinjam }}
</div>

<div class="p-5 rounded-2xl bg-blue-500/20">
🔵 Maintenance : {{ $maintenance }}
</div>

<div class="p-5 rounded-2xl bg-red-500/20">
🔴 Rusak : {{ $rusak }}
</div>

</div>

</div>

</body>
</html>