<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Nexventory</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            background: radial-gradient(circle at top,#0b0f1a,#05060a);
        }
    </style>
</head>

<body class="text-white min-h-screen">

@include('layouts.header')

<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-1/2 -translate-x-1/2
                w-[700px] h-[700px]
                bg-red-500/10 blur-[180px] rounded-full">
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-10">

    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-5xl font-bold">
                Data Barang
            </h1>

            <p class="text-white/50 mt-3">
                Kelola seluruh aset dan inventaris perusahaan secara real-time.
            </p>
        </div>

        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 font-semibold hover:scale-105 transition">

            + Tambah Barang

        </button>

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
            <div class="text-4xl">🏷️</div>

            <p class="text-white/50 mt-3">
                Total Kategori
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $totalKategori }}
            </h2>
        </div>

        <div class="p-6 rounded-2xl bg-white/5 border border-white/10">
            <div class="text-4xl">⚠️</div>

            <p class="text-white/50 mt-3">
                Stok Menipis
            </p>

            <h2 class="text-3xl font-bold mt-2 text-yellow-400">
                {{ $stokMenipis }}
            </h2>
        </div>

        <div class="p-6 rounded-2xl bg-gradient-to-r from-red-500 to-pink-500">
            <div class="text-4xl">✅</div>

            <p class="text-white/80 mt-3">
                Barang Tersedia
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $barangTersedia }}
            </h2>
        </div>

    </div>

    <!-- SEARCH -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-6">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari barang..."
            class="w-full md:w-96 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-red-500 outline-none">

    </form>
        <!-- TABLE -->
    <div class="overflow-hidden bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">

        <table class="w-full">

            <thead class="border-b border-white/10">

                <tr class="text-left">

                    <th class="p-4">Gambar</th>
                    <th class="p-4">Kode</th>
                    <th class="p-4">Nama Barang</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4">Lokasi</th>
                    <th class="p-4">Kondisi</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

                <tr class="border-b border-white/5 hover:bg-white/5">

                   <td class="p-4">

@if($product->image)

    <a href="{{ asset('storage/'.$product->image) }}"
       target="_blank">

        <img
            src="{{ asset('storage/'.$product->image) }}"
            class="w-16 h-16 rounded-xl object-cover cursor-pointer hover:scale-110 transition">

    </a>

@else

    <div class="w-16 h-16 rounded-xl bg-white/10 flex items-center justify-center">
        📦
    </div>

@endif

</td>

                    <td class="p-4">
                        {{ $product->product_code }}
                    </td>

                    <td class="p-4">
                        {{ $product->product_name }}
                    </td>

                    <td class="p-4">
                        {{ $product->category->category_name ?? '-' }}
                    </td>

                    <td class="p-4">

                        @if($product->stock <= $product->minimum_stock)

                            <span class="text-yellow-400 font-semibold">
                                {{ $product->stock }}
                            </span>

                        @else

                            {{ $product->stock }}

                        @endif

                    </td>

                    <td class="p-4">
                        {{ $product->location }}
                    </td>

                    <td class="p-4">

                        @if($product->item_condition == 'Baik')

                            <span class="text-green-400">
                                {{ $product->item_condition }}
                            </span>

                        @elseif($product->item_condition == 'Rusak Ringan')

                            <span class="text-yellow-400">
                                {{ $product->item_condition }}
                            </span>

                        @else

                            <span class="text-red-400">
                                {{ $product->item_condition }}
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        @if($product->status == 'Tersedia')

                            <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-sm">
                                Tersedia
                            </span>

                        @elseif($product->status == 'Dipinjam')

                            <span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 text-sm">
                                Dipinjam
                            </span>

                        @elseif($product->status == 'Maintenance')

                            <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-sm">
                                Maintenance
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-500/20 text-red-400 text-sm">
                                Rusak
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        <div class="flex gap-2">

                           <button
    onclick="openDetailModal(
        '{{ $product->product_name }}',
        '{{ $product->product_code }}',
        '{{ $product->category->category_name ?? '-' }}',
        '{{ $product->stock }}',
        '{{ $product->location }}',
        '{{ $product->item_condition }}',
        '{{ $product->status }}',
        '{{ asset('storage/'.$product->image) }}'
    )"
    class="px-3 py-2 bg-blue-500 rounded-lg hover:bg-blue-600 transition">

    Detail

</button>

                           <button
    onclick="openEditModal(
        '{{ $product->id }}',
        '{{ $product->product_code }}',
        '{{ $product->product_name }}',
        '{{ $product->category_id }}',
        '{{ $product->stock }}',
        '{{ $product->minimum_stock }}',
        '{{ $product->location }}',
        '{{ $product->item_condition }}',
        '{{ $product->status }}'
    )"
    class="px-3 py-2 bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">

    Edit

</button>

                            <form
                                action="{{ route('products.destroy',$product->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')"
                                    class="px-3 py-2 bg-red-500 rounded-lg hover:bg-red-600 transition">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center py-10 text-white/50">

                        Belum ada data barang

                    </td>

                </tr>

            @endforelse

            
<div id="imageModal"
     class="hidden fixed inset-0 z-[9999] bg-black/95 flex items-center justify-center">

    <button
        onclick="closeImageModal()"
        class="absolute top-5 right-8 text-white text-5xl">

        ×

    </button>

    <img
        id="previewImage"
        class="max-w-[95vw] max-h-[95vh] object-contain">

</div>

<script>
function showImage(url)
{
    document.getElementById('previewImage').src = url;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal()
{
    document.getElementById('imageModal').classList.add('hidden');
}
</script>


            </tbody>

        </table>

    </div>





    

            <div id="detailModal"
     class="hidden fixed inset-0 z-[99999] bg-black/80 backdrop-blur-sm flex items-center justify-center p-6">

    <div class="bg-[#111827] rounded-3xl w-full max-w-5xl overflow-hidden shadow-2xl">

        <div class="flex justify-between items-center p-6 border-b border-white/10">

            <h2 class="text-2xl font-bold">
                Detail Barang
            </h2>

            <button
                onclick="closeDetailModal()"
                class="text-3xl hover:text-red-400">

                ✕

            </button>

        </div>

        <div class="grid md:grid-cols-2">

            <div class="p-6 flex items-center justify-center bg-black/20">

                <img
                    id="detailImage"
                    class="max-h-[500px] rounded-2xl object-contain">

            </div>

            <div class="p-8 space-y-5">

                <p><b>Nama Barang :</b> <span id="detailName"></span></p>

                <p><b>Kode Barang :</b> <span id="detailCode"></span></p>

                <p><b>Kategori :</b> <span id="detailCategory"></span></p>

                <p><b>Stok :</b> <span id="detailStock"></span></p>

                <p><b>Lokasi :</b> <span id="detailLocation"></span></p>

                <p><b>Kondisi :</b> <span id="detailCondition"></span></p>

                <p><b>Status :</b> <span id="detailStatus"></span></p>

            </div>

        </div>

    </div>

</div>

<script>

function openDetailModal(
    name,
    code,
    category,
    stock,
    location,
    condition,
    status,
    image
)
{
    document.getElementById('detailName').innerText = name;
    document.getElementById('detailCode').innerText = code;
    document.getElementById('detailCategory').innerText = category;
    document.getElementById('detailStock').innerText = stock;
    document.getElementById('detailLocation').innerText = location;
    document.getElementById('detailCondition').innerText = condition;
    document.getElementById('detailStatus').innerText = status;
    document.getElementById('detailImage').src = image;

    document.getElementById('detailModal').classList.remove('hidden');

    document.body.style.overflow = 'hidden';
}

function closeDetailModal()
{
    document.getElementById('detailModal').classList.add('hidden');

    document.body.style.overflow = 'auto';
}

</script>




<div id="editModal"
     class="hidden fixed inset-0 z-[99999] bg-black/80 backdrop-blur-sm flex items-center justify-center p-6">

    <div class="bg-[#111827] rounded-3xl w-full max-w-4xl p-8">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Edit Barang
            </h2>

            <button
                onclick="closeEditModal()"
                class="text-3xl">

                ✕

            </button>

        </div>

        <form
            id="editForm"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label>Kode Barang</label>
                    <input
                        id="edit_product_code"
                        name="product_code"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
                </div>

                <div>
                    <label>Nama Barang</label>
                    <input
                        id="edit_product_name"
                        name="product_name"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
                </div>

                <div>
                    <label>Kategori</label>

                    <select
                        id="edit_category_id"
                        name="category_id"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                        @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->category_name }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div>
                    <label>Stok</label>

                    <input
                        type="number"
                        id="edit_stock"
                        name="stock"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
                </div>

                <div>
                    <label>Minimum Stok</label>

                    <input
                        type="number"
                        id="edit_minimum_stock"
                        name="minimum_stock"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
                </div>

                <div>
                    <label>Lokasi</label>

                    <input
                        id="edit_location"
                        name="location"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
                </div>

                <div>
                    <label>Kondisi</label>

                    <select
                        id="edit_condition"
                        name="item_condition"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                        <option value="Dalam Perbaikan">Dalam Perbaikan</option>

                    </select>

                </div>

                <div>
                    <label>Status</label>

                    <select
                        id="edit_status"
                        name="status"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                        <option value="Tersedia">Tersedia</option>
                        <option value="Maintenance">Maintenance</option>

                    </select>

                </div>

                <div class="md:col-span-2">

                    <label>Ganti Gambar</label>

                    <input
                        type="file"
                        name="image"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                </div>

                <div class="md:col-span-2">

                    <button
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-500 font-bold">

                        Update Barang

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<script>

function openEditModal(
    id,
    code,
    name,
    category,
    stock,
    minimum,
    location,
    condition,
    status
)
{
    document.getElementById('edit_product_code').value = code;
    document.getElementById('edit_product_name').value = name;
    document.getElementById('edit_category_id').value = category;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_minimum_stock').value = minimum;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_condition').value = condition;
    document.getElementById('edit_status').value = status;

    document.getElementById('editForm').action =
        "/products/" + id;

    document.getElementById('editModal')
        .classList.remove('hidden');

    document.body.style.overflow = 'hidden';
}

function closeEditModal()
{
    document.getElementById('editModal')
        .classList.add('hidden');

    document.body.style.overflow = 'auto';
}

</script>




    <!-- PAGINATION -->
    <div class="mt-6">

        {{ $products->links() }}

    </div>

</div>
<!-- MODAL TAMBAH BARANG -->
<div id="modalTambah"
     onclick="if(event.target===this)this.classList.add('hidden')"
     class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4">
     
     <div class="bg-[#111827] border border-white/10 rounded-2xl w-full max-w-5xl p-8 max-h-[90vh] overflow-y-auto scrollbar-thin">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Tambah Barang Baru
            </h2>

            <button
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-white/60 hover:text-white text-xl">

                ✕

            </button>

        </div>

        <form
            action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid md:grid-cols-2 gap-5">

            @csrf

            <!-- KODE BARANG -->
            <div>

                <label class="text-sm text-white/70">
                    Kode Barang
                </label>

                <input
                    type="text"
                    name="product_code"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- NAMA BARANG -->
            <div>

                <label class="text-sm text-white/70">
                    Nama Barang
                </label>

                <input
                    type="text"
                    name="product_name"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- KATEGORI -->
            <div>

                <label class="text-sm text-white/70">
                    Kategori
                </label>

                <select
                    name="category_id"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    <option value="">
                        Pilih Kategori
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->category_name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- STOK -->
            <div>

                <label class="text-sm text-white/70">
                    Stok
                </label>

                <input
                    type="number"
                    name="stock"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- MINIMUM STOK -->
            <div>

                <label class="text-sm text-white/70">
                    Minimum Stok
                </label>

                <input
                    type="number"
                    name="minimum_stock"
                    value="5"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- LOKASI -->
            <div>

                <label class="text-sm text-white/70">
                    Lokasi Penyimpanan
                </label>

                <input
                    type="text"
                    name="location"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- KONDISI -->
            <div>

                <label class="text-sm text-white/70">
                    Kondisi Barang
                </label>

                <select
                    name="item_condition"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    <option value="Baik">Baik</option>
                    <option value="Rusak Ringan">Rusak Ringan</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>

                </select>

            </div>

            <!-- STATUS -->
            <div>

                <label class="text-sm text-white/70">
                    Status Barang
                </label>

                <select
                    name="status"
                    required
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    <option value="Tersedia">
                        Tersedia
                    </option>

                    <option value="Dipinjam">
                        Dipinjam
                    </option>

                    <option value="Maintenance">
                        Maintenance
                    </option>

                    <option value="Rusak">
                        Rusak
                    </option>

                </select>

            </div>

            <!-- TANGGAL BELI -->
            <div>

                <label class="text-sm text-white/70">
                    Tanggal Pembelian
                </label>

                <input
                    type="date"
                    name="purchase_date"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- HARGA BELI -->
            <div>

                <label class="text-sm text-white/70">
                    Harga Pembelian
                </label>

                <input
                    type="number"
                    name="purchase_price"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- GAMBAR -->
            <div>

                <label class="text-sm text-white/70">
                    Upload Gambar
                </label>

                <input
                    type="file"
                    name="image"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <!-- DESKRIPSI -->
            <div class="md:col-span-2">

                <label class="text-sm text-white/70">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10"></textarea>

            </div>

            <!-- BUTTON -->
            <div class="md:col-span-2">

                <button
                    type="submit"
                    class="w-full py-4 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 font-semibold hover:scale-[1.02] transition">

                    Simpan Barang

                </button>

            </div>

        </form>

    </div>

</div>
<!-- MODAL EDIT BARANG -->
@foreach($products as $product)

<div id="modalEdit{{ $product->id }}"
     class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto">

    <div class="bg-[#111827] border border-white/10 rounded-2xl w-full max-w-4xl p-8 my-10">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Edit Barang
            </h2>

            <button
                onclick="document.getElementById('modalEdit{{ $product->id }}').classList.add('hidden')"
                class="text-white/60 hover:text-white text-xl">

                ✕

            </button>

        </div>

        <form
            action="{{ route('products.update',$product->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid md:grid-cols-2 gap-5">

            @csrf
            @method('PUT')

            <div>
                <label>Kode Barang</label>

                <input
                    type="text"
                    name="product_code"
                    value="{{ $product->product_code }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
            </div>

            <div>
                <label>Nama Barang</label>

                <input
                    type="text"
                    name="product_name"
                    value="{{ $product->product_name }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">
            </div>

            <div>

                <label>Kategori</label>

                <select
                    name="category_id"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->category_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Stok</label>

                <input
                    type="number"
                    name="stock"
                    value="{{ $product->stock }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div>

                <label>Minimum Stok</label>

                <input
                    type="number"
                    name="minimum_stock"
                    value="{{ $product->minimum_stock }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div>

                <label>Lokasi</label>

                <input
                    type="text"
                    name="location"
                    value="{{ $product->location }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div>

                <label>Kondisi</label>

                <select
                    name="item_condition"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    <option value="Baik" {{ $product->item_condition == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>

                    <option value="Rusak Ringan" {{ $product->item_condition == 'Rusak Ringan' ? 'selected' : '' }}>
                        Rusak Ringan
                    </option>

                    <option value="Rusak Berat" {{ $product->item_condition == 'Rusak Berat' ? 'selected' : '' }}>
                        Rusak Berat
                    </option>

                    <option value="Dalam Perbaikan" {{ $product->item_condition == 'Dalam Perbaikan' ? 'selected' : '' }}>
                        Dalam Perbaikan
                    </option>

                </select>

            </div>

            <div>

                <label>Status</label>

                <select
                    name="status"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

                    <option value="Tersedia" {{ $product->status == 'Tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>

                    <option value="Dipinjam" {{ $product->status == 'Dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>

                    <option value="Maintenance" {{ $product->status == 'Maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>

                    <option value="Rusak" {{ $product->status == 'Rusak' ? 'selected' : '' }}>
                        Rusak
                    </option>

                </select>

            </div>

            <div>

                <label>Harga Pembelian</label>

                <input
                    type="number"
                    name="purchase_price"
                    value="{{ $product->purchase_price }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div>

                <label>Tanggal Pembelian</label>

                <input
                    type="date"
                    name="purchase_date"
                    value="{{ $product->purchase_date }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div class="md:col-span-2">

                <label>Deskripsi</label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">{{ $product->description }}</textarea>

            </div>

            <div class="md:col-span-2">

                <label>Gambar Baru</label>

                <input
                    type="file"
                    name="image"
                    class="w-full mt-2 px-4 py-3 rounded-xl bg-black/30 border border-white/10">

            </div>

            <div class="md:col-span-2">

                <button
                    type="submit"
                    class="w-full py-4 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-500 font-semibold">

                    Update Barang

                </button>

            </div>

        </form>

    </div>

</div>

@endforeach