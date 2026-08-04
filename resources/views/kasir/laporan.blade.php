<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kasir - Kasir Lapau Uda Sutan</title>

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
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            #printableReceipt, #printableReceipt * {
                visibility: visible;
            }
            #printableReceipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased" x-data="laporanKasir()">

    {{-- Navbar --}}
    <x-kasir.navbar active="laporan" />

    <!-- Main Container -->
    <main class="pt-4 md:pt-20 pb-24 md:pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">
        
        {{-- ==================== 1. HEADER & FILTER BAR ==================== --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-slate-200/80 shadow-sm relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4">
            {{-- Decorative Accent Bar --}}
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-maroon-primary via-red-500 to-amber-500"></div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 flex items-center justify-center font-bold text-xl shadow-md shadow-maroon-primary/20 shrink-0">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Shift Active: Kasir Sutan
                        </span>
                        <span class="text-xs text-slate-400 font-medium">• Realtime Audit</span>
                    </div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight">Laporan Penjualan & Kasir</h1>
                    <p class="text-xs md:text-sm text-slate-500">Ringkasan transaksi shift, rekonsiliasi kas laci, dan omset harian</p>
                </div>
            </div>

            {{-- Filter & Action Controls --}}
            <div class="flex flex-wrap items-center gap-2.5">
                {{-- Catat Kas Out Button --}}
                <button @click="showKasOutModal = true" 
                    class="inline-flex items-center justify-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs md:text-sm px-3.5 py-2.5 rounded-xl transition duration-150 cursor-pointer">
                    <i class="fa-solid fa-minus-circle"></i>
                    <span>+ Catat Kas Out</span>
                </button>

                {{-- Periode Selector --}}
                <div class="relative flex-1 sm:flex-none">
                    <select x-model="selectedPeriod" @change="updatePeriod()" 
                        class="w-full sm:w-auto appearance-none bg-slate-100/80 hover:bg-slate-100 border border-slate-200 text-slate-800 font-bold text-xs md:text-sm rounded-xl px-4 py-2.5 pr-8 focus:outline-none focus:ring-2 focus:ring-maroon-primary cursor-pointer transition">
                        <option value="shift_ini">Shift Ini (Hari Ini)</option>
                        <option value="kemarin">Kemarin</option>
                        <option value="minggu_ini">Minggu Ini</option>
                        <option value="bulan_ini">Bulan Ini</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                </div>

                {{-- Tombol Cetak Struk Shift --}}
                <button @click="printShiftReport()" 
                    class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-maroon-primary to-maroon-dark hover:from-maroon-dark hover:to-maroon-primary text-white font-bold text-xs md:text-sm px-4 py-2.5 rounded-xl shadow-md shadow-maroon-primary/20 transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-print text-amber-300"></i>
                    <span>Cetak Shift</span>
                </button>

                {{-- Export Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false" 
                        class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs md:text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 shadow-sm transition">
                        <i class="fa-solid fa-file-export text-slate-400"></i>
                        <span>Export</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    
                    <div x-show="open" x-transition 
                        class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl border border-slate-200 py-1 z-30">
                        <button @click="alert('Export PDF...'); open = false" class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                            <i class="fa-solid fa-file-pdf text-rose-500"></i> Export PDF
                        </button>
                        <button @click="alert('Export Excel...'); open = false" class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                            <i class="fa-solid fa-file-excel text-emerald-600"></i> Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== 2. EXECUTIVE METRICS GRID (4 CARDS) ==================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Total Omset --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between hover:-translate-y-0.5 hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 bottom-0 w-1 bg-maroon-primary"></div>
                <div class="space-y-1 pl-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Omset</span>
                    <div class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight" x-text="formatRupiah(summary.totalRevenue)">Rp 0</div>
                    <div class="flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-md w-fit">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +12.4% vs lalu
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-maroon-primary/10 to-maroon-primary/5 text-maroon-primary flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-200 shrink-0">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>

            {{-- Total Transaksi --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between hover:-translate-y-0.5 hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 bottom-0 w-1 bg-emerald-500"></div>
                <div class="space-y-1 pl-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Transaksi</span>
                    <div class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight" x-text="summary.totalTransactions + ' Nota'">0 Nota</div>
                    <div class="text-[11px] font-medium text-slate-500 flex items-center gap-1.5">
                        <span class="text-emerald-600 font-bold" x-text="summary.successCount + ' Lunas'"></span>
                        <span>•</span>
                        <span class="text-rose-500 font-bold" x-text="summary.voidCount + ' Void'"></span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 text-emerald-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-200 shrink-0">
                    <i class="fa-solid fa-receipt"></i>
                </div>
            </div>

            {{-- Uang Tunai di Laci --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between hover:-translate-y-0.5 hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 bottom-0 w-1 bg-amber-500"></div>
                <div class="space-y-1 pl-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Uang Laci (Cash)</span>
                    <div class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight" x-text="formatRupiah(summary.cashInDrawer)">Rp 0</div>
                    <div class="text-[11px] text-slate-500 font-medium">Modal Float: <strong class="text-slate-700" x-text="formatRupiah(summary.initialFloat)"></strong></div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500/10 to-amber-500/5 text-amber-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-200 shrink-0">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
            </div>

            {{-- Non-Tunai --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between hover:-translate-y-0.5 hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 bottom-0 w-1 bg-blue-500"></div>
                <div class="space-y-1 pl-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Non-Tunai (QRIS/EDC)</span>
                    <div class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight" x-text="formatRupiah(summary.nonCashRevenue)">Rp 0</div>
                    <div class="text-[11px] font-bold text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded-md w-fit" x-text="summary.nonCashPercentage + '% Porsi Omset'">0%</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500/10 to-blue-500/5 text-blue-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-200 shrink-0">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
            </div>

        </div>

        {{-- ==================== 3. REKONSILIASI KAS & AUDIT SHIFT (FINANCIAL FLOW CARD) ==================== --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 md:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-5 border-b border-slate-100">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-vault text-maroon-primary"></i>
                        Rekonsiliasi Kas & Audit Shift
                    </h2>
                    <p class="text-xs text-slate-500">Audit pencocokan fisik uang laci tunai dengan ekspektasi sistem</p>
                </div>
                <button @click="showCloseShiftModal = true" 
                    class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm cursor-pointer self-start sm:self-auto flex items-center gap-2">
                    <i class="fa-solid fa-lock text-amber-400"></i>
                    <span>Tutup Shift & Serah Terima</span>
                </button>
            </div>

            {{-- Connected Formula Cards Flow --}}
            <div class="flex flex-col lg:flex-row items-stretch gap-3">
                
                {{-- Item 1: Modal Awal --}}
                <div class="flex-1 bg-slate-50/80 p-4 rounded-xl border border-slate-200/60 flex items-center justify-between">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Modal Awal (Float)</span>
                        <div class="text-base font-extrabold text-slate-800" x-text="formatRupiah(summary.initialFloat)">Rp 500.000</div>
                        <span class="text-[11px] text-slate-400 font-medium">Kas awal shift</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-slate-200/70 text-slate-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>

                {{-- Operator + --}}
                <div class="hidden lg:flex items-center justify-center text-slate-300 font-black text-lg px-1">
                    <i class="fa-solid fa-plus text-slate-400"></i>
                </div>

                {{-- Item 2: Penjualan Tunai --}}
                <div class="flex-1 bg-emerald-50/40 p-4 rounded-xl border border-emerald-200/50 flex items-center justify-between">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Penjualan Tunai (+)</span>
                        <div class="text-base font-extrabold text-emerald-600" x-text="'+ ' + formatRupiah(summary.cashRevenue)">+ Rp 1.450.000</div>
                        <span class="text-[11px] text-emerald-600/80 font-medium">Uang masuk tunai</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>

                {{-- Operator - --}}
                <div class="hidden lg:flex items-center justify-center text-slate-300 font-black text-lg px-1">
                    <i class="fa-solid fa-minus text-slate-400"></i>
                </div>

                {{-- Item 3: Kas Out Operasional --}}
                <div class="flex-1 bg-rose-50/40 p-4 rounded-xl border border-rose-200/50 flex items-center justify-between">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold text-rose-700 uppercase tracking-wider block">Kas Out / Operasional (-)</span>
                        <div class="text-base font-extrabold text-rose-600" x-text="'- ' + formatRupiah(summary.pettyCashOut)">- Rp 50.000</div>
                        <button @click="showKasOutModal = true" class="text-[11px] text-rose-600 font-bold hover:underline">
                            + Tambah Pengeluaran
                        </button>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                </div>

                {{-- Operator = --}}
                <div class="hidden lg:flex items-center justify-center text-slate-300 font-black text-lg px-1">
                    <i class="fa-solid fa-equals text-slate-400"></i>
                </div>

                {{-- Item 4: Result (Total Fisik Wajib Laci) --}}
                <div class="flex-1 bg-gradient-to-br from-emerald-500 to-emerald-600 p-4 rounded-xl shadow-md shadow-emerald-500/20 text-white flex items-center justify-between">
                    <div class="space-y-0.5">
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-100">Wajib Ada di Laci</span>
                            <span class="text-[10px] font-extrabold bg-white/20 text-white px-1.5 py-0.2 rounded-full">Balance</span>
                        </div>
                        <div class="text-xl font-black tracking-tight" x-text="formatRupiah(expectedCashInDrawer)">Rp 1.900.000</div>
                        <span class="text-[11px] text-emerald-100 font-medium">Total fisik siap disetor</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center font-extrabold text-lg shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

            </div>
        </div>

        {{-- ==================== 4. GRAFIK & ANALISIS MENU & KATEGORI ==================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Modern Frameless Line Chart Card --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 md:p-6 flex flex-col justify-between">
                
                {{-- Header Above Chart: Title + Segmented Filter Tabs --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-maroon-primary/10 text-maroon-primary text-[11px] font-bold mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-maroon-primary animate-pulse"></span>
                            Analytics Trends
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-maroon-primary"></i>
                            Tren Penjualan Harian
                        </h3>
                        <p class="text-xs text-slate-500">Pantau pergerakan omset dan jam sibuk secara real-time</p>
                    </div>

                    {{-- Segmented Controller Tabs --}}
                    <div class="flex items-center p-1 bg-slate-100 rounded-xl w-fit self-start sm:self-auto border border-slate-200/70">
                        <template x-for="filter in ['Jam Ini', 'Hari Ini', 'Mingguan']" :key="filter">
                            <button @click="chartFilter = filter; updatePeriod()"
                                :class="chartFilter === filter ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-800 font-medium'"
                                class="px-3 py-1.5 rounded-lg text-xs transition duration-150 cursor-pointer"
                                x-text="filter">
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Hero Metric Summary Strip Directly Above Chart Canvas --}}
                <div class="py-4 my-2 px-4 bg-gradient-to-r from-slate-50 via-white to-slate-50 rounded-xl border border-slate-100 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Omset Chart</span>
                        <span class="text-xl md:text-2xl font-black text-maroon-primary tracking-tight" x-text="formatRupiah(summary.totalRevenue)">Rp 2.850.000</span>
                    </div>

                    <div class="hidden sm:block h-8 w-px bg-slate-200"></div>

                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Rata-rata Transaksi</span>
                        <span class="text-sm font-bold text-slate-800">Rp 59.375 <span class="text-[10px] text-emerald-600 font-semibold bg-emerald-50 px-1 py-0.5 rounded">+4.2%</span></span>
                    </div>

                    <div class="hidden sm:block h-8 w-px bg-slate-200"></div>

                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Jam Puncak (Peak)</span>
                        <span class="text-sm font-extrabold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/60 inline-flex items-center gap-1">
                            <i class="fa-solid fa-fire text-amber-500 text-xs"></i> 12:00 - 13:30
                        </span>
                    </div>
                </div>

                {{-- Chart Canvas --}}
                <div class="relative w-full h-[260px] pt-2">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>

            {{-- Top Menu & Breakdown Kategori --}}
            <div class="space-y-6">
                {{-- Top 3 Menu Terlaris --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 md:p-6">
                    <h3 class="text-base font-bold text-slate-900 mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-trophy text-amber-500"></i>
                        Menu Terlaris (Top 3)
                    </h3>
                    <p class="text-xs text-slate-500 mb-4">Item paling banyak terjual pada shift ini</p>
                    
                    <div class="space-y-3">
                        <template x-for="(item, idx) in topProducts" :key="idx">
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 rounded-lg font-bold text-xs flex items-center justify-center"
                                        :class="idx === 0 ? 'bg-amber-100 text-amber-800' : (idx === 1 ? 'bg-slate-200 text-slate-700' : 'bg-orange-100 text-orange-800')"
                                        x-text="'#' + (idx + 1)"></span>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900" x-text="item.name"></h4>
                                        <span class="text-[11px] text-slate-500" x-text="item.qty + ' Terjual'"></span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-maroon-primary" x-text="formatRupiah(item.total)"></span>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Breakdown Omset per Kategori --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 md:p-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-utensils text-maroon-primary"></i>
                        Porsi Terjual per Kategori
                    </h3>
                    <div class="space-y-2.5 text-xs font-medium">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-slate-700 font-bold">Makanan Utama</span>
                                <span class="text-slate-900 font-bold">62 Porsi (65%)</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-maroon-primary h-full rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-slate-700 font-bold">Minuman</span>
                                <span class="text-slate-900 font-bold">54 Gelas (28%)</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-slate-700 font-bold">Snack / Kerupuk</span>
                                <span class="text-slate-900 font-bold">18 Bungkus (7%)</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full rounded-full" style="width: 7%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== 5. TABEL HISTORY TRANSAKSI ==================== --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            {{-- Table Header Controls --}}
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-maroon-primary"></i>
                        Riwayat Transaksi
                    </h3>
                    <p class="text-xs text-slate-500">Daftar transaksi nota pembayaran kasir</p>
                </div>

                {{-- Search & Filter Controls --}}
                <div class="flex items-center gap-2.5">
                    {{-- Search Input --}}
                    <div class="relative flex-1 sm:flex-none">
                        <input type="text" x-model="searchQuery" placeholder="Cari No Nota..." 
                            class="w-full sm:w-48 bg-slate-100 border border-slate-200 text-xs rounded-xl pl-8 pr-3 py-2 text-slate-800 focus:outline-none focus:ring-2 focus:ring-maroon-primary">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>

                    {{-- Status Filter --}}
                    <select x-model="statusFilter" 
                        class="bg-slate-100 border border-slate-200 text-xs font-semibold rounded-xl px-3 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-primary cursor-pointer">
                        <option value="all">Semua Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Void">Void</option>
                    </select>
                </div>
            </div>

            {{-- Responsive Table Container --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[640px]">
                    <thead>
                        <tr class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/80">
                            <th class="py-3 px-4">No. Invoice</th>
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">Pelanggan</th>
                            <th class="py-3 px-4">Metode Bayar</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Total</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                        <template x-for="trx in filteredTransactions" :key="trx.id">
                            <tr class="hover:bg-slate-50/80 transition duration-150">
                                <td class="py-3 px-4 font-bold text-slate-900" x-text="trx.invoice"></td>
                                <td class="py-3 px-4 text-slate-500" x-text="trx.time"></td>
                                <td class="py-3 px-4">
                                    <div class="font-semibold text-slate-800" x-text="trx.customer"></div>
                                    <div class="text-[10px] text-slate-400" x-text="'Meja ' + trx.table"></div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold"
                                        :class="{
                                            'bg-emerald-50 text-emerald-700': trx.method === 'Tunai',
                                            'bg-blue-50 text-blue-700': trx.method === 'QRIS',
                                            'bg-purple-50 text-purple-700': trx.method === 'Transfer'
                                        }" x-text="trx.method">
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                        :class="trx.status === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'"
                                        x-text="trx.status"></span>
                                </td>
                                <td class="py-3 px-4 text-right font-bold text-slate-900" x-text="formatRupiah(trx.total)"></td>
                                <td class="py-3 px-4 text-center">
                                    <button @click="openReceiptModal(trx)" 
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-maroon-primary hover:text-white text-slate-700 text-xs font-semibold transition cursor-pointer">
                                        <i class="fa-solid fa-receipt"></i>
                                        <span>Struk</span>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            <div class="p-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Menampilkan <strong x-text="filteredTransactions.length"></strong> dari <strong x-text="transactions.length"></strong> data</span>
                <div class="flex items-center gap-1">
                    <button class="px-2.5 py-1 bg-white border border-slate-200 rounded-md text-slate-400" disabled>Prev</button>
                    <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                    <button class="px-2.5 py-1 bg-white border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">Next</button>
                </div>
            </div>
        </div>

        {{-- ==================== MODAL 1: CATAT KAS OUT / PETTY CASH ==================== --}}
        <div x-cloak x-show="showKasOutModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showKasOutModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button @click="showKasOutModal = false" class="absolute right-4 top-4 text-slate-400 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Catat Kas Out / Pengeluaran Kasir</h3>
                        <p class="text-xs text-slate-500">Pengeluaran kecil operasional dari laci tunai</p>
                    </div>
                </div>

                <form @submit.prevent="submitKasOut()" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nominal Pengeluaran (Rp)</label>
                        <input type="number" x-model.number="kasOutForm.amount" required placeholder="Contoh: 25000"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-rose-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Keterangan / Keperluan</label>
                        <textarea x-model="kasOutForm.note" required rows="2" placeholder="Misal: Beli Es Batu & Parkir Supplier"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs font-medium text-slate-800 focus:ring-2 focus:ring-rose-500 focus:outline-none"></textarea>
                    </div>

                    <div class="pt-2 flex gap-2">
                        <button type="button" @click="showKasOutModal = false" class="flex-1 bg-slate-100 text-slate-700 font-bold py-2.5 rounded-xl text-xs">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2.5 rounded-xl text-xs shadow transition">
                            Simpan Kas Out
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ==================== MODAL 2: TUTUP SHIFT & REKONSILIASI FISIK ==================== --}}
        <div x-cloak x-show="showCloseShiftModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showCloseShiftModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button @click="showCloseShiftModal = false" class="absolute right-4 top-4 text-slate-400 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Form Audit Tutup Shift Kasir</h3>
                        <p class="text-xs text-slate-500">Hitung fisik uang tunai di laci saat serah terima</p>
                    </div>
                </div>

                <div class="space-y-3 bg-slate-50 p-3.5 rounded-xl border border-slate-200/70 text-xs mb-4">
                    <div class="flex justify-between"><span>Ekspektasi Uang Laci (Sistem):</span><strong class="text-slate-900" x-text="formatRupiah(expectedCashInDrawer)"></strong></div>
                </div>

                <form @submit.prevent="submitCloseShift()" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jumlah Uang Fisik Dihitung (Rp)</label>
                        <input type="number" x-model.number="actualCashInput" required placeholder="Masukkan jumlah fisik di laci"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm font-extrabold text-slate-900 focus:ring-2 focus:ring-maroon-primary focus:outline-none">
                    </div>

                    {{-- Live Selisih Detection --}}
                    <div x-cloak x-show="actualCashInput > 0" class="p-3 rounded-xl text-xs font-bold flex justify-between items-center"
                        :class="cashDifference === 0 ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : (cashDifference > 0 ? 'bg-blue-50 text-blue-800 border border-blue-200' : 'bg-rose-50 text-rose-800 border border-rose-200')">
                        <span>Status Selisih Kas:</span>
                        <span x-text="cashDifference === 0 ? 'PAS (Sesuai)' : (cashDifference > 0 ? 'LEBIH (+ ' + formatRupiah(cashDifference) + ')' : 'KURANG (' + formatRupiah(cashDifference) + ')')"></span>
                    </div>

                    <div class="pt-2 flex gap-2">
                        <button type="button" @click="showCloseShiftModal = false" class="flex-1 bg-slate-100 text-slate-700 font-bold py-2.5 rounded-xl text-xs">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 rounded-xl text-xs shadow transition">
                            Proses Tutup Shift
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ==================== MODAL 3: STRUK THERMAL ==================== --}}
        <div x-cloak x-show="showReceiptModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showReceiptModal = false" class="bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl relative">
                <button @click="showReceiptModal = false" class="absolute right-4 top-4 text-slate-400 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div id="printableReceipt" class="font-mono text-xs text-slate-800 space-y-3 pt-2">
                    <div class="text-center pb-2 border-b border-dashed border-slate-300">
                        <h2 class="font-bold text-sm text-slate-900">LAPAU UDA SUTAN</h2>
                        <p class="text-[10px] text-slate-500">Struk Pembayaran Kasir</p>
                    </div>

                    <div class="text-[11px] space-y-0.5 pb-2 border-b border-dashed border-slate-300">
                        <div class="flex justify-between"><span>No Nota:</span><strong x-text="selectedTrx.invoice"></strong></div>
                        <div class="flex justify-between"><span>Waktu:</span><span x-text="selectedTrx.time"></span></div>
                        <div class="flex justify-between"><span>Pelanggan:</span><span x-text="selectedTrx.customer"></span></div>
                    </div>

                    <div class="space-y-1 py-1 border-b border-dashed border-slate-300">
                        <template x-for="item in selectedTrx.items" :key="item.name">
                            <div class="flex justify-between">
                                <span x-text="item.name + ' (x' + item.qty + ')'"></span>
                                <span x-text="formatRupiah(item.subtotal)"></span>
                            </div>
                        </template>
                    </div>

                    <div class="space-y-1 pt-1 text-[11px]">
                        <div class="flex justify-between font-bold text-sm text-slate-900">
                            <span>TOTAL:</span>
                            <span x-text="formatRupiah(selectedTrx.total)"></span>
                        </div>
                        <div class="flex justify-between text-slate-500"><span>Metode:</span><span x-text="selectedTrx.method"></span></div>
                    </div>
                </div>

                <div class="mt-5">
                    <button @click="window.print()" class="w-full bg-maroon-primary hover:bg-maroon-dark text-white font-bold py-2 rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <i class="fa-solid fa-print"></i> Cetak Struk (Thermal 80mm)
                    </button>
                </div>
            </div>
        </div>

    </main>

    {{-- Script Alpine.js --}}
    <script>
        function laporanKasir() {
            return {
                selectedPeriod: 'shift_ini',
                chartFilter: 'Hari Ini',
                searchQuery: '',
                statusFilter: 'all',
                showReceiptModal: false,
                showKasOutModal: false,
                showCloseShiftModal: false,
                selectedTrx: {},

                kasOutForm: {
                    amount: null,
                    note: ''
                },

                actualCashInput: null,

                summary: {
                    totalRevenue: 2850000,
                    totalTransactions: 48,
                    successCount: 47,
                    voidCount: 1,
                    cashInDrawer: 1900000,
                    initialFloat: 500000,
                    cashRevenue: 1450000,
                    pettyCashOut: 50000,
                    nonCashRevenue: 1400000,
                    nonCashPercentage: 49.1
                },

                get expectedCashInDrawer() {
                    return (this.summary.initialFloat + this.summary.cashRevenue) - this.summary.pettyCashOut;
                },

                get cashDifference() {
                    if (!this.actualCashInput) return 0;
                    return this.actualCashInput - this.expectedCashInDrawer;
                },

                submitKasOut() {
                    if (!this.kasOutForm.amount || this.kasOutForm.amount <= 0) return;
                    this.summary.pettyCashOut += this.kasOutForm.amount;
                    alert('Kas Out sebesar ' + this.formatRupiah(this.kasOutForm.amount) + ' berhasil dicatat!');
                    this.kasOutForm.amount = null;
                    this.kasOutForm.note = '';
                    this.showKasOutModal = false;
                },

                submitCloseShift() {
                    if (!this.actualCashInput) return;
                    alert('Shift Kasir Berhasil Ditutup! Status Selisih: ' + (this.cashDifference === 0 ? 'PAS' : this.formatRupiah(this.cashDifference)));
                    this.showCloseShiftModal = false;
                },

                topProducts: [
                    { name: 'Nasi Rendang Daging', qty: 34, total: 850000 },
                    { name: 'Ayam Pop Sambal Hijau', qty: 28, total: 560000 },
                    { name: 'Es Teh Manis', qty: 52, total: 260000 }
                ],

                transactions: [
                    { id: 1, invoice: 'INV-20260804-001', time: '12:45 WIB', customer: 'Budi Santoso', table: '04', method: 'Tunai', status: 'Lunas', total: 75000, items: [{ name: 'Nasi Rendang Daging', qty: 2, price: 25000, subtotal: 50000 }, { name: 'Es Teh Manis', qty: 5, price: 5000, subtotal: 25000 }] },
                    { id: 2, invoice: 'INV-20260804-002', time: '12:50 WIB', customer: 'Rina Wijaya', table: '02', method: 'QRIS', status: 'Lunas', total: 52000, items: [{ name: 'Ayam Pop Sambal Hijau', qty: 2, price: 20000, subtotal: 40000 }, { name: 'Es Teh Manis', qty: 2, price: 6000, subtotal: 12000 }] },
                    { id: 3, invoice: 'INV-20260804-003', time: '13:05 WIB', customer: 'Doni Pratama', table: '08', method: 'Tunai', status: 'Lunas', total: 110000, items: [{ name: 'Nasi Rendang Daging', qty: 4, price: 25000, subtotal: 100000 }, { name: 'Es Teh Manis', qty: 2, price: 5000, subtotal: 10000 }] },
                    { id: 4, invoice: 'INV-20260804-004', time: '13:15 WIB', customer: 'Siti Rahma', table: 'Takeaway', method: 'Transfer', status: 'Lunas', total: 45000, items: [{ name: 'Ayam Pop Sambal Hijau', qty: 2, price: 20000, subtotal: 40000 }, { name: 'Kerupuk Kulit', qty: 1, price: 5000, subtotal: 5000 }] },
                    { id: 5, invoice: 'INV-20260804-005', time: '13:22 WIB', customer: 'Ahmad Fauzi', table: '01', method: 'Tunai', status: 'Void', total: 30000, items: [{ name: 'Nasi Goreng Padang', qty: 1, price: 30000, subtotal: 30000 }] }
                ],

                get filteredTransactions() {
                    return this.transactions.filter(t => {
                        const matchSearch = t.invoice.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                            t.customer.toLowerCase().includes(this.searchQuery.toLowerCase());
                        const matchStatus = this.statusFilter === 'all' || t.status === this.statusFilter;
                        return matchSearch && matchStatus;
                    });
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
                },

                openReceiptModal(trx) {
                    this.selectedTrx = trx;
                    this.showReceiptModal = true;
                },

                printShiftReport() {
                    alert('Mencetak Laporan Rekap Shift Kasir...');
                },

                updatePeriod() {
                    this.renderCharts();
                },

                init() {
                    this.$nextTick(() => {
                        this.renderCharts();
                    });
                },

                renderCharts() {
                    const ctxTrend = document.getElementById('revenueTrendChart').getContext('2d');
                    if (window.trendChartInstance) window.trendChartInstance.destroy();
                    
                    window.trendChartInstance = new Chart(ctxTrend, {
                        type: 'line',
                        data: {
                            labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'],
                            datasets: [{
                                label: 'Omset (Rp)',
                                data: [250000, 480000, 1150000, 420000, 310000, 780000, 240000],
                                borderColor: '#721c24',
                                backgroundColor: 'rgba(114, 28, 36, 0.06)',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.35,
                                pointBackgroundColor: '#721c24',
                                pointRadius: 3.5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: {
                                    ticks: {
                                        callback: (v) => 'Rp ' + (v / 1000) + 'k'
                                    }
                                }
                            }
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>
