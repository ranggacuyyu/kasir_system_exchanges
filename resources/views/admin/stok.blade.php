<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stok & Menu Masakan - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminStokSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="stok" />

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
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Master Database Stok Lauk & Menu Masakan Padang</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Stok & Katolog Menu Masakan
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Kelola batas stok porsi harian masakan dapur, atur penetapan harga porsi, restock instan, dan tandai status ketersediaan lauk.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddMenuModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-plus text-base"></i>
                        <span>+ Tambah Menu Baru</span>
                    </button>
                    <button @click="exportStokExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Data Stok (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Menu --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Menu Terdaftar</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900" x-text="menuItems.length + ' Menu'">0 Menu</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Semua Kategori Kuliner</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </div>

                {{-- Stok Aman --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Aman (Available)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600" x-text="availableCount + ' Menu'">0 Menu</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Tersedia Cukup</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                {{-- Stok Menipis --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Menipis / Kritis</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700" x-text="warningCount + ' Menu'">0 Menu</div>
                        <span class="text-[11px] text-amber-800 font-bold bg-amber-50 px-2 py-0.5 rounded">&lt; Limit Alert</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                {{-- Out of Stock --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Habis (Sold Out)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-rose-600" x-text="soldOutCount + ' Menu'">0 Menu</div>
                        <span class="text-[11px] text-rose-600 font-bold bg-rose-50 px-2 py-0.5 rounded">Perlu Memasak Lagi</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                </div>

            </div>

            {{-- 3. CONTROL FILTER & TABEL STOK MASAKAN --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Filter Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-maroon-primary"></i>
                                Katalog Master Stok Menu Lapau Uda Sutan
                            </h2>
                            <p class="text-xs text-zinc-500">Kelola rincian stok porsi masakan dan perbaharui ketersediaan harian</p>
                        </div>
                    </div>

                    <!-- Filter Controls Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
                        <!-- Kategori Filter -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Kategori Menu</label>
                            <select x-model="categoryFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kategori</option>
                                <option value="Lauk Utama">Lauk Utama / Daging</option>
                                <option value="Ayam & Bebek">Ayam & Bebek</option>
                                <option value="Gulai & Kuah">Gulai & Kuah</option>
                                <option value="Minuman">Minuman & Dessert</option>
                                <option value="Paket Box">Paket Nasi Box</option>
                            </select>
                        </div>

                        <!-- Status Stok Filter -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Stok Porsi</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status</option>
                                <option value="Aman">Stok Aman</option>
                                <option value="Menipis">Menipis (Restock Needed)</option>
                                <option value="Habis">Habis (Sold Out)</option>
                            </select>
                        </div>

                        <!-- Quick Sort -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Urutkan Berdasarkan</label>
                            <select x-model="sortBy" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="stok_asc">Stok Terendah (Kritis First)</option>
                                <option value="nama_asc">Nama Menu (A - Z)</option>
                                <option value="harga_desc">Harga Tertinggi</option>
                            </select>
                        </div>

                        <!-- Search Input -->
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari nama menu / SKU..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
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
                                <th class="py-3.5 px-4">Menu & Kategori</th>
                                <th class="py-3.5 px-4">Kode SKU</th>
                                <th class="py-3.5 px-4 text-right">Harga Porsi</th>
                                <th class="py-3.5 px-4 text-center">Batas Alert Min.</th>
                                <th class="py-3.5 px-4 text-center">Stok Porsi Saat Ini</th>
                                <th class="py-3.5 px-4 text-center">Status Ketersediaan</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredMenuItems" :key="item.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Menu & Kategori -->
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 text-maroon-dark flex items-center justify-center font-extrabold text-sm shadow-xs shrink-0">
                                                <i class="fa-solid fa-bowl-food"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-zinc-900 text-xs" x-text="item.name"></h4>
                                                <span class="text-[10px] text-zinc-400 font-semibold" x-text="item.category"></span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Kode SKU -->
                                    <td class="py-3.5 px-4 text-zinc-500 font-mono text-[11px]" x-text="item.sku"></td>

                                    <!-- Harga Porsi -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-maroon-primary" x-text="formatRupiah(item.price)"></td>

                                    <!-- Batas Alert -->
                                    <td class="py-3.5 px-4 text-center text-zinc-500 font-semibold" x-text="item.minAlert + ' Porsi'"></td>

                                    <!-- Quick Stock Counter Controls -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="inline-flex items-center justify-center gap-2 bg-zinc-50 border border-zinc-200 rounded-xl px-2.5 py-1">
                                            <button @click="decreaseStock(item)" class="w-6 h-6 rounded-lg bg-white border border-zinc-200 text-zinc-700 hover:bg-zinc-100 font-extrabold flex items-center justify-center text-xs transition cursor-pointer">
                                                -
                                            </button>
                                            <span class="font-extrabold text-zinc-900 text-sm px-1" x-text="item.stock"></span>
                                            <button @click="increaseStock(item)" class="w-6 h-6 rounded-lg bg-maroon-primary text-white font-extrabold flex items-center justify-center text-xs hover:bg-maroon-dark transition cursor-pointer shadow-xs">
                                                +
                                            </button>
                                        </div>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="{
                                                  'bg-emerald-100 text-emerald-800 border border-emerald-300/60': getStatus(item) === 'Aman',
                                                  'bg-amber-100 text-amber-800 border border-amber-300/60': getStatus(item) === 'Menipis',
                                                  'bg-rose-100 text-rose-800 border border-rose-300/60': getStatus(item) === 'Habis'
                                              }">
                                            <i class="fa-solid mr-1" 
                                               :class="{
                                                   'fa-circle-check': getStatus(item) === 'Aman',
                                                   'fa-triangle-exclamation': getStatus(item) === 'Menipis',
                                                   'fa-ban': getStatus(item) === 'Habis'
                                               }"></i>
                                            <span x-text="getStatus(item) === 'Aman' ? 'Tersedia' : (getStatus(item) === 'Menipis' ? 'Restock Needed' : 'Sold Out')"></span>
                                        </span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="editMenu(item)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition cursor-pointer flex items-center gap-1">
                                                <i class="fa-solid fa-pen-to-square text-zinc-500"></i>
                                                <span>Edit</span>
                                            </button>
                                            <button @click="restockItem(item)" class="px-2.5 py-1.5 rounded-lg bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white text-xs font-bold transition cursor-pointer flex items-center gap-1">
                                                <i class="fa-solid fa-rotate text-amber-300"></i>
                                                <span>Restock</span>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredMenuItems.length"></strong> varian menu masakan Padang</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL TAMBAH / EDIT MENU MASAKAN --}}
        <div x-cloak x-show="showMenuModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showMenuModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showMenuModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-3 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900" x-text="isEdit ? 'Edit Detail Menu Masakan' : 'Tambah Menu Masakan Baru'"></h3>
                    <p class="text-xs text-zinc-500">Atur harga jual per porsi & batas stok alert minimum</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Nama Menu Masakan</label>
                        <input type="text" x-model="formMenu.name" placeholder="Misal: Rendang Daging Sapi Special" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Kategori</label>
                            <select x-model="formMenu.category" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                                <option value="Lauk Utama">Lauk Utama</option>
                                <option value="Ayam & Bebek">Ayam & Bebek</option>
                                <option value="Gulai & Kuah">Gulai & Kuah</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Paket Box">Paket Box</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Kode SKU</label>
                            <input type="text" x-model="formMenu.sku" placeholder="MN-001" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-mono focus:ring-2 focus:ring-maroon-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Harga Porsi (Rp)</label>
                            <input type="number" x-model.number="formMenu.price" placeholder="24000" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-extrabold text-maroon-primary focus:ring-2 focus:ring-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Stok Porsi Awal</label>
                            <input type="number" x-model.number="formMenu.stock" placeholder="40" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex items-center justify-end gap-3">
                    <button @click="showMenuModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="saveMenu()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan Menu
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminStokSystem() {
            return {
                sidebarOpen: false,
                categoryFilter: 'all',
                statusFilter: 'all',
                sortBy: 'stok_asc',
                searchQuery: '',
                showMenuModal: false,
                isEdit: false,
                formMenu: { name: '', category: 'Lauk Utama', sku: '', price: 0, stock: 0, minAlert: 5 },

                menuItems: [
                    { id: 1, name: 'Rendang Daging Sapi Special', category: 'Lauk Utama', sku: 'LUK-001', price: 24000, stock: 35, minAlert: 10 },
                    { id: 2, name: 'Ayam Pop Khas Minang', category: 'Ayam & Bebek', sku: 'AYM-002', price: 22000, stock: 4, minAlert: 8 },
                    { id: 3, name: 'Gulai Tunjang / Kikil', category: 'Gulai & Kuah', sku: 'GLI-003', price: 26000, stock: 3, minAlert: 5 },
                    { id: 4, name: 'Dendeng Batokok Cabe Ijo', category: 'Lauk Utama', sku: 'LUK-004', price: 25000, stock: 0, minAlert: 5 },
                    { id: 5, name: 'Cincang Sapi Karang', category: 'Gulai & Kuah', sku: 'GLI-005', price: 23000, stock: 18, minAlert: 5 },
                    { id: 6, name: 'Ayam Goreng Lengkuas', category: 'Ayam & Bebek', sku: 'AYM-006', price: 20000, stock: 25, minAlert: 8 },
                    { id: 7, name: 'Teh Talua Uda Sutan', category: 'Minuman', sku: 'MNM-007', price: 12000, stock: 50, minAlert: 10 },
                    { id: 8, name: 'Nasi Box Rendang Komplit', category: 'Paket Box', sku: 'PKT-008', price: 32000, stock: 40, minAlert: 10 }
                ],

                get filteredMenuItems() {
                    let list = this.menuItems.filter(item => {
                        const matchCat = this.categoryFilter === 'all' || item.category === this.categoryFilter;
                        const matchStatus = this.statusFilter === 'all' || this.getStatus(item) === this.statusFilter;
                        const matchQuery = item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.sku.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCat && matchStatus && matchQuery;
                    });

                    if (this.sortBy === 'stok_asc') {
                        list.sort((a, b) => a.stock - b.stock);
                    } else if (this.sortBy === 'nama_asc') {
                        list.sort((a, b) => a.name.localeCompare(b.name));
                    } else if (this.sortBy === 'harga_desc') {
                        list.sort((a, b) => b.price - a.price);
                    }

                    return list;
                },

                get availableCount() {
                    return this.menuItems.filter(i => this.getStatus(i) === 'Aman').length;
                },

                get warningCount() {
                    return this.menuItems.filter(i => this.getStatus(i) === 'Menipis').length;
                },

                get soldOutCount() {
                    return this.menuItems.filter(i => this.getStatus(i) === 'Habis').length;
                },

                getStatus(item) {
                    if (item.stock === 0) return 'Habis';
                    if (item.stock <= item.minAlert) return 'Menipis';
                    return 'Aman';
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                increaseStock(item) {
                    item.stock++;
                },

                decreaseStock(item) {
                    if (item.stock > 0) item.stock--;
                },

                restockItem(item) {
                    item.stock += 20;
                    alert(`Stok ${item.name} berhasil ditambah +20 Porsi!`);
                },

                openAddMenuModal() {
                    this.isEdit = false;
                    this.formMenu = { name: '', category: 'Lauk Utama', sku: 'MN-00' + (this.menuItems.length + 1), price: 20000, stock: 30, minAlert: 5 };
                    this.showMenuModal = true;
                },

                editMenu(item) {
                    this.isEdit = true;
                    this.formMenu = { ...item };
                    this.showMenuModal = true;
                },

                saveMenu() {
                    if (this.isEdit) {
                        const idx = this.menuItems.findIndex(i => i.id === this.formMenu.id);
                        if (idx !== -1) this.menuItems[idx] = { ...this.formMenu };
                    } else {
                        this.formMenu.id = Date.now();
                        this.menuItems.push({ ...this.formMenu });
                    }
                    this.showMenuModal = false;
                    alert('Menu berhasil disimpan!');
                },

                exportStokExcel() {
                    alert('Mengunduh Berkas Master Stok Menu Masakan (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
