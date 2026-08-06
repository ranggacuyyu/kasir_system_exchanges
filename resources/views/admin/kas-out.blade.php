<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Persetujuan Kas Out - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminKasOutSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="kas-out" />

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
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <span>Audit Verifikasi & Approval Petty Cash Operasional Warung</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Persetujuan Kas Out (Petty Cash)
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Verifikasi pengeluaran uang tunai dari laci kasir untuk kebutuhan operasional darurat (es batu, bumbu dapur, kertas struk thermal, & parkir supplier).
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddKasOutModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-plus text-base"></i>
                        <span>+ Input Kas Out Operasional</span>
                    </button>
                    <button @click="exportKasOutExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Laporan (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Kas Out Disetujui --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Kas Out Disetujui (Hari Ini)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-rose-600">Rp 85.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">2 Pengeluaran Terverifikasi</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                {{-- Menunggu Approval --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Menunggu Approval Admin</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700" x-text="pendingCount + ' Pengajuan'">0 Pengajuan</div>
                        <span class="text-[11px] text-amber-800 font-bold bg-amber-50 px-2 py-0.5 rounded">Perlu Review Segera</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>

                {{-- Limit Petty Cash Laci --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Sisa Limit Petty Cash</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">Rp 415.000</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Dari Limit Rp 500.000</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>

                {{-- Kategori Terbesar --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Kategori Terbesar</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900">Bahan Operasional</div>
                        <span class="text-[11px] text-zinc-400 font-medium">58.8% Porsi Kas Out</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                </div>

            </div>

            {{-- 3. TABEL PENGAJUAN KAS OUT KASIR --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Controls Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Daftar Pengajuan Kas Out Operasional
                            </h2>
                            <p class="text-xs text-zinc-500">Verifikasi nota pembelian kasir sebelum pemotongan saldo laci akhir shift</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Kasir Pemohon</label>
                            <select x-model="cashierFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kasir</option>
                                <option value="Kasir Sutan">Kasir Sutan</option>
                                <option value="Kasir Rahma">Kasir Rahma</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Verifikasi</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status</option>
                                <option value="Menunggu">Menunggu Approval</option>
                                <option value="Disetujui">Disetujui Admin</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari keterangan pengeluaran..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[850px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Kasir Pemohon</th>
                                <th class="py-3.5 px-4">Keperluan & Keterangan</th>
                                <th class="py-3.5 px-4">Waktu Pengajuan</th>
                                <th class="py-3.5 px-4 text-right">Nominal Uang Out</th>
                                <th class="py-3.5 px-4 text-center">Status Approval</th>
                                <th class="py-3.5 px-4 text-center">Tindakan Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredKasOutList" :key="item.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Kasir -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900 text-xs" x-text="item.cashier"></div>
                                        <div class="text-[10px] text-zinc-400 font-semibold" x-text="item.shift"></div>
                                    </td>

                                    <!-- Keperluan -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-zinc-900" x-text="item.note"></div>
                                        <div class="text-[10px] text-maroon-primary font-semibold" x-text="'Kategori: ' + item.category"></div>
                                    </td>

                                    <!-- Waktu -->
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-800 font-semibold" x-text="item.date"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="item.time"></div>
                                    </td>

                                    <!-- Nominal -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-rose-600 text-sm" x-text="formatRupiah(item.amount)"></td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="{
                                                  'bg-amber-100 text-amber-800 border border-amber-300': item.status === 'Menunggu',
                                                  'bg-emerald-100 text-emerald-800 border border-emerald-300': item.status === 'Disetujui',
                                                  'bg-rose-100 text-rose-800 border border-rose-300': item.status === 'Ditolak'
                                              }">
                                            <i class="fa-solid mr-1" :class="item.status === 'Menunggu' ? 'fa-clock' : (item.status === 'Disetujui' ? 'fa-circle-check' : 'fa-xmark')"></i>
                                            <span x-text="item.status"></span>
                                        </span>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="py-3.5 px-4 text-center">
                                        <template x-if="item.status === 'Menunggu'">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <button @click="approveKasOut(item)" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs shadow-xs transition flex items-center gap-1">
                                                    <i class="fa-solid fa-check"></i> Setujui
                                                </button>
                                                <button @click="rejectKasOut(item)" class="px-3 py-1.5 rounded-lg bg-zinc-200 hover:bg-zinc-300 text-zinc-700 font-bold text-xs transition">
                                                    Tolak
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="item.status !== 'Menunggu'">
                                            <span class="text-[11px] text-zinc-400 font-semibold" x-text="'Verified by ' + (item.approvedBy || 'Admin')"></span>
                                        </template>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredKasOutList.length"></strong> berkas pengajuan kas out</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL INPUT KAS OUT MANDIRI ADMIN --}}
        <div x-cloak x-show="showAddModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showAddModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showAddModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900">Input Pengeluaran Kas Out Baru</h3>
                    <p class="text-xs text-zinc-500">Catat pengeluaran tunai operasional laci kasir</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Keperluan Pengeluaran</label>
                        <input type="text" x-model="formKasOut.note" placeholder="Misal: Beli Kertas Struk Thermal Kasir" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Nominal (Rp)</label>
                            <input type="number" x-model.number="formKasOut.amount" placeholder="35000" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-extrabold text-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Kategori</label>
                            <select x-model="formKasOut.category" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold">
                                <option value="Perlengkapan Kasir">Perlengkapan Kasir</option>
                                <option value="Bahan Operasional Dapur">Bahan Operasional Dapur</option>
                                <option value="Parkir & Logistik">Parkir & Logistik Supplier</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex justify-end gap-3">
                    <button @click="showAddModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="saveKasOut()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan & Approve Kas Out
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminKasOutSystem() {
            return {
                sidebarOpen: false,
                cashierFilter: 'all',
                statusFilter: 'all',
                searchQuery: '',
                showAddModal: false,
                formKasOut: { note: '', amount: 0, category: 'Perlengkapan Kasir' },

                kasOutList: [
                    {
                        id: 1,
                        cashier: 'Kasir Rahma',
                        shift: 'Shift 2 (Sore)',
                        note: 'Beli Kertas Struk Thermal Kasir 10 Roll',
                        category: 'Perlengkapan Kasir',
                        amount: 35000,
                        date: '6 Agustus 2026',
                        time: '17:40 WIB',
                        status: 'Menunggu',
                        approvedBy: null
                    },
                    {
                        id: 2,
                        cashier: 'Kasir Sutan',
                        shift: 'Shift 1 (Pagi)',
                        note: 'Parkir Pick Up Supplier Sayur & Daging',
                        category: 'Parkir & Logistik',
                        amount: 25000,
                        date: '6 Agustus 2026',
                        time: '14:15 WIB',
                        status: 'Disetujui',
                        approvedBy: 'Uda Sutan (Admin)'
                    },
                    {
                        id: 3,
                        cashier: 'Kasir Sutan',
                        shift: 'Shift 1 (Pagi)',
                        note: 'Beli Es Batu Kristal 5 Plastik',
                        category: 'Bahan Operasional Dapur',
                        amount: 25000,
                        date: '6 Agustus 2026',
                        time: '10:30 WIB',
                        status: 'Disetujui',
                        approvedBy: 'Uda Sutan (Admin)'
                    }
                ],

                get filteredKasOutList() {
                    return this.kasOutList.filter(item => {
                        const matchCashier = this.cashierFilter === 'all' || item.cashier === this.cashierFilter;
                        const matchStatus = this.statusFilter === 'all' || item.status === this.statusFilter;
                        const matchQuery = item.note.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCashier && matchStatus && matchQuery;
                    });
                },

                get pendingCount() {
                    return this.kasOutList.filter(i => i.status === 'Menunggu').length;
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                approveKasOut(item) {
                    item.status = 'Disetujui';
                    item.approvedBy = 'Uda Sutan (Admin)';
                    alert(`Pengajuan Kas Out '${item.note}' sebesar ${this.formatRupiah(item.amount)} disetujui!`);
                },

                rejectKasOut(item) {
                    item.status = 'Ditolak';
                    item.approvedBy = 'Uda Sutan (Admin)';
                },

                openAddKasOutModal() {
                    this.formKasOut = { note: '', amount: 0, category: 'Perlengkapan Kasir' };
                    this.showAddModal = true;
                },

                saveKasOut() {
                    this.kasOutList.unshift({
                        id: Date.now(),
                        cashier: 'Uda Sutan (Admin)',
                        shift: 'Shift Full',
                        note: this.formKasOut.note,
                        category: this.formKasOut.category,
                        amount: this.formKasOut.amount,
                        date: '6 Agustus 2026',
                        time: '21:10 WIB',
                        status: 'Disetujui',
                        approvedBy: 'Uda Sutan (Admin)'
                    });
                    this.showAddModal = false;
                    alert('Kas Out berhasil ditambahkan!');
                },

                exportKasOutExcel() {
                    alert('Mengunduh Laporan Kas Out Petty Cash (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
