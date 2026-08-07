<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola QR & Meja Resto - Panel Admin | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- QR Code Generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

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
            #printableQrCard, #printableQrCard * {
                visibility: visible;
            }
            #printableQrCard {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminKelolaMejaSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="kelola-meja" />

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
                        <span>Manajemen QR Code Standee & Nomor Meja Self-Ordering</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Kelola Nomor Meja & QR Code
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Atur daftar meja restoran, cetak kartu QR Code standee meja, dan pantau status meja yang sedang aktif dipesan pelanggan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddMejaModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-plus text-base"></i>
                        <span>+ Tambah Meja Baru</span>
                    </button>
                    <button @click="printAllQrCards()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-print"></i>
                        <span>Cetak Masal QR Meja</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Meja --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Meja Resto</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900" x-text="mejaList.length + ' Meja'">0 Meja</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Area Utama, VIP, Outdoor</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-chair"></i>
                    </div>
                </div>

                {{-- Meja Terisi --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Meja Terisi / Pesanan Aktif</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700" x-text="occupiedCount + ' Meja'">0 Meja</div>
                        <span class="text-[11px] text-amber-800 font-bold bg-amber-50 px-2 py-0.5 rounded">Sedang Santap</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </div>

                {{-- Meja Kosong --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Meja Kosong (Ready)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600" x-text="emptyCount + ' Meja'">0 Meja</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Siap Ditempati</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                {{-- Total Scan QR --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Scan QR (Hari Ini)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">84 Scan</div>
                        <span class="text-[11px] text-sky-600 font-bold">Tingkat Self-Order High</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                </div>

            </div>

            {{-- 3. FILTER AREA & LIST GRID MEJA RESTO --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-3 border-b border-zinc-100">
                    <!-- Filter Area Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button @click="areaFilter = 'all'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="areaFilter === 'all' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Semua Area (<span x-text="mejaList.length"></span>)
                        </button>
                        <button @click="areaFilter = 'Area Utama'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="areaFilter === 'Area Utama' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Area Utama (Lantai 1)
                        </button>
                        <button @click="areaFilter = 'VIP AC'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="areaFilter === 'VIP AC' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Ruang VIP AC
                        </button>
                        <button @click="areaFilter = 'Outdoor Terasi'" 
                                class="px-3.5 py-2 rounded-xl text-xs font-bold transition"
                                :class="areaFilter === 'Outdoor Terasi' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            Outdoor & Teras
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" x-model="searchQuery" placeholder="Cari nomor meja..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                    </div>
                </div>

                <!-- GRID CARD MEJA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pt-2">
                    <template x-for="meja in filteredMejaList" :key="meja.id">
                        <div class="bg-white rounded-2xl border border-zinc-200 shadow-xs hover:shadow-md transition p-5 space-y-4 relative flex flex-col justify-between overflow-hidden group">
                            
                            <!-- Top Status Indicator Line -->
                            <div class="absolute top-0 left-0 right-0 h-1.5"
                                 :class="meja.status === 'Terisi' ? 'bg-amber-500' : 'bg-emerald-500'"></div>

                            <div class="space-y-3">
                                <!-- Header Meja & Status Badge -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 font-extrabold text-sm flex items-center justify-center shadow-xs">
                                            <span x-text="meja.number"></span>
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-zinc-900 text-sm" x-text="'Meja ' + meja.number"></h4>
                                            <span class="text-[10px] text-zinc-400 font-semibold" x-text="meja.area"></span>
                                        </div>
                                    </div>

                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                          :class="meja.status === 'Terisi' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800'"
                                          x-text="meja.status"></span>
                                </div>

                                <!-- QR Preview Frame -->
                                <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-100 flex flex-col items-center justify-center space-y-2">
                                    <!-- QR Image Placeholder / Simulated QR -->
                                    <div class="w-24 h-24 bg-white p-2 rounded-lg border border-zinc-200 flex items-center justify-center shadow-2xs">
                                        <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=' + encodeURIComponent(getQrUrl(meja.number))" alt="QR Code Meja" class="w-full h-full object-contain">
                                    </div>
                                    <span class="text-[10px] text-zinc-400 font-mono truncate max-w-[180px]" x-text="getQrUrl(meja.number)"></span>
                                </div>
                            </div>

                            <!-- Footer Actions -->
                            <div class="pt-3 border-t border-zinc-100 flex items-center justify-between gap-2">
                                <a :href="getQrUrl(meja.number)" target="_blank" class="flex-1 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-[11px] font-bold transition flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-zinc-500"></i>
                                    <span>Simulasi Scan</span>
                                </a>

                                <button @click="openPrintModal(meja)" class="py-1.5 px-3 rounded-lg bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white text-[11px] font-extrabold transition shadow-xs flex items-center gap-1 cursor-pointer">
                                    <i class="fa-solid fa-print"></i>
                                    <span>Cetak Standee</span>
                                </button>
                            </div>

                        </div>
                    </template>
                </div>
            </div>

        </div>

        {{-- MODAL STANDEE STIKER QR MEJA (PRINTABLE CARD) --}}
        <div x-cloak x-show="showPrintModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showPrintModal = false" class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl relative space-y-5" id="printableQrCard">
                <button @click="showPrintModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <!-- Standee Card Frame Design -->
                <div class="bg-gradient-to-b from-maroon-dark via-maroon-primary to-maroon-dark text-white rounded-2xl p-6 text-center space-y-4 border-2 border-amber-400 shadow-xl relative overflow-hidden">
                    <div class="w-12 h-12 rounded-xl bg-amber-400 text-maroon-dark flex items-center justify-center font-black text-xl mx-auto shadow-md">
                        <i class="fa-solid fa-utensils"></i>
                    </div>

                    <div>
                        <h3 class="text-xs font-black text-amber-300 uppercase tracking-widest">LAPAU UDA SUTAN</h3>
                        <h2 class="text-2xl font-extrabold text-white mt-1" x-text="'MEJA ' + selectedMeja.number"></h2>
                        <p class="text-[10px] text-zinc-200 mt-0.5" x-text="selectedMeja.area"></p>
                    </div>

                    <!-- QR Code Frame -->
                    <div class="bg-white p-3 rounded-2xl w-40 h-40 mx-auto shadow-inner flex items-center justify-center">
                        <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=' + encodeURIComponent(getQrUrl(selectedMeja.number))" alt="QR Meja" class="w-full h-full object-contain">
                    </div>

                    <div class="space-y-1 pt-1">
                        <p class="text-xs font-bold text-amber-300">Pesan Masakan Padang Lewat HP</p>
                        <p class="text-[10px] text-zinc-200">Scan QR Code ini untuk memilih menu & langsung bayar dari meja Anda!</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button @click="showPrintModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Tutup
                    </button>
                    <button @click="window.print()" class="px-5 py-2 rounded-xl bg-maroon-primary text-white font-extrabold text-xs shadow-md flex items-center gap-1.5">
                        <i class="fa-solid fa-print"></i> Cetak Kartu Standee
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL TAMBAH MEJA BARU --}}
        <div x-cloak x-show="showAddModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showAddModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showAddModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900">Tambah Meja Resto Baru</h3>
                    <p class="text-xs text-zinc-500">Buat nomor meja & QR code pemesanan baru</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Nomor Meja (Misal: 21)</label>
                        <input type="text" x-model="formMeja.number" placeholder="21" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-extrabold">
                    </div>

                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Area Restoran</label>
                        <select x-model="formMeja.area" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold">
                            <option value="Area Utama">Area Utama (Lantai 1)</option>
                            <option value="VIP AC">Ruang VIP AC</option>
                            <option value="Outdoor Terasi">Outdoor & Teras</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex justify-end gap-3">
                    <button @click="showAddModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="saveMeja()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan Meja Baru
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminKelolaMejaSystem() {
            return {
                sidebarOpen: false,
                areaFilter: 'all',
                searchQuery: '',
                showPrintModal: false,
                showAddModal: false,
                selectedMeja: {},
                formMeja: { number: '', area: 'Area Utama' },

                mejaList: [
                    { id: 1, number: '01', area: 'Area Utama', status: 'Terisi' },
                    { id: 2, number: '02', area: 'Area Utama', status: 'Kosong' },
                    { id: 3, number: '03', area: 'Area Utama', status: 'Terisi' },
                    { id: 4, number: '04', area: 'Area Utama', status: 'Kosong' },
                    { id: 5, number: '05', area: 'Area Utama', status: 'Terisi' },
                    { id: 6, number: '06', area: 'VIP AC', status: 'Kosong' },
                    { id: 7, number: '07', area: 'VIP AC', status: 'Terisi' },
                    { id: 8, number: '08', area: 'VIP AC', status: 'Kosong' },
                    { id: 9, number: '09', area: 'Outdoor Terasi', status: 'Kosong' },
                    { id: 10, number: '10', area: 'Outdoor Terasi', status: 'Terisi' }
                ],

                get filteredMejaList() {
                    return this.mejaList.filter(m => {
                        const matchArea = this.areaFilter === 'all' || m.area === this.areaFilter;
                        const matchQuery = m.number.includes(this.searchQuery) || m.area.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchArea && matchQuery;
                    });
                },

                get occupiedCount() {
                    return this.mejaList.filter(m => m.status === 'Terisi').length;
                },

                get emptyCount() {
                    return this.mejaList.filter(m => m.status === 'Kosong').length;
                },

                getQrUrl(number) {
                    return window.location.origin + '/order/meja/' + number;
                },

                openPrintModal(meja) {
                    this.selectedMeja = meja;
                    this.showPrintModal = true;
                },

                openAddMejaModal() {
                    this.formMeja = { number: (this.mejaList.length + 1).toString().padStart(2, '0'), area: 'Area Utama' };
                    this.showAddModal = true;
                },

                saveMeja() {
                    this.mejaList.push({
                        id: Date.now(),
                        number: this.formMeja.number,
                        area: this.formMeja.area,
                        status: 'Kosong'
                    });
                    this.showAddModal = false;
                    alert(`Meja ${this.formMeja.number} berhasil ditambahkan!`);
                },

                printAllQrCards() {
                    window.print();
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
