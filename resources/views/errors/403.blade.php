<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>403</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center">

<div class="text-center">

    <h1 class="text-8xl font-bold text-red-500">
        403
    </h1>

    <p class="mt-4 text-xl">
        Akses Ditolak
    </p>

    <p class="text-white/50 mt-2">
        Anda tidak memiliki izin untuk membuka halaman ini.
    </p>

    <a
        href="{{ route('dashboard') }}"
        class="inline-block mt-6 px-6 py-3 bg-red-500 rounded-xl">

        Kembali ke Dashboard

    </a>

</div>

</body>
</html>