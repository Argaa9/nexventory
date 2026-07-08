<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manajemen User - Nexventory</title>

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
                bg-red-500/10 blur-[180px]
                rounded-full">
    </div>

</div>

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold">
                Manajemen User
            </h1>

            <p class="text-white/50 mt-3">
                Kelola akun pengguna Nexventory
            </p>

        </div>

        <button
            onclick="document.getElementById('modalCreate').classList.remove('hidden')"
            class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-500">

            + Tambah User

        </button>

    </div>

    <!-- ALERT -->
    @if(session('success'))

    <div class="mb-5 p-4 rounded-xl bg-green-500/20 text-green-400 border border-green-500/20">

        {{ session('success') }}

    </div>

    @endif

    <!-- TABLE -->
    <div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10">

        <table class="w-full">

            <thead class="border-b border-white/10">

                <tr>

                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Role</th>
                    <th class="p-4 text-left">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr class="border-b border-white/5 hover:bg-white/5">

                    <td class="p-4">
                        {{ $user->name }}
                    </td>

                    <td class="p-4">
                        {{ $user->email }}
                    </td>

                    <td class="p-4">

                        @if($user->role == 'admin')

                            <span class="px-3 py-1 rounded-full bg-red-500/20 text-red-400">
                                Admin
                            </span>

                        @elseif($user->role == 'staff')

                            <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400">
                                Staff
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400">
                                Manager
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        <div class="flex gap-2">

                            <button
                                onclick="document.getElementById('edit{{ $user->id }}').classList.remove('hidden')"
                                class="px-4 py-2 bg-blue-500 rounded-lg">

                                Edit

                            </button>

                            @if($user->id != auth()->id())

                            <form
                                action="{{ route('users.destroy',$user->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus user ini?')"
                                    class="px-4 py-2 bg-red-500 rounded-lg">

                                    Hapus

                                </button>

                            </form>

                            @endif

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL CREATE -->
<div id="modalCreate"
     class="hidden fixed inset-0 bg-black/70 flex justify-center items-center z-50">

    <div class="bg-[#111827] w-full max-w-lg p-8 rounded-2xl border border-white/10">

        <div class="flex justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Tambah User
            </h2>

            <button
                onclick="document.getElementById('modalCreate').classList.add('hidden')">

                ✕

            </button>

        </div>

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <input
                type="text"
                name="name"
                placeholder="Nama"
                required
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <select
                name="role"
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="manager">Manager</option>

            </select>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-500">

                Simpan User

            </button>

        </form>

    </div>

</div>

<!-- MODAL EDIT -->
@foreach($users as $user)

<div id="edit{{ $user->id }}"
     class="hidden fixed inset-0 bg-black/70 flex justify-center items-center z-50">

    <div class="bg-[#111827] w-full max-w-lg p-8 rounded-2xl border border-white/10">

        <div class="flex justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Edit User
            </h2>

            <button
                onclick="document.getElementById('edit{{ $user->id }}').classList.add('hidden')">

                ✕

            </button>

        </div>

        <form
            action="{{ route('users.update',$user->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <input
                type="text"
                name="name"
                value="{{ $user->name }}"
                required
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <input
                type="email"
                name="email"
                value="{{ $user->email }}"
                required
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

            <select
                name="role"
                class="w-full mb-4 px-4 py-3 rounded-lg bg-black/30 border border-white/10">

                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>
                    Staff
                </option>

                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>
                    Manager
                </option>

            </select>

            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-blue-500">

                Update User

            </button>

        </form>

    </div>

</div>

@endforeach

</body>
</html>