<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjaman Barang - Nexventory</title>

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
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold">
                Peminjaman Barang
            </h1>

            <p class="text-white/50 mt-3">
                Kelola peminjaman aset perusahaan secara real-time.
            </p>

        </div>

        <button
            onclick="document.getElementById('modalPinjam').classList.remove('hidden')"
            class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 font-semibold hover:scale-105 transition">

            + Tambah Peminjaman

        </button>

    </div>

    <!-- ALERT -->
    @if(session('success'))

    <div class="mb-5 p-4 rounded-xl bg-green-500/20 text-green-400 border border-green-500/20">

        {{ session('success') }}

    </div>

    @endif

    @if(session('error'))

    <div class="mb-5 p-4 rounded-xl bg-red-500/20 text-red-400 border border-red-500/20">

        {{ session('error') }}

    </div>

    @endif

    <!-- KPI -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">📦</div>

            <p class="text-white/50 mt-3">
                Sedang Dipinjam
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalDipinjam }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">👥</div>

            <p class="text-white/50 mt-3">
                Total Peminjaman
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalPeminjam }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">

            <div class="text-4xl">✅</div>

            <p class="text-white/50 mt-3">
                Sudah Dikembalikan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalDikembalikan }}
            </h2>

        </div>

        <div class="p-6 rounded-2xl bg-gradient-to-r from-red-500 to-pink-500">

            <div class="text-4xl">⚠️</div>

            <p class="text-white/80 mt-3">
                Terlambat
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $terlambat }}
            </h2>

        </div>

    </div>

    <!-- SEARCH -->
    <div class="mb-6">

        <input
            type="text"
            placeholder="Cari peminjam..."
            class="w-full md:w-96 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-red-500 outline-none">

    </div>

    <!-- TABLE -->
    <div class="overflow-hidden bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">

        <table class="w-full">

            <thead class="border-b border-white/10">

                <tr class="text-left">

                    <th class="p-4">Kode</th>
                    <th class="p-4">Peminjam</th>
                    <th class="p-4">Divisi</th>
                    <th class="p-4">Tanggal Pinjam</th>
                    <th class="p-4">Tanggal Kembali</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($borrowings as $borrowing)

            <tr class="border-b border-white/5 hover:bg-white/5">

                <td class="p-4">
                    {{ $borrowing->borrow_code }}
                </td>

                <td class="p-4">
                    {{ $borrowing->borrower_name }}
                </td>

                <td class="p-4">
                    {{ $borrowing->division }}
                </td>

                <td class="p-4">
                    {{ $borrowing->borrow_date }}
                </td>

                <td class="p-4">
                    {{ $borrowing->return_date }}
                </td>

                <td class="p-4">

                    @if($borrowing->status == 'Dipinjam')

                    <span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400">
                        Dipinjam
                    </span>

                    @elseif($borrowing->status == 'Dikembalikan')

                    <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400">
                        Dikembalikan
                    </span>

                    @else

                    <span class="px-3 py-1 rounded-full bg-red-500/20 text-red-400">
                        Terlambat
                    </span>

                    @endif

                </td>

                <td class="p-4">

                    <div class="flex gap-2">

                        <button
                            onclick="document.getElementById('detail{{ $borrowing->id }}').classList.remove('hidden')"
                            class="px-3 py-2 bg-blue-500 rounded-lg">

                            Detail

                        </button>

                        @if($borrowing->status == 'Dipinjam')

                        <form
                            action="{{ route('borrowings.return',$borrowing->id) }}"
                            method="POST">

                            @csrf
                            @method('PUT')

                            <button
                                onclick="return confirm('Konfirmasi pengembalian barang?')"
                                class="px-3 py-2 bg-green-500 rounded-lg">

                                Kembalikan

                            </button>

                        </form>

                        @endif

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-10 text-white/50">

                    Belum ada data peminjaman

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">
        {{ $borrowings->links() }}
    </div>

</div>

<!-- MODAL TAMBAH PEMINJAMAN -->
<div id="modalPinjam"
     class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto p-6">

    <div class="bg-[#111827] border border-white/10 rounded-2xl w-full max-w-4xl p-8 my-10">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Tambah Peminjaman Barang
            </h2>

            <button
                onclick="document.getElementById('modalPinjam').classList.add('hidden')"
                class="text-white/60 hover:text-white text-2xl">

                ✕

            </button>

        </div>

        <form action="{{ route('borrowings.store') }}"
              method="POST">

            @csrf

            <div class="grid md:grid-cols-2 gap-4">

                <div>

                    <label>Nama Peminjam</label>

                    <input
                        type="text"
                        name="borrower_name"
                        required
                        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                </div>

                <div>

                    <label>Divisi</label>

                    <input
                        type="text"
                        name="division"
                        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                </div>

                <div>

                    <label>No HP</label>

                    <input
                        type="text"
                        name="phone"
                        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                </div>

                <div>

                    <label>Tanggal Pinjam</label>

                    <input
                        type="date"
                        name="borrow_date"
                        required
                        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                </div>

                <div>

                    <label>Tanggal Kembali</label>

                    <input
                        type="date"
                        name="return_date"
                        required
                        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                </div>

            </div>

            <!-- BARANG -->
            <div class="mt-8">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="font-semibold text-lg">

                        Barang Dipinjam

                    </h3>

                    <button
                        type="button"
                        onclick="addItem()"
                        class="px-4 py-2 bg-green-500 rounded-lg">

                        + Tambah Barang

                    </button>

                </div>

                <div id="itemsContainer">

                    <div class="grid md:grid-cols-3 gap-4 item-row mb-4">

                        <select
                            name="product_id[]"
                            required
                            class="px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                            <option value="">
                                Pilih Barang
                            </option>

                            @foreach($products as $product)

                            <option value="{{ $product->id }}">

                                {{ $product->product_name }}
                                (Stok: {{ $product->stock }})

                            </option>

                            @endforeach

                        </select>

                        <input
                            type="number"
                            name="qty[]"
                            min="1"
                            value="1"
                            required
                            class="px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                        <button
                            type="button"
                            onclick="removeItem(this)"
                            class="bg-red-500 rounded-lg">

                            Hapus

                        </button>

                    </div>

                </div>

            </div>

            <button
                type="submit"
                class="w-full mt-6 py-4 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 font-semibold">

                Simpan Peminjaman

            </button>

        </form>

    </div>

</div>

<!-- DETAIL MODAL -->
@foreach($borrowings as $borrowing)

<div id="detail{{ $borrowing->id }}"
     class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-6">

    <div class="bg-[#111827] border border-white/10 rounded-2xl w-full max-w-3xl p-8">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">

                Detail Peminjaman

            </h2>

            <button
                onclick="document.getElementById('detail{{ $borrowing->id }}').classList.add('hidden')"
                class="text-2xl">

                ✕

            </button>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-6">

            <div>

                <p class="text-white/50">
                    Kode
                </p>

                <p>
                    {{ $borrowing->borrow_code }}
                </p>

            </div>

            <div>

                <p class="text-white/50">
                    Nama Peminjam
                </p>

                <p>
                    {{ $borrowing->borrower_name }}
                </p>

            </div>

            <div>

                <p class="text-white/50">
                    Divisi
                </p>

                <p>
                    {{ $borrowing->division }}
                </p>

            </div>

            <div>

                <p class="text-white/50">
                    No HP
                </p>

                <p>
                    {{ $borrowing->phone }}
                </p>

            </div>

        </div>

        <div class="border-t border-white/10 pt-5">

            <h3 class="font-semibold mb-4">

                Barang Dipinjam

            </h3>

            @foreach($borrowing->details as $detail)

            <div class="flex justify-between py-3 border-b border-white/5">

                <span>

                    {{ $detail->product->product_name }}

                </span>

                <span>

                    Qty :
                    {{ $detail->qty }}

                </span>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endforeach

<script>

function addItem()
{
    let html = `
    <div class="grid md:grid-cols-3 gap-4 item-row mb-4">

        <select
            name="product_id[]"
            required
            class="px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <option value="">
                Pilih Barang
            </option>

            @foreach($products as $product)

            <option value="{{ $product->id }}">

                {{ $product->product_name }}
                (Stok: {{ $product->stock }})

            </option>

            @endforeach

        </select>

        <input
            type="number"
            name="qty[]"
            min="1"
            value="1"
            required
            class="px-4 py-3 rounded-lg bg-black/30 border border-white/10">

        <button
            type="button"
            onclick="removeItem(this)"
            class="bg-red-500 rounded-lg">

            Hapus

        </button>

    </div>
    `;

    document
        .getElementById('itemsContainer')
        .insertAdjacentHTML('beforeend', html);
}

function removeItem(button)
{
    button.closest('.item-row').remove();
}

</script>

</body>
</html>

