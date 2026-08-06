<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan QRIS & EDC - Panel Admin | Lapau Uda Sutan</title>

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
    </style>
</head>

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminAuditQrisSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="audit-qris" />

    <!-- Top Navbar Component -->
    <x-admin.navbar />

    <!-- Main Content Area -->
    <main class="pt-20 pb-16 md:pl-64 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- 1. HEADER BANNER --}}
            <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary rounded-3xl p-6 md:p-8 border border-maroon-light/30 shadow-xl relative overflow-hidden text-white flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Background Accent Glows -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="space-y-2 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-dark/80 border border-amber-400/30 text-amber-300 text-xs font-bold shadow-inner">
                        <i class="fa-solid fa-qrcode"></i>
                        <span>Audit Rekonsiliasi Non-Tunai QRIS & EDC Card Terminal</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Laporan QRIS & EDC Terminal Bank
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Rekonsiliasi settlement harian transaksi non-tunai, audit potongan fee MDR (0.7%), pencocokan RRN bank, dan nominal bersih masuk rekening.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="triggerSettlement()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-bolt text-base"></i>
                        <span>Trigger Settlement Bank</span>
                    </button>
                    <button @click="exportQrisExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Excel (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Gross Non-Tunai --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Non-Tunai Gross</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">Rp 3.350.000</div>
                        <span class="text-[11px] text-sky-600 font-bold bg-sky-50 px-2 py-0.5 rounded">41 Transaksi Masuk</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>

                {{-- QRIS BCA & Mandiri --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Volume QRIS All-Payment</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">Rp 2.150.000</div>
                        <span class="text-[11px] text-emerald-600 font-bold">64.2% Porsi Non-Tunai</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                </div>

                {{-- Mesin EDC Card --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Mesin EDC Kartu Debit/Kredit</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">Rp 1.200.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">8 Gesek Kartu</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                </div>

                {{-- Net Income Bersih --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Net Bersih Rekening</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-700">Rp 3.326.550</div>
                        <span class="text-[11px] text-rose-600 font-bold">MDR Fee: Rp 23.450</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                </div>

            </div>

            {{-- 3. BREAKDOWN PROVIDER MERCHANT BANK (FITUR AUDIT) --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-chart-pie text-maroon-primary"></i>
                            Rincian Provider Merchant & Fee MDR Bank
                        </h3>
                        <p class="text-xs text-zinc-500">Audit potongan komisi Merchant Discount Rate (MDR 0.7%) per kanal pembayaran</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">Settlement Ready</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    
                    <!-- QRIS BCA -->
                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-qrcode text-sky-600"></i> QRIS BCA (Static & Dynamic)
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-sky-100 text-sky-800">NMID: ID1022039201</span>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-zinc-500">Total Nominal Gross:</span>
                            <strong class="text-zinc-900 font-extrabold">Rp 1.450.000</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-rose-600 font-bold">Fee MDR (0.7%):</span>
                            <strong class="text-rose-600 font-bold">- Rp 10.150</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-emerald-700 font-extrabold">Net Bersih:</span>
                            <strong class="text-emerald-700 font-extrabold text-sm">Rp 1.439.850</strong>
                        </div>
                    </div>

                    <!-- QRIS Mandiri -->
                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-qrcode text-amber-600"></i> QRIS Mandiri Livin
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-100 text-amber-800">NMID: ID1022039202</span>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-zinc-500">Total Nominal Gross:</span>
                            <strong class="text-zinc-900 font-extrabold">Rp 700.000</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-rose-600 font-bold">Fee MDR (0.7%):</span>
                            <strong class="text-rose-600 font-bold">- Rp 4.900</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-emerald-700 font-extrabold">Net Bersih:</span>
                            <strong class="text-emerald-700 font-extrabold text-sm">Rp 695.100</strong>
                        </div>
                    </div>

                    <!-- EDC Mandiri / BCA -->
                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-credit-card text-maroon-primary"></i> EDC Mesin Kartu Debit
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-rose-100 text-rose-800">TID: 8820192</span>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-zinc-500">Total Nominal Gross:</span>
                            <strong class="text-zinc-900 font-extrabold">Rp 1.200.000</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-rose-600 font-bold">Fee MDR (0.7%):</span>
                            <strong class="text-rose-600 font-bold">- Rp 8.400</strong>
                        </div>
                        <div class="flex items-center justify-between pt-1 border-t border-zinc-200/60">
                            <span class="text-emerald-700 font-extrabold">Net Bersih:</span>
                            <strong class="text-emerald-700 font-extrabold text-sm">Rp 1.191.600</strong>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 4. TABEL LOG TRANSAKSI NON-TUNAI --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Controls Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Log Transaksi Non-Tunai & No Referensi Bank (RRN)
                            </h2>
                            <p class="text-xs text-zinc-500">Daftar transaksi QRIS & EDC yang berhasil terverifikasi otomatis</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Kanal Pembayaran</label>
                            <select x-model="providerFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Metode</option>
                                <option value="QRIS BCA">QRIS BCA</option>
                                <option value="QRIS Mandiri">QRIS Mandiri</option>
                                <option value="EDC Debit">EDC Debit Card</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Settlement</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status</option>
                                <option value="Settled">Sudah Settlement</option>
                                <option value="Batch Open">Batch Open (Pending)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari RRN / No Invoice..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
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
                                <th class="py-3.5 px-4">No Invoice</th>
                                <th class="py-3.5 px-4">No Referensi Bank (RRN)</th>
                                <th class="py-3.5 px-4">Waktu Transaksi</th>
                                <th class="py-3.5 px-4">Metode & Merchant</th>
                                <th class="py-3.5 px-4 text-right">Nominal Gross</th>
                                <th class="py-3.5 px-4 text-right">Fee MDR (0.7%)</th>
                                <th class="py-3.5 px-4 text-right">Net Masuk</th>
                                <th class="py-3.5 px-4 text-center">Status Settlement</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredQrisList" :key="item.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- No Invoice -->
                                    <td class="py-3.5 px-4 font-mono font-extrabold text-zinc-900 text-[11px]" x-text="item.invoiceNo"></td>

                                    <!-- RRN -->
                                    <td class="py-3.5 px-4 font-mono font-bold text-sky-800" x-text="item.rrn"></td>

                                    <!-- Waktu -->
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-800 font-semibold" x-text="item.date"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="item.time"></div>
                                    </td>

                                    <!-- Metode -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-zinc-900" x-text="item.provider"></div>
                                        <div class="text-[10px] text-zinc-400 font-semibold" x-text="'Kasir: ' + item.cashierName"></div>
                                    </td>

                                    <!-- Gross -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-sky-700" x-text="formatRupiah(item.gross)"></td>

                                    <!-- MDR -->
                                    <td class="py-3.5 px-4 text-right font-bold text-rose-600" x-text="'- ' + formatRupiah(item.mdr)"></td>

                                    <!-- Net -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-emerald-700 bg-zinc-50/60" x-text="formatRupiah(item.net)"></td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="item.status === 'Settled' ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300'"
                                              x-text="item.status"></span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <button @click="openQrisDetail(item)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition">
                                            <i class="fa-solid fa-eye text-zinc-500 mr-1"></i> Detail RRN
                                        </button>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredQrisList.length"></strong> log transaksi non-tunai</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL DETAIL AUDIT RRN & SETTLEMENT --}}
        <div x-cloak x-show="showDetailModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showDetailModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showDetailModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-3 border-b border-zinc-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-extrabold text-base">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900" x-text="'Audit RRN: ' + selectedQris.rrn"></h3>
                        <p class="text-xs text-zinc-500" x-text="selectedQris.provider + ' • ' + selectedQris.invoiceNo"></p>
                    </div>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex justify-between">
                        <span class="text-zinc-500 font-bold">Nominal Pembayaran Gross:</span>
                        <strong class="text-sky-700 text-sm font-extrabold" x-text="formatRupiah(selectedQris.gross)"></strong>
                    </div>

                    <div class="p-3 bg-rose-50 rounded-xl border border-rose-200 flex justify-between">
                        <span class="text-rose-700 font-bold">Biaya MDR Bank (0.7%):</span>
                        <strong class="text-rose-700 font-extrabold" x-text="'- ' + formatRupiah(selectedQris.mdr)"></strong>
                    </div>

                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between">
                        <span class="text-emerald-800 font-bold">Net Masuk Rekening Mandiri:</span>
                        <strong class="text-emerald-800 font-extrabold text-sm" x-text="formatRupiah(selectedQris.net)"></strong>
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <button @click="showDetailModal = false" class="px-5 py-2.5 rounded-xl bg-maroon-primary text-white text-xs font-bold">
                        Tutup Audit
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminAuditQrisSystem() {
            return {
                sidebarOpen: false,
                providerFilter: 'all',
                statusFilter: 'all',
                searchQuery: '',
                showDetailModal: false,
                selectedQris: {},

                qrisList: [
                    {
                        id: 1,
                        invoiceNo: 'INV-20260806-001',
                        rrn: '000192837411',
                        date: '6 Agustus 2026',
                        time: '12:15 WIB',
                        provider: 'QRIS BCA',
                        cashierName: 'Kasir Sutan',
                        gross: 120000,
                        mdr: 840,
                        net: 119160,
                        status: 'Settled'
                    },
                    {
                        id: 2,
                        invoiceNo: 'INV-20260806-003',
                        rrn: '000192837499',
                        date: '6 Agustus 2026',
                        time: '13:40 WIB',
                        provider: 'QRIS Mandiri',
                        cashierName: 'Kasir Sutan',
                        gross: 85000,
                        mdr: 595,
                        net: 84405,
                        status: 'Settled'
                    },
                    {
                        id: 3,
                        invoiceNo: 'INV-20260806-015',
                        rrn: '000192838102',
                        date: '6 Agustus 2026',
                        time: '18:50 WIB',
                        provider: 'EDC Debit',
                        cashierName: 'Kasir Rahma',
                        gross: 350000,
                        mdr: 2450,
                        net: 347550,
                        status: 'Batch Open'
                    }
                ],

                get filteredQrisList() {
                    return this.qrisList.filter(item => {
                        const matchProvider = this.providerFilter === 'all' || item.provider === this.providerFilter;
                        const matchStatus = this.statusFilter === 'all' || item.status === this.statusFilter;
                        const matchQuery = item.rrn.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.invoiceNo.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchProvider && matchStatus && matchQuery;
                    });
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                openQrisDetail(item) {
                    this.selectedQris = item;
                    this.showDetailModal = true;
                },

                triggerSettlement() {
                    alert('Melakukan Batch Settlement Otomatis ke Bank BCA & Mandiri...');
                },

                exportQrisExcel() {
                    alert('Mengunduh Berkas Laporan QRIS & EDC (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
