<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Nexventory</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: radial-gradient(circle at top, #0b0f1a, #05060a);
    }
  </style>
</head>

<body class="text-white min-h-screen flex items-center justify-center py-12 relative">

<!-- GLOW -->
<div class="pointer-events-none fixed inset-0 -z-10">
  <div class="absolute bottom-[-200px] left-1/2 -translate-x-1/2 w-[500px] h-[500px]
              bg-red-500/10 blur-[160px] rounded-full"></div>
</div>

<!-- REGISTER CARD (TIDAK SCROLL) -->
<div class="w-full max-w-md p-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-md">

  <!-- LOGO -->
  <div class="flex items-center justify-center gap-2 font-bold text-xl mb-6">
    <img src="/logo.png" class="w-6 h-6" alt="logo">
    <span>Nexventory</span>
  </div>

  <!-- TITLE -->
  <h2 class="text-2xl font-bold text-center">
    Create Account
  </h2>
  <p class="text-white/50 text-sm text-center mt-2">
    Register to start managing your inventory
  </p>

  <!-- FORM -->
  <form class="mt-8 space-y-4">

    <div>
      <label class="text-sm text-white/60">Full Name</label>
      <input type="text"
        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10 focus:border-red-500 outline-none"
        placeholder="Your name">
    </div>

    <div>
      <label class="text-sm text-white/60">Email</label>
      <input type="email"
        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10 focus:border-red-500 outline-none"
        placeholder="you@example.com">
    </div>

    <div>
      <label class="text-sm text-white/60">Password</label>
      <input type="password"
        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10 focus:border-red-500 outline-none"
        placeholder="••••••••">
    </div>

    <div>
      <label class="text-sm text-white/60">Confirm Password</label>
      <input type="password"
        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10 focus:border-red-500 outline-none"
        placeholder="••••••••">
    </div>

    <div>
      <label class="text-sm text-white/60">Phone Number</label>
      <input type="text"
        class="w-full mt-2 px-4 py-3 rounded-lg bg-black/30 border border-white/10 focus:border-red-500 outline-none"
        placeholder="08xxxxxxxxxx">
    </div>

    <button type="submit"
      class="w-full py-3 rounded-lg bg-gradient-to-r from-red-500 to-pink-500 font-semibold hover:opacity-90 transition">
      Create Account
    </button>

    <p class="text-center text-white/40 text-sm mt-4">
      Already have an account?
      <a href="/login" class="text-red-400 hover:underline">
        Sign in
      </a>
    </p>

  </form>

  <p class="text-center text-white/40 text-xs mt-6">
    Secure registration • Enterprise-grade system
  </p>

</div>

</body>
</html>