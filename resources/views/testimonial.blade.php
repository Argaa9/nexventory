<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Testimonial - Nexventory</title>

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
                bg-red-500/10 blur-[180px]
                rounded-full">
    </div>

</div>

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->

    <div class="mb-10">

        <h1 class="text-5xl font-bold">
            User Testimonials
        </h1>

        <p class="text-white/50 mt-3">
            Share your experience using Nexventory.
        </p>

    </div>

    <!-- SUCCESS -->

    @if(session('success'))

    <div class="mb-6 p-4 rounded-2xl bg-green-500/20 border border-green-500/30 text-green-300">

        {{ session('success') }}

    </div>

    @endif

    <!-- FORM -->

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 mb-8">

        <h2 class="text-2xl font-bold mb-6">
            Submit Testimonial
        </h2>

        <form
            method="POST"
            action="{{ route('testimonial.store') }}">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 text-white/70">
                    Rating
                </label>

                <select
                    name="rating"
                    required
                    class="w-full bg-black/30 border border-white/10 rounded-xl p-3">

                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4">⭐⭐⭐⭐ Very Good</option>
                    <option value="3">⭐⭐⭐ Good</option>
                    <option value="2">⭐⭐ Fair</option>
                    <option value="1">⭐ Poor</option>

                </select>

            </div>

            <div class="mb-5">

                <label class="block mb-2 text-white/70">
                    Your Experience
                </label>

                <textarea
                    name="message"
                    rows="5"
                    required
                    class="w-full bg-black/30 border border-white/10 rounded-xl p-4"
                    placeholder="Write your experience using Nexventory..."></textarea>

            </div>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 hover:opacity-90 transition">

                Submit Testimonial

            </button>

        </form>

    </div>

    <!-- LIST TESTIMONIAL -->

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($testimonials as $item)

        <div class="bg-white/5 border border-white/10 rounded-3xl p-6">

            <div class="mb-4 text-yellow-400 text-lg">

                @for($i = 1; $i <= $item->rating; $i++)
                    ⭐
                @endfor

            </div>

            <p class="text-white/70 italic leading-relaxed">
                "{{ $item->message }}"
            </p>

            <div class="mt-6 pt-4 border-t border-white/10">

                <h3 class="font-bold">
                    {{ $item->user->name }}
                </h3>

                <p class="text-white/40 text-sm">
                    {{ ucfirst($item->user->role) }}
                </p>

            </div>

        </div>

        @empty

        <div class="col-span-3 text-center py-20">

            <h3 class="text-2xl font-semibold">
                No Testimonials Yet
            </h3>

            <p class="text-white/50 mt-2">
                Be the first user to share your experience.
            </p>

        </div>

        @endforelse

    </div>

</div>

</body>
</html>