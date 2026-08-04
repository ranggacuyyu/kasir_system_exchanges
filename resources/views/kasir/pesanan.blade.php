<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Pesanan - Kasir Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Bootstrap Icons & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-800 antialiased" x-data="{ activeTab: 'utama' }">

    {{-- Navbar --}}
    <x-kasir.navbar active="pesanan" />

    <!-- Content Wrapper -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-8 px-4 md:px-6 lg:px-8">

        <div class="w-full max-w-7xl mx-auto pt-4 md:pt-6 space-y-6">

            {{-- ===== SLIDING VIEW SWITCHER BAR ===== --}}
            <div class="bg-white p-3 md:p-4 rounded-2xl border border-zinc-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-lg shrink-0">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <h2 class="text-sm sm:text-base font-extrabold text-zinc-900 leading-tight">Management Station Pesanan</h2>
                        <p class="text-xs text-zinc-500">Geser tampilan untuk beralih antara Pesanan Utama dan Stasiun Minuman</p>
                    </div>
                </div>

                {{-- Segmented Toggle Switcher --}}
                <div class="flex items-center p-1 bg-zinc-100 rounded-xl border border-zinc-200/80 w-full sm:w-auto">
                    <button @click="activeTab = 'utama'"
                        :class="activeTab === 'utama' ? 'bg-maroon-primary text-white shadow-md font-bold' : 'text-zinc-600 hover:text-zinc-900 font-semibold'"
                        class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm transition-all duration-300 cursor-pointer">
                        <i class="fa-solid fa-utensils text-xs"></i>
                        <span>Pesanan Utama & Dapur</span>
                    </button>

                    <button @click="activeTab = 'minuman'"
                        :class="activeTab === 'minuman' ? 'bg-maroon-primary text-white shadow-md font-bold' : 'text-zinc-600 hover:text-zinc-900 font-semibold'"
                        class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm transition-all duration-300 cursor-pointer relative">
                        <i class="fa-solid fa-glass-water text-xs"></i>
                        <span>Stasiun Pesanan Minuman</span>
                        <span class="ml-1 px-1.5 py-0.5 rounded-full bg-amber-400 text-slate-900 font-black text-[10px]">5 Bar</span>
                    </button>
                </div>
            </div>

            {{-- ===== SLIDING HORIZONTAL CONTAINER ===== --}}
            <div class="relative w-full overflow-hidden">
                <div class="flex w-[200%] transition-transform duration-500 ease-in-out"
                    :style="activeTab === 'minuman' ? 'transform: translateX(-50%)' : 'transform: translateX(0%)'">
                    
                    {{-- ============================================================
                         SLIDE 1: TAMPILAN PESANAN UTAMA
                         ============================================================ --}}
                    <div class="w-1/2 pr-0 lg:pr-3 flex-shrink-0 space-y-6">
                        
                        {{-- Bagian Summary Cards --}}
                        <x-kasir.card-pesanan />

                        {{-- Main Order Grid (Daftar & Detail) --}}
                        <div class="pb-4 gap-6 flex flex-col lg:flex-row">

                            {{-- ===== DAFTAR PESANAN PANEL ===== --}}
                            <div class="w-full lg:w-4/10 flex flex-col gap-3 mb-4">

                                {{-- Panel Header --}}
                                <div class="rounded-2xl overflow-hidden shadow-lg border border-maroon-dark/20">

                                    {{-- Gradient Header --}}
                                    <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary px-5 py-4 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                                <i class="fa-solid fa-receipt text-white text-base"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold text-base leading-tight">Daftar Pesanan</p>
                                                <p class="text-white/60 text-xs">Kelola pesanan masuk</p>
                                            </div>
                                        </div>
                                        <button id="btn-refresh"
                                            class="group flex items-center gap-2 bg-white/15 hover:bg-white/30 text-white text-xs font-medium px-3 py-2 rounded-xl border border-white/20 transition-all duration-200 cursor-pointer">
                                            <i class="fa-solid fa-rotate-right text-xs group-hover:rotate-180 transition-transform duration-500"></i>
                                            Refresh
                                        </button>
                                    </div>

                                    {{-- Search & Filter Bar --}}
                                    <div class="bg-base px-4 py-3 border-b border-secondary-base">
                                        <div class="relative">
                                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-maroon-secondary text-sm"></i>
                                            <input type="text" id="cari-pesanan" name="cari_pesanan"
                                                placeholder="Cari nomor pesanan..."
                                                class="w-full pl-9 pr-4 py-2.5 bg-white border border-secondary-base rounded-xl text-sm text-zinc-700 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-maroon-secondary/40 focus:border-maroon-secondary transition-all duration-200">
                                        </div>
                                    </div>

                                    {{-- Order Filter Tabs --}}
                                    <div class="bg-base px-4 py-2 flex gap-2 overflow-x-auto">
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-maroon-primary text-white transition cursor-pointer shrink-0">Semua</button>
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition cursor-pointer shrink-0">Pending</button>
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition cursor-pointer shrink-0">Selesai</button>
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition cursor-pointer shrink-0">Dine In</button>
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition cursor-pointer shrink-0">Take Away</button>
                                    </div>
                                </div>

                                {{-- Order List Items --}}
                                <div class="flex flex-col gap-2 max-h-[40vh] md:max-h-[50vh] lg:max-h-[60vh] overflow-y-auto pr-1">
                                    @foreach ([
                                        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
                                        ['no' => '#0002', 'nama' => 'Meja 3', 'item' => 2, 'total' => 'Rp 28.000', 'status' => 'selesai', 'waktu' => '08:45'],
                                        ['no' => '#0003', 'nama' => 'Take Away', 'item' => 5, 'total' => 'Rp 72.000', 'status' => 'pending', 'waktu' => '09:01'],
                                        ['no' => '#0004', 'nama' => 'Meja 2', 'item' => 1, 'total' => 'Rp 15.000', 'status' => 'selesai', 'waktu' => '09:15'],
                                    ] as $pesanan)
                                        <div class="group bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:border-maroon-secondary/30 transition-all duration-200 cursor-pointer p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl {{ $pesanan['status'] === 'pending' ? 'bg-amber-100' : 'bg-emerald-100' }} flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid {{ $pesanan['status'] === 'pending' ? 'fa-clock text-amber-600' : 'fa-check text-emerald-600' }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2">
                                                        <p class="text-sm font-semibold text-zinc-800">{{ $pesanan['no'] }}</p>
                                                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $pesanan['status'] === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700' }}">
                                                            {{ ucfirst($pesanan['status']) }}
                                                        </span>
                                                    </div>
                                                    <p class="text-xs text-zinc-500">{{ $pesanan['nama'] }} · {{ $pesanan['item'] }} item · {{ $pesanan['waktu'] }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-bold text-maroon-primary">{{ $pesanan['total'] }}</p>
                                                <i class="fa-solid fa-chevron-right text-xs text-zinc-300 group-hover:text-maroon-secondary transition"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- ===== DETAIL PESANAN PANEL ===== --}}
                            <div class="bg-white w-full lg:w-6/10 rounded-2xl border border-zinc-200/80 shadow-md flex flex-col overflow-hidden">
                                {{-- Header Detail --}}
                                <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary p-5 flex items-center justify-between shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center text-white">
                                            <i class="fa-solid fa-receipt text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h3 class="text-white font-bold text-base tracking-wide">#PSN10298283830</h3>
                                                <button class="text-white/60 hover:text-white text-xs transition" title="Salin No. Pesanan">
                                                    <i class="fa-regular fa-copy"></i>
                                                </button>
                                            </div>
                                            <p class="text-white/70 text-xs mt-0.5 flex items-center gap-2">
                                                <span><i class="fa-regular fa-calendar-alt mr-1"></i>12-03-2026</span>
                                                <span>•</span>
                                                <span><i class="fa-regular fa-clock mr-1"></i>11:49 PM</span>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-200 border border-amber-400/30 backdrop-blur-sm">
                                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                        Belum Dibayar
                                    </span>
                                </div>

                                {{-- Body Detail --}}
                                <div class="p-6 flex flex-col gap-6 overflow-y-auto max-h-[calc(100vh-280px)]">
                                    <div>
                                        <h4 class="text-xs font-bold text-maroon-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                                            <i class="fa-solid fa-circle-info text-xs"></i> Informasi Pesanan
                                        </h4>
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-zinc-50 p-4 rounded-xl border border-zinc-200">
                                            <div>
                                                <p class="text-[11px] text-zinc-400 font-medium">Tipe Pemesanan</p>
                                                <p class="text-xs font-semibold text-zinc-800 mt-0.5">Dine In (Meja 2)</p>
                                            </div>
                                            <div>
                                                <p class="text-[11px] text-zinc-400 font-medium">Status Bayar</p>
                                                <p class="text-xs font-semibold text-amber-600 mt-0.5">Belum Dibayar</p>
                                            </div>
                                            <div>
                                                <p class="text-[11px] text-zinc-400 font-medium">Sumber Pesanan</p>
                                                <p class="text-xs font-semibold text-zinc-800 mt-0.5">Guest / QR</p>
                                            </div>
                                            <div>
                                                <p class="text-[11px] text-zinc-400 font-medium">Kasir / Pelayan</p>
                                                <p class="text-xs font-semibold text-zinc-800 mt-0.5">Budi (Kasir 1)</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Daftar Item --}}
                                    <div>
                                        <h4 class="text-xs font-bold text-maroon-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                                            <i class="fa-solid fa-utensils text-xs"></i> Menu Yang Dipesan
                                        </h4>
                                        <div class="rounded-xl border border-zinc-100 overflow-hidden divide-y divide-zinc-100">
                                            <div class="p-3.5 flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">2x</div>
                                                    <div>
                                                        <p class="text-xs font-semibold text-zinc-800">Nasi Rendang Daging</p>
                                                        <p class="text-[11px] text-zinc-400">@ Rp 22.000</p>
                                                    </div>
                                                </div>
                                                <p class="text-xs font-bold text-zinc-800">Rp 44.000</p>
                                            </div>
                                            <div class="p-3.5 flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">1x</div>
                                                    <div>
                                                        <p class="text-xs font-semibold text-zinc-800">Ayam Pop Spesial</p>
                                                        <p class="text-[11px] text-zinc-400">@ Rp 20.000</p>
                                                    </div>
                                                </div>
                                                <p class="text-xs font-bold text-zinc-800">Rp 20.000</p>
                                            </div>
                                            <div class="p-3.5 flex items-center justify-between bg-zinc-50 border-l-4 border-maroon-primary">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">3x</div>
                                                    <div>
                                                        <p class="text-xs font-bold text-zinc-900 flex items-center gap-1.5">
                                                            <span>Es Teh Manis</span>
                                                            <span class="text-[10px] bg-maroon-primary/10 text-maroon-primary px-1.5 py-0.2 rounded font-semibold">Minuman</span>
                                                        </p>
                                                        <p class="text-[11px] text-zinc-500">@ Rp 5.000 • <em class="text-maroon-primary">Manis sedang, Es sedikit</em></p>
                                                    </div>
                                                </div>
                                                <p class="text-xs font-bold text-zinc-800">Rp 15.000</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Ringkasan Pembayaran --}}
                                    <div class="bg-zinc-50 p-4 rounded-xl border border-zinc-200 space-y-2">
                                        <div class="flex justify-between text-xs text-zinc-500"><span>Subtotal</span><span class="font-medium text-zinc-700">Rp 79.000</span></div>
                                        <div class="flex justify-between text-xs text-zinc-500"><span>Pajak (10%)</span><span class="font-medium text-zinc-700">Rp 7.900</span></div>
                                        <div class="pt-2 border-t border-zinc-200 flex justify-between items-center">
                                            <span class="text-xs font-bold text-zinc-800">Total Pembayaran</span>
                                            <span class="text-base font-bold text-maroon-primary">Rp 86.900</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Footer Actions --}}
                                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-end gap-3 mt-auto">
                                    <button class="px-4 py-2 rounded-xl text-xs font-medium text-zinc-600 hover:bg-zinc-200 transition flex items-center gap-2 cursor-pointer">
                                        <i class="fa-solid fa-print text-xs"></i> Cetak Struk
                                    </button>
                                    <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-maroon-primary text-white hover:bg-maroon-dark shadow-sm transition flex items-center gap-2 cursor-pointer">
                                        <i class="fa-solid fa-cash-register text-xs"></i> Bayar Sekarang
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- ============================================================
                         SLIDE 2: TAMPILAN BARU STASIUN PESANAN MINUMAN
                         (Mobile: Compact, Desktop/Tablet: Full Rich Layout)
                         ============================================================ --}}
                    <div class="w-1/2 pl-0 lg:pl-3 flex-shrink-0 space-y-4 sm:space-y-6">
                        
                        {{-- Header Summary Cards (Mobile: 2x2 Grid, Desktop: 4 Cards Full) --}}
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4">
                            
                            <div class="bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm border-l-4 border-l-maroon-primary flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Antrean Minuman</span>
                                    <span class="text-lg sm:text-2xl font-extrabold text-maroon-primary">5 Nota</span>
                                    <span class="hidden sm:block text-[11px] text-zinc-400 mt-0.5">Perlu diracik</span>
                                </div>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                                    <i class="fa-solid fa-glass-water"></i>
                                </div>
                            </div>

                            <div class="bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-amber-500">
                                <div>
                                    <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Sedang Dibuat</span>
                                    <span class="text-lg sm:text-2xl font-extrabold text-amber-600">2 Pesanan</span>
                                    <span class="hidden sm:block text-[11px] text-zinc-400 mt-0.5">Di bar station</span>
                                </div>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                                    <i class="fa-solid fa-blender"></i>
                                </div>
                            </div>

                            <div class="bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-emerald-500">
                                <div>
                                    <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Siap Diantar</span>
                                    <span class="text-lg sm:text-2xl font-extrabold text-emerald-600">3 Selesai</span>
                                    <span class="hidden sm:block text-[11px] text-zinc-400 mt-0.5">Menunggu pelayan</span>
                                </div>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                            </div>

                            <div class="bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-zinc-700">
                                <div>
                                    <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Gelas Shift Ini</span>
                                    <span class="text-lg sm:text-2xl font-extrabold text-zinc-900">54 Gelas</span>
                                    <span class="hidden sm:block text-[11px] text-emerald-600 font-bold mt-0.5">100% Terpenuhi</span>
                                </div>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-zinc-100 text-zinc-700 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                                    <i class="fa-solid fa-wine-glass-drop"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Drink Order Queue Management Board --}}
                        <div class="bg-white rounded-xl sm:rounded-2xl border border-zinc-200 shadow-md p-3.5 sm:p-5 space-y-3 sm:space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-zinc-900 flex items-center gap-2">
                                        <i class="fa-solid fa-wine-glass text-maroon-primary"></i>
                                        Antrean Stasiun Barista & Minuman
                                    </h3>
                                    <p class="text-xs text-zinc-500">Kelola dan perbarui status pembuatan minuman per meja</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1.5 bg-zinc-100 text-zinc-700 font-bold text-xs rounded-xl hover:bg-zinc-200 transition">
                                        <i class="fa-solid fa-filter mr-1"></i> Filter Bar
                                    </button>
                                    <button class="px-3 py-1.5 bg-maroon-primary text-white font-bold text-xs rounded-xl hover:bg-maroon-dark transition shadow-sm">
                                        <i class="fa-solid fa-print mr-1"></i> Cetak Ticket Bar
                                    </button>
                                </div>
                            </div>

                            {{-- Drink Orders Grid Cards --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                                
                                {{-- Card 1: Sedang Dibuat --}}
                                <div class="bg-zinc-50 rounded-xl border-2 border-amber-400 p-3.5 sm:p-4 shadow-sm relative space-y-3">
                                    <div class="flex items-center justify-between border-b border-zinc-200 pb-2">
                                        <div>
                                            <span class="text-xs font-bold text-zinc-400 block uppercase">Meja 02 (Dine In)</span>
                                            <h4 class="text-xs sm:text-sm font-extrabold text-zinc-900">#PSN10298283830</h4>
                                        </div>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                            Sedang Dibuat
                                        </span>
                                    </div>

                                    <div class="space-y-2 text-xs">
                                        <div class="flex justify-between items-start bg-white p-2.5 rounded-lg border border-zinc-200">
                                            <div>
                                                <p class="font-extrabold text-zinc-900">3x Es Teh Manis</p>
                                                <p class="text-[11px] text-maroon-primary italic font-medium">Note: Manis sedang, es sedikit</p>
                                            </div>
                                            <span class="text-[10px] bg-zinc-100 text-zinc-700 px-1.5 py-0.5 rounded font-bold">Dingin</span>
                                        </div>

                                        <div class="flex justify-between items-start bg-white p-2.5 rounded-lg border border-zinc-200">
                                            <div>
                                                <p class="font-extrabold text-zinc-900">1x Jus Alpukat Spesial</p>
                                                <p class="text-[11px] text-maroon-primary italic font-medium">Note: Pakai susu cokelat banyak</p>
                                            </div>
                                            <span class="text-[10px] bg-zinc-100 text-zinc-700 px-1.5 py-0.5 rounded font-bold">Jus</span>
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-xl text-xs flex items-center justify-center gap-2 shadow transition">
                                            <i class="fa-solid fa-circle-check"></i> Tandai Siap Diantar
                                        </button>
                                    </div>
                                </div>

                                {{-- Card 2: Menunggu Barista --}}
                                <div class="bg-white rounded-xl border border-zinc-200 p-3.5 sm:p-4 shadow-sm space-y-3">
                                    <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                                        <div>
                                            <span class="text-xs font-bold text-zinc-400 block uppercase">Meja 05 (Dine In)</span>
                                            <h4 class="text-xs sm:text-sm font-extrabold text-zinc-900">#PSN10298283835</h4>
                                        </div>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-maroon-primary/10 text-maroon-primary">
                                            Menunggu Barista
                                        </span>
                                    </div>

                                    <div class="space-y-2 text-xs">
                                        <div class="flex justify-between items-start bg-zinc-50 p-2.5 rounded-lg border border-zinc-100">
                                            <div>
                                                <p class="font-extrabold text-zinc-900">2x Kopi Telur Padang (Hot)</p>
                                                <p class="text-[11px] text-zinc-500">Note: Kopi hitam pekat, tanpa gula</p>
                                            </div>
                                            <span class="text-[10px] bg-amber-50 text-amber-700 px-1.5 py-0.5 rounded font-bold">Panas</span>
                                        </div>

                                        <div class="flex justify-between items-start bg-zinc-50 p-2.5 rounded-lg border border-zinc-100">
                                            <div>
                                                <p class="font-extrabold text-zinc-900">2x Es Jeruk Peras</p>
                                                <p class="text-[11px] text-zinc-500">Note: Jeruk murni</p>
                                            </div>
                                            <span class="text-[10px] bg-zinc-100 text-zinc-700 px-1.5 py-0.5 rounded font-bold">Dingin</span>
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button class="w-full bg-maroon-primary hover:bg-maroon-dark text-white font-bold py-2 rounded-xl text-xs flex items-center justify-center gap-2 shadow transition">
                                            <i class="fa-solid fa-fire"></i> Mulai Racik Minuman
                                        </button>
                                    </div>
                                </div>

                                {{-- Card 3: Selesai --}}
                                <div class="bg-white rounded-xl border border-zinc-200 p-3.5 sm:p-4 shadow-sm opacity-80 space-y-3">
                                    <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                                        <div>
                                            <span class="text-xs font-bold text-zinc-400 block uppercase">Takeaway #04</span>
                                            <h4 class="text-xs sm:text-sm font-extrabold text-zinc-900">#PSN10298283812</h4>
                                        </div>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-check mr-1"></i> Selesai Diantar
                                        </span>
                                    </div>

                                    <div class="space-y-2 text-xs">
                                        <div class="flex justify-between items-start bg-zinc-50 p-2.5 rounded-lg border border-zinc-100">
                                            <div>
                                                <p class="font-extrabold text-zinc-900">4x Teh Botol Sosro</p>
                                                <p class="text-[11px] text-zinc-400">Kemasan dingin</p>
                                            </div>
                                            <span class="text-[10px] bg-emerald-50 text-emerald-700 px-1.5 py-0.5 rounded font-bold">Kemasan</span>
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button class="w-full bg-zinc-200 text-zinc-700 font-bold py-2 rounded-xl text-xs flex items-center justify-center gap-1 cursor-default" disabled>
                                            <i class="fa-solid fa-check-double"></i> Sudah Diantar ke Meja
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

</body>

</html>
