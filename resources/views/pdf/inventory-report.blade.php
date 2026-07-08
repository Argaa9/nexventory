<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#333;
}

.header{
    text-align:center;
    margin-bottom:25px;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#e11d48;
}

.title{
    font-size:22px;
    font-weight:bold;
    margin-top:5px;
}

.subtitle{
    color:#666;
    margin-top:3px;
}

.info{
    margin-top:20px;
    margin-bottom:20px;
}

.info-table{
    width:100%;
}

.info-table td{
    padding:6px;
}

.summary{
    margin-top:15px;
    margin-bottom:25px;
}

.summary-box{
    width:23%;
    display:inline-block;
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
    margin-right:1%;
    border-radius:8px;
}

.summary-title{
    font-size:11px;
    color:#666;
}

.summary-value{
    font-size:20px;
    font-weight:bold;
    margin-top:5px;
}

.section-title{
    font-size:16px;
    font-weight:bold;
    margin-bottom:10px;
    color:#111827;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#111827;
    color:white;
    padding:10px;
    text-align:left;
}

td{
    padding:8px;
    border-bottom:1px solid #ddd;
}

.footer{
    margin-top:30px;
    text-align:right;
    color:#666;
    font-size:11px;
}

.status-tersedia{
    color:green;
    font-weight:bold;
}

.status-dipinjam{
    color:orange;
    font-weight:bold;
}

.status-rusak{
    color:red;
    font-weight:bold;
}

</style>

</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="logo">
        NEXVENTORY
    </div>

    <div class="title">
        LAPORAN INVENTARIS BARANG
    </div>

    <div class="subtitle">
        Smart Inventory Management System
    </div>

</div>

<!-- INFO -->
<div class="info">

    <table class="info-table">

        <tr>
            <td width="180"><b>Tanggal Cetak</b></td>
            <td>: {{ date('d F Y H:i') }}</td>
        </tr>

        <tr>
            <td><b>Dicetak Oleh</b></td>
            <td>: Administrator</td>
        </tr>

        <tr>
            <td><b>Total Data Barang</b></td>
            <td>: {{ count($products) }}</td>
        </tr>

    </table>

</div>

<!-- SUMMARY -->
<div class="summary">

    <div class="summary-box">
        <div class="summary-title">
            Total Barang
        </div>

        <div class="summary-value">
            {{ count($products) }}
        </div>
    </div>

    <div class="summary-box">
        <div class="summary-title">
            Tersedia
        </div>

        <div class="summary-value">
            {{ $products->where('status','Tersedia')->count() }}
        </div>
    </div>

    <div class="summary-box">
        <div class="summary-title">
            Dipinjam
        </div>

        <div class="summary-value">
            {{ $products->where('status','Dipinjam')->count() }}
        </div>
    </div>

    <div class="summary-box">
        <div class="summary-title">
            Rusak
        </div>

        <div class="summary-value">
            {{ $products->where('status','Rusak')->count() }}
        </div>
    </div>

</div>

<br><br>

<!-- DATA BARANG -->
<div class="section-title">
    Daftar Inventaris Barang
</div>

<table>

    <thead>

        <tr>

            <th width="10%">Kode</th>
            <th width="30%">Nama Barang</th>
            <th width="10%">Stok</th>
            <th width="20%">Lokasi</th>
            <th width="15%">Kategori</th>
            <th width="15%">Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($products as $product)

        <tr>

            <td>
                {{ $product->product_code }}
            </td>

            <td>
                {{ $product->product_name }}
            </td>

            <td>
                {{ $product->stock }}
            </td>

            <td>
                {{ $product->location }}
            </td>

            <td>
                {{ $product->category->category_name ?? '-' }}
            </td>

            <td>

                @if($product->status == 'Tersedia')

                    <span class="status-tersedia">
                        Tersedia
                    </span>

                @elseif($product->status == 'Dipinjam')

                    <span class="status-dipinjam">
                        Dipinjam
                    </span>

                @else

                    <span class="status-rusak">
                        {{ $product->status }}
                    </span>

                @endif

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">

    Dokumen ini dibuat secara otomatis oleh sistem Nexventory.

</div>

</body>
</html>