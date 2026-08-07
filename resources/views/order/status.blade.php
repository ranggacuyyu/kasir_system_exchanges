<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan — Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon-dark:    #5d1a1a;
            --maroon-primary: #721c24;
            --maroon-sec:     #a52834;
            --base:           #f9f3ed;
        }
        [x-cloak] { display: none !important; }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--base); }

        .top-bar {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--maroon-primary) 60%, var(--maroon-sec) 100%);
        }

        /* Success hero */
        .status-hero {
            background: radial-gradient(ellipse at 70% 0%, rgba(245,158,11,0.18) 0%, transparent 55%),
                        radial-gradient(ellipse at 0% 100%, rgba(114,28,36,0.20) 0%, transparent 50%),
                        linear-gradient(155deg, var(--maroon-dark) 0%, var(--maroon-primary) 55%, #8b2a35 100%);
            border-radius: 28px;
        }

        .card { background:#fff; border:1.5px solid #e8e3dc; border-radius:22px; }

        /* Stepper */
        .step-done   { background: linear-gradient(135deg, #10b981, #059669); }
        .step-active { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .step-idle   { background: #e4e4e7; }

        .step-line-done   { background: linear-gradient(to bottom, #10b981, #10b98133); }
        .step-line-active { background: linear-gradient(to bottom, #f59e0b, #f59e0b33); }
        .step-line-idle   { background: #e4e4e7; }

        /* Animated cooking icon */
        @keyframes cookbounce {
            0%,100% { transform: translateY(0) rotate(-3deg); }
            50%      { transform: translateY(-6px) rotate(3deg); }
        }
        @keyframes orbit {
            from { transform: rotate(0deg) translateX(22px) rotate(0deg); opacity:1; }
            to   { transform: rotate(360deg) translateX(22px) rotate(-360deg); opacity:0.2; }
        }
        @keyframes slide-up {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }

        .cook-bounce { animation: cookbounce 1.6s ease-in-out infinite; }
        .orbit-dot   { animation: orbit 2.2s linear infinite; }
        .s1 { animation: slide-up 0.45s ease both; }
        .s2 { animation: slide-up 0.45s 0.10s ease both; }
        .s3 { animation: slide-up 0.45s 0.20s ease both; }
        .s4 { animation: slide-up 0.45s 0.30s ease both; }

        /* Timer ring */
        @keyframes ring-spin {
            to { stroke-dashoffset: 0; }
        }

        /* Receipt summary */
        .receipt-row { display:flex; justify-content:space-between; font-size:11px; }

        .btn-add {
            border: 1.5px solid #e8e3dc;
            border-radius: 14px;
            transition: all 0.2s;
        }
        .btn-add:hover { border-color: var(--maroon-primary); background: #fdf8f7; }

        .btn-refresh {
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-dark));
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(114,28,36,0.30);
            transition: all 0.2s;
        }
        .btn-refresh:hover { box-shadow: 0 6px 20px rgba(114,28,36,0.40); }
    </style>
</head>

<body class="min-h-screen pb-10" x-data="orderStatusSystem('{{ $orderId }}')">

    {{-- ═══════════ HEADER ═══════════ --}}
    <header class="top-bar sticky top-0 z-40 px-4 py-3 flex items-center gap-3 border-b border-amber-400/20 shadow-xl">
        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center border border-white/15 shrink-0">
            <i class="fa-solid fa-clock-rotate-left text-amber-300 text-xs"></i>
        </div>
        <div class="flex-1">
            <p class="text-[9px] font-extrabold tracking-[0.15em] text-amber-400 uppercase">Tracking Pesanan</p>
            <h1 class="text-sm font-black text-white leading-tight" x-text="orderId"></h1>
        </div>
        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-amber-400/30">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-[11px] font-extrabold text-amber-300" x-text="'Meja ' + meja"></span>
        </div>
    </header>


    <main class="max-w-lg mx-auto px-4 pt-5 space-y-4">

        {{-- 1. HERO STATUS BANNER --}}
        <div class="s1 status-hero p-6 text-white text-center relative overflow-hidden border border-white/10 shadow-2xl space-y-4">
            <!-- Decorative glow blobs -->
            <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-amber-400/10 blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 rounded-full bg-white/5 blur-xl pointer-events-none"></div>

            <!-- Animated cooking icon -->
            <div class="relative w-20 h-20 mx-auto">
                <div class="cook-bounce absolute inset-0 flex items-center justify-center">
                    <div class="w-20 h-20 rounded-[22px] bg-gradient-to-br from-amber-300 via-amber-500 to-amber-600 flex items-center justify-center text-[#5d1a1a] text-3xl border-2 border-amber-200/40 shadow-xl">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>
                </div>
                <!-- Orbiting dots -->
                <div class="orbit-dot absolute top-1/2 left-1/2 w-2 h-2 rounded-full bg-amber-300 -mt-1 -ml-1"
                     style="animation-delay:0s"></div>
                <div class="orbit-dot absolute top-1/2 left-1/2 w-1.5 h-1.5 rounded-full bg-white/60 -mt-0.5 -ml-0.5"
                     style="animation-delay:0.75s"></div>
            </div>

            <!-- Status text -->
            <div class="space-y-1.5">
                <span class="inline-block px-3 py-0.5 rounded-full bg-emerald-400/25 border border-emerald-400/40 text-emerald-300 text-[10px] font-extrabold uppercase tracking-wider">
                    ✓ Pesanan Berhasil Masuk
                </span>
                <h2 class="text-xl font-black" x-text="'Terima kasih, ' + customerName + '!'"></h2>
                <p class="text-xs text-white/70 leading-relaxed max-w-xs mx-auto">
                    Dapur Lapau Uda Sutan sedang menyiapkan pesanan lezat Anda dengan penuh cinta!
                </p>
            </div>

            <!-- Countdown timer badge -->
            <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm">
                <div class="w-8 h-8 relative shrink-0">
                    <svg class="w-8 h-8 -rotate-90" viewBox="0 0 32 32">
                        <circle cx="16" cy="16" r="13" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="2.5"/>
                        <circle cx="16" cy="16" r="13" fill="none" stroke="#f59e0b" stroke-width="2.5"
                                stroke-dasharray="81.68" stroke-dashoffset="40" stroke-linecap="round"/>
                    </svg>
                    <i class="fa-solid fa-hourglass-half absolute inset-0 flex items-center justify-center text-amber-300 text-[9px] m-auto w-4 h-4"></i>
                </div>
                <div class="text-left">
                    <p class="text-[9px] text-amber-300/80 font-bold uppercase tracking-wider">Estimasi Penyajian</p>
                    <p class="text-sm font-black text-amber-300">10 – 15 Menit</p>
                </div>
            </div>
        </div>


        {{-- 2. PROGRESS TRACKER --}}
        <div class="s2 card p-5 space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-zinc-100">
                <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                    <i class="fa-solid fa-route text-[#721c24] text-xs"></i>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-zinc-900">Progress Penyajian</h3>
                    <p class="text-[10px] text-zinc-400">Dapur sedang memasak pesanan Anda</p>
                </div>
            </div>

            <div class="space-y-0 pl-1 text-xs">

                <template x-for="(step, i) in steps" :key="i">
                    <div class="flex gap-3.5 items-start">
                        <!-- Icon + line -->
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-9 h-9 rounded-[12px] flex items-center justify-center shadow-md text-sm transition-all"
                                 :class="step.state === 'done' ? 'step-done text-white' : (step.state === 'active' ? 'step-active text-white' : 'step-idle text-zinc-400')">
                                <template x-if="step.state === 'done'">
                                    <i class="fa-solid fa-check text-sm"></i>
                                </template>
                                <template x-if="step.state !== 'done'">
                                    <i class="fa-solid text-sm" :class="step.icon"></i>
                                </template>
                            </div>
                            <template x-if="i < steps.length - 1">
                                <div class="w-0.5 h-8 mt-1 mb-1 rounded-full"
                                     :class="step.state === 'done' ? 'step-line-done' : (step.state === 'active' ? 'step-line-active' : 'step-line-idle')"></div>
                            </template>
                        </div>

                        <!-- Content -->
                        <div class="pt-1 pb-4" :class="i === steps.length - 1 ? 'pb-0' : ''">
                            <div class="flex items-center gap-2 mb-0.5">
                                <h4 class="font-extrabold text-zinc-900" :class="step.state === 'idle' ? 'text-zinc-400' : 'text-zinc-900'"
                                    x-text="step.title"></h4>
                                <template x-if="step.state === 'active'">
                                    <span class="px-1.5 py-0.5 rounded text-[8px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200 uppercase tracking-wider animate-pulse">
                                        Sedang Berlangsung
                                    </span>
                                </template>
                            </div>
                            <p class="text-[11px] leading-relaxed" :class="step.state === 'idle' ? 'text-zinc-400' : 'text-zinc-500'" x-text="step.desc"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>


        {{-- 3. RINGKASAN NOTA --}}
        <div class="s3 card p-5 space-y-3.5">
            <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-[#721c24]/10 flex items-center justify-center">
                        <i class="fa-solid fa-file-invoice text-[#721c24] text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-zinc-900">Ringkasan Nota</h3>
                        <p class="text-[10px] text-zinc-400" x-text="orderId"></p>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold border"
                      :class="paymentMethod === 'qris' ? 'bg-sky-50 text-sky-700 border-sky-200' : 'bg-amber-50 text-amber-700 border-amber-200'"
                      x-text="paymentMethod === 'qris' ? 'QRIS Verified ✓' : 'Bayar Tunai 💵'">
                </span>
            </div>

            <div class="space-y-2 text-xs">
                <div class="receipt-row text-zinc-500"><span>Nama Pemesan:</span><strong class="text-zinc-900" x-text="customerName"></strong></div>
                <div class="receipt-row text-zinc-500"><span>Nomor Meja:</span><strong class="text-[#721c24] font-extrabold" x-text="'Meja ' + meja"></strong></div>
                <div class="receipt-row text-zinc-500 pt-2 border-t border-zinc-100"><span>1× Rendang Daging Special:</span><span class="font-bold text-zinc-800">Rp 24.000</span></div>
                <div class="receipt-row text-zinc-500"><span>1× Teh Talua Uda Sutan:</span><span class="font-bold text-zinc-800">Rp 12.000</span></div>
                <div class="receipt-row pt-2 border-t border-zinc-100 text-sm font-extrabold text-zinc-900">
                    <span>Total Pembayaran</span>
                    <span class="text-[#721c24] text-base" x-text="'Rp ' + (total).toLocaleString('id-ID')"></span>
                </div>
            </div>

            <!-- QR Verifikasi Struk -->
            <div class="pt-2 border-t border-zinc-100 text-center space-y-2">
                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">QR Verifikasi Struk</p>
                <div class="w-28 h-28 mx-auto bg-zinc-50 rounded-2xl border border-zinc-200 flex items-center justify-center p-1.5 shadow-xs">
                    <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=' + encodeURIComponent(orderId)"
                         alt="QR Struk" class="w-full h-full object-contain rounded-xl">
                </div>
                <p class="text-[10px] text-zinc-400">Tunjukkan ke pramusaji bila diperlukan</p>
            </div>
        </div>


        {{-- 4. ACTION BUTTONS --}}
        <div class="s4 flex items-stretch gap-3">
            <a :href="'/order/menu/' + meja"
               class="btn-add flex-1 py-3.5 flex items-center justify-center gap-2 text-xs font-extrabold text-zinc-700 bg-white">
                <i class="fa-solid fa-plus text-[#721c24] text-xs"></i>
                <span>Tambah Lauk</span>
            </a>

            <button @click="refreshStatus()"
                    class="btn-refresh flex-1 py-3.5 flex items-center justify-center gap-2 text-xs font-extrabold text-white">
                <i class="fa-solid fa-rotate text-amber-300 text-xs" :class="refreshing ? 'animate-spin' : ''"></i>
                <span>Refresh Status</span>
            </button>
        </div>

    </main>


    <script>
        function orderStatusSystem(orderId) {
            const params = new URLSearchParams(window.location.search);
            return {
                orderId,
                customerName:  params.get('name')   || 'Pelanggan',
                meja:          params.get('meja')   || '05',
                paymentMethod: params.get('method') || 'qris',
                total:         parseInt(params.get('total') || '36000'),
                refreshing: false,

                steps: [
                    {
                        icon: 'fa-check-circle',
                        title: 'Pesanan Diterima Sistem',
                        desc:  'Nota otomatis tercetak di POS Kasir & layar monitor dapur.',
                        state: 'done'
                    },
                    {
                        icon: 'fa-fire',
                        title: 'Dapur Sedang Memasak',
                        desc:  'Chef meracik bumbu rempah & menyiapkan porsi lauk pilihan Anda.',
                        state: 'active'
                    },
                    {
                        icon: 'fa-person-walking',
                        title: 'Pramusaji Mengantar ke Meja',
                        desc:  'Hidangan hangat akan diantarkan langsung ke meja Anda.',
                        state: 'idle'
                    },
                    {
                        icon: 'fa-star',
                        title: 'Selesai & Selamat Menikmati',
                        desc:  'Nikmati hidangan Masakan Padang asli Lapau Uda Sutan!',
                        state: 'idle'
                    },
                ],

                refreshStatus() {
                    this.refreshing = true;
                    setTimeout(() => {
                        this.refreshing = false;
                        // Simulate progress advancement
                        const activeIdx = this.steps.findIndex(s => s.state === 'active');
                        if (activeIdx !== -1 && activeIdx < this.steps.length - 1) {
                            this.steps[activeIdx].state = 'done';
                            this.steps[activeIdx + 1].state = 'active';
                        }
                    }, 900);
                }
            }
        }
    </script>

    @livewireScripts
</body>
</html>
