<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Peminjaman - Nexventory</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background: radial-gradient(circle at top,#0b0f1a,#05060a);
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
    <div class="mb-8">

        <h1 class="text-5xl font-bold">

            Riwayat Peminjaman

        </h1>

        <p class="text-white/50 mt-3">

            Seluruh transaksi peminjaman yang telah selesai.

        </p>

    </div>

    <!-- SEARCH -->
    <div class="mb-6">

        <input
            type="text"
            placeholder="Cari riwayat..."
            class="w-full md:w-96 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-red-500 outline-none">

    </div>

    <!-- TABLE -->
    <div class="overflow-hidden bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">

        <table class="w-full">

            <thead class="border-b border-white/10">

                <tr class="text-left">

                    <th class="p-4">Kode</th>
                    <th class="p-4">Peminjam</th>
                    <th class="p-4">No HP</th>
                    <th class="p-4">Tanggal Pinjam</th>
                    <th class="p-4">Tanggal Kembali</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($histories as $history)

            <tr class="border-b border-white/5 hover:bg-white/5">

                <td class="p-4">

                    {{ $history->borrow_code }}

                </td>

                <td class="p-4">

                    {{ $history->borrower_name }}

                </td>

                <td class="p-4">

                    {{ $history->phone }}

                </td>

                <td class="p-4">

                    {{ $history->borrow_date }}

                </td>

                <td class="p-4">

                    {{ $history->return_date }}

                </td>

                <td class="p-4">

                    <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400">

                        Dikembalikan

                    </span>

                </td>

                <td class="p-4">

                    <button
                        onclick="document.getElementById('detail{{ $history->id }}').classList.remove('hidden')"
                        class="px-3 py-2 bg-blue-500 rounded-lg">

                        Detail

                    </button>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7"
                    class="text-center py-10 text-white/50">

                    Belum ada riwayat peminjaman

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $histories->links() }}

    </div>

</div>

@foreach($histories as $history)

<div id="detail{{ $history->id }}"
     class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex justify-center items-center z-50">

    <div class="bg-[#111827] border border-white/10 rounded-2xl w-full max-w-3xl p-8">

        <div class="flex justify-between mb-6">

            <h2 class="text-2xl font-bold">

                Detail Riwayat

            </h2>

            <button
                onclick="document.getElementById('detail{{ $history->id }}').classList.add('hidden')">

                ✕

            </button>

        </div>

        <div class="space-y-3">

            <p>
                <b>Kode :</b>
                {{ $history->borrow_code }}
            </p>

            <p>
                <b>Nama :</b>
                {{ $history->borrower_name }}
            </p>

            <p>
                <b>No HP :</b>
                {{ $history->phone }}
            </p>

            <p>
                <b>Tanggal Pinjam :</b>
                {{ $history->borrow_date }}
            </p>

            <p>
                <b>Tanggal Kembali :</b>
                {{ $history->return_date }}
            </p>

        </div>

        <hr class="my-6 border-white/10">

        <h3 class="font-bold mb-4">

            Barang Dipinjam

        </h3>

        @foreach($history->details as $detail)

        <div class="flex justify-between py-3 border-b border-white/10">

            <span>

                {{ $detail->product->product_name }}

            </span>

            <span>

                Qty : {{ $detail->qty }}

            </span>

        </div>

        @endforeach

    </div>

</div>

@endforeach
