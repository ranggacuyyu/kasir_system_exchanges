<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Diskon & Promo Paket - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminDiskonPromoSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="diskon-promo" />

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
                        <i class="fa-solid fa-tags"></i>
                        <span>Pemasaran & Program Promosi Paket Nasi Box</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Diskon & Promo Paket Masakan
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Kelola voucher kode promo, diskon persentase, bundling paket hemat nasi box, dan promo otomatis kasir Lapau Uda Sutan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddPromoModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-plus text-base"></i>
                        <span>+ Buat Program Promo Baru</span>
                    </button>
                    <button @click="exportPromoExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Rekap (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Promo Aktif --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Campaign Promo Aktif</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600" x-text="activePromoCount + ' Campaign'">0 Campaign</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Berjalan Lancar</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                </div>

                {{-- Kupon Terpakai --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Kupon Terpakai (Hari Ini)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">38 Klaim</div>
                        <span class="text-[11px] text-maroon-primary font-bold bg-rose-50 px-2 py-0.5 rounded">+18% dari Kemarin</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                </div>

                {{-- Total Hemat Pelanggan --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Potongan Diskon</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700">Rp 480.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Total Insentif Hemat</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>

                {{-- Omset Dari Promo --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Omset Hasil Promo</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">Rp 2.450.000</div>
                        <span class="text-[11px] text-sky-600 font-bold">33.1% Porsi Penjualan</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>

            </div>

            {{-- 3. FILTER TABS & CONTROL BAR --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-3 border-b border-zinc-100">
                    <!-- Tab Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button @click="tabFilter = 'all'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="tabFilter === 'all' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Semua Promo (<span x-text="promoList.length"></span>)
                        </button>
                        <button @click="tabFilter = 'Diskon'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="tabFilter === 'Diskon' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Diskon & Voucher
                        </button>
                        <button @click="tabFilter = 'Paket'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="tabFilter === 'Paket' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Paket Hemat / Bundling
                        </button>
                        <button @click="tabFilter = 'Bonus'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="tabFilter === 'Bonus' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Bonus Free Item
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" x-model="searchQuery" placeholder="Cari nama promo / kode kupon..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                    </div>
                </div>

                {{-- GRID CATALOG CARD PROMO --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-2">
                    <template x-for="promo in filteredPromoList" :key="promo.id">
                        <div class="bg-white rounded-2xl border border-zinc-200/90 shadow-xs hover:shadow-md transition p-5 space-y-4 relative flex flex-col justify-between overflow-hidden group">
                            
                            <!-- Top Accent Line -->
                            <div class="absolute top-0 left-0 right-0 h-1.5"
                                 :class="promo.status === 'Aktif' ? 'bg-emerald-500' : 'bg-zinc-300'"></div>

                            <div class="space-y-3">
                                <!-- Top Status Strip -->
                                <div class="flex items-center justify-between">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                          :class="promo.status === 'Aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-100 text-zinc-600'"
                                          x-text="promo.status === 'Aktif' ? 'Campaign Aktif' : 'Non-Aktif'"></span>

                                    <!-- Voucher Badge -->
                                    <div class="px-3 py-1 rounded-lg bg-amber-50 border border-amber-200 text-amber-900 font-mono font-extrabold text-xs tracking-wider flex items-center gap-1.5 shadow-2xs">
                                        <i class="fa-solid fa-ticket text-amber-600 text-xs"></i>
                                        <span x-text="promo.code"></span>
                                    </div>
                                </div>

                                <!-- Promo Title & Description -->
                                <div>
                                    <h3 class="font-extrabold text-zinc-900 text-sm group-hover:text-maroon-primary transition-colors" x-text="promo.title"></h3>
                                    <p class="text-xs text-zinc-500 mt-1 leading-relaxed" x-text="promo.description"></p>
                                </div>

                                <!-- Discount & Min Order Details -->
                                <div class="grid grid-cols-2 gap-2 p-3 bg-zinc-50 rounded-xl border border-zinc-100 text-xs">
                                    <div>
                                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nilai Promo</span>
                                        <span class="font-extrabold text-maroon-primary text-sm" x-text="promo.discountValue"></span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Min. Pembelian</span>
                                        <span class="font-extrabold text-zinc-800" x-text="formatRupiah(promo.minOrder)"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Info & Controls -->
                            <div class="pt-3 border-t border-zinc-100 space-y-3">
                                <div class="flex items-center justify-between text-[11px] text-zinc-500 font-semibold">
                                    <span><i class="fa-regular fa-clock mr-1 text-zinc-400"></i> <span x-text="promo.validUntil"></span></span>
                                    <span><i class="fa-solid fa-users mr-1 text-zinc-400"></i> <strong x-text="promo.usedCount" class="text-zinc-800"></strong> Terpakai</span>
                                </div>

                                <div class="flex items-center justify-between gap-2">
                                    <!-- Toggle Status Sakelar -->
                                    <button @click="toggleStatus(promo)" 
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5"
                                            :class="promo.status === 'Aktif' ? 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-zinc-100 hover:bg-zinc-200 text-zinc-700'">
                                        <i class="fa-solid" :class="promo.status === 'Aktif' ? 'fa-toggle-on text-emerald-600 text-sm' : 'fa-toggle-off text-zinc-400 text-sm'"></i>
                                        <span x-text="promo.status === 'Aktif' ? 'Aktif' : 'Aktifkan'"></span>
                                    </button>

                                    <div class="flex items-center gap-1">
                                        <button @click="editPromo(promo)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition">
                                            <i class="fa-solid fa-pen-to-square text-zinc-500"></i>
                                        </button>
                                        <button @click="deletePromo(promo)" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition">
                                            <i class="fa-solid fa-trash-can text-rose-500"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>
            </div>

        </div>

        {{-- MODAL BUAT / EDIT PROMO BARU --}}
        <div x-cloak x-show="showPromoModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showPromoModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showPromoModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-3 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900" x-text="isEdit ? 'Edit Program Promo' : 'Buat Program Promo Baru'"></h3>
                    <p class="text-xs text-zinc-500">Atur syarat potongan harga & kode kupon voucher</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Judul Program Promo</label>
                        <input type="text" x-model="formPromo.title" placeholder="Misal: Promo Paket Nasi Box Rombongan" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Kode Kupon Promo</label>
                            <input type="text" x-model="formPromo.code" placeholder="PADANG15" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-mono uppercase font-extrabold text-maroon-primary focus:ring-2 focus:ring-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Tipe Promo</label>
                            <select x-model="formPromo.type" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                                <option value="Diskon">Diskon Persentase / Nominal</option>
                                <option value="Paket">Paket Bundling Hemat</option>
                                <option value="Bonus">Bonus Free Item</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Nilai Promo (Misal: 15% / Rp 10.000)</label>
                            <input type="text" x-model="formPromo.discountValue" placeholder="15% Off" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Min. Pembelian (Rp)</label>
                            <input type="number" x-model.number="formPromo.minOrder" placeholder="100000" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Deskripsi Syarat & Ketentuan</label>
                        <textarea x-model="formPromo.description" rows="2" placeholder="Tuliskan detail ketentuan promo..." class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Masa Berlaku s/d</label>
                            <input type="text" x-model="formPromo.validUntil" placeholder="31 Agustus 2026" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Status Campaign</label>
                            <select x-model="formPromo.status" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex items-center justify-end gap-3">
                    <button @click="showPromoModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="savePromo()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan Promo
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminDiskonPromoSystem() {
            return {
                sidebarOpen: false,
                tabFilter: 'all',
                searchQuery: '',
                showPromoModal: false,
                isEdit: false,
                formPromo: { title: '', code: '', type: 'Diskon', discountValue: '', minOrder: 0, description: '', validUntil: '31 Agustus 2026', status: 'Aktif' },

                promoList: [
                    {
                        id: 1,
                        title: 'Promo Paket Nasi Rendang Family Box',
                        code: 'PADANGFAMILY',
                        type: 'Paket',
                        discountValue: 'Diskon 15%',
                        minOrder: 120000,
                        description: 'Potongan 15% untuk pemesanan minimal 5 porsi Nasi Rendang Special porsi keluarga.',
                        validUntil: '31 Agustus 2026',
                        usedCount: 24,
                        status: 'Aktif'
                    },
                    {
                        id: 2,
                        title: 'Jumat Barokah Free Teh Talua',
                        code: 'JUMATBAROKAH',
                        type: 'Bonus',
                        discountValue: 'Free 1 Teh Talua',
                        minOrder: 50000,
                        description: 'Gratis 1 porsi Teh Talua khas Uda Sutan tiap pembelian Lauk Ayam Pop komplit di hari Jumat.',
                        validUntil: '15 Agustus 2026',
                        usedCount: 14,
                        status: 'Aktif'
                    },
                    {
                        id: 3,
                        title: 'Voucher Pelanggan VIP Uda Sutan',
                        code: 'VIPUDA10K',
                        type: 'Diskon',
                        discountValue: 'Potongan Rp 10.000',
                        minOrder: 100000,
                        description: 'Voucher potongan Rp 10.000 untuk member pelanggan VIP Lapau Uda Sutan.',
                        validUntil: '31 Desember 2026',
                        usedCount: 42,
                        status: 'Aktif'
                    },
                    {
                        id: 4,
                        title: 'Diskon Catering Nasi Box Corporate',
                        code: 'CATERING50',
                        type: 'Diskon',
                        discountValue: 'Diskon 10%',
                        minOrder: 500000,
                        description: 'Potongan 10% untuk pesanan catering Nasi Box instansi minimal 50 porsi.',
                        validUntil: '30 September 2026',
                        usedCount: 8,
                        status: 'Aktif'
                    }
                ],

                get filteredPromoList() {
                    return this.promoList.filter(p => {
                        const matchTab = this.tabFilter === 'all' || p.type === this.tabFilter;
                        const matchQuery = p.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || p.code.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchTab && matchQuery;
                    });
                },

                get activePromoCount() {
                    return this.promoList.filter(p => p.status === 'Aktif').length;
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                toggleStatus(promo) {
                    promo.status = promo.status === 'Aktif' ? 'Non-Aktif' : 'Aktif';
                },

                openAddPromoModal() {
                    this.isEdit = false;
                    this.formPromo = { title: '', code: '', type: 'Diskon', discountValue: '', minOrder: 0, description: '', validUntil: '31 Agustus 2026', status: 'Aktif' };
                    this.showPromoModal = true;
                },

                editPromo(promo) {
                    this.isEdit = true;
                    this.formPromo = { ...promo };
                    this.showPromoModal = true;
                },

                savePromo() {
                    if (this.isEdit) {
                        const idx = this.promoList.findIndex(p => p.id === this.formPromo.id);
                        if (idx !== -1) this.promoList[idx] = { ...this.formPromo };
                    } else {
                        this.formPromo.id = Date.now();
                        this.formPromo.usedCount = 0;
                        this.formPromo.code = this.formPromo.code.toUpperCase();
                        this.promoList.push({ ...this.formPromo });
                    }
                    this.showPromoModal = false;
                    alert('Program Promo berhasil disimpan!');
                },

                deletePromo(promo) {
                    if (confirm(`Apakah Anda yakin ingin menghapus promo '${promo.title}'?`)) {
                        this.promoList = this.promoList.filter(p => p.id !== promo.id);
                    }
                },

                exportPromoExcel() {
                    alert('Mengunduh Berkas Rekap Program Promo (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
