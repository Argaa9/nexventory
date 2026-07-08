<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Nexventory</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background: radial-gradient(circle at top,#0b0f1a,#05060a);
}
</style>

</head>

<body class="min-h-screen flex items-center justify-center text-white">

<div class="absolute top-0 left-1/2 -translate-x-1/2
            w-[600px] h-[600px]
            bg-red-500/10 blur-[180px]
            rounded-full">
</div>

<div class="w-full max-w-md p-8 rounded-3xl
            bg-white/5 border border-white/10
            backdrop-blur-xl relative">

    <div class="text-center mb-8">

        <div class="text-5xl mb-3">
            📦
        </div>

        <h1 class="text-3xl font-bold">
            Nexventory
        </h1>

        <p class="text-white/50 mt-2">
            Inventory Management System
        </p>

    </div>

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                required
                class="w-full px-4 py-3 rounded-xl
                       bg-black/30
                       border border-white/10">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full px-4 py-3 rounded-xl
                       bg-black/30
                       border border-white/10">

        </div>

        <div class="mb-5">

            <label class="flex items-center gap-2">

                <input type="checkbox" name="remember">

                Remember Me

            </label>

        </div>

        <button
            type="submit"
            class="w-full py-3 rounded-xl
                   bg-gradient-to-r
                   from-red-500
                   to-pink-500">

            Login

        </button>

    </form>

    @if($errors->any())

    <div class="mt-4 p-3 rounded-lg bg-red-500/20 text-red-400">

        {{ $errors->first() }}

    </div>

    @endif


</div>

</body>
</html>