<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapau Uda Sutan - Cita Rasa Masakan Padang Autentik & Warisan Rempah Minang</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Warung Masakan Padang Lapau Uda Sutan. Menyajikan Rendang Daging Sapi Pilihan, Ayam Pop, Gulai Tunjang, dan Sambal Lado Mudo murni resep Minangkabau sejak 1998.">
    <meta name="keywords" content="Masakan Padang, Lapau Uda Sutan, Rendang Padang, Ayam Pop, Rumah Makan Padang, Culinary Minang">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Animate On Scroll (AOS) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0f0707;
            color: #f5f5f5;
        }

        .font-serif-title {
            font-family: 'Playfair Display', serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #170a0a;
        }
        ::-webkit-scrollbar-thumb {
            background: #8b2635;
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #b8345e;
        }

        /* Custom Gradient Effects */
        .bg-gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa7c11 100%);
        }
        .text-gold-gradient {
            background: linear-gradient(135deg, #fceabb 0%, #f8b500 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-hero-pattern {
            background-image: radial-gradient(rgba(184, 52, 94, 0.15) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .glass-card {
            background: rgba(34, 15, 15, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(212, 175, 55, 0.15);
        }
        .glass-card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card-hover:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.4);
            box-shadow: 0 20px 40px -15px rgba(114, 28, 36, 0.5);
        }
    </style>
</head>

<body x-data="{ 
    mobileMenuOpen: false, 
    activeTab: 'semua',
    scrolled: false,
    selectedDish: null
}" 
@scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-zinc-950/90 backdrop-blur-md border-b border-amber-900/30 py-3 shadow-xl' : 'bg-transparent py-5'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Brand Logo -->
                <a href="#beranda" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-600 via-rose-700 to-amber-900 p-0.5 shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <div class="w-full h-full bg-zinc-950 rounded-[10px] flex items-center justify-center">
                            <i class="bi bi-house-door-fill text-amber-400 text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <span class="block font-serif-title text-xl font-bold tracking-tight text-white group-hover:text-amber-400 transition-colors">
                            LAPAU UDA SUTAN
                        </span>
                        <span class="block text-[10px] font-semibold tracking-widest text-amber-500 uppercase">
                            Masakan Padang Autentik
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-300">
                    <a href="#beranda" class="hover:text-amber-400 transition-colors">Beranda</a>
                    <a href="#tentang" class="hover:text-amber-400 transition-colors">Tentang Kami</a>
                    <a href="#menu" class="hover:text-amber-400 transition-colors">Menu Favorit</a>
                    <a href="#rahasia" class="hover:text-amber-400 transition-colors">Rahasia Bumbu</a>
                    <a href="#catering" class="hover:text-amber-400 transition-colors">Catering</a>
                    <a href="#testimoni" class="hover:text-amber-400 transition-colors">Testimoni</a>
                    <a href="#lokasi" class="hover:text-amber-400 transition-colors">Lokasi</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="https://wa.me/6281234567890?text=Halo%20Uda%20Sutan,%20saya%20ingin%20pesan%20masakan%20padang" target="_blank"
                       class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-500 via-rose-600 to-amber-600 hover:from-amber-400 hover:to-rose-500 text-zinc-950 font-bold text-sm shadow-lg shadow-amber-900/30 hover:shadow-amber-500/20 transform hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="bi bi-whatsapp text-lg"></i>
                        <span>Pesan WhatsApp</span>
                    </a>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-zinc-300 hover:text-white p-2">
                    <i class="bi" :class="mobileMenuOpen ? 'bi-x-lg text-2xl' : 'bi-list text-3xl'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden bg-zinc-950 border-b border-amber-900/40 px-6 py-6 space-y-4 text-center">
            <a href="#beranda" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Beranda</a>
            <a href="#tentang" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Tentang Kami</a>
            <a href="#menu" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Menu Favorit</a>
            <a href="#rahasia" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Rahasia Bumbu</a>
            <a href="#catering" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Catering & Acara</a>
            <a href="#testimoni" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Testimoni</a>
            <a href="#lokasi" @click="mobileMenuOpen = false" class="block text-zinc-300 hover:text-amber-400 font-medium py-1">Lokasi & Kontak</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="block w-full py-3 rounded-full bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold text-sm">
                <i class="bi bi-whatsapp mr-2"></i> Pesan via WhatsApp
            </a>
        </div>
    </header>

    <!-- SECTION 1: HERO SECTION -->
    <section id="beranda" class="relative pt-32 pb-24 md:pt-44 md:pb-36 overflow-hidden bg-hero-pattern">
        <!-- Background Lighting Glows -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-rose-900/20 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute top-1/3 right-10 w-[350px] h-[350px] bg-amber-600/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Left Content -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-950/60 border border-amber-500/30 text-amber-400 text-xs sm:text-sm font-semibold shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        <i class="bi bi-award-fill text-amber-400"></i>
                        <span>Resep Minang Warisan Asli Sejak 1998</span>
                    </div>

                    <h1 class="font-serif-title text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.15] tracking-tight">
                        Cita Rasa Minang Asli, <br class="hidden sm:inline" />
                        <span class="text-gold-gradient">Santan Murni & Bumbu Rempah</span> Warisan Uda Sutan
                    </h1>

                    <p class="text-zinc-300 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Nikmati kelezatan <strong class="text-amber-400 font-semibold">Rendang Daging Sapi Hitam Slow-Cook 8 Jam</strong>, <strong class="text-amber-400 font-semibold">Ayam Pop Sambal Tomat Khas</strong>, dan <strong class="text-amber-400 font-semibold">Gulai Tunjang Gurih</strong> dengan porsi melimpah khas Minangkabau.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#menu" class="w-full sm:w-auto px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 via-rose-600 to-amber-600 hover:from-amber-400 hover:to-rose-500 text-zinc-950 font-extrabold text-base shadow-xl shadow-amber-950/50 hover:shadow-amber-500/25 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                            <span>Jelajahi Menu & Harga</span>
                            <i class="bi bi-arrow-right text-lg"></i>
                        </a>

                        <a href="https://wa.me/6281234567890?text=Halo%20Uda%20Sutan,%20saya%20ingin%20pesan" target="_blank" 
                           class="w-full sm:w-auto px-8 py-4 rounded-full bg-zinc-900/80 hover:bg-zinc-800 border border-amber-600/40 text-amber-300 hover:text-white font-bold text-base transition-all flex items-center justify-center gap-3 glass-card">
                            <i class="bi bi-whatsapp text-emerald-400 text-xl"></i>
                            <span>Pesan Nasi Bungkus</span>
                        </a>
                    </div>

                    <!-- Quick Trust Badges -->
                    <div class="pt-6 border-t border-amber-900/30 grid grid-cols-3 gap-4 max-w-md mx-auto lg:mx-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-950/80 border border-emerald-500/30 flex items-center justify-center text-emerald-400 text-lg">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-zinc-400">Jaminan</p>
                                <p class="text-xs font-bold text-white">100% Halal MUI</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-950/80 border border-amber-500/30 flex items-center justify-center text-amber-400 text-lg">
                                <i class="bi bi-fire"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-zinc-400">Kualitas</p>
                                <p class="text-xs font-bold text-white">Bumbu Segar</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-rose-950/80 border border-rose-500/30 flex items-center justify-center text-rose-400 text-lg">
                                <i class="bi bi-bag-heart-fill"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-zinc-400">Porsi</p>
                                <p class="text-xs font-bold text-white">Super Mantap</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Visual -->
                <div class="lg:col-span-5 relative" data-aos="fade-left" data-aos-duration="1200">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Decorative Frame Layer -->
                        <div class="absolute -inset-4 rounded-3xl bg-gradient-to-tr from-amber-600 via-rose-700 to-amber-400 opacity-30 blur-xl animate-pulse"></div>

                        <!-- Main Image Container -->
                        <div class="relative rounded-2xl overflow-hidden border-2 border-amber-500/30 shadow-2xl shadow-rose-950/80 group">
                            <img src="/images/hero.png" alt="Masakan Padang Uda Sutan" class="w-full h-[420px] sm:h-[480px] object-cover transform group-hover:scale-105 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent opacity-80"></div>

                            <!-- Overlay Floating Card -->
                            <div class="absolute bottom-6 left-6 right-6 p-4 rounded-xl glass-card border border-amber-500/30 flex items-center gap-4">
                                <div class="w-14 h-14 rounded-lg bg-amber-500/20 flex items-center justify-center text-amber-400 text-2xl font-bold shrink-0">
                                    🌶️
                                </div>
                                <div>
                                    <h4 class="font-serif-title font-bold text-white text-base">Sistem Hidang & Nasi Bungkus</h4>
                                    <p class="text-xs text-zinc-300">Siap melayani porsi keluarga, acara syukuran, & catering kantor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COUNTER / STATS BAR -->
    <section class="py-10 bg-zinc-950 border-y border-amber-900/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center" data-aos="zoom-in">
                <div class="space-y-1">
                    <p class="font-serif-title text-3xl sm:text-4xl font-extrabold text-amber-400">25+ Tahun</p>
                    <p class="text-xs sm:text-sm text-zinc-400 font-medium uppercase tracking-wider">Pengalaman Memasak</p>
                </div>
                <div class="space-y-1">
                    <p class="font-serif-title text-3xl sm:text-4xl font-extrabold text-rose-400">40+ Variasi</p>
                    <p class="text-xs sm:text-sm text-zinc-400 font-medium uppercase tracking-wider">Lauk & Sayur Padang</p>
                </div>
                <div class="space-y-1">
                    <p class="font-serif-title text-3xl sm:text-4xl font-extrabold text-amber-400">150.000+</p>
                    <p class="text-xs sm:text-sm text-zinc-400 font-medium uppercase tracking-wider">Nasi Bungkus Terjual</p>
                </div>
                <div class="space-y-1">
                    <p class="font-serif-title text-3xl sm:text-4xl font-extrabold text-emerald-400">4.9 / 5.0</p>
                    <p class="text-xs sm:text-sm text-zinc-400 font-medium uppercase tracking-wider">Rating Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: TENTANG KAMI & FILOSOFI -->
    <section id="tentang" class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Image Showcase -->
                <div class="lg:col-span-5 relative" data-aos="fade-right">
                    <div class="relative">
                        <div class="w-full h-[400px] sm:h-[480px] rounded-2xl overflow-hidden border border-amber-500/30 shadow-2xl">
                            <img src="/images/rendang.png" alt="Rendang Daging Sapi Uda Sutan" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Floating Badge -->
                        <div class="absolute -bottom-6 -right-6 p-6 rounded-2xl glass-card border border-amber-400/40 max-w-xs shadow-2xl hidden sm:block">
                            <i class="bi bi-quote text-3xl text-amber-400 block mb-1"></i>
                            <p class="text-xs italic text-zinc-200">"Rendang yang enak itu warnanya cokelat gelap kehitaman, bumbunya meresap sampai ke serat daging terdalam."</p>
                            <p class="text-xs font-bold text-amber-400 mt-2">— Uda Sutan (Pendiri)</p>
                        </div>
                    </div>
                </div>

                <!-- Right Story Content -->
                <div class="lg:col-span-7 space-y-6" data-aos="fade-left">
                    <div class="inline-block px-3 py-1 rounded-md bg-rose-950 border border-rose-800/40 text-rose-400 text-xs font-bold tracking-widest uppercase">
                        Cerita & Warisan
                    </div>

                    <h2 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Mengapa Masakan <span class="text-gold-gradient">Lapau Uda Sutan</span> Selalu Rindu Di Hati?
                    </h2>

                    <p class="text-zinc-300 text-base leading-relaxed">
                        Berawal dari lapau kecil di pinggir jalan pada tahun 1998, Uda Sutan memegang teguh tradisi leluhur Minangkabau: <strong class="text-amber-300 font-semibold">"Lamak di awak, katuju dek urang"</strong> (Enak bagi kita, disukai oleh semua orang).
                    </p>

                    <p class="text-zinc-300 text-base leading-relaxed">
                        Setiap porsi masakan kami diracik tanpa bahan pengawet sintesis. Santan diperas murni dari kelapa tua pilihan, cabai merah keriting dan lado mudo didatangkan langsung dari dataran tinggi Bukittinggi, serta proses pemasakan slow cook yang melunakkan daging tanpa merusak gizi.
                    </p>

                    <!-- 4 Pillars Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                        <div class="p-4 rounded-xl bg-zinc-900/60 border border-amber-900/30 flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0 text-xl font-bold">1</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Rempah Murni Bukittinggi</h4>
                                <p class="text-xs text-zinc-400 mt-1">Serai, asam kandis, lengkuas, dan pekak asli tanpa campuran perasa buatan.</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-zinc-900/60 border border-amber-900/30 flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-lg bg-rose-500/10 text-rose-400 flex items-center justify-center shrink-0 text-xl font-bold">2</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Memasak Tradisional</h4>
                                <p class="text-xs text-zinc-400 mt-1">Kuali besi tebal & pengadukan perlahan hingga minyak kelapa alami keluar.</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-zinc-900/60 border border-amber-900/30 flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0 text-xl font-bold">3</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Porsi Nasi Melimpah</h4>
                                <p class="text-xs text-zinc-400 mt-1">Nasi hangat, kuah gulai banjir, daun singkong rebus segar & sambal murni.</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-zinc-900/60 border border-amber-900/30 flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0 text-xl font-bold">4</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Jaminan Kebersihan</h4>
                                <p class="text-xs text-zinc-400 mt-1">Standar higienis tinggi di dapur & area makan tempat berkumpul keluarga.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 3: KATALOG MENU FAVORIT (INTERACTIVE TABS) -->
    <section id="menu" class="py-24 bg-zinc-950/80 border-t border-amber-900/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Title Header -->
            <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
                <span class="px-3 py-1 rounded-md bg-amber-950 border border-amber-800/40 text-amber-400 text-xs font-bold tracking-widest uppercase">
                    Katalog Kuliner Minang
                </span>
                <h2 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    Menu Unggulan <span class="text-gold-gradient">Lapau Uda Sutan</span>
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base">
                    Pilih kategori masakan favorit Anda. Setiap porsi disajikan lengkap dengan Nasi Putih, Kuah Gulai Nangka, Daun Singkong Rebus, dan Sambal Lado Mudo.
                </p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2 mt-10" data-aos="fade-up" data-aos-delay="100">
                <button @click="activeTab = 'semua'" 
                        :class="activeTab === 'semua' ? 'bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold shadow-lg shadow-amber-900/40' : 'bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800'"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                    Semua Menu
                </button>
                <button @click="activeTab = 'daging'" 
                        :class="activeTab === 'daging' ? 'bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold shadow-lg shadow-amber-900/40' : 'bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800'"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                    🥩 Olahan Daging Sapi
                </button>
                <button @click="activeTab = 'ayam'" 
                        :class="activeTab === 'ayam' ? 'bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold shadow-lg shadow-amber-900/40' : 'bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800'"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                    🍗 Ayam & Bebek
                </button>
                <button @click="activeTab = 'gulai'" 
                        :class="activeTab === 'gulai' ? 'bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold shadow-lg shadow-amber-900/40' : 'bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800'"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                    🍲 Gulai & Kikil
                </button>
                <button @click="activeTab = 'seafood'" 
                        :class="activeTab === 'seafood' ? 'bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-bold shadow-lg shadow-amber-900/40' : 'bg-zinc-900 text-zinc-400 hover:text-white border border-zinc-800'"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                    🐟 Ikan & Seafood
                </button>
            </div>

            <!-- Menu Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                
                <!-- CARD 1: Rendang Daging Sapi -->
                <div x-show="activeTab === 'semua' || activeTab === 'daging'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up">
                    <div>
                        <div class="relative h-56 overflow-hidden">
                            <img src="/images/rendang.png" alt="Rendang Daging" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-amber-500 text-zinc-950 text-xs font-extrabold uppercase">
                                Best Seller #1
                            </div>
                            <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-zinc-950/80 text-amber-400 text-xs font-bold border border-amber-500/30">
                                🌶️🌶️ Pedas Manis Gurih
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Rendang Daging Sapi Hitam</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 24.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Daging sapi paha segar dimasak slow cook 8 jam dengan santan kelapa murni dan 12 rempah alami Minang hingga bumbu meresap hitam sempurna.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Rendang%20Daging%20Sapi" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

                <!-- CARD 2: Ayam Pop Khas Uda Sutan -->
                <div x-show="activeTab === 'semua' || activeTab === 'ayam'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="relative h-56 overflow-hidden bg-zinc-900">
                            <div class="w-full h-full bg-gradient-to-tr from-rose-950 via-zinc-900 to-amber-950 flex items-center justify-center p-6 text-center">
                                <div class="space-y-2">
                                    <span class="text-5xl">🍗</span>
                                    <h4 class="font-serif-title font-bold text-amber-300">Ayam Pop Sambal Tomat Khas</h4>
                                </div>
                            </div>
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-rose-600 text-white text-xs font-extrabold uppercase">
                                Rekomendasi Uda
                            </div>
                            <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-zinc-950/80 text-amber-400 text-xs font-bold border border-amber-500/30">
                                🌶️ Gurih Lembut
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Ayam Pop Uda Sutan</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 22.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Ayam kampung pilihan direbus air kelapa muda & bumbu bawang putih, kemudian digoreng kilat mentega. Disajikan dengan Sambal Tomat Petai Khas.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Ayam%20Pop" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

                <!-- CARD 3: Gulai Tunjang / Kikil -->
                <div x-show="activeTab === 'semua' || activeTab === 'gulai'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="relative h-56 overflow-hidden bg-zinc-900">
                            <div class="w-full h-full bg-gradient-to-tr from-amber-950 via-zinc-900 to-rose-950 flex items-center justify-center p-6 text-center">
                                <div class="space-y-2">
                                    <span class="text-5xl">🍲</span>
                                    <h4 class="font-serif-title font-bold text-amber-300">Gulai Tunjang Sapi Empuk</h4>
                                </div>
                            </div>
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-amber-600 text-zinc-950 text-xs font-extrabold uppercase">
                                Porsi Mantap
                            </div>
                            <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-zinc-950/80 text-amber-400 text-xs font-bold border border-amber-500/30">
                                🌶️🌶️ Kuah Kental
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Gulai Tunjang / Kikil</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 26.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Kikil kaki sapi empuk lembut bebas bau amis, disiram kuah gulai merah kental yang kaya akan kunyit, serai, daun jeruk, dan santan legit.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Gulai%20Tunjang" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

                <!-- CARD 4: Dendeng Batokok Lado Mudo -->
                <div x-show="activeTab === 'semua' || activeTab === 'daging'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up">
                    <div>
                        <div class="relative h-56 overflow-hidden bg-zinc-900">
                            <div class="w-full h-full bg-gradient-to-tr from-emerald-950 via-zinc-900 to-amber-950 flex items-center justify-center p-6 text-center">
                                <div class="space-y-2">
                                    <span class="text-5xl">🥩</span>
                                    <h4 class="font-serif-title font-bold text-emerald-300">Dendeng Batokok Lado Mudo</h4>
                                </div>
                            </div>
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-emerald-600 text-white text-xs font-extrabold uppercase">
                                Pedas Hijau Segar
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Dendeng Batokok Lado Mudo</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 25.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Daging sapi diiris tipis lalu dipukul (batokok) sampai empuk, disiram sambal cabai hijau keriting kasar bertabur bawang merah tumis minyak kelapa.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Dendeng%20Batokok" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

                <!-- CARD 5: Gulai Kepala Ikan Kakap -->
                <div x-show="activeTab === 'semua' || activeTab === 'seafood' || activeTab === 'gulai'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="relative h-56 overflow-hidden bg-zinc-900">
                            <div class="w-full h-full bg-gradient-to-tr from-sky-950 via-zinc-900 to-amber-950 flex items-center justify-center p-6 text-center">
                                <div class="space-y-2">
                                    <span class="text-5xl">🐟</span>
                                    <h4 class="font-serif-title font-bold text-sky-300">Gulai Kepala Ikan Kakap</h4>
                                </div>
                            </div>
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-sky-600 text-white text-xs font-extrabold uppercase">
                                Porsi Jumbo
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Gulai Kepala Kakap</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 45.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Kepala ikan kakap merah segar porsi jumbo dimasak dalam kuah gulai asam kuning asam kandis, daun ruku-ruku, dan serai wangi khas pesisir.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Gulai%20Kepala%20Kakap" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

                <!-- CARD 6: Cincang Daging Sapi -->
                <div x-show="activeTab === 'semua' || activeTab === 'daging' || activeTab === 'gulai'" 
                     class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="relative h-56 overflow-hidden bg-zinc-900">
                            <div class="w-full h-full bg-gradient-to-tr from-rose-950 via-zinc-900 to-amber-950 flex items-center justify-center p-6 text-center">
                                <div class="space-y-2">
                                    <span class="text-5xl">🍲</span>
                                    <h4 class="font-serif-title font-bold text-rose-300">Cincang Daging Sapi Gurih</h4>
                                </div>
                            </div>
                            <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-rose-600 text-white text-xs font-extrabold uppercase">
                                Paling Ketagihan
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-serif-title font-bold text-xl text-white">Gulai Cincang Sapi</h3>
                                <span class="text-amber-400 font-extrabold text-lg">Rp 23.000</span>
                            </div>
                            <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                Potongan daging & tetelan sapi empuk dimasak kuah gulai merah berminyak rempah kental. Paling cocok disiram melimpah di atas nasi hangat.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="https://wa.me/6281234567890?text=Pesan%20Gulai%20Cincang" target="_blank"
                           class="w-full py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 border border-amber-500/40 text-amber-400 hover:text-zinc-950 font-bold text-xs sm:text-sm transition-all flex items-center justify-center gap-2">
                            <i class="bi bi-cart-plus text-base"></i> Pesan Porsi Ini
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 4: RAHASIA BUMBU & PROSES MEMASAK -->
    <section id="rahasia" class="py-24 relative overflow-hidden bg-hero-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
                <span class="px-3 py-1 rounded-md bg-rose-950 border border-rose-800/40 text-rose-400 text-xs font-bold tracking-widest uppercase">
                    Kualitas Tanpa Kompromi
                </span>
                <h2 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    4 Langkah Rahasia <span class="text-gold-gradient">Kelezatan Uda Sutan</span>
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base">
                    Proses mengolah hidangan tradisional yang mempertahankan standar keaslian Minang dari generasi ke generasi.
                </p>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-16" data-aos="zoom-in-up">
                <!-- Step 1 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 text-amber-400 text-2xl font-bold flex items-center justify-center mx-auto shadow-inner">
                        01
                    </div>
                    <h3 class="font-serif-title font-bold text-lg text-white">Pilihan Rempah Segar</h3>
                    <p class="text-zinc-400 text-xs sm:text-sm">
                        Menggunakan 12 bahan rempah alami Bukittinggi tanpa bubuk perasa instan atau zat pewarna.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-2xl bg-rose-500/20 text-rose-400 text-2xl font-bold flex items-center justify-center mx-auto shadow-inner">
                        02
                    </div>
                    <h3 class="font-serif-title font-bold text-lg text-white">Santan Kelapa Tua</h3>
                    <p class="text-zinc-400 text-xs sm:text-sm">
                        Diperas murni dari kelapa tua pilihan untuk menghasilkan kuah gulai yang gurih alami dan berminyak lezat.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 text-2xl font-bold flex items-center justify-center mx-auto shadow-inner">
                        03
                    </div>
                    <h3 class="font-serif-title font-bold text-lg text-white">Slow Cooking 8 Jam</h3>
                    <p class="text-zinc-400 text-xs sm:text-sm">
                        Daging sapi diolah dengan api sedang secara perlahan hingga sari rempah meresap sampai ke serat terdalam.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-2xl bg-sky-500/20 text-sky-400 text-2xl font-bold flex items-center justify-center mx-auto shadow-inner">
                        04
                    </div>
                    <h3 class="font-serif-title font-bold text-lg text-white">Penyajian Hidang & Bungkus</h3>
                    <p class="text-zinc-400 text-xs sm:text-sm">
                        Disajikan segar panas tiap hari dengan balutan daun pisang yang menambah aroma harum alami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: PAKET CATERING & NASI BUNGKUS KANTOR -->
    <section id="catering" class="py-24 bg-zinc-950 border-y border-amber-900/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6" data-aos="fade-right">
                    <span class="px-3 py-1 rounded-md bg-amber-950 border border-amber-800/40 text-amber-400 text-xs font-bold tracking-widest uppercase">
                        Solusi Acara & Syukuran
                    </span>
                    <h2 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                        Layanan <span class="text-gold-gradient">Nasi Box & Catering</span> Lapau Uda Sutan
                    </h2>
                    <p class="text-zinc-300 text-sm sm:text-base leading-relaxed">
                        Menerima pesanan Nasi Kotak porsi besar untuk rapat kantor, pengajian, pesta pernikahan, seminar, dan acara keluarga. Dikemas rapi, higienis, lengkap dengan buah segar & sendok.
                    </p>

                    <!-- Package List -->
                    <div class="space-y-4">
                        <div class="p-4 rounded-xl glass-card flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">📦</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Paket Nasi Kotak Hemat</h4>
                                    <p class="text-xs text-zinc-400">Nasi + Ayam Goreng/Bakar + Sayur Nangka + Sambal + Kerupuk</p>
                                </div>
                            </div>
                            <span class="text-amber-400 font-extrabold text-sm sm:text-base">Rp 23.000 / box</span>
                        </div>

                        <div class="p-4 rounded-xl glass-card flex items-center justify-between border-amber-500/40">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold">👑</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Paket Nasi Kotak Uda Sultan (Favorit)</h4>
                                    <p class="text-xs text-zinc-400">Nasi + Rendang Daging + Telur Dadar Padang + Sayur + Buah + Air Mineral</p>
                                </div>
                            </div>
                            <span class="text-amber-400 font-extrabold text-sm sm:text-base">Rp 32.000 / box</span>
                        </div>

                        <div class="p-4 rounded-xl glass-card flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">🎪</div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Catering Prasmanan Pernikahan</h4>
                                    <p class="text-xs text-zinc-400">Pilihan 8 Lauk Utama, Pondokan Rendang & Es Tebet (Min 100 Porsi)</p>
                                </div>
                            </div>
                            <span class="text-emerald-400 font-extrabold text-sm sm:text-base">Hubungi Kami</span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="https://wa.me/6281234567890?text=Halo%20Uda%20Sutan,%20saya%20mau%20tanya%20paket%20catering" target="_blank"
                           class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-rose-600 text-zinc-950 font-extrabold text-sm shadow-xl hover:shadow-amber-500/20 transition-all">
                            <i class="bi bi-telephone-fill text-lg"></i>
                            <span>Konsultasi Menu Catering WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="lg:col-span-6" data-aos="fade-left">
                    <div class="p-8 rounded-3xl bg-gradient-to-br from-amber-950/60 via-zinc-900 to-rose-950/60 border border-amber-500/30 text-center space-y-6 relative">
                        <div class="w-20 h-20 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-400 text-4xl flex items-center justify-center mx-auto shadow-lg">
                            🍱
                        </div>
                        <h3 class="font-serif-title text-2xl sm:text-3xl font-bold text-white">Diskon Spesial Pesanan > 50 Box</h3>
                        <p class="text-zinc-300 text-sm max-w-md mx-auto">
                            Dapatkan <strong class="text-amber-400">Gratis Pengiriman</strong> untuk wilayah kota dan tambahan porsi bonus lauk ekstra tiap pemesanan porsi acara.
                        </p>
                        <div class="p-4 rounded-xl bg-zinc-950/80 border border-amber-900/40 max-w-sm mx-auto space-y-2">
                            <p class="text-xs text-amber-400 font-bold tracking-widest uppercase">Langkah Mudah Pemesanan</p>
                            <p class="text-xs text-zinc-300">1. Hubungi WA & Rincikan Jumlah Porsi</p>
                            <p class="text-xs text-zinc-300">2. Pilih Variasi Lauk & Jam Antar</p>
                            <p class="text-xs text-zinc-300">3. Pesanan Diantar Tepat Waktu Hangat!</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 6: TESTIMONI PELANGGAN -->
    <section id="testimoni" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4" data-aos="fade-up">
                <span class="px-3 py-1 rounded-md bg-amber-950 border border-amber-800/40 text-amber-400 text-xs font-bold tracking-widest uppercase">
                    Kata Mereka
                </span>
                <h2 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    Testimoni Pelanggan <span class="text-gold-gradient">Setia Uda Sutan</span>
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base">
                    Kepuasan ribuan penikmat masakan Minang yang telah membuktikan keaslian cita rasa kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12" data-aos="fade-up" data-aos-delay="100">
                <!-- Testi 1 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-400 gap-1 text-sm">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-zinc-300 text-xs sm:text-sm italic leading-relaxed">
                            "Rendangnya juara banget! Dagingnya empuk parah dan bumbu hitamnya meresap sampai ke dalam. Nasi bungkus porsinya melimpah, kuah gulainya melimpah. Langganan makan siang kantor kami!"
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-zinc-800">
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center font-bold text-amber-400">
                            BS
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Bambang S.</h4>
                            <p class="text-[11px] text-zinc-400">Manager Operasional BUMN</p>
                        </div>
                    </div>
                </div>

                <!-- Testi 2 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-400 gap-1 text-sm">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-zinc-300 text-xs sm:text-sm italic leading-relaxed">
                            "Ayam Pop-nya autentik banget kayak yang di Bukittinggi. Sambal petainya mantap manis gurih. Kemarin pesan 80 box untuk acara syukuran rumah, semua tamu puji enak!"
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-zinc-800">
                        <div class="w-10 h-10 rounded-full bg-rose-500/20 flex items-center justify-center font-bold text-rose-400">
                            NR
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Nyonya Rina</h4>
                            <p class="text-[11px] text-zinc-400">Ibu Rumah Tangga</p>
                        </div>
                    </div>
                </div>

                <!-- Testi 3 -->
                <div class="glass-card p-6 rounded-2xl border border-amber-500/20 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-400 gap-1 text-sm">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="text-zinc-300 text-xs sm:text-sm italic leading-relaxed">
                            "Gulai Tunjang & Dendeng Batokok Lado Mudo-nya beneran nagih! Tempatnya bersih, pelayanan cepat, dan harganya sangat bersahabat dibanding kualitas rasanya."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-zinc-800">
                        <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center font-bold text-emerald-400">
                            AH
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Arif Hidayat</h4>
                            <p class="text-[11px] text-zinc-400">Food Vlogger & Content Creator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: FAQ (PERTANYAAN SERING DITANYAKAN) -->
    <section class="py-20 bg-zinc-950/90 border-t border-amber-900/30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" x-data="{ openFaq: null }">
            <div class="text-center space-y-3" data-aos="fade-up">
                <h2 class="font-serif-title text-3xl font-bold text-white">Pertanyaan Sering Ditanyakan (FAQ)</h2>
                <p class="text-zinc-400 text-sm">Informasi lengkap seputar layanan & pemesanan di Lapau Uda Sutan.</p>
            </div>

            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
                <!-- FAQ 1 -->
                <div class="rounded-xl bg-zinc-900 border border-amber-900/30 overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-4 text-left font-semibold text-white flex items-center justify-between text-sm sm:text-base">
                        <span>Apakah semua masakan di Lapau Uda Sutan 100% Halal?</span>
                        <i class="bi" :class="openFaq === 1 ? 'bi-chevron-up text-amber-400' : 'bi-chevron-down text-zinc-400'"></i>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-4 text-xs sm:text-sm text-zinc-300 border-t border-zinc-800 pt-3">
                        Ya, 100% Halal. Seluruh bahan daging sapi, ayam, dan rempah diproses sesuai syariat Islam dan standar kebersihan higienis tinggi.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-xl bg-zinc-900 border border-amber-900/30 overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-4 text-left font-semibold text-white flex items-center justify-between text-sm sm:text-base">
                        <span>Berapa minimal pemesanan untuk Nasi Box Catering?</span>
                        <i class="bi" :class="openFaq === 2 ? 'bi-chevron-up text-amber-400' : 'bi-chevron-down text-zinc-400'"></i>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-4 text-xs sm:text-sm text-zinc-300 border-t border-zinc-800 pt-3">
                        Minimal pemesanan Nasi Box Catering adalah 10 kotak. Pemesanan di atas 50 kotak disarankan menghubungi H-1 melalui WhatsApp.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-xl bg-zinc-900 border border-amber-900/30 overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-4 text-left font-semibold text-white flex items-center justify-between text-sm sm:text-base">
                        <span>Apakah menerima pembayaran non-tunai (QRIS & Transfer)?</span>
                        <i class="bi" :class="openFaq === 3 ? 'bi-chevron-up text-amber-400' : 'bi-chevron-down text-zinc-400'"></i>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-4 text-xs sm:text-sm text-zinc-300 border-t border-zinc-800 pt-3">
                        Ya! Kami menerima pembayaran tunai, QRIS All Payment, serta Transfer Bank Mandiri/BCA/BRI untuk memudahkan transaksi Anda.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: LOKASI & KONTAK -->
    <section id="lokasi" class="py-24 relative bg-hero-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Info Column -->
                <div class="lg:col-span-5 space-y-6" data-aos="fade-right">
                    <span class="px-3 py-1 rounded-md bg-amber-950 border border-amber-800/40 text-amber-400 text-xs font-bold tracking-widest uppercase">
                        Kunjungi Kami
                    </span>
                    <h2 class="font-serif-title text-3xl sm:text-4xl font-bold text-white">
                        Lokasi & Jam Operasional
                    </h2>
                    <p class="text-zinc-300 text-sm">
                        Nikmati sensasi santap di tempat (*Dine-In*) dengan suasana nyaman dan pelayanan ramah ala Minang.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 text-xl">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Alamat Lapau</h4>
                                <p class="text-xs text-zinc-300 mt-0.5">Jl. Raya Utama No. 88, Koto Tangah, Kota Padang, Sumatera Barat</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 text-xl">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Jam Buka</h4>
                                <p class="text-xs text-zinc-300 mt-0.5">Buka Setiap Hari: 08:00 - 22:00 WIB</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 text-xl">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm">WhatsApp & Pemesanan</h4>
                                <p class="text-xs text-zinc-300 mt-0.5">+62 812-3456-7890 (Uda Sutan Direct Line)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Placeholder Frame -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="h-80 sm:h-96 rounded-3xl overflow-hidden border-2 border-amber-500/30 relative glass-card shadow-2xl flex items-center justify-center text-center p-6">
                        <div class="space-y-3">
                            <div class="w-16 h-16 rounded-full bg-amber-500/20 text-amber-400 text-3xl flex items-center justify-center mx-auto">
                                <i class="bi bi-map-fill"></i>
                            </div>
                            <h4 class="font-serif-title font-bold text-xl text-white">Petunjuk Arah Google Maps</h4>
                            <p class="text-xs text-zinc-400 max-w-sm mx-auto">Cari "Lapau Uda Sutan Padang" di Google Maps atau Waze untuk navigasi langsung ke lokasi kami.</p>
                            <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-amber-500 text-zinc-950 font-bold text-xs">
                                <i class="bi bi-box-arrow-up-right"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-zinc-950 border-t border-amber-900/40 py-12 text-zinc-400 text-xs sm:text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-500 flex items-center justify-center text-zinc-950 font-bold text-lg">
                        <i class="bi bi-house-door-fill"></i>
                    </div>
                    <span class="font-serif-title font-bold text-lg text-white">LAPAU UDA SUTAN</span>
                </div>

                <!-- Copyright -->
                <p class="text-center">
                    &copy; {{ date('Y') }} Lapau Uda Sutan. Hak Cipta Dilindungi. Cita Rasa Minang Warisan Asli.
                </p>

                <!-- Socials -->
                <div class="flex items-center gap-4 text-lg text-zinc-400">
                    <a href="#" class="hover:text-amber-400 transition-colors"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="hover:text-amber-400 transition-colors"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="hover:text-amber-400 transition-colors"><i class="bi bi-facebook"></i></a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-emerald-400 transition-colors"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/6281234567890?text=Halo%20Uda%20Sutan,%20saya%20ingin%20pesan" target="_blank"
       class="fixed bottom-6 right-6 z-50 p-4 rounded-full bg-emerald-500 text-zinc-950 font-bold shadow-2xl shadow-emerald-950/80 hover:bg-emerald-400 hover:scale-110 transition-all flex items-center justify-center">
        <i class="bi bi-whatsapp text-2xl"></i>
    </a>

    <!-- AOS JS Init -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        });
    </script>
</body>

</html>
