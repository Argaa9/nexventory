<header class="border-b border-white/10 bg-black/30 backdrop-blur-md sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex items-center gap-3">

            <img src="/logo.png"
                 alt="Nexventory"
                 class="w-8 h-8 object-contain">

            <div>
                <h1 class="font-bold text-xl text-white">
                    Nexventory
                </h1>

                <p class="text-xs text-white/40">
                    Smart Inventory System
                </p>
            </div>

        </div>

        <!-- NAVIGATION -->
        <nav class="hidden md:flex items-center gap-8">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->is('dashboard') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                Dashboard
            </a>

            @if(
                auth()->user()->role == 'admin' ||
                auth()->user()->role == 'staff'
            )

                <a href="{{ route('products.index') }}"
                   class="{{ request()->is('products*') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                    Data Barang
                </a>

                <a href="{{ route('borrowings.index') }}"
                   class="{{ request()->is('borrowings*') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                    Peminjaman
                </a>

                <a href="{{ route('history') }}"
                   class="{{ request()->is('history') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                    Riwayat
                </a>

            @endif

            @if(
                auth()->user()->role == 'admin' ||
                auth()->user()->role == 'manager'
            )

                <a href="{{ route('reports.index') }}"
                   class="{{ request()->is('reports*') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                    Laporan
                </a>

            @endif

            @if(auth()->user()->role == 'admin')

                <a href="{{ route('users.index') }}"
                   class="{{ request()->is('users*') ? 'text-red-400 font-semibold' : 'text-white/60 hover:text-white transition' }}">
                    Manajemen User
                </a>

            @endif

        </nav>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- STATUS -->
            <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded-full border border-green-500/20 bg-green-500/10">

                <span class="w-2 h-2 rounded-full bg-green-400"></span>

                <span class="text-xs text-green-400">
                    System Online
                </span>

            </div>

           <div class="relative group">

    <button class="flex items-center gap-2">

        <div class="w-10 h-10 rounded-full
                    bg-gradient-to-r from-red-500 to-pink-500
                    flex items-center justify-center font-bold">

            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

        </div>

        <div class="hidden md:block leading-tight">

            <p class="text-sm font-medium text-white">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-white/40">
                {{ ucfirst(auth()->user()->role) }}
            </p>

        </div>

        <svg class="w-4 h-4 text-white/50"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"/>

        </svg>

    </button>

                <!-- DROPDOWN -->
                <div class="absolute right-0 mt-3 w-56
                            bg-[#111827]
                            border border-white/10
                            rounded-2xl
                            shadow-2xl
                            opacity-0 invisible
                            group-hover:opacity-100
                            group-hover:visible
                            transition-all duration-200">

                    <div class="p-4 border-b border-white/10">

                        <p class="font-semibold text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-white/40">
                            {{ ucfirst(auth()->user()->role) }}
                        </p>

                    </div>

                    <a href="{{ route('testimonial.index') }}"
                       class="block px-4 py-3 text-white/70 hover:bg-white/5 hover:text-white transition">

                        ⭐ Testimonial

                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-3 text-white/70 hover:bg-white/5 hover:text-white transition">

                        ⚙️ Profile

                    </a>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin logout?')"
                            class="w-full text-left px-4 py-3 text-red-400 hover:bg-red-500/10 transition">

                            🚪 Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>