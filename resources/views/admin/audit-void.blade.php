<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Void & Pembatalan - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminAuditVoidSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="audit-void" />

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
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Audit Keamanan Transaksi & Pencegahan Fraud Kasir</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Audit Void & Pembatalan Nota
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Pengawasan jejak audit pembatalan pesanan, verifikasi PIN otorisasi supervisor, dan investigasi pencegahan manipulasi kasir.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="exportVoidExcel()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        <span>Export Log Void (.xlsx)</span>
                    </button>
                    <button @click="window.print()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-print"></i>
                        <span>Cetak Laporan Void</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Void Hari Ini --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Void (Hari Ini)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-rose-600" x-text="voidList.length + ' Kejadian'">0 Kejadian</div>
                        <span class="text-[11px] text-rose-600 font-bold bg-rose-50 px-2 py-0.5 rounded">Tingkat Void Rendah</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                </div>

                {{-- Nominal Void --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Nilai Nominal Void</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">Rp 47.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Total Item Dihapus</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                {{-- Status PIN Supervisor --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Otorisasi PIN Admin</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">100% Valid</div>
                        <span class="text-[11px] text-emerald-600 font-bold">Disetujui Manager</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-key text-xl"></i>
                    </div>
                </div>

                {{-- Indikator Risiko Fraud --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Indikator Risiko Fraud</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">Aman (Low)</div>
                        <span class="text-[11px] text-zinc-400 font-medium">Tidak Ada Anomali</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                </div>

            </div>

            {{-- 3. DETEKSI ANOMALI VOID (FITUR PENGAWASAN) --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                        Indikator Deteksi Anomali Void Kasir
                    </h3>
                    <span class="text-xs text-zinc-400 font-medium">Sistem Pengawasan Otomatis</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-xs">
                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-zinc-800 block">Void Setelah Struk Terbuka</span>
                            <span class="text-[10px] text-zinc-500">0 Transaksi Terdeteksi</span>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-zinc-800 block">Pembatalan Item Porsi Termahal</span>
                            <span class="text-[10px] text-zinc-500">1 Item (Gulai Tunjang)</span>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-zinc-800 block">Void Tanpa Pelanggan di Kasir</span>
                            <span class="text-[10px] text-zinc-500">0 Transaksi Terdeteksi</span>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    </div>
                </div>
            </div>

            {{-- 4. TABEL LOG AUDIT VOID --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Header Control Bar -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Log Transaksi Void & Pembatalan Item
                            </h2>
                            <p class="text-xs text-zinc-500">Daftar riwayat penghapusan item nota kasir terverifikasi PIN Admin</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Kasir</label>
                            <select x-model="cashierFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kasir</option>
                                <option value="Kasir Sutan">Kasir Sutan</option>
                                <option value="Kasir Rahma">Kasir Rahma</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Alasan Pembatalan</label>
                            <select x-model="reasonFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Alasan</option>
                                <option value="Salah Input Pelanggan">Salah Input Pelanggan</option>
                                <option value="Ganti Menu">Ganti Menu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari no invoice / item..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
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
                                <th class="py-3.5 px-4">Kasir & Shift</th>
                                <th class="py-3.5 px-4">Waktu Void</th>
                                <th class="py-3.5 px-4">Item Masakan Dibatalkan</th>
                                <th class="py-3.5 px-4 text-right">Nilai Void</th>
                                <th class="py-3.5 px-4">Alasan Pembatalan</th>
                                <th class="py-3.5 px-4 text-center">Otorisasi Supervisor</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredVoidList" :key="item.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- No Invoice -->
                                    <td class="py-3.5 px-4 font-mono font-extrabold text-zinc-900 text-[11px]" x-text="item.invoiceNo"></td>

                                    <!-- Kasir & Shift -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900 text-xs" x-text="item.cashierName"></div>
                                        <div class="text-[10px] text-zinc-400 font-semibold" x-text="item.shiftName"></div>
                                    </td>

                                    <!-- Waktu Void -->
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-800 font-semibold" x-text="item.date"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="item.time"></div>
                                    </td>

                                    <!-- Item Dibatalkan -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-maroon-primary" x-text="item.cancelledItem"></div>
                                        <div class="text-[10px] text-zinc-500" x-text="item.qty + ' Porsi'"></div>
                                    </td>

                                    <!-- Nilai Void -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-rose-600" x-text="formatRupiah(item.amount)"></td>

                                    <!-- Alasan -->
                                    <td class="py-3.5 px-4 text-zinc-700 font-semibold" x-text="item.reason"></td>

                                    <!-- Otorisasi Supervisor -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300/60">
                                            <i class="fa-solid fa-check-double mr-1"></i> <span x-text="'PIN: ' + item.approvedBy"></span>
                                        </span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <button @click="openVoidDetail(item)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition">
                                            <i class="fa-solid fa-eye text-zinc-500 mr-1"></i> Audit Struk
                                        </button>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredVoidList.length"></strong> log pembatalan transaksi</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL DETAIL AUDIT STRUK VOID --}}
        <div x-cloak x-show="showDetailModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showDetailModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showDetailModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-3 border-b border-zinc-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center font-extrabold text-base">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900" x-text="'Audit Void: ' + selectedVoid.invoiceNo"></h3>
                        <p class="text-xs text-zinc-500" x-text="selectedVoid.cashierName + ' • ' + selectedVoid.time"></p>
                    </div>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="p-3 bg-rose-50 rounded-xl border border-rose-200 flex justify-between items-center">
                        <div>
                            <span class="text-rose-800 font-bold block">Item Masakan Dihapus:</span>
                            <strong class="text-rose-900 text-sm font-extrabold" x-text="selectedVoid.cancelledItem"></strong>
                        </div>
                        <span class="text-base font-extrabold text-rose-700" x-text="formatRupiah(selectedVoid.amount)"></span>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 space-y-1">
                        <span class="text-zinc-500 font-bold">Alasan Kasir:</span>
                        <p class="text-zinc-900 font-semibold" x-text="selectedVoid.reason"></p>
                    </div>

                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between">
                        <span class="text-emerald-800 font-bold">Otorisasi Supervisor / Manager:</span>
                        <strong class="text-emerald-800 font-extrabold" x-text="selectedVoid.approvedBy"></strong>
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
        function adminAuditVoidSystem() {
            return {
                sidebarOpen: false,
                cashierFilter: 'all',
                reasonFilter: 'all',
                searchQuery: '',
                showDetailModal: false,
                selectedVoid: {},

                voidList: [
                    {
                        id: 1,
                        invoiceNo: 'INV-20260806-004',
                        cashierName: 'Kasir Sutan',
                        shiftName: 'Shift 1 (Pagi)',
                        date: '6 Agustus 2026',
                        time: '14:20 WIB',
                        cancelledItem: 'Ayam Pop Khas Minang',
                        qty: 1,
                        amount: 22000,
                        reason: 'Salah Input Pelanggan',
                        approvedBy: 'Uda Sutan (Admin)'
                    },
                    {
                        id: 2,
                        invoiceNo: 'INV-20260806-012',
                        cashierName: 'Kasir Rahma',
                        shiftName: 'Shift 2 (Sore)',
                        date: '6 Agustus 2026',
                        time: '18:15 WIB',
                        cancelledItem: 'Dendeng Batokok Cabe Ijo',
                        qty: 1,
                        amount: 25000,
                        reason: 'Ganti Menu ke Rendang',
                        approvedBy: 'Uda Sutan (Admin)'
                    }
                ],

                get filteredVoidList() {
                    return this.voidList.filter(item => {
                        const matchCashier = this.cashierFilter === 'all' || item.cashierName === this.cashierFilter;
                        const matchReason = this.reasonFilter === 'all' || item.reason === this.reasonFilter;
                        const matchQuery = item.invoiceNo.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.cancelledItem.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCashier && matchReason && matchQuery;
                    });
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                openVoidDetail(item) {
                    this.selectedVoid = item;
                    this.showDetailModal = true;
                },

                exportVoidExcel() {
                    alert('Mengunduh Berkas Log Audit Void (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
