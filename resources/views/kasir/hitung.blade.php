 <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hitung Transaksi - Kasir Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Bootstrap Icons & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-slate-100/80 text-zinc-800 antialiased overflow-x-hidden">

    {{-- Navbar --}}
    <x-kasir.navbar />

    <!-- Content Wrapper -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-8 px-4 md:px-6 lg:px-8">

        <div x-data="posSystem()" class="w-full max-w-7xl mx-auto pt-4 md:pt-6">

            <!-- Page Title Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 md:mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-maroon-dark tracking-tight flex items-center gap-2.5">
                        <i class="fa-solid fa-calculator text-maroon-primary"></i>
                        Hitung & Transaksi Kasir
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-500 mt-0.5">Pilih menu pesanan pelanggan dan hitung transaksi dengan cepat.</p>
                </div>

                <!-- Quick Stats Badge -->
                <div class="flex items-center gap-3">
                    <div class="bg-white px-4 py-2 rounded-2xl border border-zinc-200 shadow-sm flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-sm">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-zinc-400 font-semibold uppercase tracking-wider">Item Di Keranjang</p>
                            <p class="text-sm font-extrabold text-zinc-800" x-text="cartTotalCount() + ' Item'"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Layout Container -->
            <div class="flex flex-col lg:flex-row items-start gap-6 relative">

                {{-- bagian untuk card menu dan ada gambar menu juga dengan filter makanan,minuman, dan sarapan --}}
                <div class="w-full lg:w-7/12 xl:w-2/3 flex flex-col gap-4">

                    <!-- Filter & Search Toolbar (Sticky di atas area menu saat scroll) -->
                    <div class="bg-white/95 backdrop-blur-md p-3.5 md:p-4 rounded-2xl border border-zinc-200/80 shadow-md flex flex-col sm:flex-row items-center justify-between gap-3 sticky top-0 md:top-16 z-30">

                        <!-- Search Box -->
                        <div class="relative w-full sm:w-64">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400 text-sm"></i>
                            <input type="text"
                                x-model="searchQuery"
                                placeholder="Cari menu makanan / minuman..."
                                class="w-full bg-slate-50 border border-zinc-200 rounded-xl py-2 pl-10 pr-4 text-xs md:text-sm text-zinc-800 placeholder-zinc-400 focus:outline-none focus:border-maroon-primary focus:ring-2 focus:ring-maroon-primary/20 transition-all">
                            <button x-show="searchQuery.length > 0"
                                    @click="searchQuery = ''"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 text-xs">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Category Filter Pills & View Mode Switcher -->
                        <div class="flex items-center justify-between sm:justify-end gap-2 w-full sm:w-auto">
                            <!-- Category Filter Pills -->
                            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 scrollbar-none">
                                <template x-for="cat in categories" :key="cat.id">
                                    <button @click="activeCategory = cat.id"
                                            :class="activeCategory === cat.id
                                                ? 'bg-maroon-primary text-white shadow-md shadow-maroon-primary/20 font-bold'
                                                : 'bg-slate-100 text-zinc-600 hover:bg-slate-200/80 font-medium'"
                                            class="px-3 py-1.5 rounded-xl text-xs flex items-center gap-1.5 whitespace-nowrap transition-all duration-200 cursor-pointer">
                                        <i :class="cat.icon" class="text-[11px]"></i>
                                        <span x-text="cat.label"></span>
                                    </button>
                                </template>
                            </div>

                            <!-- Mode Tampilan Switcher (Grid vs Mode Baris Ringkas) -->
                            <div class="bg-zinc-100 p-1 rounded-xl flex items-center gap-1 border border-zinc-200 flex-shrink-0">
                                <button @click="viewMode = 'grid'"
                                        :class="viewMode === 'grid' ? 'bg-white text-maroon-primary shadow-sm' : 'text-zinc-400 hover:text-zinc-700'"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-xs transition cursor-pointer"
                                        title="Tampilan Card Grid">
                                    <i class="fa-solid fa-table-cells-large"></i>
                                </button>
                                <button @click="viewMode = 'compact'"
                                        :class="viewMode === 'compact' ? 'bg-white text-maroon-primary shadow-sm' : 'text-zinc-400 hover:text-zinc-700'"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-xs transition cursor-pointer"
                                        title="Tampilan Baris Ringkas (Hemat Scroll)">
                                    <i class="fa-solid fa-list"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- AKSES CEPAT (Quick Favorites Bar / Menu Terlaris 1-Klik) -->
                    <div class="bg-amber-500/10 border border-amber-500/20 p-2.5 rounded-2xl flex items-center gap-2 overflow-x-auto scrollbar-none">
                        <span class="text-[11px] font-bold text-amber-700 whitespace-nowrap flex items-center gap-1 px-1">
                            <i class="fa-solid fa-bolt text-amber-500"></i> Cepat 1-Klik:
                        </span>
                        <div class="flex items-center gap-1.5">
                            <template x-for="fav in quickFavorites" :key="fav.id">
                                <button @click="addToCart(fav)"
                                        class="bg-white hover:bg-amber-50 text-maroon-dark hover:text-maroon-primary border border-amber-300 px-2.5 py-1 rounded-xl text-xs font-semibold shadow-xs flex items-center gap-1.5 transition whitespace-nowrap active:scale-95 cursor-pointer">
                                    <span x-text="fav.name"></span>
                                    <span class="text-[10px] font-black text-amber-600" x-text="formatRupiah(fav.price)"></span>
                                    <i class="fa-solid fa-plus text-[9px] text-maroon-primary"></i>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Scrollable Menu Grid / Compact List Container -->
                    <div class="max-h-[calc(100vh-260px)] overflow-y-auto pr-1.5 space-y-4 rounded-2xl scrollbar-thin scrollbar-thumb-zinc-300">

                        <!-- MODE 1: GRID CARDS VIEW -->
                        <div x-show="viewMode === 'grid'" class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-3 gap-4 pb-2">
                            <template x-for="item in filteredMenus()" :key="item.id">
                                <div class="group bg-white rounded-2xl border border-zinc-200/80 shadow-sm hover:shadow-xl hover:border-maroon-primary/40 transition-all duration-300 overflow-hidden flex flex-col justify-between">

                                    <!-- Card Media (Gambar Menu) -->
                                    <div class="relative h-32 md:h-36 w-full overflow-hidden bg-slate-100">
                                        <img :src="item.image"
                                             :alt="item.name"
                                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500"
                                             onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=400&q=80'">

                                        <!-- Overlay Gradient -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>

                                        <!-- Category Badge -->
                                        <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider shadow-sm text-white backdrop-blur-md"
                                              :class="{
                                                  'bg-rose-600/90': item.category === 'makanan',
                                                  'bg-teal-600/90': item.category === 'minuman',
                                                  'bg-amber-600/90': item.category === 'sarapan'
                                              }"
                                              x-text="item.category">
                                        </span>

                                        <!-- Highlight Tag if present -->
                                        <template x-if="item.tag">
                                            <span class="absolute top-2 right-2 px-2 py-0.5 rounded-md text-[9px] font-extrabold bg-amber-400 text-maroon-dark shadow-sm"
                                                  x-text="item.tag">
                                            </span>
                                        </template>

                                        <!-- Selected Count Badge in Cart -->
                                        <template x-if="getItemQtyInCart(item.id) > 0">
                                            <div class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-amber-400 text-maroon-dark font-black text-[11px] flex items-center justify-center shadow-lg border-2 border-white animate-bounce">
                                                <span x-text="getItemQtyInCart(item.id)"></span>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Card Content -->
                                    <div class="p-3 flex flex-col flex-1 justify-between gap-2.5">
                                        <div>
                                            <h3 class="font-bold text-xs md:text-sm text-zinc-900 line-clamp-1 group-hover:text-maroon-primary transition-colors" x-text="item.name"></h3>
                                            <p class="text-[10px] text-zinc-400 line-clamp-1 mt-0.5" x-text="item.desc"></p>
                                        </div>

                                        <div class="flex items-center justify-between pt-2 border-t border-zinc-100">
                                            <div>
                                                <p class="text-[9px] text-zinc-400 font-medium">Harga</p>
                                                <p class="text-xs md:text-sm font-extrabold text-maroon-primary" x-text="formatRupiah(item.price)"></p>
                                            </div>

                                            <button @click="addToCart(item)"
                                                    class="px-2.5 py-1.5 rounded-xl bg-maroon-primary hover:bg-maroon-dark text-white text-[11px] font-semibold shadow-sm hover:shadow-md active:scale-95 transition-all duration-200 flex items-center gap-1 cursor-pointer">
                                                <i class="fa-solid fa-plus text-[10px]"></i>
                                                <span>Tambah</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </template>
                        </div>

                        <!-- MODE 2: COMPACT LIST VIEW (MODE BARIS RINGKAS TANPA SCROLL PANJANG) -->
                        <div x-show="viewMode === 'compact'" class="space-y-2 pb-2">
                            <template x-for="item in filteredMenus()" :key="item.id">
                                <div class="bg-white rounded-xl border border-zinc-200/80 p-2.5 px-3 shadow-xs hover:border-maroon-primary/40 flex items-center justify-between gap-3 transition">
                                    <div class="flex items-center gap-3 min-w-0 flex-1">
                                        <img :src="item.image" :alt="item.name" class="w-9 h-9 rounded-lg object-cover border border-zinc-100 flex-shrink-0">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <h4 class="font-bold text-xs text-zinc-800 truncate" x-text="item.name"></h4>
                                                <span class="px-1.5 py-0.2 rounded text-[9px] font-bold text-zinc-500 bg-slate-100 uppercase" x-text="item.category"></span>
                                            </div>
                                            <p class="text-[10px] font-semibold text-maroon-primary" x-text="formatRupiah(item.price)"></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <template x-if="getItemQtyInCart(item.id) > 0">
                                            <span class="px-2 py-0.5 rounded-full bg-amber-400 text-maroon-dark font-extrabold text-[10px]"
                                                  x-text="getItemQtyInCart(item.id) + 'x'"></span>
                                        </template>

                                        <button @click="addToCart(item)"
                                                class="px-3 py-1.5 rounded-lg bg-maroon-primary hover:bg-maroon-dark text-white text-xs font-semibold shadow-xs active:scale-95 transition flex items-center gap-1 cursor-pointer">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                            <span>Tambah</span>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Empty Filter State -->
                        <div x-show="filteredMenus().length === 0"
                             class="bg-white rounded-2xl p-10 text-center border border-zinc-200/80 shadow-sm my-4">
                            <div class="w-14 h-14 rounded-full bg-slate-100 text-zinc-400 flex items-center justify-center mx-auto mb-3 text-xl">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                            <h4 class="font-bold text-zinc-700 text-sm">Menu Tidak Ditemukan</h4>
                            <p class="text-xs text-zinc-400 mt-1">Coba kata kunci lain atau pilih kategori menu yang berbeda.</p>
                            <button @click="searchQuery = ''; activeCategory = 'semua'"
                                    class="mt-3 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-zinc-700 text-xs font-semibold transition">
                                Reset Filter
                            </button>
                        </div>

                    </div>

                </div>

                {{-- bagian untuk keranjang pesanan dan detail pesanan (FIXED STICKY PANEL DI KANAN) --}}
                <div class="w-full lg:w-5/12 xl:w-1/3 flex flex-col gap-4 sticky top-14 md:top-20 z-20">

                    <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-lg overflow-hidden flex flex-col max-h-[calc(100vh-140px)]">

                        <!-- Header Detail Keranjang (Tetap Diam di Atas) -->
                        <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary p-3.5 md:p-4 flex items-center justify-between text-white shadow-sm flex-shrink-0">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center text-white">
                                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-sm md:text-base tracking-wide">Keranjang Pesanan</h3>
                                    <p class="text-white/70 text-[11px]" x-text="trxNumber"></p>
                                </div>
                            </div>

                            <button @click="clearCart()"
                                    x-show="cart.length > 0"
                                    title="Kosongkan Keranjang"
                                    class="px-2 py-1 rounded-lg bg-white/10 hover:bg-white/25 text-white/90 hover:text-white text-xs font-medium transition flex items-center gap-1 cursor-pointer">
                                <i class="fa-solid fa-trash-can text-[10px]"></i>
                                <span>Reset</span>
                            </button>
                        </div>

                        <!-- Tipe Pemesanan & No Meja (Tetap Diam) -->
                        <div class="p-3 bg-slate-50 border-b border-zinc-200/60 flex flex-col gap-2.5 flex-shrink-0">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold text-zinc-500 uppercase tracking-wider">Tipe Pesanan:</span>

                                <div class="bg-zinc-200/70 p-1 rounded-xl flex items-center gap-1">
                                    <button @click="orderType = 'dine_in'"
                                            :class="orderType === 'dine_in' ? 'bg-white text-maroon-primary shadow-sm font-bold' : 'text-zinc-500 hover:text-zinc-800 font-medium'"
                                            class="px-2.5 py-1 rounded-lg text-xs transition cursor-pointer flex items-center gap-1">
                                        <i class="fa-solid fa-utensils text-[10px]"></i> Dine In
                                    </button>
                                    <button @click="orderType = 'take_away'"
                                            :class="orderType === 'take_away' ? 'bg-white text-maroon-primary shadow-sm font-bold' : 'text-zinc-500 hover:text-zinc-800 font-medium'"
                                            class="px-2.5 py-1 rounded-lg text-xs transition cursor-pointer flex items-center gap-1">
                                        <i class="fa-solid fa-bag-shopping text-[10px]"></i> Take Away
                                    </button>
                                </div>
                            </div>

                            <!-- Selector No Meja (jika Dine In) -->
                            <div x-show="orderType === 'dine_in'" class="flex items-center justify-between gap-2 pt-2 border-t border-zinc-200/50">
                                <label for="tableSelect" class="text-xs font-medium text-zinc-600">Nomor Meja:</label>
                                <select id="tableSelect" x-model="tableNo"
                                        class="bg-white border border-zinc-300 rounded-lg px-2.5 py-1 text-xs text-zinc-800 font-semibold focus:outline-none focus:border-maroon-primary">
                                    <option value="Meja 1">Meja 1</option>
                                    <option value="Meja 2">Meja 2</option>
                                    <option value="Meja 3">Meja 3</option>
                                    <option value="Meja 4">Meja 4</option>
                                    <option value="Meja 5">Meja 5</option>
                                    <option value="Meja 6">Meja 6</option>
                                    <option value="Meja VIP">Meja VIP</option>
                                </select>
                            </div>
                        </div>

                        <!-- Daftar Item Dalam Keranjang (Scrollable secara independen) -->
                        <div class="p-3 flex-1 min-h-[120px] max-h-[180px] md:max-h-[200px] overflow-y-auto divide-y divide-zinc-100 space-y-2.5 scrollbar-thin scrollbar-thumb-zinc-200">

                            <!-- State jika keranjang kosong -->
                            <div x-show="cart.length === 0" class="py-8 text-center">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-zinc-300 flex items-center justify-center mx-auto mb-2 text-lg">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </div>
                                <p class="text-xs font-bold text-zinc-400">Keranjang Masih Kosong</p>
                                <p class="text-[10px] text-zinc-400 mt-0.5">Klik tombol "+ Tambah" pada menu di samping.</p>
                            </div>

                            <!-- List Item Cart -->
                            <template x-for="item in cart" :key="item.id">
                                <div class="pt-2.5 first:pt-0 flex items-center justify-between gap-2.5">
                                    <div class="flex items-center gap-2.5 flex-1 min-w-0">
                                        <img :src="item.image" :alt="item.name" class="w-9 h-9 rounded-xl object-cover border border-zinc-200 flex-shrink-0">
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-zinc-800 truncate" x-text="item.name"></h4>
                                            <p class="text-[10px] text-zinc-400" x-text="formatRupiah(item.price)"></p>
                                        </div>
                                    </div>

                                    <!-- Quantity Controller -->
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center border border-zinc-200 rounded-lg overflow-hidden bg-slate-50">
                                            <button @click="updateQty(item.id, -1)" class="w-5 h-5 flex items-center justify-center text-zinc-600 hover:bg-zinc-200 transition text-[11px] font-bold">
                                                -
                                            </button>
                                            <span class="w-6 text-center text-xs font-bold text-zinc-800" x-text="item.qty"></span>
                                            <button @click="updateQty(item.id, 1)" class="w-5 h-5 flex items-center justify-center text-zinc-600 hover:bg-zinc-200 transition text-[11px] font-bold">
                                                +
                                            </button>
                                        </div>

                                        <p class="text-xs font-extrabold text-zinc-800 w-16 text-right" x-text="formatRupiah(item.price * item.qty)"></p>

                                        <button @click="removeItem(item.id)" class="text-zinc-300 hover:text-rose-600 text-xs transition p-0.5">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>

                        </div>

                        <!-- Calculation & Total Section (Tetap Diam di Bawah) -->
                        <div class="p-3.5 bg-slate-50/90 border-t border-zinc-200/80 space-y-1.5 flex-shrink-0">

                            <div class="flex items-center justify-between text-xs text-zinc-500">
                                <span>Subtotal</span>
                                <span class="font-bold text-zinc-700" x-text="formatRupiah(getSubtotal())"></span>
                            </div>

                            <div class="flex items-center justify-between text-xs text-zinc-500">
                                <span>Pajak & Service (10%)</span>
                                <span class="font-bold text-zinc-700" x-text="formatRupiah(getTax())"></span>
                            </div>

                            <div class="pt-2 border-t border-zinc-200 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-extrabold text-zinc-500 uppercase tracking-wider block">Total Pembayaran</span>
                                    <span class="text-[10px] text-zinc-400">Termasuk pajak</span>
                                </div>
                                <span class="text-lg md:text-xl font-black text-maroon-primary" x-text="formatRupiah(getGrandTotal())"></span>
                            </div>

                        </div>

                        <!-- Cash Payment Calculator (Tetap Diam) -->
                        <div x-show="cart.length > 0" class="p-3 bg-white border-t border-zinc-200 space-y-2.5 flex-shrink-0">

                            <div class="flex items-center justify-between">
                                <label class="text-[11px] font-bold text-zinc-700 flex items-center gap-1.5">
                                    <i class="fa-solid fa-money-bill-wave text-emerald-600"></i> Uang Diterima (Rp):
                                </label>

                                <button @click="cashInput = getGrandTotal()"
                                        class="text-[10px] font-bold text-maroon-primary hover:underline">
                                    Uang Pas
                                </button>
                            </div>

                            <!-- Input Nominal -->
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-zinc-400">Rp</span>
                                <input type="number"
                                       x-model.number="cashInput"
                                       placeholder="0"
                                       class="w-full bg-slate-50 border border-zinc-300 rounded-xl py-1.5 pl-9 pr-3 text-xs font-black text-zinc-800 focus:outline-none focus:border-maroon-primary focus:ring-2 focus:ring-maroon-primary/20">
                            </div>

                            <!-- Quick Cash Nominal Buttons -->
                            <div class="grid grid-cols-4 gap-1">
                                <button @click="cashInput = 20000" class="py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-zinc-700 transition">20rb</button>
                                <button @click="cashInput = 50000" class="py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-zinc-700 transition">50rb</button>
                                <button @click="cashInput = 100000" class="py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-zinc-700 transition">100rb</button>
                                <button @click="cashInput = 200000" class="py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-zinc-700 transition">200rb</button>
                            </div>

                            <!-- Kembalian Info Badge -->
                            <div class="p-2.5 rounded-xl border flex items-center justify-between"
                                 :class="getChange() >= 0 ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-rose-50 border-rose-200 text-rose-800'">
                                <span class="text-[11px] font-bold">Kembalian:</span>
                                <span class="text-xs font-black" x-text="getChange() >= 0 ? formatRupiah(getChange()) : 'Uang Kurang ' + formatRupiah(Math.abs(getChange()))"></span>
                            </div>

                        </div>

                        <!-- Action Checkout Buttons (Tetap Diam di Paling Bawah) -->
                        <div class="p-3 bg-slate-50 border-t border-zinc-200 flex items-center gap-2 flex-shrink-0">
                            <button @click="processPayment()"
                                    :disabled="cart.length === 0 || getChange() < 0"
                                    class="w-full py-3 px-4 rounded-xl bg-maroon-primary hover:bg-maroon-dark disabled:opacity-50 disabled:cursor-not-allowed text-white font-extrabold text-xs shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-print"></i>
                                <span>Bayar & Cetak Struk</span>
                            </button>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Modal Sukses Pembayaran -->
            <div x-show="showSuccessModal"
                 x-cloak
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">

                <div class="bg-white rounded-3xl max-w-sm w-full p-6 text-center shadow-2xl animate-in zoom-in-95 duration-200 border border-zinc-100">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 text-3xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <h3 class="text-xl font-black text-zinc-900">Transaksi Berhasil!</h3>
                    <p class="text-xs text-zinc-500 mt-1">Struk pembayaran telah dicetak.</p>

                    <div class="my-5 p-4 rounded-2xl bg-slate-50 border border-zinc-200 text-left space-y-2 text-xs">
                        <div class="flex justify-between text-zinc-500">
                            <span>No. Transaksi:</span>
                            <span class="font-bold text-zinc-800" x-text="lastTransaction?.trx"></span>
                        </div>
                        <div class="flex justify-between text-zinc-500">
                            <span>Total Bayar:</span>
                            <span class="font-bold text-zinc-800" x-text="formatRupiah(lastTransaction?.total || 0)"></span>
                        </div>
                        <div class="flex justify-between text-zinc-500">
                            <span>Uang Diterima:</span>
                            <span class="font-bold text-zinc-800" x-text="formatRupiah(lastTransaction?.cash || 0)"></span>
                        </div>
                        <div class="flex justify-between text-zinc-500 pt-2 border-t border-zinc-200 font-bold text-emerald-600">
                            <span>Kembalian:</span>
                            <span x-text="formatRupiah(lastTransaction?.change || 0)"></span>
                        </div>
                    </div>

                    <button @click="showSuccessModal = false"
                            class="w-full py-3 rounded-xl bg-maroon-primary hover:bg-maroon-dark text-white font-bold text-xs transition cursor-pointer">
                        Transaksi Baru
                    </button>
                </div>

            </div>

        </div>

    </main>

    @livewireScripts

    <!-- Alpine.js POS System Logic -->
    <script>
        function posSystem() {
            return {
                searchQuery: '',
                activeCategory: 'semua',
                orderType: 'dine_in',
                tableNo: 'Meja 1',
                cashInput: 0,
                taxRate: 0.10,
                showSuccessModal: false,
                viewMode: 'grid', // 'grid' | 'compact'
                trxNumber: '#TRX-' + Math.floor(100000 + Math.random() * 900000),
                lastTransaction: null,

                categories: [
                    { id: 'semua', label: 'Semua Menu', icon: 'fa-solid fa-utensils' },
                    { id: 'makanan', label: 'Makanan', icon: 'fa-solid fa-bowl-food' },
                    { id: 'minuman', label: 'Minuman', icon: 'fa-solid fa-mug-hot' },
                    { id: 'sarapan', label: 'Sarapan', icon: 'fa-solid fa-egg' },
                ],

                // Menu Favorit Cepat (1-Klik Tanpa Scroll)
                quickFavorites: [
                    { id: 1, name: 'Nasi Rendang', price: 26000, category: 'makanan', image: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=400&q=80' },
                    { id: 2, name: 'Ayam Pop', price: 24000, category: 'makanan', image: 'https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?auto=format&fit=crop&w=400&q=80' },
                    { id: 6, name: 'Teh Talua', price: 12000, category: 'minuman', image: 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?auto=format&fit=crop&w=400&q=80' },
                    { id: 7, name: 'Es Teh Manis', price: 6000, category: 'minuman', image: 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=400&q=80' },
                ],

                menus: [
                    { id: 1, name: 'Nasi Rendang Daging', category: 'makanan', price: 26000, tag: 'Laris', desc: 'Daging sapi empuk bumbu rempah Padang asli', image: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=400&q=80' },
                    { id: 2, name: 'Nasi Ayam Pop', category: 'makanan', price: 24000, tag: 'Favorit', desc: 'Ayam khas Padang disajikan dengan sambal petai', image: 'https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?auto=format&fit=crop&w=400&q=80' },
                    { id: 3, name: 'Nasi Cincang Daging', category: 'makanan', price: 25000, tag: '', desc: 'Gulai cincang gurih kaya bumbu tradisional', image: 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=400&q=80' },
                    { id: 4, name: 'Gulai Tunjang Padang', category: 'makanan', price: 28000, tag: 'Spesial', desc: 'Kikil tunjang lembut dengan kuah gulai kental', image: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=400&q=80' },
                    { id: 5, name: 'Dendeng Batokok', category: 'makanan', price: 27000, tag: 'Pedas', desc: 'Dendeng daging sapi renyah dengan cabai hijau', image: 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=400&q=80' },
                    { id: 6, name: 'Teh Talua khas Uda', category: 'minuman', price: 12000, tag: 'Khas', desc: 'Teh telur kocok rempah hangat stamina', image: 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?auto=format&fit=crop&w=400&q=80' },
                    { id: 7, name: 'Es Teh Manis', category: 'minuman', price: 6000, tag: '', desc: 'Es teh segar melati dingin', image: 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=400&q=80' },
                    { id: 8, name: 'Jus Alpukat Kocok', category: 'minuman', price: 15000, tag: 'Segar', desc: 'Alpukat mentega kocok dengan susu cokelat', image: 'https://images.unsplash.com/photo-1525385133512-2f3bdd039054?auto=format&fit=crop&w=400&q=80' },
                    { id: 9, name: 'Lontong Sayur Padang', category: 'sarapan', price: 16000, tag: 'Pagi', desc: 'Lontong kuah gulai nangka + kerupuk merah', image: 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=400&q=80' },
                    { id: 10, name: 'Nasi Gurih / Uduk', category: 'sarapan', price: 15000, tag: '', desc: 'Nasi gurih dengan telor balado & biun', image: 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=400&q=80' },
                    { id: 11, name: 'Soto Padang Daging', category: 'sarapan', price: 22000, tag: 'Hangat', desc: 'Soto daging krispi gurih dengan perkedel', image: 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=400&q=80' },
                ],

                cart: [],

                filteredMenus() {
                    return this.menus.filter(item => {
                        const matchesCategory = (this.activeCategory === 'semua' || item.category === this.activeCategory);
                        const matchesSearch = item.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchesCategory && matchesSearch;
                    });
                },

                addToCart(item) {
                    const existing = this.cart.find(c => c.id === item.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cart.push({
                            id: item.id,
                            name: item.name,
                            price: item.price,
                            image: item.image,
                            qty: 1
                        });
                    }
                },

                updateQty(id, change) {
                    const item = this.cart.find(c => c.id === id);
                    if (item) {
                        item.qty += change;
                        if (item.qty <= 0) {
                            this.removeItem(id);
                        }
                    }
                },

                removeItem(id) {
                    this.cart = this.cart.filter(c => c.id !== id);
                },

                clearCart() {
                    this.cart = [];
                    this.cashInput = 0;
                },

                getItemQtyInCart(id) {
                    const item = this.cart.find(c => c.id === id);
                    return item ? item.qty : 0;
                },

                cartTotalCount() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },

                getSubtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                getTax() {
                    return Math.round(this.getSubtotal() * this.taxRate);
                },

                getGrandTotal() {
                    return this.getSubtotal() + this.getTax();
                },

                getChange() {
                    return this.cashInput - this.getGrandTotal();
                },

                processPayment() {
                    if (this.cart.length === 0 || this.getChange() < 0) return;

                    this.lastTransaction = {
                        trx: this.trxNumber,
                        total: this.getGrandTotal(),
                        cash: this.cashInput,
                        change: this.getChange()
                    };

                    this.showSuccessModal = true;
                    this.clearCart();
                    this.trxNumber = '#TRX-' + Math.floor(100000 + Math.random() * 900000);
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number || 0);
                }
            };
        }
    </script>

</body>

</html>
