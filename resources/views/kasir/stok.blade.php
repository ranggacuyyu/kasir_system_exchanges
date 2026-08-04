<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola & Update Stok - Kasir Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Bootstrap Icons & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-800 antialiased" x-data="stokSystem()">

    {{-- Navbar --}}
    <x-kasir.navbar active="stok" />

    <!-- Content Wrapper -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-8 px-4 md:px-6 lg:px-8">

        <div class="w-full max-w-7xl mx-auto pt-4 md:pt-6 space-y-6">

            {{-- ==================== 1. HEADER & ACTION BAR ==================== --}}
            <div class="bg-white rounded-2xl p-5 md:p-6 border border-zinc-200 shadow-sm relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4">
                {{-- Top Accent Bar --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-maroon-primary via-red-500 to-amber-500"></div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-xl shrink-0">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Akses Kasir: Kelola & Update Stok
                            </span>
                            <span class="text-xs text-zinc-400 font-medium">• Lapau Uda Sutan</span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-extrabold text-zinc-900 tracking-tight">Kelola Persediaan & Update Stok</h1>
                        <p class="text-xs md:text-sm text-zinc-500">Kurangi atau tambahkan jumlah stok porsi/bahan yang ada dan laporkan bumbu yang habis</p>
                    </div>
                </div>

                {{-- Action Controls (Tombol Lapor & Cetak) --}}
                <div class="flex flex-wrap items-center gap-2.5">
                    <button @click="openReportModal()" 
                        class="inline-flex items-center justify-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs md:text-sm px-4 py-2.5 rounded-xl transition duration-200 cursor-pointer">
                        <i class="fa-solid fa-bullhorn text-rose-600"></i>
                        <span>+ Lapor Bahan/Bumbu Habis</span>
                    </button>

                    <button @click="alert('Mencetak Laporan Stok...')" 
                        class="inline-flex items-center justify-center gap-2 bg-white hover:bg-zinc-50 text-zinc-700 font-bold text-xs md:text-sm px-3.5 py-2.5 rounded-xl border border-zinc-200 shadow-sm transition">
                        <i class="fa-solid fa-print text-zinc-400"></i>
                        <span>Cetak Stok</span>
                    </button>
                </div>
            </div>

            {{-- ==================== 2. EXECUTIVE SUMMARY CARDS ==================== --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                
                {{-- Card 1: Total Item --}}
                <div class="bg-white p-4 sm:p-5 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-maroon-primary">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Menu/Item</span>
                        <span class="text-lg sm:text-2xl font-extrabold text-zinc-900" x-text="items.length + ' Item'">0 Item</span>
                        <span class="hidden sm:block text-[11px] text-zinc-400 mt-0.5">Item terdaftar</span>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                </div>

                {{-- Card 2: Stok Aman --}}
                <div class="bg-white p-4 sm:p-5 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-emerald-500">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Aman</span>
                        <span class="text-lg sm:text-2xl font-extrabold text-emerald-600" x-text="safeCount + ' Item'">0 Item</span>
                        <span class="hidden sm:block text-[11px] text-zinc-400 mt-0.5">Ketersediaan mencukupi</span>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                {{-- Card 3: Stok Menipis --}}
                <div class="bg-white p-4 sm:p-5 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-amber-500">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Menipis</span>
                        <span class="text-lg sm:text-2xl font-extrabold text-amber-600" x-text="warningCount + ' Item'">0 Item</span>
                        <span class="hidden sm:block text-[11px] text-amber-600 font-bold mt-0.5">Mendekati batas min.</span>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                {{-- Card 4: Stok Habis --}}
                <div class="bg-white p-4 sm:p-5 rounded-xl sm:rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between border-l-4 border-l-rose-500">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold text-zinc-400 uppercase tracking-wider block">Stok Habis</span>
                        <span class="text-lg sm:text-2xl font-extrabold text-rose-600" x-text="criticalCount + ' Item'">0 Item</span>
                        <span class="hidden sm:block text-[11px] text-rose-600 font-bold mt-0.5">Porsi kosong (0)</span>
                    </div>
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-sm sm:text-lg shrink-0">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>

            </div>

            {{-- ==================== 3. TABLE MANAGEMENT STOK & QUICK ADJUSTMENT ==================== --}}
            <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                {{-- Header Controls & Filter Tabs --}}
                <div class="p-5 border-b border-zinc-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    {{-- Status Filter Tabs --}}
                    <div class="flex items-center p-1 bg-zinc-100 rounded-xl border border-zinc-200/80 overflow-x-auto w-full lg:w-auto">
                        <template x-for="tab in ['semua', 'menu', 'bahan', 'warning']" :key="tab">
                            <button @click="activeTab = tab"
                                :class="activeTab === tab ? 'bg-maroon-primary text-white shadow-sm font-bold' : 'text-zinc-600 hover:text-zinc-900 font-semibold'"
                                class="px-3.5 py-1.5 rounded-lg text-xs transition cursor-pointer shrink-0 uppercase tracking-wider"
                                x-text="tab === 'semua' ? 'Semua Item' : (tab === 'menu' ? 'Menu Siap Saji' : (tab === 'bahan' ? 'Bahan Baku' : 'Stok Menipis/Habis'))">
                            </button>
                        </template>
                    </div>

                    {{-- Search & Category Filter --}}
                    <div class="flex items-center gap-2.5">
                        {{-- Search Input --}}
                        <div class="relative flex-1 sm:flex-none">
                            <input type="text" x-model="searchQuery" placeholder="Cari nama item..." 
                                class="w-full sm:w-48 bg-zinc-100 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 text-zinc-800 focus:outline-none focus:ring-2 focus:ring-maroon-primary">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                        </div>

                        {{-- Kategori Filter --}}
                        <select x-model="categoryFilter" 
                            class="bg-zinc-100 border border-zinc-200 text-xs font-semibold rounded-xl px-3 py-2 text-zinc-700 focus:outline-none focus:ring-2 focus:ring-maroon-primary cursor-pointer">
                            <option value="all">Semua Kategori</option>
                            <option value="Makanan">Makanan Utama</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Dapur">Bahan Dapur</option>
                        </select>
                    </div>
                </div>

                {{-- Table Content --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[680px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Nama Item / Bahan</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4">Satuan</th>
                                <th class="py-3.5 px-4 text-center">Batas Min.</th>
                                <th class="py-3.5 px-4 text-center">Stok Terkini</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4 text-center">Update Stok (- / +)</th>
                                <th class="py-3.5 px-4 text-center">Aksi Edit Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredItems" :key="item.id">
                                <tr class="hover:bg-zinc-50/80 transition duration-150">
                                    {{-- Item Name --}}
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-sm shrink-0">
                                                <i :class="item.type === 'menu' ? (item.category === 'Minuman' ? 'fa-solid fa-glass-water' : 'fa-solid fa-utensils') : 'fa-solid fa-wheat-awn'"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-zinc-900" x-text="item.name"></h4>
                                                <span class="text-[10px] text-zinc-400" x-text="'Kode: ' + item.code"></span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Category --}}
                                    <td class="py-3.5 px-4">
                                        <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-zinc-100 text-zinc-700" x-text="item.category"></span>
                                    </td>

                                    {{-- Satuan --}}
                                    <td class="py-3.5 px-4 font-semibold text-zinc-600" x-text="item.unit"></td>

                                    {{-- Min Level --}}
                                    <td class="py-3.5 px-4 text-center font-bold text-zinc-500" x-text="item.minStock + ' ' + item.unit"></td>

                                    {{-- Current Stock --}}
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="text-sm font-black" 
                                            :class="item.stock === 0 ? 'text-rose-600' : (item.stock <= item.minStock ? 'text-amber-600' : 'text-zinc-900')"
                                            x-text="item.stock + ' ' + item.unit"></span>
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="py-3.5 px-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1 w-fit"
                                            :class="{
                                                'bg-emerald-100 text-emerald-800': item.stock > item.minStock,
                                                'bg-amber-100 text-amber-800': item.stock > 0 && item.stock <= item.minStock,
                                                'bg-rose-100 text-rose-800': item.stock === 0
                                            }">
                                            <i :class="{
                                                'fa-solid fa-circle-check text-emerald-600': item.stock > item.minStock,
                                                'fa-solid fa-triangle-exclamation text-amber-600': item.stock > 0 && item.stock <= item.minStock,
                                                'fa-solid fa-circle-xmark text-rose-600': item.stock === 0
                                            }"></i>
                                            <span x-text="item.stock > item.minStock ? 'Stok Aman' : (item.stock > 0 ? 'Stok Menipis' : 'Stok Habis')"></span>
                                        </span>
                                    </td>

                                    {{-- Tombol Kurangi / Tambah Stok Langsung --}}
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="inline-flex items-center gap-1 bg-zinc-100 p-1 rounded-xl border border-zinc-200">
                                            <button @click="adjustStock(item, -1)" class="w-7 h-7 rounded-lg bg-white hover:bg-rose-50 hover:text-rose-600 font-black text-xs text-zinc-700 flex items-center justify-center transition shadow-xs cursor-pointer" title="Kurangi Stok 1">-</button>
                                            <span class="w-9 text-center font-extrabold text-xs text-zinc-900" x-text="item.stock"></span>
                                            <button @click="adjustStock(item, 1)" class="w-7 h-7 rounded-lg bg-white hover:bg-emerald-50 hover:text-emerald-600 font-black text-xs text-zinc-700 flex items-center justify-center transition shadow-xs cursor-pointer" title="Tambah Stok 1">+</button>
                                        </div>
                                    </td>

                                    {{-- Actions Edit Nominal Stok --}}
                                    <td class="py-3.5 px-4 text-center">
                                        <button @click="openUpdateStockModal(item)" 
                                            class="px-3 py-1.5 rounded-lg bg-zinc-100 hover:bg-maroon-primary hover:text-white text-zinc-700 text-xs font-bold transition cursor-pointer flex items-center gap-1.5 mx-auto">
                                            <i class="fa-solid fa-sliders text-xs"></i> Edit Nominal
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Table Footer --}}
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-between text-xs text-zinc-500">
                    <span>Menampilkan <strong x-text="filteredItems.length"></strong> dari <strong x-text="items.length"></strong> item</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

            {{-- ==================== 4. PELAPORAN BUMBU & BAHAN KECIL ==================== --}}
            <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                    <div>
                        <h2 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-basket-shopping text-rose-600"></i>
                            Pusat Pelaporan Bumbu Dapur & Perlengkapan Minuman Kecil
                        </h2>
                        <p class="text-xs text-zinc-500">Klik item di bawah jika bumbu dapur atau perlengkapan barista habis</p>
                    </div>
                    <button @click="openReportModal()" class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs px-3.5 py-2 rounded-xl border border-rose-200 transition cursor-pointer">
                        <i class="fa-solid fa-plus mr-1"></i> Form Laporan Custom
                    </button>
                </div>

                {{-- Quick Report Grid Chips --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Bumbu Dapur --}}
                    <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200 space-y-3">
                        <h3 class="text-xs font-extrabold text-zinc-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-mortar-pestle text-amber-600"></i>
                            Bumbu & Pelengkap Dapur
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="bumbu in bumbuList" :key="bumbu">
                                <button @click="quickReport(bumbu, 'Bumbu Dapur')" 
                                    class="px-3 py-1.5 bg-white hover:bg-rose-50 hover:border-rose-300 border border-zinc-200 rounded-lg text-xs font-bold text-zinc-700 flex items-center gap-1.5 transition cursor-pointer shadow-2xs">
                                    <i class="fa-solid fa-circle-exclamation text-amber-500 text-[10px]"></i>
                                    <span x-text="bumbu"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Minuman Bar --}}
                    <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200 space-y-3">
                        <h3 class="text-xs font-extrabold text-zinc-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-glass-water text-blue-600"></i>
                            Bahan & Perlengkapan Minuman (Barista)
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="barItem in barList" :key="barItem">
                                <button @click="quickReport(barItem, 'Minuman & Bar')" 
                                    class="px-3 py-1.5 bg-white hover:bg-blue-50 hover:border-blue-300 border border-zinc-200 rounded-lg text-xs font-bold text-zinc-700 flex items-center gap-1.5 transition cursor-pointer shadow-2xs">
                                    <i class="fa-solid fa-cube text-blue-500 text-[10px]"></i>
                                    <span x-text="barItem"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== MODAL 1: UPDATE STOK ITEM ==================== --}}
        <div x-cloak x-show="showUpdateStockModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showUpdateStockModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button @click="showUpdateStockModal = false" class="absolute right-4 top-4 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900">Update Nominal Stok</h3>
                        <p class="text-xs text-zinc-500" x-text="selectedItem.name"></p>
                    </div>
                </div>

                <form @submit.prevent="saveUpdateStock()" class="space-y-4">
                    <div class="bg-zinc-50 p-3 rounded-xl border border-zinc-200 flex justify-between text-xs font-medium">
                        <span>Satuan: <strong class="text-zinc-900" x-text="selectedItem.unit"></strong></span>
                        <span>Batas Min: <strong class="text-amber-600" x-text="selectedItem.minStock"></strong></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-zinc-700 mb-1">Jumlah Stok Baru</label>
                        <input type="number" x-model.number="selectedItem.stock" min="0" required
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-base font-black text-zinc-900 focus:ring-2 focus:ring-maroon-primary focus:outline-none">
                    </div>

                    <div class="pt-2 flex gap-2">
                        <button type="button" @click="showUpdateStockModal = false" class="flex-1 bg-zinc-100 text-zinc-700 font-bold py-2.5 rounded-xl text-xs">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-maroon-primary hover:bg-maroon-dark text-white font-bold py-2.5 rounded-xl text-xs shadow transition">
                            Simpan Perubahan Stok
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ==================== MODAL 2: FORM LAPORAN STOK/BUMBU ==================== --}}
        <div x-cloak x-show="showReportModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showReportModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button @click="showReportModal = false" class="absolute right-4 top-4 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900">Form Lapor Bahan / Bumbu Habis</h3>
                        <p class="text-xs text-zinc-500">Kirim pemberitahuan langsung ke bagian dapur & belanja</p>
                    </div>
                </div>

                <form @submit.prevent="submitReport()" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-zinc-700 mb-1">Nama Bahan / Bumbu / Barang</label>
                        <input type="text" x-model="reportForm.itemName" required placeholder="Contoh: Es Batu, Garam, Sedotan, Susu SKM..."
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2 text-xs font-bold text-zinc-800 focus:ring-2 focus:ring-rose-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-zinc-700 mb-1">Kategori</label>
                            <select x-model="reportForm.category" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3 py-2 text-xs font-semibold text-zinc-800">
                                <option value="Bumbu Dapur">Bumbu Dapur</option>
                                <option value="Minuman & Bar">Minuman & Bar</option>
                                <option value="Perlengkapan">Perlengkapan Kasir</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-zinc-700 mb-1">Tingkat Urgensi</label>
                            <select x-model="reportForm.urgency" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3 py-2 text-xs font-semibold text-zinc-800">
                                <option value="Habis Total">Habis Total (Mendesak)</option>
                                <option value="Hampir Habis">Hampir Habis / Menipis</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-zinc-700 mb-1">Catatan Tambahan Kasir</label>
                        <textarea x-model="reportForm.note" rows="2" placeholder="Misal: Tinggal 1 bungkus lagi, tolong dibelikan sebelum jam makan siang."
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2 text-xs font-medium text-zinc-800 focus:ring-2 focus:ring-rose-500 focus:outline-none"></textarea>
                    </div>

                    <div class="pt-2 flex gap-2">
                        <button type="button" @click="showReportModal = false" class="flex-1 bg-zinc-100 text-zinc-700 font-bold py-2.5 rounded-xl text-xs">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2.5 rounded-xl text-xs shadow transition">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    {{-- Script Alpine.js --}}
    <script>
        function stokSystem() {
            return {
                activeTab: 'semua',
                searchQuery: '',
                categoryFilter: 'all',
                showReportModal: false,
                showUpdateStockModal: false,
                selectedItem: {},

                bumbuList: [
                    'Garam Dapur', 'Gula Pasir', 'Bawang Merah', 'Bawang Putih', 
                    'Cabai Rawit', 'Daun Jeruk & Serai', 'Minyak Goreng', 'Santan Kelapa', 'Kecap Manis'
                ],

                barList: [
                    'Es Batu Kristal', 'Sedotan Plastik', 'Kantong Plastik / Cup', 
                    'Susu Kental Manis', 'Teh Celup Celup', 'Jeruk Nipis', 'Syrup Vanilla', 'Tissue Meja'
                ],

                reportForm: {
                    itemName: '',
                    category: 'Bumbu Dapur',
                    urgency: 'Habis Total',
                    note: ''
                },

                items: [
                    { id: 1, code: 'STK-001', name: 'Nasi Rendang Daging', category: 'Makanan', type: 'menu', unit: 'Porsi', stock: 34, minStock: 10 },
                    { id: 2, code: 'STK-002', name: 'Ayam Pop Spesial', category: 'Makanan', type: 'menu', unit: 'Porsi', stock: 8, minStock: 10 },
                    { id: 3, code: 'STK-003', name: 'Daging Sapi Fresh', category: 'Dapur', type: 'bahan', unit: 'Kg', stock: 15, minStock: 5 },
                    { id: 4, code: 'STK-004', name: 'Es Teh Manis', category: 'Minuman', type: 'menu', unit: 'Gelas', stock: 85, minStock: 20 },
                    { id: 5, code: 'STK-005', name: 'Beras Solok Spesial', category: 'Dapur', type: 'bahan', unit: 'Kg', stock: 45, minStock: 15 },
                    { id: 6, code: 'STK-006', name: 'Cabai Merah Padang', category: 'Dapur', type: 'bahan', unit: 'Kg', stock: 2, minStock: 5 },
                    { id: 7, code: 'STK-007', name: 'Minyak Goreng Sawit', category: 'Dapur', type: 'bahan', unit: 'Liter', stock: 0, minStock: 5 },
                    { id: 8, code: 'STK-008', name: 'Kerupuk Kulit', category: 'Makanan', type: 'menu', unit: 'Bungkus', stock: 18, minStock: 5 }
                ],

                get safeCount() {
                    return this.items.filter(i => i.stock > i.minStock).length;
                },

                get warningCount() {
                    return this.items.filter(i => i.stock > 0 && i.stock <= i.minStock).length;
                },

                get criticalCount() {
                    return this.items.filter(i => i.stock === 0).length;
                },

                get filteredItems() {
                    return this.items.filter(item => {
                        const matchTab = this.activeTab === 'semua' || 
                                         (this.activeTab === 'menu' && item.type === 'menu') ||
                                         (this.activeTab === 'bahan' && item.type === 'bahan') ||
                                         (this.activeTab === 'warning' && item.stock <= item.minStock);
                        
                        const matchCat = this.categoryFilter === 'all' || item.category === this.categoryFilter;
                        const matchSearch = item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                            item.code.toLowerCase().includes(this.searchQuery.toLowerCase());
                        
                        return matchTab && matchCat && matchSearch;
                    });
                },

                adjustStock(item, delta) {
                    item.stock = Math.max(0, item.stock + delta);
                },

                openUpdateStockModal(item) {
                    this.selectedItem = { ...item };
                    this.showUpdateStockModal = true;
                },

                saveUpdateStock() {
                    const idx = this.items.findIndex(i => i.id === this.selectedItem.id);
                    if (idx !== -1) {
                        this.items[idx].stock = this.selectedItem.stock;
                    }
                    this.showUpdateStockModal = false;
                },

                openReportModal() {
                    this.reportForm = { itemName: '', category: 'Bumbu Dapur', urgency: 'Habis Total', note: '' };
                    this.showReportModal = true;
                },

                quickReport(itemName, category) {
                    this.reportForm.itemName = itemName;
                    this.reportForm.category = category;
                    this.reportForm.urgency = 'Habis Total';
                    this.showReportModal = true;
                },

                submitReport() {
                    if (!this.reportForm.itemName) return;
                    alert('Laporan Stok Habis "' + this.reportForm.itemName + '" Berhasil Dikirim!');
                    this.showReportModal = false;
                }
            }
        }
    </script>
</body>

</html>
