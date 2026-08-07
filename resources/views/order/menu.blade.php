<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Menu Masakan — Meja {{ $meja }} | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon-dark:    #5d1a1a;
            --maroon-primary: #721c24;
            --maroon-sec:     #a52834;
            --base:           #f9f3ed;
            --amber:          #f59e0b;
        }
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--base);
        }

        .top-bar {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--maroon-primary) 60%, var(--maroon-sec) 100%);
        }

        /* Category pills */
        .pill-active {
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-sec));
            color: #fff;
            box-shadow: 0 4px 14px rgba(114,28,36,0.35);
        }
        .pill-inactive {
            background: #fff;
            color: #52525b;
            border: 1.5px solid #e4e4e7;
        }
        .pill-inactive:hover { background: #faf5f5; border-color: #d4a0a5; }

        /* Menu card */
        .menu-card {
            background: #fff;
            border: 1.5px solid #e8e3dc;
            border-radius: 22px;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .menu-card:hover {
            box-shadow: 0 12px 32px rgba(114,28,36,0.12);
            transform: translateY(-3px);
            border-color: #d4a0a5;
        }

        .img-placeholder {
            background: linear-gradient(135deg, #f5ece5 0%, #e6d7cc 100%);
            border-radius: 16px;
        }

        /* Qty button */
        .btn-add-item {
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-sec));
            color: #fff;
            box-shadow: 0 4px 12px rgba(114,28,36,0.30);
            transition: all 0.2s ease;
        }
        .btn-add-item:hover {
            transform: scale(1.04);
            box-shadow: 0 6px 16px rgba(114,28,36,0.40);
        }

        .qty-control-box {
            background: #fdf8f7;
            border: 1.5px solid #e8cecf;
            border-radius: 12px;
        }

        /* Cart bar */
        .cart-bar {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--maroon-primary) 65%, #8b2a35 100%);
            box-shadow: 0 -6px 36px rgba(114,28,36,0.45);
            border-top: 1.5px solid rgba(245,158,11,0.40);
        }
        .cart-cta {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: var(--maroon-dark);
            box-shadow: 0 4px 16px rgba(245,158,11,0.45);
            font-weight: 900;
        }
        .cart-cta:hover { transform: translateY(-1px); brightness: 1.05; }

        .cart-detail-btn {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.20);
            color: #fff;
        }
        .cart-detail-btn:hover { background: rgba(255,255,255,0.22); }

        @keyframes slide-up {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .cart-enter { animation: slide-up 0.28s cubic-bezier(0.16, 1, 0.3, 1) both; }

        /* Scrollbar hide */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Search box */
        .search-box {
            background: #fff;
            border: 1.5px solid #e4ddd4;
            border-radius: 16px;
            transition: all 0.2s ease;
        }
        .search-box:focus-within {
            border-color: var(--maroon-primary);
            box-shadow: 0 0 0 4px rgba(114,28,36,0.10);
        }

        /* Modal backdrop blur */
        .drawer-backdrop {
            background: rgba(45, 10, 14, 0.65);
            backdrop-filter: blur(6px);
        }
    </style>
</head>

<body class="min-h-screen pb-40" x-data="customerMenuSystem('{{ $meja }}')">

    {{-- ═══════════ TOP HEADER BAR ═══════════ --}}
    <header class="top-bar sticky top-0 z-40 px-4 py-3 flex items-center gap-3 border-b border-amber-400/20 shadow-xl">
        <a href="{{ route('order.welcome', ['meja' => $meja]) }}" class="w-8.5 h-8.5 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center border border-white/15 transition shrink-0">
            <i class="fa-solid fa-arrow-left text-amber-300 text-xs"></i>
        </a>

        <div class="flex-1 min-w-0">
            <p class="text-[9px] font-extrabold tracking-[0.18em] text-amber-400 uppercase">Katalog Self-Ordering</p>
            <h1 class="text-sm font-black text-white leading-tight truncate">Lapau Uda Sutan</h1>
        </div>

        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-amber-400/30">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-[11px] font-extrabold text-amber-300" x-text="'Meja ' + meja"></span>
        </div>
    </header>


    {{-- ═══════════ STICKY SEARCH & FILTER ═══════════ --}}
    <div class="sticky top-[53px] z-30 bg-[#f9f3ed] px-4 pt-3 pb-3 space-y-2.5 border-b border-[#ece6de] shadow-xs">
        <!-- Search Input -->
        <div class="search-box flex items-center gap-2.5 px-3.5 py-2.5">
            <i class="fa-solid fa-magnifying-glass text-zinc-400 text-xs shrink-0"></i>
            <input type="text" x-model="searchQuery"
                   placeholder="Cari Rendang, Ayam Pop, Teh Talua, Gulai..."
                   class="flex-1 bg-transparent text-xs font-semibold text-zinc-800 placeholder-zinc-400 outline-none">
            <template x-if="searchQuery">
                <button @click="searchQuery=''" class="text-zinc-400 hover:text-zinc-600 shrink-0">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </template>
        </div>

        <!-- Category Chips -->
        <div class="flex gap-2 overflow-x-auto no-scrollbar">
            <template x-for="cat in categories" :key="cat.key">
                <button @click="categoryFilter = cat.key"
                        class="px-3.5 py-1.5 rounded-full text-xs font-extrabold whitespace-nowrap transition-all flex items-center gap-1.5"
                        :class="categoryFilter === cat.key ? 'pill-active' : 'pill-inactive'">
                    <span x-text="cat.icon"></span>
                    <span x-text="cat.label"></span>
                </button>
            </template>
        </div>
    </div>


    {{-- ═══════════ MENU CATALOG LIST ═══════════ --}}
    <main class="max-w-2xl mx-auto px-4 pt-4 space-y-3">

        <!-- Results Info & Active Filter Tag -->
        <div class="flex items-center justify-between px-1">
            <p class="text-[11px] text-zinc-500 font-bold">
                Menampilkan <span x-text="filteredMenuItems.length" class="text-maroon-primary font-black"></span> masakan Padang
            </p>

            <template x-if="totalCartItems > 0">
                <button @click="showCartDrawer = true" class="text-[11px] font-black text-[#721c24] hover:underline flex items-center gap-1">
                    <i class="fa-solid fa-basket-shopping text-xs"></i>
                    <span x-text="'Detail Keranjang (' + totalCartItems + ')'"></span>
                </button>
            </template>
        </div>

        <!-- Empty state -->
        <template x-if="filteredMenuItems.length === 0">
            <div class="py-16 text-center text-zinc-400 space-y-2 bg-white rounded-3xl border border-zinc-200">
                <i class="fa-solid fa-bowl-food text-4xl opacity-30 text-maroon-primary"></i>
                <p class="text-sm font-extrabold text-zinc-800">Menu tidak ditemukan</p>
                <p class="text-xs">Coba kata kunci lain atau pilih kategori menu lainnya</p>
            </div>
        </template>

        <!-- Menu Cards List -->
        <template x-for="item in filteredMenuItems" :key="item.id">
            <div class="menu-card p-4 flex items-center gap-3.5 sm:gap-4 relative overflow-hidden">

                <!-- Image Placeholder Icon -->
                <div class="img-placeholder w-18 h-18 sm:w-20 sm:h-20 flex items-center justify-center shrink-0 shadow-xs relative border border-white/60">
                    <i class="fa-solid text-[#a52834]/70 text-3xl" :class="item.icon"></i>
                </div>

                <!-- Info Column -->
                <div class="flex-1 min-w-0 space-y-1">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="font-extrabold text-zinc-900 text-sm leading-snug truncate" x-text="item.name"></h3>
                        <span x-show="item.badge" class="px-2 py-0.5 rounded-full text-[9px] font-black whitespace-nowrap shrink-0 border"
                              :class="item.badgeClass" x-text="item.badge"></span>
                    </div>
                    
                    <p class="text-[11px] text-zinc-500 leading-relaxed line-clamp-2" x-text="item.description"></p>

                    <div class="flex items-center justify-between pt-1.5">
                        <span class="font-black text-[#721c24] text-sm sm:text-base" x-text="formatRupiah(item.price)"></span>

                        <!-- Interactive Qty Controls -->
                        <div>
                            <!-- Case A: Item Not in Cart Yet -> Show "+ Tambah" Button -->
                            <template x-if="getCartQty(item.id) === 0">
                                <button @click="increaseQty(item)"
                                        class="btn-add-item px-3.5 py-1.5 rounded-xl text-xs font-black flex items-center gap-1.5 active:scale-95 cursor-pointer">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                    <span>Tambah</span>
                                </button>
                            </template>

                            <!-- Case B: Item already in Cart -> Show Counter [-] [Qty] [+] -->
                            <template x-if="getCartQty(item.id) > 0">
                                <div class="qty-control-box flex items-center gap-1.5 px-2 py-1 shadow-2xs">
                                    <button @click="decreaseQty(item)" class="w-6 h-6 rounded-lg bg-white text-zinc-700 font-black text-xs flex items-center justify-center border border-zinc-200 active:scale-90 shadow-2xs cursor-pointer">
                                        −
                                    </button>
                                    <span class="w-5 text-center font-black text-xs text-[#721c24]" x-text="getCartQty(item.id)"></span>
                                    <button @click="increaseQty(item)" class="w-6 h-6 rounded-lg bg-[#721c24] text-white font-black text-xs flex items-center justify-center active:scale-90 shadow-2xs cursor-pointer">
                                        +
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

            </div>
        </template>

    </main>


    {{-- ═══════════ MODAL DRAWER DETAIL KERANJANG ═══════════ --}}
    <div x-cloak x-show="showCartDrawer"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 drawer-backdrop flex items-end justify-center p-0 sm:p-4">

        <div @click.outside="showCartDrawer = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="bg-white rounded-t-3xl sm:rounded-3xl max-w-lg w-full max-h-[85vh] flex flex-col shadow-2xl overflow-hidden border border-zinc-200">

            <!-- Drawer Header -->
            <div class="px-5 py-4 bg-gradient-to-r from-maroon-dark to-maroon-primary text-white flex items-center justify-between border-b border-amber-400/30">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-400 text-maroon-dark flex items-center justify-center font-black text-sm shadow">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-black tracking-tight">Detail Keranjang Pesanan</h3>
                        <p class="text-[10px] text-amber-300 font-bold" x-text="'Meja ' + meja + ' • ' + totalCartItems + ' Porsi Disimpan'"></p>
                    </div>
                </div>

                <button @click="showCartDrawer = false" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Drawer Item List -->
            <div class="p-5 overflow-y-auto flex-1 space-y-3 divide-y divide-zinc-100">
                
                <template x-if="totalCartItems === 0">
                    <div class="py-12 text-center text-zinc-400 space-y-2">
                        <i class="fa-solid fa-cart-flatbed text-4xl opacity-30 text-maroon-primary"></i>
                        <p class="text-sm font-bold">Keranjang masih kosong</p>
                        <p class="text-xs">Silakan tambah masakan Padang pilihan Anda</p>
                    </div>
                </template>

                <template x-for="cartItem in cartDetailList" :key="cartItem.id">
                    <div class="pt-3 first:pt-0 flex items-center justify-between gap-3">
                        
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-[#f9f3ed] border border-[#e8e3dc] flex items-center justify-center shrink-0">
                                <i class="fa-solid text-[#a52834] text-sm" :class="cartItem.icon"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-extrabold text-zinc-900 text-xs sm:text-sm truncate" x-text="cartItem.name"></h4>
                                <p class="text-[10px] text-zinc-500 font-bold" x-text="formatRupiah(cartItem.price) + ' / porsi'"></p>
                                <p class="text-[11px] font-black text-maroon-primary" x-text="'Subtotal: ' + formatRupiah(cartItem.price * cartItem.qty)"></p>
                            </div>
                        </div>

                        <!-- Counter in Modal -->
                        <div class="flex items-center gap-2 shrink-0">
                            <div class="qty-control-box flex items-center gap-1.5 px-2 py-1 shadow-2xs">
                                <button @click="decreaseQty(cartItem)" class="w-6 h-6 rounded-lg bg-white text-zinc-700 font-black text-xs flex items-center justify-center border border-zinc-200 active:scale-90 shadow-2xs cursor-pointer">
                                    −
                                </button>
                                <span class="w-5 text-center font-black text-xs text-[#721c24]" x-text="cartItem.qty"></span>
                                <button @click="increaseQty(cartItem)" class="w-6 h-6 rounded-lg bg-[#721c24] text-white font-black text-xs flex items-center justify-center active:scale-90 shadow-2xs cursor-pointer">
                                    +
                                </button>
                            </div>

                            <button @click="removeItemCompletely(cartItem.id)" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 font-bold text-xs flex items-center justify-center transition">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>

                    </div>
                </template>
            </div>

            <!-- Drawer Footer Summary & Action Buttons -->
            <div class="p-5 bg-zinc-50 border-t border-zinc-200 space-y-3">
                <div class="flex items-center justify-between text-xs font-bold text-zinc-600">
                    <span>Total Estimasi Bayar:</span>
                    <span class="text-base font-black text-maroon-primary" x-text="formatRupiah(totalCartPrice)"></span>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-1">
                    <button @click="showCartDrawer = false" class="py-3 rounded-2xl bg-white border border-zinc-300 text-zinc-700 font-extrabold text-xs shadow-2xs hover:bg-zinc-100 transition">
                        + Tambah Menu Lain
                    </button>

                    <a :href="'{{ route('order.checkout', ['meja' => $meja]) }}'"
                       class="py-3 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 text-maroon-dark font-black text-xs shadow-md flex items-center justify-center gap-1.5 transition hover:brightness-105">
                        <span>Lanjut Bayar</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>


    {{-- ═══════════ FLOATING BAR DENGAN 2 TOMBOL AKSI ═══════════ --}}
    <div x-cloak x-show="totalCartItems > 0"
         x-transition:enter="transition duration-300 ease-out"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="cart-bar cart-enter fixed bottom-4 inset-x-4 max-w-lg mx-auto rounded-[24px] p-3.5 shadow-2xl border border-amber-400/40 z-40 space-y-2.5">
        
        <!-- Summary Strip -->
        <div class="flex items-center justify-between px-1 text-white">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-amber-400 text-maroon-dark flex items-center justify-center font-black text-xs shadow">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-amber-300 uppercase tracking-wider block" x-text="totalCartItems + ' Porsi Masakan Disimpan'"></span>
                    <span class="text-sm font-black text-white" x-text="formatRupiah(totalCartPrice)"></span>
                </div>
            </div>

            <button @click="showCartDrawer = true" class="text-[11px] font-black text-amber-300 underline hover:text-white transition">
                Cek Detail Rincian
            </button>
        </div>

        <!-- 2 Main Action Buttons -->
        <div class="grid grid-cols-2 gap-2.5 pt-1">
            <!-- Button 1: Cek Detail Keranjang -->
            <button @click="showCartDrawer = true"
                    class="cart-detail-btn py-3 px-3 rounded-2xl text-xs font-black flex items-center justify-center gap-1.5 transition cursor-pointer">
                <i class="fa-solid fa-basket-shopping text-amber-300"></i>
                <span>Cek Detail Keranjang</span>
            </button>

            <!-- Button 2: Lanjut Ke Step Berikutnya (Checkout) -->
            <a :href="'{{ route('order.checkout', ['meja' => $meja]) }}'"
               class="cart-cta py-3 px-3 rounded-2xl text-xs flex items-center justify-center gap-1.5 transition cursor-pointer">
                <span>Lanjut Pembayaran</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>


    <!-- Script Alpine.js -->
    <script>
        function customerMenuSystem(meja) {
            return {
                meja,
                searchQuery: '',
                categoryFilter: 'all',
                showCartDrawer: false,
                cart: {},

                categories: [
                    { key: 'all',          label: 'Semua Menu',     icon: '🍽️' },
                    { key: 'Lauk Utama',   label: 'Lauk & Daging',  icon: '🥩' },
                    { key: 'Ayam & Bebek', label: 'Ayam & Bebek',   icon: '🍗' },
                    { key: 'Gulai & Kuah', label: 'Gulai & Kuah',   icon: '🍲' },
                    { key: 'Minuman',      label: 'Minuman',         icon: '🥤' },
                ],

                menuItems: [
                    { id:1, name:'Rendang Daging Sapi Special',  category:'Lauk Utama',   price:24000, icon:'fa-drumstick-bite',  badge:'Terlaris 🔥', badgeClass:'bg-rose-100 text-rose-700 border-rose-200', description:'Daging sapi pilihan dimasak santan & 40 bumbu rempah Minang, seharian penuh hingga hitam sempurna.' },
                    { id:2, name:'Ayam Pop Khas Minang',          category:'Ayam & Bebek', price:22000, icon:'fa-drumstick-bite',  badge:'Favorit ⭐', badgeClass:'bg-amber-100 text-amber-700 border-amber-200', description:'Ayam kampung rebus santan bening, disajikan dengan sambal merah pedas khas Padang.' },
                    { id:3, name:'Gulai Tunjang / Kikil Sapi',    category:'Gulai & Kuah', price:26000, icon:'fa-bowl-food',      badge:'Premium', badgeClass:'bg-purple-100 text-purple-700 border-purple-200', description:'Kikil tunjang empuk kuah kuning kental sarat rempah — sajian istimewa dari dapur Uda Sutan.' },
                    { id:4, name:'Dendeng Batokok Cabe Ijo',      category:'Lauk Utama',   price:25000, icon:'fa-fire',          badge:'Pedas 🌶', badgeClass:'bg-rose-100 text-rose-700 border-rose-200',  description:'Daging iris tipis dipukul, digoreng kering, disiram sambal cabe hijau segar Minang.' },
                    { id:5, name:'Cincang Sapi Karang',            category:'Gulai & Kuah', price:23000, icon:'fa-bowl-food',      badge:'Rekomendasi', badgeClass:'bg-sky-100 text-sky-700 border-sky-200',    description:'Gulai cincang daging sapi dengan bumbu karang asam yang kaya dan autentik.' },
                    { id:6, name:'Teh Talua Uda Sutan',            category:'Minuman',      price:12000, icon:'fa-mug-hot',         badge:'Khas Minang', badgeClass:'bg-amber-100 text-amber-700 border-amber-200', description:'Teh telur kocok hangat berempah kayu manis — minuman stamina legendaris Sumatra Barat.' },
                    { id:7, name:'Es Teh Manis Segar',             category:'Minuman',      price:8000,  icon:'fa-glass-water',    badge:'',           badgeClass:'hidden',                                         description:'Teh manis dingin dengan es batu kristal segar, cocok menemani makan siang.' },
                    { id:8, name:'Juice Alpukat Kocok Santan',     category:'Minuman',      price:15000, icon:'fa-blender',        badge:'',           badgeClass:'hidden',                                         description:'Alpukat mentega dengan santan, krimer cokelat, dan sirup gula aren.' },
                ],

                get filteredMenuItems() {
                    return this.menuItems.filter(i => {
                        const cat = this.categoryFilter === 'all' || i.category === this.categoryFilter;
                        const q   = i.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return cat && q;
                    });
                },

                get totalCartItems() { return Object.values(this.cart).reduce((s,q) => s+q, 0); },

                get totalCartPrice() {
                    return Object.entries(this.cart).reduce((sum,[id,qty]) => {
                        const item = this.menuItems.find(i => i.id == id);
                        return sum + (item ? item.price * qty : 0);
                    }, 0);
                },

                get cartDetailList() {
                    const list = [];
                    for (const [id, qty] of Object.entries(this.cart)) {
                        if (qty > 0) {
                            const item = this.menuItems.find(i => i.id == id);
                            if (item) {
                                list.push({ ...item, qty });
                            }
                        }
                    }
                    return list;
                },

                getCartQty(id)   { return this.cart[id] || 0; },
                
                increaseQty(item){ 
                    if(!this.cart[item.id]) this.cart[item.id] = 0; 
                    this.cart[item.id]++; 
                },
                
                decreaseQty(item){ 
                    if(this.cart[item.id]) { 
                        this.cart[item.id]--; 
                        if(!this.cart[item.id]) delete this.cart[item.id]; 
                    } 
                },

                removeItemCompletely(id) {
                    delete this.cart[id];
                },

                formatRupiah(n)  { return 'Rp ' + (n||0).toLocaleString('id-ID'); }
            }
        }
    </script>

    @livewireScripts
</body>
</html>
