<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Shift Kasir - Panel Admin | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f3ed; /* --color-base */
        }
        @media print {
            body * {
                visibility: hidden;
            }
            #printableShiftAudit, #printableShiftAudit * {
                visibility: visible;
            }
            #printableShiftAudit {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body class="min-h-screen text-zinc-800 antialiased" x-data="laporanShiftAdmin()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="laporan-shift" />

    <!-- Top Navbar Component -->
    <x-admin.navbar />

    <!-- Main Content Area -->
    <main class="pt-20 pb-16 md:pl-64 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- 1. HEADER BANNER LAPORAN SHIFT --}}
            <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary rounded-3xl p-6 md:p-8 border border-maroon-light/30 shadow-xl relative overflow-hidden text-white flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Background Accent Glows -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="space-y-2 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-dark/80 border border-amber-400/30 text-amber-300 text-xs font-bold shadow-inner">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        <span>Audit Rekonsiliasi Shift & Setoran Fisik Kasir</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Laporan Shift Kasir & Rekap Penjualan
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Verifikasi laporan serah terima shift kasir, audit selisih laci tunai, dan cetak berita acara penutupan kas harian.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="printSummaryReport()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-print"></i>
                        <span>Cetak Struk Rekap</span>
                    </button>
                    <button @click="exportExcel()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        <span>Export Excel (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Omset Shift</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">Rp 7.400.000</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">2 Shift Disetor</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Fisik Tunai Laci</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-700">Rp 4.050.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Uang Siap Disetor Bank</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Setoran QRIS / EDC</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">Rp 3.350.000</div>
                        <span class="text-[11px] text-sky-600 font-bold">45.2% Porsi Pembayaran</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Status Audit Admin</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-800">1 Menunggu</div>
                        <span class="text-[11px] font-bold text-emerald-600">2 Shift Approved</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
            </div>

            {{-- 3. FILTER & TABEL LAPORAN SHIFT KASIR --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Filter Controls Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Berkas Laporan Penutupan Shift Kasir
                            </h2>
                            <p class="text-xs text-zinc-500">Audit pencocokan fisik uang laci tunai dengan sistem kasir Lapau Uda Sutan</p>
                        </div>
                    </div>

                    <!-- Filter Controls Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
                        <!-- Periode Filter -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Periode Waktu</label>
                            <select x-model="periodFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="today">Hari Ini (6 Agustus 2026)</option>
                                <option value="yesterday">Kemarin</option>
                                <option value="this_week">Minggu Ini</option>
                                <option value="this_month">Bulan Ini</option>
                            </select>
                        </div>

                        <!-- Kasir Filter -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Kasir Berjaga</label>
                            <select x-model="cashierFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kasir</option>
                                <option value="Kasir Sutan">Kasir Sutan</option>
                                <option value="Kasir Rahma">Kasir Rahma</option>
                                <option value="Kasir Budi">Kasir Budi</option>
                            </select>
                        </div>

                        <!-- Status Audit Filter -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Audit Admin</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status Audit</option>
                                <option value="Pending">Menunggu Verifikasi</option>
                                <option value="Approved">Disetujui Admin</option>
                            </select>
                        </div>

                        <!-- Search Box -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari nota / kasir..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[900px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Kasir & Shift</th>
                                <th class="py-3.5 px-4">Waktu Setor</th>
                                <th class="py-3.5 px-4 text-right">Float Awal</th>
                                <th class="py-3.5 px-4 text-right">Tunai Masuk</th>
                                <th class="py-3.5 px-4 text-right">Non-Tunai</th>
                                <th class="py-3.5 px-4 text-right">Kas Out</th>
                                <th class="py-3.5 px-4 text-right">Ekspektasi Laci</th>
                                <th class="py-3.5 px-4 text-right">Fisik Dihitung</th>
                                <th class="py-3.5 px-4 text-center">Selisih</th>
                                <th class="py-3.5 px-4 text-center">Status Audit</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="report in filteredShiftReports" :key="report.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Kasir & Shift -->
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

                                    <!-- Waktu Setor -->
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-800 font-semibold" x-text="report.date"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="report.submittedAt"></div>
                                    </td>

                                    <!-- Float Awal -->
                                    <td class="py-3.5 px-4 text-right text-zinc-500 font-semibold" x-text="formatRupiah(report.initialFloat)"></td>

                                    <!-- Tunai Masuk -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-emerald-700" x-text="formatRupiah(report.cashSales)"></td>

                                    <!-- Non-Tunai -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-sky-700" x-text="formatRupiah(report.nonCashSales)"></td>

                                    <!-- Kas Out -->
                                    <td class="py-3.5 px-4 text-right font-bold text-rose-600" x-text="'- ' + formatRupiah(report.pettyCashOut)"></td>

                                    <!-- Ekspektasi Laci -->
                                    <td class="py-3.5 px-4 text-right font-bold text-zinc-800" x-text="formatRupiah(report.expectedCash)"></td>

                                    <!-- Fisik Dihitung Kasir -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-zinc-900 bg-zinc-50/60" x-text="formatRupiah(report.actualCash)"></td>

                                    <!-- Selisih Kas -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            PAS (Rp 0)
                                        </span>
                                    </td>

                                    <!-- Status Audit -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="report.status === 'Pending' ? 'bg-amber-100 text-amber-800 border border-amber-300/60' : 'bg-emerald-100 text-emerald-800 border border-emerald-300/60'">
                                            <i class="fa-solid mr-1" :class="report.status === 'Pending' ? 'fa-clock' : 'fa-circle-check'"></i>
                                            <span x-text="report.status === 'Pending' ? 'Menunggu Audit' : 'Disetujui'"></span>
                                        </span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="openAuditModal(report)" 
                                                    class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition cursor-pointer flex items-center gap-1">
                                                <i class="fa-solid fa-eye text-zinc-500"></i>
                                                <span>Detail</span>
                                            </button>

                                            <template x-if="report.status === 'Pending'">
                                                <button @click="approveReport(report)" 
                                                        class="px-2.5 py-1.5 rounded-lg bg-gradient-to-r from-maroon-primary to-maroon-secondary hover:from-maroon-dark hover:to-maroon-primary text-white text-xs font-bold transition shadow-xs cursor-pointer flex items-center gap-1">
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

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredShiftReports.length"></strong> berkas laporan shift kasir</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL AUDIT DEEP-DIVE SHIFT KASIR --}}
        <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showModal = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 shadow-2xl relative space-y-6 max-h-[90vh] overflow-y-auto" id="printableShiftAudit">
                <button @click="showModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
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
                        <h3 class="text-lg font-extrabold text-zinc-900" x-text="'Audit Laporan Shift: ' + selectedReport.cashierName"></h3>
                    </div>
                </div>

                <!-- Grid Details -->
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
                        <span class="text-[10px] font-bold text-rose-700 uppercase tracking-wider block">Kas Out Operasional</span>
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

                <!-- Pecahan Uang Fisik -->
                <div class="p-4 bg-zinc-50 rounded-2xl border border-zinc-200 space-y-2">
                    <h4 class="text-xs font-extrabold text-zinc-900 flex items-center gap-2">
                        <i class="fa-solid fa-coins text-amber-600"></i> Audit Pecahan Uang Kertas & Koin Laci
                    </h4>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                        <div class="p-2 bg-white rounded-lg border border-zinc-200 flex justify-between"><span>Rp 100.000:</span><strong class="text-zinc-900">14 Lembar</strong></div>
                        <div class="p-2 bg-white rounded-lg border border-zinc-200 flex justify-between"><span>Rp 50.000:</span><strong class="text-zinc-900">8 Lembar</strong></div>
                        <div class="p-2 bg-white rounded-lg border border-zinc-200 flex justify-between"><span>Rp 20.000:</span><strong class="text-zinc-[900]">4 Lembar</strong></div>
                        <div class="p-2 bg-white rounded-lg border border-zinc-200 flex justify-between"><span>Rp 10.000:</span><strong class="text-zinc-900">2 Lembar</strong></div>
                    </div>
                </div>

                <!-- Admin Action Note -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-zinc-700">Catatan Verifikasi Admin</label>
                    <textarea x-model="adminNote" rows="2" placeholder="Tulis instruksi atau konfirmasi verifikasi setoran..." class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 text-xs font-medium focus:ring-2 focus:ring-maroon-primary focus:outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button @click="window.print()" class="px-4 py-2.5 rounded-xl bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-bold text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-print"></i> Cetak Berita Acara
                    </button>
                    <button @click="approveSelectedReport()" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary hover:from-maroon-dark hover:to-maroon-primary text-white font-extrabold text-xs shadow-md">
                        <i class="fa-solid fa-check mr-1"></i> Setujui Setoran Kasir
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function laporanShiftAdmin() {
            return {
                sidebarOpen: false,
                periodFilter: 'today',
                cashierFilter: 'all',
                statusFilter: 'all',
                searchQuery: '',
                showModal: false,
                selectedReport: {},
                adminNote: '',

                shiftReports: [
                    {
                        id: 1,
                        cashierName: 'Kasir Sutan',
                        shiftName: 'Shift 1 (Pagi)',
                        shiftTime: '08:00 - 16:00',
                        date: '6 Agustus 2026',
                        submittedAt: '16:05 WIB',
                        initialFloat: 500000,
                        cashSales: 1450000,
                        nonCashSales: 1400000,
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
                        initialFloat: 500000,
                        cashSales: 2600000,
                        nonCashSales: 1950000,
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
                        initialFloat: 500000,
                        cashSales: 1200000,
                        nonCashSales: 950000,
                        pettyCashOut: 20000,
                        expectedCash: 1680000,
                        actualCash: 1680000,
                        difference: 0,
                        status: 'Approved'
                    }
                ],

                get filteredShiftReports() {
                    return this.shiftReports.filter(r => {
                        const matchCashier = this.cashierFilter === 'all' || r.cashierName === this.cashierFilter;
                        const matchStatus = this.statusFilter === 'all' || r.status === this.statusFilter;
                        const matchQuery = r.cashierName.toLowerCase().includes(this.searchQuery.toLowerCase()) || r.shiftName.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCashier && matchStatus && matchQuery;
                    });
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                getInitials(name) {
                    return name.split(' ').map(n => n[0]).join('').toUpperCase();
                },

                openAuditModal(report) {
                    this.selectedReport = report;
                    this.adminNote = '';
                    this.showModal = true;
                },

                approveReport(report) {
                    report.status = 'Approved';
                    alert(`Setoran shift dari ${report.cashierName} berhasil disetujui!`);
                },

                approveSelectedReport() {
                    if (this.selectedReport) {
                        this.selectedReport.status = 'Approved';
                        this.showModal = false;
                        alert('Setoran shift kasir berhasil disetujui!');
                    }
                },

                printSummaryReport() {
                    window.print();
                },

                exportExcel() {
                    alert('Mengunduh Berkas Laporan Shift Kasir (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
