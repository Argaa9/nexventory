<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexventory - Smart Inventory Management</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html{
            scroll-behavior:smooth;
        }

        body{
            background: radial-gradient(circle at top,#0b0f1a,#05060a);
        }

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .fade-up{
            animation:fadeUp 1s ease forwards;
        }

        .glass{
            background:rgba(255,255,255,.04);
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,.08);
        }

        .glow{
            box-shadow:0 0 80px rgba(239,68,68,.25);
        }
    </style>
</head>

<body class="text-white overflow-x-hidden">

<!-- BACKGROUND EFFECT -->
<div class="fixed inset-0 -z-10 pointer-events-none">

    <div class="absolute top-0 left-1/2 -translate-x-1/2
    w-[700px] h-[700px]
    bg-red-500/10 blur-[180px] rounded-full">
    </div>

    <div class="absolute bottom-[-250px] right-[-150px]
    w-[500px] h-[500px]
    bg-pink-500/10 blur-[180px] rounded-full">
    </div>

</div>

<!-- NAVBAR -->
<header class="sticky top-0 z-50 border-b border-white/10 bg-black/30 backdrop-blur-xl">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex items-center gap-3">

            <img
                src="/logo.png"
                alt="Nexventory"
                class="w-8 h-8 object-contain">

            <div>
                <h1 class="font-bold tracking-wide">
                    Nexventory
                </h1>
            </div>

        </div>

        <!-- MENU -->
        <nav class="hidden md:flex items-center gap-8 text-sm text-white/70">

            <a href="#features" class="hover:text-white transition">
                Features
            </a>

            <a href="#workflow" class="hover:text-white transition">
                Workflow
            </a>

            <a href="#technology" class="hover:text-white transition">
                Technology
            </a>

            <a href="#about" class="hover:text-white transition">
                Team
            </a>

        </nav>

        <!-- BUTTON -->
        <div class="flex items-center gap-3">

            <a href="{{ route('login') }}"
               class="text-sm text-white/70 hover:text-white">
                Sign In
            </a>

            <a href="{{ route('login') }}"
               class="px-5 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-500 font-semibold hover:opacity-90 transition">
                Get Started
            </a>

        </div>

    </div>

</header>

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="grid md:grid-cols-2 gap-16 items-center">

        <!-- LEFT -->
        <div class="fade-up">

            <div class="inline-flex items-center gap-2
            px-4 py-2 rounded-full
            border border-red-500/20
            bg-red-500/10
            text-red-300 text-sm">

                🚀 Telkomsel Innovation Project 2026

            </div>

            <h1 class="mt-6 text-5xl md:text-7xl font-bold leading-tight">

                Smart
                <span class="text-red-400">
                    Inventory
                </span>

                Management
                For Modern
                Organizations

            </h1>

            <p class="mt-8 text-white/60 text-lg max-w-xl">

                Nexventory is a centralized inventory and asset
                management platform designed to help organizations
                monitor stock availability, manage borrowing
                activities, and generate real-time reports
                through a single intelligent dashboard.

            </p>

            <div class="flex flex-wrap gap-4 mt-10">

                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-xl
                   bg-gradient-to-r from-red-500 to-pink-500
                   font-semibold">

                    Launch System

                </a>

                <a href="#features"
                   class="px-6 py-3 rounded-xl
                   border border-white/15
                   hover:bg-white/5">

                    Explore Features

                </a>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-3 gap-8 mt-14">

                <div>
                    <h3 class="text-3xl font-bold">
                        99%
                    </h3>

                    <p class="text-white/50 text-sm mt-2">
                        Data Accuracy
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold">
                        Realtime
                    </h3>

                    <p class="text-white/50 text-sm mt-2">
                        Synchronization
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-bold">
                        Multi
                    </h3>

                    <p class="text-white/50 text-sm mt-2">
                        Role Access
                    </p>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative fade-up">

            <div class="absolute inset-0 bg-red-500/20 blur-[120px] rounded-full">
            </div>

            <div class="relative grid gap-5">

                <div class="glass rounded-2xl p-6 glow">

                    <h3 class="font-semibold text-lg">
                        📦 Inventory Monitoring
                    </h3>

                    <p class="text-white/60 text-sm mt-3">

                        Track inventory levels, stock movement,
                        and product conditions in real-time.

                    </p>

                </div>

                <div class="glass rounded-2xl p-6">

                    <h3 class="font-semibold text-lg">
                        🔄 Borrowing Management
                    </h3>

                    <p class="text-white/60 text-sm mt-3">

                        Manage borrowing requests,
                        approval workflows,
                        and return tracking efficiently.

                    </p>

                </div>

                <div class="glass rounded-2xl p-6">

                    <h3 class="font-semibold text-lg">
                        📊 Smart Analytics
                    </h3>

                    <p class="text-white/60 text-sm mt-3">

                        Visual reports and insights
                        for faster operational decisions.

                    </p>

                </div>

                <div class="glass rounded-2xl p-6 border border-red-500/30">

                    <h3 class="font-semibold text-red-300 text-lg">
                        👨‍💼 Role Based Access
                    </h3>

                    <p class="text-white/60 text-sm mt-3">

                        Dedicated dashboards for
                        Admin, Staff, and Manager
                        with secure permissions.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- PROBLEM STATEMENT -->
<section class="max-w-7xl mx-auto px-6 py-24">
      <div class="text-center">

        <span class="text-red-400 font-semibold tracking-widest uppercase">
            Problem Statement
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            Why Nexventory Was Built
        </h2>

        <p class="text-white/60 max-w-3xl mx-auto mt-5">
            Many organizations still rely on spreadsheets and manual inventory
            records, causing stock discrepancies, delayed reporting,
            misplaced assets, and inefficient borrowing processes.
            Nexventory addresses these challenges through automation,
            real-time synchronization, and centralized inventory control.
        </p>


    <div class="mt-20 grid lg:grid-cols-2 gap-12">

        <div>

            <div class="border-l-2 border-red-500 pl-6">

                <h3 class="text-2xl font-semibold mb-3">
                    Centralized Asset Management
                </h3>

                <p class="text-white/60 leading-relaxed">
                    All inventory records are stored in a single system,
                    allowing organizations to manage assets more efficiently
                    while reducing data duplication and manual tracking.
                </p>

            </div>

        </div>

        <div>

            <div class="border-l-2 border-red-500 pl-6">

                <h3 class="text-2xl font-semibold mb-3">
                    Complete Borrowing Visibility
                </h3>

                <p class="text-white/60 leading-relaxed">
                    Every borrowing and return transaction is recorded,
                    making it easier to monitor asset usage and maintain
                    a transparent borrowing history.
                </p>

            </div>

        </div>

        <div>

            <div class="border-l-2 border-red-500 pl-6">

                <h3 class="text-2xl font-semibold mb-3">
                    Data-Driven Reporting
                </h3>

                <p class="text-white/60 leading-relaxed">
                    Generate inventory reports and operational summaries
                    to support decision-making and improve resource planning.
                </p>

            </div>

        </div>

        <div>

            <div class="border-l-2 border-red-500 pl-6">

                <h3 class="text-2xl font-semibold mb-3">
                    Secure Role-Based Access
                </h3>

                <p class="text-white/60 leading-relaxed">
                    Different user roles ensure that administrators,
                    staff, and managers access only the features
                    relevant to their responsibilities.
                </p>

            </div>

        </div>

    </div>

</section>
<!-- FEATURES -->
<section id="features" class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-red-400 font-semibold tracking-widest uppercase">
            Core Features
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            Built To Simplify Inventory Operations
        </h2>

        <p class="text-white/60 max-w-3xl mx-auto mt-5">
            Nexventory provides a centralized platform that enables organizations
            to manage inventory assets, borrowing activities, reporting, and user
            access control through a modern web-based system.
        </p>

    </div>

    <div class="mt-20 grid lg:grid-cols-2 gap-12">

        <div class="border-l-2 border-red-500 pl-6">

            <h3 class="text-2xl font-semibold mb-4">
                Inventory Management
            </h3>

            <p class="text-white/60 leading-relaxed">
                Manage inventory records, categories, locations, stock quantities,
                and item conditions through a centralized inventory database.
            </p>

        </div>

        <div class="border-l-2 border-red-500 pl-6">

            <h3 class="text-2xl font-semibold mb-4">
                Borrowing Management
            </h3>

            <p class="text-white/60 leading-relaxed">
                Record borrowing and return transactions while maintaining
                complete asset tracking and transaction history.
            </p>

        </div>

        <div class="border-l-2 border-red-500 pl-6">

            <h3 class="text-2xl font-semibold mb-4">
                Reports & Analytics
            </h3>

            <p class="text-white/60 leading-relaxed">
                Generate inventory reports, monitor borrowing trends,
                and export operational data into PDF and Excel formats.
            </p>

        </div>

        <div class="border-l-2 border-red-500 pl-6">

            <h3 class="text-2xl font-semibold mb-4">
                Role-Based Access Control
            </h3>

            <p class="text-white/60 leading-relaxed">
                Secure system access through role management for
                Administrators, Staff, and Managers.
            </p>

        </div>

    </div>

</section>



<!-- WORKFLOW -->
<section id="workflow" class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-red-400 font-semibold uppercase tracking-widest">
            System Workflow
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            How Nexventory Operates
        </h2>

        <p class="text-white/60 mt-5 max-w-3xl mx-auto">
            Every activity inside Nexventory follows a structured workflow,
            ensuring inventory data remains organized, transparent,
            and easy to monitor.
        </p>

    </div>

    <div class="mt-20">

        <div class="grid lg:grid-cols-5 gap-8">

            <div>
                <span class="text-red-400 text-sm font-semibold">
                    STEP 01
                </span>

                <h3 class="text-2xl font-bold mt-3">
                    Login
                </h3>

                <p class="text-white/60 mt-4 leading-relaxed">
                    Users access the platform according to their assigned role.
                </p>
            </div>

            <div>
                <span class="text-red-400 text-sm font-semibold">
                    STEP 02
                </span>

                <h3 class="text-2xl font-bold mt-3">
                    Manage Assets
                </h3>

                <p class="text-white/60 mt-4 leading-relaxed">
                    Inventory items are registered, categorized,
                    and monitored in real time.
                </p>
            </div>

            <div>
                <span class="text-red-400 text-sm font-semibold">
                    STEP 03
                </span>

                <h3 class="text-2xl font-bold mt-3">
                    Borrow Items
                </h3>

                <p class="text-white/60 mt-4 leading-relaxed">
                    Borrowing transactions are recorded automatically
                    within the system.
                </p>
            </div>

            <div>
                <span class="text-red-400 text-sm font-semibold">
                    STEP 04
                </span>

                <h3 class="text-2xl font-bold mt-3">
                    Return Assets
                </h3>

                <p class="text-white/60 mt-4 leading-relaxed">
                    Returned items update inventory records and history data.
                </p>
            </div>

            <div>
                <span class="text-red-400 text-sm font-semibold">
                    STEP 05
                </span>

                <h3 class="text-2xl font-bold mt-3">
                    Generate Reports
                </h3>

                <p class="text-white/60 mt-4 leading-relaxed">
                    Managers review analytics and export reports
                    for operational evaluation.
                </p>
            </div>

        </div>

    </div>

</section>



<!-- TECHNOLOGY -->
<section id="technology" class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-red-400 font-semibold uppercase tracking-widest">
            Technology Stack
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            Built With Reliable Technologies
        </h2>

        <p class="text-white/60 max-w-2xl mx-auto mt-5">
            Nexventory is developed using modern web technologies
            to ensure performance, scalability, and security.
        </p>

    </div>

    <div class="flex flex-wrap justify-center gap-4 mt-16">

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            Laravel 12
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            PHP 8
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            MySQL
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            Tailwind CSS
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            Chart.js
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            DomPDF
        </span>

        <span class="px-6 py-3 rounded-full border border-white/10 bg-white/5">
            Laravel Breeze
        </span>

    </div>

</section>

<!-- SYSTEM PREVIEW -->
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-red-400 font-semibold uppercase tracking-widest">
            System Preview
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            Modern Inventory Dashboard
        </h2>

        <p class="text-white/60 mt-5 max-w-3xl mx-auto">
            Monitor inventory assets, borrowing transactions,
            stock conditions, and operational activities
            through a centralized dashboard.
        </p>

    </div>

    <div class="mt-16 glass rounded-3xl border border-white/10 overflow-hidden">

        <!-- Browser Bar -->
        <div class="flex items-center gap-2 px-6 py-4 border-b border-white/10 bg-black/20">

            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
            <div class="w-3 h-3 rounded-full bg-green-500"></div>

            <span class="ml-4 text-white/40 text-sm">
                Dashboard Preview
            </span>

        </div>

        <div class="p-8">

            <!-- KPI -->

            <div class="grid md:grid-cols-4 gap-5">

                <div class="bg-white/5 rounded-2xl p-5 border border-white/10">

                    <p class="text-white/50 text-sm">
                        Total Assets
                    </p>

                    <h3 class="text-4xl font-bold mt-2">
                        248
                    </h3>

                </div>

                <div class="bg-white/5 rounded-2xl p-5 border border-white/10">

                    <p class="text-white/50 text-sm">
                        Categories
                    </p>

                    <h3 class="text-4xl font-bold mt-2">
                        12
                    </h3>

                </div>

                <div class="bg-white/5 rounded-2xl p-5 border border-white/10">

                    <p class="text-white/50 text-sm">
                        Borrowed
                    </p>

                    <h3 class="text-4xl font-bold mt-2">
                        28
                    </h3>

                </div>

                <div class="bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl p-5">

                    <p class="text-sm">
                        Low Stock
                    </p>

                    <h3 class="text-4xl font-bold mt-2">
                        5
                    </h3>

                </div>

            </div>

            <!-- MAIN CONTENT -->

            <div class="grid md:grid-cols-2 gap-6 mt-8">

                <div class="bg-white/5 border border-white/10 rounded-2xl p-6">

                    <h3 class="font-bold text-xl mb-4">
                        Recent Activities
                    </h3>

                    <div class="space-y-3">

                        <div class="border-b border-white/10 pb-2">
                            Asset borrowing recorded
                        </div>

                        <div class="border-b border-white/10 pb-2">
                            Inventory item updated
                        </div>

                        <div class="border-b border-white/10 pb-2">
                            Monthly report generated
                        </div>

                    </div>

                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-6">

                    <h3 class="font-bold text-xl mb-4">
                        Asset Status
                    </h3>

                    <div class="space-y-4">

                        <div class="flex justify-between">
                            <span>Tersedia</span>
                            <span class="text-green-400">120</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Dipinjam</span>
                            <span class="text-yellow-400">28</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Maintenance</span>
                            <span class="text-blue-400">6</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Rusak</span>
                            <span class="text-red-400">2</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- TESTIMONIALS -->
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center mb-16">

        <span class="text-red-400 font-semibold uppercase tracking-widest">
            Testimonials
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            What Our Users Say
        </h2>

        <p class="text-white/60 max-w-2xl mx-auto mt-5">
            Feedback from administrators, staff, and managers who use
            Nexventory to manage inventory, borrowing activities,
            and operational reporting.
        </p>

    </div>

    <div class="flex flex-wrap justify-center gap-8">

        @foreach($testimonials as $item)
<div class="glass rounded-2xl p-6 w-full max-w-[280px] border border-white/10 hover:border-red-500/50 transition">

           <div class="text-yellow-400 mb-3 text-sm">
    @for($i=1;$i<=$item->rating;$i++)
        ⭐
    @endfor
</div>

<p class="text-white/60 italic text-sm leading-relaxed min-h-[60px]">
    "{{ $item->message }}"
</p>

<div class="mt-5 pt-4 border-t border-white/10">

    <h4 class="font-semibold">
        {{ $item->user->name }}
    </h4>

    <p class="text-xs text-white/40">
        {{ ucfirst($item->user->role) }}
    </p>

</div>

        </div>

        @endforeach

    </div>

</section>

<!-- TEAM -->
<section id="about" class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-red-400 font-semibold uppercase tracking-widest">
            Development Team
        </span>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
            Meet The Creator
        </h2>

        <p class="text-white/60 mt-5 max-w-2xl mx-auto">
              Nexventory was built entirely from scratch, starting from the initial
    concept to the final implementation. I independently designed the user
    interface, developed the backend, created the database, and implemented
    every core feature in less than a week.

    </div>

    <div class="max-w-4xl mx-auto mt-16">

        <div class="glass rounded-3xl p-10">

            <div class="grid md:grid-cols-2 gap-10 items-center">

                <!-- FOTO -->
                <div class="text-center">

                    <!-- Ganti dengan foto sendiri -->
                    <img src="{{ asset('images/arga.jpeg') }}"
                        class="w-60 h-60 rounded-full mx-auto object-cover border-4 border-red-500 shadow-2xl shadow-red-500/20">

                    <div class="flex justify-center gap-3 mt-6">

                        <span class="px-4 py-2 rounded-full bg-red-500/10 text-red-400 text-sm">
                            Laravel
                        </span>

                        <span class="px-4 py-2 rounded-full bg-red-500/10 text-red-400 text-sm">
                            PHP
                        </span>

                        <span class="px-4 py-2 rounded-full bg-red-500/10 text-red-400 text-sm">
                            MySQL
                        </span>

                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div>

                    <h3 class="text-4xl font-bold">
                        Arga Pratama
                    </h3>

                    <p class="text-red-400 mt-2 text-lg">
                        Full Stack Developer
                    </p>

                    <p class="text-white/60 mt-6 leading-8">

                        An Informatics Engineering student passionate about
                        building modern web applications, inventory systems,
                        and digital business solutions.

                        Nexventory was created to help organizations manage
                        inventory efficiently through an intuitive interface,
                        real-time monitoring, and intelligent stock management.

                    </p>

                    <!-- STATISTIC -->
                    <div class="grid grid-cols-3 gap-4 mt-8">

                        <div class="glass rounded-xl p-5 text-center">

                            <h4 class="text-3xl font-bold text-red-400">
                                7+
                            </h4>

                            <p class="text-white/50 text-sm mt-1">
                                Projects
                            </p>

                        </div>

                        <div class="glass rounded-xl p-5 text-center">

                            <h4 class="text-3xl font-bold text-red-400">
                                3+
                            </h4>

                            <p class="text-white/50 text-sm mt-1">
                                Years Learning
                            </p>

                        </div>

                        <div class="glass rounded-xl p-5 text-center">

                            <h4 class="text-3xl font-bold text-red-400">
                                100%
                            </h4>

                            <p class="text-white/50 text-sm mt-1">
                                Passion
                            </p>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex flex-wrap gap-4 mt-8">

                        <a href="{{ asset('files/Portofolio_ArgaPratama.pdf') }}"
   download
   class="px-6 py-3 rounded-xl bg-red-500 hover:bg-red-600 transition">

    Portfolio

</a>

                      <a href="https://wa.me/6283829335748?text=Hello%20Arga,%20I%20would%20like%20to%20know%20more%20about%20Nexventory."
   target="_blank"
   class="px-6 py-3 rounded-xl border border-white/10 hover:border-red-500 transition">

    Contact

</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="glass rounded-3xl p-12 text-center">

        <span class="text-red-400 uppercase tracking-widest font-semibold">
            Ready To Transform Inventory Management?
        </span>

        <h2 class="text-4xl md:text-6xl font-bold mt-6">

            Experience
            <span class="text-red-400">
                Nexventory
            </span>

            Today

        </h2>

        <p class="text-white/60 mt-6 max-w-2xl mx-auto">

            Simplify inventory monitoring,
            asset borrowing,
            stock management,
            and business reporting
            with one integrated platform.

        </p>

        <div class="flex flex-wrap justify-center gap-4 mt-10">

            <a href="{{ route('login') }}"
               class="px-8 py-4 rounded-xl
               bg-gradient-to-r from-red-500 to-pink-500
               font-semibold">

                Launch Dashboard

            </a>

            <a href="#features"
               class="px-8 py-4 rounded-xl
               border border-white/10
               hover:bg-white/5 transition">

                Learn More

            </a>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="border-t border-white/10 mt-12">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid md:grid-cols-3 gap-10">

            <!-- BRAND -->

            <div>

                <div class="flex items-center gap-3">

                    <img
                        src="/logo.png"
                        alt="Nexventory"
                        class="w-8 h-8 object-contain">

                    <h3 class="font-bold text-xl">
                        Nexventory
                    </h3>

                </div>

                <p class="text-white/50 mt-4">

                    Smart Inventory &
                    Asset Management Platform
                    built for modern organizations.

                </p>

            </div>

            <!-- LINKS -->

            <div>

                <h4 class="font-semibold mb-4">
                    Quick Links
                </h4>

                <div class="space-y-2 text-white/60">

                    <a href="#features" class="block hover:text-white">
                        Features
                    </a>

                    <a href="#workflow" class="block hover:text-white">
                        Workflow
                    </a>

                    <a href="#technology" class="block hover:text-white">
                        Technology
                    </a>

                    <a href="#about" class="block hover:text-white">
                        Team
                    </a>

                </div>

            </div>

            <!-- CONTACT -->

            <div>

                <h4 class="font-semibold mb-4">
                    Project Information
                </h4>

                <div class="space-y-2 text-white/60">

                    <p>
                        Universitas Kuningan
                    </p>

                    <p>
                        Informatics Engineering
                    </p>

                    <p>
                        Innovation Competition Project 2026
                    </p>

                </div>

            </div>

        </div>

        <div class="border-t border-white/10 mt-10 pt-6
                    flex flex-col md:flex-row
                    justify-between items-center gap-3">

            <p class="text-white/50 text-sm">

                © 2026 Nexventory.
                All Rights Reserved.

            </p>

            <p class="text-white/50 text-sm">

                Developed By
                <span class="text-red-400 font-semibold">
                    Arga Pratama
                </span>

            </p>

        </div>

    </div>

</footer>

</body>
</html>

