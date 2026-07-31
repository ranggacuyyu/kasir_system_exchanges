<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Toko</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap Icons & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body class="min-h-screen">

    {{-- Navbar --}}
    <x-kasir.navbar />

    <!-- Content -->
    <main class="pt-0 md:pt-14 pb-20 md:pb-0 px-4 md:px-6 lg:px-8">

        {{-- Isi halaman --}}
        {{-- Bagian Card --}}
        <div class="w-full py-6">
            <x-kasir.card-pesanan />
        </div>

        <div class="pb-4 gap-6 flex flex-col lg:flex-row">

            {{-- ===== DAFTAR PESANAN PANEL ===== --}}
            <div class="w-full lg:w-4/10 flex flex-col gap-3 mb-4">

                {{-- Panel Header --}}
                <div class="rounded-2xl overflow-hidden shadow-lg border border-maroon-dark/20">

                    {{-- Gradient Header --}}
                    <div
                        class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary px-5 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                <i class="fa-solid fa-receipt text-white text-base"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-base leading-tight">Daftar Pesanan</p>
                                <p class="text-white/60 text-xs">Kelola pesanan masuk</p>
                            </div>
                        </div>
                        <button id="btn-refresh"
                            class="group flex items-center gap-2 bg-white/15 hover:bg-white/30 text-white text-xs font-medium px-3 py-2 rounded-xl border border-white/20 transition-all duration-200 cursor-pointer">
                            <i
                                class="fa-solid fa-rotate-right text-xs group-hover:rotate-180 transition-transform duration-500"></i>
                            Refresh
                        </button>
                    </div>

                    {{-- Search & Filter Bar --}}
                    <div class="bg-base px-4 py-3 border-b border-secondary-base">
                        <div class="relative">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-maroon-secondary text-sm"></i>
                            <input type="text" id="cari-pesanan" name="cari_pesanan"
                                placeholder="Cari nomor pesanan..."
                                class="w-full pl-9 pr-4 py-2.5 bg-white border border-secondary-base rounded-xl text-sm text-zinc-700 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-maroon-secondary/40 focus:border-maroon-secondary transition-all duration-200">
                        </div>
                    </div>

                    {{-- Order Filter Tabs --}}
                    <div class="bg-base px-4 py-2 flex gap-2">
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-medium bg-maroon-primary text-white transition-all duration-200 cursor-pointer">Semua</button>
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition-all duration-200 cursor-pointer">Pending</button>
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition-all duration-200 cursor-pointer">Selesai</button>
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition-all duration-200 cursor-pointer">Dine
                            In</button>
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-medium text-zinc-500 hover:bg-secondary-base transition-all duration-200 cursor-pointer">Take
                            Away</button>
                    </div>
                </div>

                {{-- Order List --}}
                <div class="flex flex-col gap-2 max-h-[40vh] md:max-h-[50vh] lg:max-h-[60vh] overflow-y-auto pr-1"
                    style="scrollbar-width: thin; scrollbar-color: var(--color-maroon-secondary) transparent;">

                    {{-- Order Item (contoh) --}}
                    @foreach ([
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0001', 'nama' => 'Meja 1', 'item' => 3, 'total' => 'Rp 45.000', 'status' => 'pending', 'waktu' => '08:12'],
        ['no' => '#0002', 'nama' => 'Meja 3', 'item' => 2, 'total' => 'Rp 28.000', 'status' => 'selesai', 'waktu' => '08:45'],
        ['no' => '#0003', 'nama' => 'Take Away', 'item' => 5, 'total' => 'Rp 72.000', 'status' => 'pending', 'waktu' => '09:01'],
        ['no' => '#0004', 'nama' => 'Meja 2', 'item' => 1, 'total' => 'Rp 15.000', 'status' => 'selesai', 'waktu' => '09:15'],
    ] as $pesanan)
                        <div
                            class="group bg-white rounded-xl border border-zinc-100 shadow-sm hover:shadow-md hover:border-maroon-secondary/30 transition-all duration-200 cursor-pointer p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl {{ $pesanan['status'] === 'pending' ? 'bg-warning/10' : 'bg-success/10' }} flex items-center justify-center flex-shrink-0">
                                    <i
                                        class="fa-solid {{ $pesanan['status'] === 'pending' ? 'fa-clock text-warning' : 'fa-check text-success' }} text-sm"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-semibold text-zinc-800">{{ $pesanan['no'] }}</p>
                                        <span
                                            class="text-xs px-2 py-0.5 rounded-full font-medium {{ $pesanan['status'] === 'pending' ? 'bg-warning/15 text-amber-700' : 'bg-success/15 text-green-700' }}">
                                            {{ ucfirst($pesanan['status']) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-zinc-500">{{ $pesanan['nama'] }} · {{ $pesanan['item'] }}
                                        item · {{ $pesanan['waktu'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-maroon-primary">{{ $pesanan['total'] }}</p>
                                <i
                                    class="fa-solid fa-chevron-right text-xs text-zinc-300 group-hover:text-maroon-secondary group-hover:translate-x-0.5 transition-all duration-200"></i>
                            </div>
                        </div>
                    @endforeach

                    {{-- Empty state (tampil jika kosong) --}}
                    {{-- <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-secondary-base flex items-center justify-center mb-3">
                            <i class="fa-solid fa-inbox text-2xl text-zinc-400"></i>
                        </div>
                        <p class="text-sm font-medium text-zinc-500">Belum ada pesanan</p>
                        <p class="text-xs text-zinc-400 mt-1">Pesanan akan muncul di sini</p>
                    </div> --}}
                </div>
            </div>

            {{-- ===== DETAIL PESANAN PANEL ===== --}}
            <div
                class="bg-white w-full lg:w-6/10 rounded-2xl border border-zinc-200/80 shadow-md flex flex-col overflow-hidden">

                {{-- Header Detail --}}
                <div
                    class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary p-5 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center text-white">
                            <i class="fa-solid fa-receipt text-lg"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-white font-bold text-base tracking-wide">#PSN10298283830</h3>
                                <button class="text-white/60 hover:text-white text-xs transition"
                                    title="Salin No. Pesanan">
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
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-200 border border-amber-400/30 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        Belum Dibayar
                    </span>
                </div>

                {{-- Body Detail --}}
                <div class="p-6 flex flex-col gap-6 overflow-y-auto max-h-[calc(100vh-280px)]">

                    {{-- Section 1: Informasi Pesanan --}}
                    <div>
                        <h4
                            class="text-xs font-bold text-maroon-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-xs"></i> Informasi Pesanan
                        </h4>
                        <div
                            class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-base/60 p-4 rounded-xl border border-secondary-base">
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

                    {{-- Section 2: Daftar Item Pesanan --}}
                    <div>
                        <h4
                            class="text-xs font-bold text-maroon-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-utensils text-xs"></i> Menu Yang Dipesan
                        </h4>
                        <div class="rounded-xl border border-zinc-100 overflow-hidden divide-y divide-zinc-100">
                            {{-- Item 1 --}}
                            <div class="p-3.5 flex items-center justify-between hover:bg-zinc-50/60 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">
                                        2x
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-800">Nasi Rendang Daging</p>
                                        <p class="text-[11px] text-zinc-400">@ Rp 22.000</p>
                                    </div>
                                </div>
                                <p class="text-xs font-bold text-zinc-800">Rp 44.000</p>
                            </div>

                            {{-- Item 2 --}}
                            <div class="p-3.5 flex items-center justify-between hover:bg-zinc-50/60 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">
                                        1x
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-800">Ayam Pop Spesial</p>
                                        <p class="text-[11px] text-zinc-400">@ Rp 20.000</p>
                                    </div>
                                </div>
                                <p class="text-xs font-bold text-zinc-800">Rp 20.000</p>
                            </div>

                            {{-- Item 3 --}}
                            <div class="p-3.5 flex items-center justify-between hover:bg-zinc-50/60 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-maroon-primary/10 text-maroon-primary font-bold text-xs flex items-center justify-center">
                                        3x
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-800">Es Teh Manis</p>
                                        <p class="text-[11px] text-zinc-400">@ Rp 5.000</p>
                                    </div>
                                </div>
                                <p class="text-xs font-bold text-zinc-800">Rp 15.000</p>
                            </div>
                        </div>
                    </div>

                    {{-- Section 3: Ringkasan Pembayaran --}}
                    <div class="bg-base/40 p-4 rounded-xl border border-secondary-base/60 space-y-2">
                        <div class="flex justify-between text-xs text-zinc-500">
                            <span>Subtotal</span>
                            <span class="font-medium text-zinc-700">Rp 79.000</span>
                        </div>
                        <div class="flex justify-between text-xs text-zinc-500">
                            <span>Pajak (10%)</span>
                            <span class="font-medium text-zinc-700">Rp 7.900</span>
                        </div>
                        <div class="pt-2 border-t border-secondary-base flex justify-between items-center">
                            <span class="text-xs font-bold text-zinc-800">Total Pembayaran</span>
                            <span class="text-base font-bold text-maroon-primary">Rp 86.900</span>
                        </div>
                    </div>

                </div>

                {{-- Footer Action Buttons --}}
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-end gap-3 mt-auto">
                    <button
                        class="px-4 py-2 rounded-xl text-xs font-medium text-zinc-600 hover:bg-zinc-200/60 transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-print text-xs"></i> Cetak Struk
                    </button>
                    <button
                        class="px-4 py-2 rounded-xl text-xs font-semibold bg-maroon-primary text-white hover:bg-maroon-dark shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-cash-register text-xs"></i> Bayar Sekarang
                    </button>
                </div>

            </div>

        </div>


        {{-- ===== SECTION 2: GRAFIK GARIS PENDAPATAN PER MINGGU (MODERN FRAMELESS ANALYTICS) ===== --}}
        <div x-data="revenueChart()"
            class="my-10 py-6 px-4 md:px-6 rounded-3xl bg-gradient-to-b from-zinc-50/80 to-transparent border-t border-b border-zinc-200/60">

            {{-- Header & Segmented Controller --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-zinc-200/50">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-primary/10 text-maroon-primary text-xs font-semibold mb-2">
                        <span class="w-2 h-2 rounded-full bg-maroon-primary animate-pulse"></span>
                        Analytics Trends
                    </div>
                    <h3 class="text-xl md:text-2xl font-black text-zinc-900 tracking-tight">Tren Pendapatan Mingguan
                    </h3>
                    <p class="text-xs md:text-sm text-zinc-500 mt-1">Pantau pergerakan omset dan performa harian secara
                        real-time</p>
                </div>

                {{-- Segmented Controller (iOS/Mac Style) --}}
                <div class="flex items-center p-1 bg-zinc-200/60 backdrop-blur-sm rounded-2xl w-fit">
                    <template x-for="mode in ['Minggu Ini', 'Minggu Lalu', 'Bulan Ini']" :key="mode">
                        <button @click="setFilter(mode)"
                            :class="activeFilter === mode ? 'bg-white text-zinc-900 shadow-sm font-bold' :
                                'text-zinc-500 hover:text-zinc-800 font-medium'"
                            class="px-4 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer"
                            x-text="mode">
                        </button>
                    </template>
                </div>
            </div>

            {{-- Inline Hero Metrics (Non-Card Typographic KPIs) --}}
            <div class="py-6 flex flex-wrap items-baseline gap-x-8 gap-y-4">
                <div>
                    <span class="text-xs font-semibold text-zinc-400 uppercase tracking-widest block">Total
                        Omset</span>
                    <span class="text-3xl md:text-4xl font-extrabold text-maroon-primary tracking-tight"
                        x-text="totalWeekly"></span>
                </div>

                <div class="hidden sm:block h-10 w-px bg-zinc-200"></div>

                <div>
                    <span class="text-xs font-semibold text-zinc-400 uppercase tracking-widest block">Rata-rata
                        Harian</span>
                    <span class="text-xl font-bold text-zinc-800" x-text="avgDaily"></span>
                </div>

                <div class="hidden sm:block h-10 w-px bg-zinc-200"></div>

                <div>
                    <span class="text-xs font-semibold text-zinc-400 uppercase tracking-widest block">Hari
                        Puncak</span>
                    <span class="text-xl font-bold text-emerald-600" x-text="peakDay"></span>
                </div>
            </div>

            {{-- Canvas Chart (Frameless & Clean) --}}
            <div class="relative w-full h-[320px] md:h-[360px] pt-2">
                <canvas id="weeklyRevenueChart"></canvas>
            </div>
        </div>
        {{-- ===== SECTION: DATA METRICS STRIP (DESAIN SIKAP MODERN NON-CARD) ===== --}}
        <div
            class="my-6 p-4 rounded-2xl bg-zinc-50 border border-zinc-200/60 flex flex-col md:flex-row items-stretch justify-between gap-4 divide-y md:divide-y-0 md:divide-x divide-zinc-200/80">

            {{-- Metric 1: Rata-rata Transaksi --}}
            <div class="flex items-center gap-3 pt-2 md:pt-0 md:px-4 first:pl-0 flex-1">
                <div
                    class="w-10 h-10 rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fa-solid fa-calculator"></i>
                </div>
                <div>
                    <span class="text-[11px] font-medium text-zinc-500 block">Rata-rata Transaksi</span>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-lg font-extrabold text-zinc-900">Rp 34.500</span>
                        <span
                            class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">+5.2%</span>
                    </div>
                </div>
            </div>

            {{-- Metric 2: Pesanan Selesai --}}
            <div class="flex items-center gap-3 pt-2 md:pt-0 md:px-4 flex-1">
                <div
                    class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span class="text-[11px] font-medium text-zinc-500 block">Pesanan Selesai</span>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-lg font-extrabold text-zinc-900">128</span>
                        <span
                            class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">98.5%</span>
                    </div>
                </div>
            </div>

            {{-- Metric 3: Pesanan Dibatalkan --}}
            <div class="flex items-center gap-3 pt-2 md:pt-0 md:px-4 flex-1">
                <div
                    class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div>
                    <span class="text-[11px] font-medium text-zinc-500 block">Pesanan Dibatalkan</span>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-lg font-extrabold text-zinc-900">2</span>
                        <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded">-1.5%</span>
                    </div>
                </div>
            </div>

            {{-- Metric 4: Jam Terramai --}}
            <div class="flex items-center gap-3 pt-2 md:pt-0 md:px-4 last:pr-0 flex-1">
                <div
                    class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fa-solid fa-fire"></i>
                </div>
                <div>
                    <span class="text-[11px] font-medium text-zinc-500 block">Jam Terramai</span>
                    <div class="flex items-baseline gap-2 mt-0.5">
                        <span class="text-base font-extrabold text-zinc-900">12:00 - 13:30</span>
                        <span
                            class="text-[10px] font-bold text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded">Puncak</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Alpine.js Chart Component Script --}}
        <script>
            function revenueChart() {
                return {
                    chart: null,
                    activeFilter: 'Minggu Ini',
                    totalWeekly: 'Rp 14.850.000',
                    avgDaily: 'Rp 2.121.400',
                    peakDay: 'Sabtu (Rp 3.100.000)',

                    datasets: {
                        'Minggu Ini': {
                            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                            data: [1800000, 1950000, 1600000, 2100000, 2450000, 3100000, 1850000],
                            total: 'Rp 14.850.000',
                            avg: 'Rp 2.121.400',
                            peak: 'Sabtu (Rp 3.100.000)'
                        },
                        'Minggu Lalu': {
                            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                            data: [1500000, 1700000, 1400000, 1900000, 2200000, 2800000, 1600000],
                            total: 'Rp 13.100.000',
                            avg: 'Rp 1.871.400',
                            peak: 'Sabtu (Rp 2.800.000)'
                        },
                        'Bulan Ini': {
                            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                            data: [12500000, 13100000, 14850000, 15200000],
                            total: 'Rp 55.650.000',
                            avg: 'Rp 13.912.500/minggu',
                            peak: 'Minggu 4 (Rp 15.200.000)'
                        }
                    },

                    init() {
                        this.$nextTick(() => {
                            this.renderChart();
                        });
                    },

                    setFilter(filter) {
                        this.activeFilter = filter;
                        const curr = this.datasets[filter];
                        this.totalWeekly = curr.total;
                        this.avgDaily = curr.avg;
                        this.peakDay = curr.peak;

                        this.chart.data.labels = curr.labels;
                        this.chart.data.datasets[0].data = curr.data;
                        this.chart.update();
                    },

                    renderChart() {
                        const ctx = document.getElementById('weeklyRevenueChart').getContext('2d');
                        const curr = this.datasets[this.activeFilter];

                        this.chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: curr.labels,
                                datasets: [{
                                    label: 'Pendapatan (Rp)',
                                    data: curr.data,
                                    borderColor: '#721c24', // Maroon primary
                                    borderWidth: 3,
                                    fill: false, // Tanpa gradasi / arsir di bawah grafik
                                    tension: 0.4, // Smooth curve
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#721c24',
                                    pointBorderWidth: 3,
                                    pointRadius: 5,
                                    pointHoverRadius: 7,
                                    pointHoverBackgroundColor: '#721c24',
                                    pointHoverBorderColor: '#ffffff',
                                    pointHoverBorderWidth: 2,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        backgroundColor: '#262626',
                                        titleFont: {
                                            family: 'Poppins',
                                            size: 12,
                                            weight: 'bold'
                                        },
                                        bodyFont: {
                                            family: 'Poppins',
                                            size: 12
                                        },
                                        padding: 12,
                                        cornerRadius: 10,
                                        callbacks: {
                                            label: function(context) {
                                                let val = context.parsed.y;
                                                return ' Pendapatan: Rp ' + val.toLocaleString('id-ID');
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            font: {
                                                family: 'Poppins',
                                                size: 11
                                            },
                                            color: '#737373'
                                        }
                                    },
                                    y: {
                                        border: {
                                            dash: [4, 4]
                                        },
                                        grid: {
                                            color: '#f0f0f0'
                                        },
                                        ticks: {
                                            font: {
                                                family: 'Poppins',
                                                size: 11
                                            },
                                            color: '#737373',
                                            callback: function(value) {
                                                if (value >= 1000000) {
                                                    return 'Rp ' + (value / 1000000) + 'jt';
                                                }
                                                return 'Rp ' + value.toLocaleString('id-ID');
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            }
        </script>

    </main>

</body>
