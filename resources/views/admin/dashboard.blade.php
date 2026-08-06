<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Overviu & Audit | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f3ed; /* --color-base */
        }
    </style>
</head>

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminDashboard()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="dashboard" />

    <!-- Top Navbar Component -->
    <x-admin.navbar />

    <!-- Main Content Area -->
    <main class="pt-20 pb-16 md:pl-64 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- 1. HERO HEADER BANNER --}}
            <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary rounded-3xl p-6 md:p-8 border border-maroon-light/30 shadow-xl relative overflow-hidden text-white flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Background Accent Glows -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-12 left-1/3 w-64 h-64 bg-maroon-light/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="space-y-2 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-dark/80 border border-amber-400/30 text-amber-300 text-xs font-bold shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Pusat Penerimaan & Verifikasi Laporan Kasir</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Selamat Datang kembali, <span class="text-amber-300">Uda Sutan</span>
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Pantau seluruh laporan kasir real-time, audit setoran fisik laci, verifikasi pengeluaran kas out operasional, dan analisa omset harian warung.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="refreshData()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-rotate text-sm" :class="loading ? 'animate-spin' : ''"></i>
                        <span>Segarkan Data</span>
                    </button>

                    <a href="{{ route('admin.laporan-shift') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                        <span>Buka Laporan Shift Kasir</span>
                    </a>
                </div>
            </div>

            {{-- 2. EXECUTIVE METRICS GRID (4 CARDS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Omset Semua Kasir --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                    <div class="absolute top-0 left-0 bottom-0 w-1.5 bg-maroon-primary"></div>
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Omset Kasir (Hari Ini)</span>
                            <div class="text-xl md:text-2xl font-extrabold text-maroon-primary tracking-tight" x-text="formatRupiah(metrics.totalRevenue)">Rp 0</div>
                            <div class="flex items-center gap-1.5 text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md w-fit">
                                <i class="fa-solid fa-arrow-trend-up"></i> +14.2% dibanding kemarin
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold group-hover:scale-110 transition shrink-0">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                        </div>
                    </div>
                </div>

                {{-- Total Shift Laporan Masuk --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                    <div class="absolute top-0 left-0 bottom-0 w-1.5 bg-maroon-secondary"></div>
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Laporan Shift Masuk</span>
                            <div class="text-xl md:text-2xl font-extrabold text-zinc-900 tracking-tight" x-text="reports.length + ' Laporan'">0 Laporan</div>
                            <div class="flex items-center gap-1 text-[11px] font-bold text-maroon-primary bg-rose-50 px-2 py-0.5 rounded-md w-fit" x-text="pendingCount + ' Menunggu Audit Admin'">
                                0 Menunggu Audit
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-maroon-secondary flex items-center justify-center text-xl font-bold group-hover:scale-110 transition shrink-0">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                    </div>
                </div>

                {{-- Kas Out Approved vs Pending --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                    <div class="absolute top-0 left-0 bottom-0 w-1.5 bg-amber-500"></div>
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Pengeluaran Kas Out</span>
                            <div class="text-xl md:text-2xl font-extrabold text-amber-700 tracking-tight" x-text="formatRupiah(metrics.totalPettyCashOut)">Rp 0</div>
                            <div class="text-[11px] font-semibold text-zinc-500">
                                Total dari <strong class="text-zinc-800" x-text="pettyCashLogs.length + ' Nota Operasional'"></strong>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition shrink-0">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </div>
                </div>

                {{-- Status Rekonsiliasi Kas Laci --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs hover:shadow-md transition relative overflow-hidden group">
                    <div class="absolute top-0 left-0 bottom-0 w-1.5 bg-emerald-500"></div>
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Status Selisih Audit Laci</span>
                            <div class="text-xl md:text-2xl font-extrabold text-emerald-600 tracking-tight" x-text="metrics.totalDifference === 0 ? 'PAS (Balanced)' : formatRupiah(metrics.totalDifference)">PAS (Balanced)</div>
                            <div class="text-[11px] font-medium text-zinc-500">
                                Akurasi Setoran Kasir: <strong class="text-emerald-600 font-bold">100% Sesuai</strong>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition shrink-0">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                    </div>
                </div>

            </div>

            {{-- 3. PUSAT PENERIMAAN LAPORAN KASIR --}}
            <div id="laporan-kasir" class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <div class="p-5 md:p-6 border-b border-zinc-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-rose-50 text-maroon-primary border border-rose-200 text-xs font-extrabold">
                                Audit Stream Realtime
                            </span>
                            <span class="text-xs text-zinc-400 font-medium">• Laporan Masuk dari Kasir</span>
                        </div>
                        <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-maroon-primary"></i>
                            Daftar Laporan Shift Kasir Masuk
                        </h2>
                        <p class="text-xs text-zinc-500">Seluruh berkas laporan shift, setoran fisik laci, dan rekonsiliasi kasir</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2.5">
                        <div class="relative flex-1 sm:flex-none">
                            <input type="text" x-model="searchKasir" placeholder="Cari nama kasir / kode..." 
                                   class="w-full sm:w-56 bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 text-zinc-800 focus:outline-none focus:ring-2 focus:ring-maroon-primary font-medium">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                        </div>

                        <select x-model="filterStatus" 
                                class="bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-700 focus:outline-none focus:ring-2 focus:ring-maroon-primary cursor-pointer">
                            <option value="all">Semua Status Audit</option>
                            <option value="Pending">Menunggu Verifikasi</option>
                            <option value="Approved">Disetujui Admin</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Kasir & Shift</th>
                                <th class="py-3.5 px-4">Waktu Setor</th>
                                <th class="py-3.5 px-4 text-right">Omset Tunai</th>
                                <th class="py-3.5 px-4 text-right">Non-Tunai</th>
                                <th class="py-3.5 px-4 text-right">Ekspektasi Laci</th>
                                <th class="py-3.5 px-4 text-right">Fisik Dihitung</th>
                                <th class="py-3.5 px-4 text-center">Selisih</th>
                                <th class="py-3.5 px-4 text-center">Status Audit</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="report in filteredReports" :key="report.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl font-extrabold flex items-center justify-center text-xs shrink-0"
                                                 :class="report.status === 'Pending' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-maroon-primary'"
                                                 x-text="getInitials(report.cashierName)">
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-zinc-900 text-xs" x-text="report.cashierName"></h4>
                                                <span class="text-[10px] text-zinc-400 font-semibold" x-text="report.shiftName + ' (' + report.shiftTime + ')'"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-800 font-semibold" x-text="report.date"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="report.submittedAt"></div>
                                    </td>
                                    <td class="py-3.5 px-4 text-right font-extrabold text-emerald-700" x-text="formatRupiah(report.cashSales)"></td>
                                    <td class="py-3.5 px-4 text-right font-extrabold text-sky-700" x-text="formatRupiah(report.nonCashSales)"></td>
                                    <td class="py-3.5 px-4 text-right font-bold text-zinc-800" x-text="formatRupiah(report.expectedCash)"></td>
                                    <td class="py-3.5 px-4 text-right font-extrabold text-zinc-900 bg-zinc-50/50" x-text="formatRupiah(report.actualCash)"></td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            PAS (Rp 0)
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="report.status === 'Pending' ? 'bg-amber-100 text-amber-800 border border-amber-300/60' : 'bg-emerald-100 text-emerald-800 border border-emerald-300/60'">
                                            <i class="fa-solid mr-1" :class="report.status === 'Pending' ? 'fa-clock' : 'fa-circle-check'"></i>
                                            <span x-text="report.status === 'Pending' ? 'Menunggu Audit' : 'Disetujui'"></span>
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="openReportDetail(report)" 
                                                    class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition cursor-pointer flex items-center gap-1">
                                                <i class="fa-solid fa-eye text-zinc-500"></i>
                                                <span>Detail</span>
                                            </button>
                                            <template x-if="report.status === 'Pending'">
                                                <button @click="approveReport(report)" 
                                                        class="px-2.5 py-1.5 rounded-lg bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white text-xs font-bold transition shadow-xs cursor-pointer flex items-center gap-1">
                                                    <i class="fa-solid fa-check"></i>
                                                    <span>Setujui</span>
                                                </button>
                                            </template>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 4. GRAFIK TREN OMSET & PERSETUJUAN KAS OUT --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                        <div>
                            <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-chart-area text-maroon-primary"></i>
                                Perbandingan Omset Shift Kasir
                            </h3>
                            <p class="text-xs text-zinc-500">Perbandingan perolehan kasir shift pagi & sore minggu ini</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg bg-rose-50 text-maroon-primary text-xs font-bold border border-rose-200">Minggu Ini</span>
                    </div>

                    <div class="relative w-full h-[280px]">
                        <canvas id="adminSalesChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                            <div>
                                <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                                    <i class="fa-solid fa-receipt text-maroon-primary"></i>
                                    Verifikasi Kas Out Kasir
                                </h3>
                                <p class="text-xs text-zinc-500">Persetujuan pengeluaran kecil dari laci</p>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3">
                            <template x-for="item in pettyCashLogs" :key="item.id">
                                <div class="p-3.5 rounded-xl bg-zinc-50 border border-zinc-100 space-y-2">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-xs font-extrabold text-zinc-900" x-text="item.note"></h4>
                                            <p class="text-[11px] text-zinc-500">Diajukan oleh: <strong class="text-zinc-700" x-text="item.cashier"></strong> • <span x-text="item.time"></span></p>
                                        </div>
                                        <span class="text-xs font-extrabold text-maroon-primary" x-text="formatRupiah(item.amount)"></span>
                                    </div>

                                    <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded"
                                              :class="item.status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'"
                                              x-text="item.status"></span>

                                        <template x-if="item.status === 'Menunggu'">
                                            <div class="flex items-center gap-1">
                                                <button @click="approvePettyCash(item)" class="px-2 py-1 rounded bg-emerald-600 text-white text-[10px] font-bold">Setujui</button>
                                                <button @click="rejectPettyCash(item)" class="px-2 py-1 rounded bg-zinc-200 text-zinc-700 text-[10px] font-bold">Tolak</button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- MODAL DETAIL LAPORAN SHIFT KASIR --}}
        <div x-cloak x-show="showReportModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showReportModal = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 shadow-2xl relative space-y-6 max-h-[90vh] overflow-y-auto">
                <button @click="showReportModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="flex items-center gap-4 pb-4 border-b border-zinc-100">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 flex items-center justify-center font-extrabold text-lg shadow-md shrink-0">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-extrabold text-maroon-primary" x-text="selectedReport.shiftName"></span>
                            <span class="text-xs text-zinc-300">•</span>
                            <span class="text-xs text-zinc-500" x-text="selectedReport.date"></span>
                        </div>
                        <h3 class="text-lg font-extrabold text-zinc-900" x-text="'Detail Audit Laporan: ' + selectedReport.cashierName"></h3>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200">
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Modal Float Awal</span>
                        <span class="text-sm font-extrabold text-zinc-900" x-text="formatRupiah(selectedReport.initialFloat || 500000)"></span>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200">
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Penjualan Tunai</span>
                        <span class="text-sm font-extrabold text-emerald-700" x-text="formatRupiah(selectedReport.cashSales)"></span>
                    </div>
                    <div class="p-3 bg-sky-50 rounded-xl border border-sky-200">
                        <span class="text-[10px] font-bold text-sky-700 uppercase tracking-wider block">Penjualan Non-Tunai</span>
                        <span class="text-sm font-extrabold text-sky-700" x-text="formatRupiah(selectedReport.nonCashSales)"></span>
                    </div>
                    <div class="p-3 bg-rose-50 rounded-xl border border-rose-200">
                        <span class="text-[10px] font-bold text-rose-700 uppercase tracking-wider block">Kas Out (Pengeluaran)</span>
                        <span class="text-sm font-extrabold text-rose-700" x-text="formatRupiah(selectedReport.pettyCashOut || 50000)"></span>
                    </div>
                    <div class="p-3 bg-zinc-100 rounded-xl border border-zinc-200">
                        <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider block">Ekspektasi Uang Laci</span>
                        <span class="text-sm font-extrabold text-zinc-900" x-text="formatRupiah(selectedReport.expectedCash)"></span>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                        <span class="text-[10px] font-bold text-amber-800 uppercase tracking-wider block">Fisik Dihitung Kasir</span>
                        <span class="text-sm font-extrabold text-amber-900" x-text="formatRupiah(selectedReport.actualCash)"></span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-zinc-700">Catatan Audit Admin / Manager</label>
                    <textarea x-model="adminNote" rows="2" placeholder="Masukkan catatan atau instruksi verifikasi untuk kasir ini..." 
                              class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs font-medium focus:ring-2 focus:ring-maroon-primary focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button @click="showReportModal = false" class="px-5 py-2.5 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Tutup
                    </button>
                    <button @click="approveSelectedReport()" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        <i class="fa-solid fa-check mr-1"></i> Setujui Setoran Kasir
                    </button>
                </div>
            </div>
        </div>

    </main>

    <script>
        function adminDashboard() {
            return {
                sidebarOpen: false,
                loading: false,
                searchKasir: '',
                filterStatus: 'all',
                showReportModal: false,
                selectedReport: {},
                adminNote: '',

                metrics: {
                    totalRevenue: 7400000,
                    totalPettyCashOut: 85000,
                    totalDifference: 0
                },

                reports: [
                    {
                        id: 1,
                        cashierName: 'Kasir Sutan',
                        shiftName: 'Shift 1 (Pagi)',
                        shiftTime: '08:00 - 16:00',
                        date: '6 Agustus 2026',
                        submittedAt: '16:05 WIB',
                        cashSales: 1450000,
                        nonCashSales: 1400000,
                        initialFloat: 500000,
                        pettyCashOut: 50000,
                        expectedCash: 1900000,
                        actualCash: 1900000,
                        difference: 0,
                        status: 'Pending'
                    },
                    {
                        id: 2,
                        cashierName: 'Kasir Rahma',
                        shiftName: 'Shift 2 (Sore)',
                        shiftTime: '16:00 - 22:00',
                        date: '6 Agustus 2026',
                        submittedAt: '22:10 WIB',
                        cashSales: 2600000,
                        nonCashSales: 1950000,
                        initialFloat: 500000,
                        pettyCashOut: 35000,
                        expectedCash: 3065000,
                        actualCash: 3065000,
                        difference: 0,
                        status: 'Approved'
                    },
                    {
                        id: 3,
                        cashierName: 'Kasir Budi',
                        shiftName: 'Shift 1 (Pagi)',
                        shiftTime: '08:00 - 16:00',
                        date: '5 Agustus 2026',
                        submittedAt: '16:02 WIB',
                        cashSales: 1200000,
                        nonCashSales: 950000,
                        initialFloat: 500000,
                        pettyCashOut: 20000,
                        expectedCash: 1680000,
                        actualCash: 1680000,
                        difference: 0,
                        status: 'Approved'
                    }
                ],

                pettyCashLogs: [
                    { id: 101, cashier: 'Kasir Sutan', amount: 25000, note: 'Beli Es Batu Kristal 5 Plastik', time: '10:30 WIB', status: 'Disetujui' },
                    { id: 102, cashier: 'Kasir Sutan', amount: 25000, note: 'Parkir Pick Up Supplier Sayur', time: '14:15 WIB', status: 'Disetujui' },
                    { id: 103, cashier: 'Kasir Rahma', amount: 35000, note: 'Beli Kertas Struk Thermal Kasir', time: '17:40 WIB', status: 'Menunggu' }
                ],

                get filteredReports() {
                    return this.reports.filter(r => {
                        const matchName = r.cashierName.toLowerCase().includes(this.searchKasir.toLowerCase()) || r.shiftName.toLowerCase().includes(this.searchKasir.toLowerCase());
                        const matchStatus = this.filterStatus === 'all' || r.status === this.filterStatus;
                        return matchName && matchStatus;
                    });
                },

                get pendingCount() {
                    return this.reports.filter(r => r.status === 'Pending').length;
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                getInitials(name) {
                    return name.split(' ').map(n => n[0]).join('').toUpperCase();
                },

                openReportDetail(report) {
                    this.selectedReport = report;
                    this.adminNote = '';
                    this.showReportModal = true;
                },

                approveReport(report) {
                    report.status = 'Approved';
                    alert(`Laporan dari ${report.cashierName} berhasil disetujui!`);
                },

                approveSelectedReport() {
                    if (this.selectedReport) {
                        this.selectedReport.status = 'Approved';
                        this.showReportModal = false;
                        alert(`Laporan shift disetujui dengan catatan admin!`);
                    }
                },

                approvePettyCash(item) {
                    item.status = 'Disetujui';
                },

                rejectPettyCash(item) {
                    item.status = 'Ditolak';
                },

                refreshData() {
                    this.loading = true;
                    setTimeout(() => {
                        this.loading = false;
                    }, 600);
                },

                init() {
                    this.$nextTick(() => {
                        this.initChart();
                    });
                },

                initChart() {
                    const ctx = document.getElementById('adminSalesChart');
                    if (!ctx) return;

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                            datasets: [
                                {
                                    label: 'Kasir Sutan (Shift 1)',
                                    data: [1800000, 2100000, 1950000, 2400000, 2850000, 3200000, 2900000],
                                    backgroundColor: '#721c24',
                                    borderRadius: 6
                                },
                                {
                                    label: 'Kasir Rahma (Shift 2)',
                                    data: [2200000, 2450000, 2300000, 2750000, 3400000, 3900000, 3650000],
                                    backgroundColor: '#a52834',
                                    borderRadius: 6
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { font: { family: 'Plus Jakarta Sans', size: 11, weight: 'bold' } }
                                }
                            },
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function(val) {
                                            return 'Rp ' + (val / 1000000) + ' Jt';
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

    @livewireScripts
</body>

</html>