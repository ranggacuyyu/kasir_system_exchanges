<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Meja {{ $meja }} — Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon-dark:    #5d1a1a;
            --maroon-primary: #721c24;
            --maroon-secondary: #a52834;
            --base: #f9f3ed;
            --amber: #f59e0b;
        }

        * { box-sizing: border-box; }
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--base);
            min-height: 100vh;
        }

        /* Animated background rings */
        .hero-bg {
            background: radial-gradient(ellipse at 70% 0%, rgba(245,158,11,0.18) 0%, transparent 60%),
                        radial-gradient(ellipse at 10% 90%, rgba(114,28,36,0.22) 0%, transparent 55%),
                        linear-gradient(160deg, var(--maroon-dark) 0%, var(--maroon-primary) 55%, #8b2a35 100%);
        }

        .step-glow-1 { box-shadow: 0 0 0 6px rgba(114,28,36,0.12), 0 4px 18px rgba(114,28,36,0.25); }
        .step-glow-2 { box-shadow: 0 0 0 6px rgba(245,158,11,0.14), 0 4px 18px rgba(245,158,11,0.22); }
        .step-glow-3 { box-shadow: 0 0 0 6px rgba(5,150,105,0.12), 0 4px 18px rgba(5,150,105,0.20); }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-8px); }
        }
        @keyframes pulse-ring {
            0%   { transform: scale(1);   opacity: 0.6; }
            100% { transform: scale(1.55); opacity: 0;   }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .float-anim  { animation: float 3.2s ease-in-out infinite; }
        .slide-up-1  { animation: slide-up 0.55s ease both; }
        .slide-up-2  { animation: slide-up 0.55s 0.10s ease both; }
        .slide-up-3  { animation: slide-up 0.55s 0.20s ease both; }
        .slide-up-4  { animation: slide-up 0.55s 0.30s ease both; }

        .pulse-ring::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 9999px;
            border: 2px solid rgba(52,211,153,0.7);
            animation: pulse-ring 1.6s cubic-bezier(0.2,0.8,0.4,1) infinite;
        }

        /* Step connector line */
        .step-connector {
            width: 2px;
            background: linear-gradient(to bottom, var(--maroon-primary) 0%, rgba(114,28,36,0.1) 100%);
        }

        .cta-btn {
            background: linear-gradient(135deg, #a52834 0%, #721c24 60%, #5d1a1a 100%);
            box-shadow: 0 8px 32px rgba(114,28,36,0.45), 0 2px 8px rgba(0,0,0,0.2);
            transition: all 0.22s ease;
        }
        .cta-btn:hover  { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(114,28,36,0.55); }
        .cta-btn:active { transform: translateY(0);    box-shadow: 0 4px 18px rgba(114,28,36,0.35); }

        .badge-live {
            background: linear-gradient(90deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.04) 100%);
            border: 1px solid rgba(245,158,11,0.35);
            backdrop-filter: blur(8px);
        }
    </style>
</head>

<body class="flex flex-col" x-data="{ meja: '{{ $meja }}' }">

    {{-- ═══════════════ TOP HEADER ═══════════════ --}}
    <header class="hero-bg sticky top-0 z-40 px-5 py-3.5 flex items-center justify-between border-b border-amber-400/25 shadow-2xl">
        <div class="flex items-center gap-3">
            <div class="relative w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shrink-0">
                <i class="fa-solid fa-utensils text-[#721c24] text-base font-black"></i>
            </div>
            <div>
                <p class="text-[9px] font-extrabold tracking-[0.18em] text-amber-400 uppercase">Warung Masakan Padang</p>
                <h1 class="text-sm font-black text-white leading-tight tracking-tight">Lapau Uda Sutan</h1>
            </div>
        </div>

        <div class="badge-live flex items-center gap-2 px-3 py-1.5 rounded-full">
            <span class="relative flex w-2.5 h-2.5 pulse-ring">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 block"></span>
            </span>
            <span class="text-[11px] font-extrabold text-amber-300" x-text="'Meja ' + meja"></span>
        </div>
    </header>


    {{-- ═══════════════ MAIN ═══════════════ --}}
    <main class="flex-1 w-full max-w-lg mx-auto px-4 pt-5 pb-10 space-y-5">

        {{-- ── HERO BANNER ── --}}
        <div class="slide-up-1 hero-bg rounded-[28px] p-7 text-white text-center relative overflow-hidden border border-white/10 shadow-2xl">
            <!-- Decorative circles -->
            <div class="absolute -top-16 -right-16 w-52 h-52 rounded-full bg-amber-400/[0.08] blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 rounded-full bg-white/[0.04] blur-xl pointer-events-none"></div>

            <!-- Floating icon -->
            <div class="float-anim inline-flex w-20 h-20 rounded-[22px] bg-gradient-to-br from-amber-300 via-amber-500 to-amber-600 items-center justify-center text-[#5d1a1a] text-3xl shadow-2xl mb-4 border-2 border-amber-200/40">
                <i class="fa-solid fa-bowl-food"></i>
            </div>

            <div class="space-y-2">
                <span class="inline-block px-3 py-0.5 rounded-full bg-amber-400/20 border border-amber-400/30 text-amber-300 text-[10px] font-extrabold uppercase tracking-[0.15em]">
                    Selamat Datang
                </span>
                <h2 class="text-[22px] font-black leading-tight" x-text="'Anda di Meja ' + meja"></h2>
                <p class="text-xs text-white/70 leading-relaxed max-w-xs mx-auto">
                    Pesan masakan Minang asli langsung dari meja Anda — tanpa antri, tanpa repot!
                </p>
            </div>

            <!-- Tagline strip -->
            <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-center gap-2 text-[10px] text-amber-300/80 font-bold">
                <i class="fa-solid fa-star text-amber-400 text-[9px]"></i>
                <span>Rendang · Ayam Pop · Gulai Tunjang · Teh Talua</span>
                <i class="fa-solid fa-star text-amber-400 text-[9px]"></i>
            </div>
        </div>


        {{-- ── HOW-TO CARD ── --}}
        <div class="slide-up-2 bg-white rounded-[24px] overflow-hidden border border-zinc-200/70 shadow-md">

            <!-- Card Header -->
            <div class="px-5 py-4 border-b border-zinc-100 flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                    <i class="fa-solid fa-wand-magic-sparkles text-[#721c24] text-xs"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-zinc-900">Cara Melakukan Pemesanan</h3>
                    <p class="text-[10px] text-zinc-400 font-medium">3 langkah mudah tanpa antri ke kasir</p>
                </div>
            </div>

            <!-- Steps -->
            <div class="px-5 py-5 space-y-0">

                {{-- Step 1 --}}
                <div class="flex gap-4 items-start">
                    <div class="flex flex-col items-center">
                        <div class="step-glow-1 w-10 h-10 rounded-2xl bg-gradient-to-br from-[#a52834] to-[#5d1a1a] text-white flex items-center justify-center shrink-0 shadow-md">
                            <i class="fa-solid fa-list text-sm"></i>
                        </div>
                        <div class="step-connector flex-1 mt-1.5 mb-1.5 h-8 mx-auto"></div>
                    </div>
                    <div class="pb-5 pt-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[9px] font-extrabold uppercase tracking-widest text-[#a52834]">Langkah 1</span>
                        </div>
                        <h4 class="font-extrabold text-zinc-900 text-sm">Pilih Menu Masakan Favorit</h4>
                        <p class="text-[11px] text-zinc-500 mt-0.5 leading-relaxed">
                            Browse katalog lauk Padang lengkap, filter per kategori (Daging, Ayam, Gulai, Minuman), dan tentukan jumlah porsi masing-masing.
                        </p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="flex gap-4 items-start">
                    <div class="flex flex-col items-center">
                        <div class="step-glow-2 w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 text-[#5d1a1a] flex items-center justify-center shrink-0 shadow-md">
                            <i class="fa-solid fa-credit-card text-sm"></i>
                        </div>
                        <div class="step-connector flex-1 mt-1.5 mb-1.5 h-8 mx-auto" style="background: linear-gradient(to bottom, #f59e0b80, transparent)"></div>
                    </div>
                    <div class="pb-5 pt-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[9px] font-extrabold uppercase tracking-widest text-amber-600">Langkah 2</span>
                        </div>
                        <h4 class="font-extrabold text-zinc-900 text-sm">Isi Nama & Pilih Cara Bayar</h4>
                        <p class="text-[11px] text-zinc-500 mt-0.5 leading-relaxed">
                            Masukkan nama pemesan dan catatan khusus untuk dapur. Pilih bayar via QRIS instan atau tunai saat makanan tiba di meja.
                        </p>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-full bg-sky-50 border border-sky-200 text-sky-700 text-[9px] font-extrabold">QRIS All-Payment</span>
                            <span class="px-2 py-0.5 rounded-full bg-zinc-100 border border-zinc-200 text-zinc-600 text-[9px] font-bold">Bayar Tunai</span>
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="flex gap-4 items-start">
                    <div class="flex flex-col items-center">
                        <div class="step-glow-3 w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md">
                            <i class="fa-solid fa-fire-burner text-sm"></i>
                        </div>
                    </div>
                    <div class="pt-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[9px] font-extrabold uppercase tracking-widest text-emerald-600">Langkah 3</span>
                        </div>
                        <h4 class="font-extrabold text-zinc-900 text-sm">Dapur Masak & Diantar ke Meja</h4>
                        <p class="text-[11px] text-zinc-500 mt-0.5 leading-relaxed">
                            Pesanan langsung masuk ke layar dapur. Chef menyiapkan hidangan hangat dan pramusaji mengantarkan langsung ke Meja Anda!
                        </p>
                        <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                            <i class="fa-solid fa-clock text-emerald-600 text-[9px]"></i>
                            <span class="text-[9px] font-extrabold text-emerald-700">Estimasi Penyajian ≈ 10 – 15 Menit</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Trust Badges -->
            <div class="px-5 pb-5">
                <div class="grid grid-cols-3 gap-2 pt-4 border-t border-zinc-100">
                    <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl bg-zinc-50 border border-zinc-100">
                        <i class="fa-solid fa-shield-halved text-[#721c24] text-sm"></i>
                        <span class="text-[9px] font-bold text-zinc-600 text-center leading-tight">Pembayaran Aman</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl bg-zinc-50 border border-zinc-100">
                        <i class="fa-solid fa-bolt text-amber-500 text-sm"></i>
                        <span class="text-[9px] font-bold text-zinc-600 text-center leading-tight">Pesanan Cepat</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl bg-zinc-50 border border-zinc-100">
                        <i class="fa-solid fa-leaf text-emerald-500 text-sm"></i>
                        <span class="text-[9px] font-bold text-zinc-600 text-center leading-tight">Bahan Segar</span>
                    </div>
                </div>
            </div>
        </div>


        {{-- ── CTA BUTTON ── --}}
        <div class="slide-up-3 space-y-3">
            <a href="{{ route('order.menu', ['meja' => $meja]) }}"
               class="cta-btn w-full py-4 rounded-[18px] text-white font-extrabold text-sm flex items-center justify-center gap-2.5 border border-white/10">
                <i class="fa-solid fa-bowl-rice text-amber-300 text-base"></i>
                <span>Lihat Menu & Mulai Pesan</span>
                <i class="fa-solid fa-arrow-right text-amber-300 text-sm"></i>
            </a>

            <p class="text-center text-[10px] text-zinc-400 font-medium">
                Dengan memesan, Anda menyetujui ketentuan layanan Lapau Uda Sutan.
            </p>
        </div>

    </main>


    {{-- ═══════════════ FOOTER ═══════════════ --}}
    <footer class="py-4 px-5 border-t border-zinc-200 bg-white text-center">
        <p class="text-[10px] text-zinc-400">© 2026 <strong class="text-[#721c24]">Lapau Uda Sutan</strong> · Sistem Self-Ordering QR Digital</p>
    </footer>

    @livewireScripts
</body>
</html>
