<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengaturan Toko & Struk - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminPengaturanSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="pengaturan" />

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
                        <i class="fa-solid fa-sliders"></i>
                        <span>Konfigurasi Identitas Restoran & Struk Thermal POS</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Pengaturan Toko & Struk Kasir
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Atur profil warung Lapau Uda Sutan, footer struk thermal, pajak PB1 10%, dan koneksi printer Bluetooth/USB/LAN.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="testPrint()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-print"></i>
                        <span>Test Print Struk</span>
                    </button>
                    <button @click="saveSettings()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-base"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </div>

            {{-- 2. GRID SETTINGS SECTIONS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- SECTION 1 & 2: PROFIL RESTO & TEMPLATE STRUK (2 COLS) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Form Identitas Toko -->
                    <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-6 space-y-4">
                        <div class="pb-3 border-b border-zinc-100 flex items-center justify-between">
                            <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-store text-maroon-primary"></i>
                                Identitas & Profil Restoran
                            </h3>
                            <span class="text-xs text-zinc-400 font-medium">Informasi Toko Utama</span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <div>
                                <label class="block font-bold text-zinc-700 mb-1">Nama Restoran / Warung</label>
                                <input type="text" x-model="config.storeName" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 font-extrabold text-zinc-900 focus:ring-2 focus:ring-maroon-primary">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-bold text-zinc-700 mb-1">Tagline / Slogan</label>
                                    <input type="text" x-model="config.tagline" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                                </div>
                                <div>
                                    <label class="block font-bold text-zinc-700 mb-1">No WhatsApp Toko</label>
                                    <input type="text" x-model="config.phone" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                                </div>
                            </div>

                            <div>
                                <label class="block font-bold text-zinc-700 mb-1">Alamat Lengkap Restoran</label>
                                <textarea x-model="config.address" rows="2" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Form Template Struk Thermal -->
                    <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-6 space-y-4">
                        <div class="pb-3 border-b border-zinc-100 flex items-center justify-between">
                            <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-receipt text-maroon-primary"></i>
                                Format & Layout Struk Thermal POS
                            </h3>
                            <span class="text-xs text-zinc-400 font-medium">Kustomisasi Tampilan Struk</span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <div>
                                <label class="block font-bold text-zinc-700 mb-1">Pesan Footer Struk (Ucapan Terima Kasih)</label>
                                <input type="text" x-model="config.receiptFooter" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-bold text-zinc-700 mb-1">Lebar Kertas Struk Thermal</label>
                                    <select x-model="config.paperWidth" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold">
                                        <option value="58mm">58mm (Thermal Portable Bluetooth)</option>
                                        <option value="80mm">80mm (Desktop POS Network/USB)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold text-zinc-700 mb-1">Tarif Pajak Resto (PB1)</label>
                                    <select x-model="config.taxRate" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold">
                                        <option value="10">PB1 10% (Pajak Restoran)</option>
                                        <option value="0">Non-Pajak (0%)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Checkboxes Tampilan Struk -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                <label class="flex items-center gap-2 bg-zinc-50 p-3 rounded-xl border border-zinc-200 cursor-pointer">
                                    <input type="checkbox" x-model="config.showLogo" class="rounded text-maroon-primary">
                                    <span class="font-bold text-zinc-800">Tampilkan Logo Resto</span>
                                </label>
                                <label class="flex items-center gap-2 bg-zinc-50 p-3 rounded-xl border border-zinc-200 cursor-pointer">
                                    <input type="checkbox" x-model="config.showQrCode" class="rounded text-maroon-primary">
                                    <span class="font-bold text-zinc-800">Tampilkan QR Code Struk</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SECTION 3: PREVIEW STRUK THERMAL & PRINTER CONNECTION (1 COL) -->
                <div class="space-y-6">
                    
                    <!-- Preview Live Struk -->
                    <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-6 space-y-4">
                        <h3 class="text-sm font-extrabold text-zinc-900 flex items-center gap-2 pb-2 border-b border-zinc-100">
                            <i class="fa-solid fa-eye text-maroon-primary"></i> Live Preview Struk Thermal
                        </h3>

                        <div class="bg-amber-50/50 p-4 rounded-xl border border-amber-200/80 font-mono text-[11px] space-y-2 text-zinc-800">
                            <div class="text-center space-y-0.5">
                                <strong class="text-xs font-bold block" x-text="config.storeName"></strong>
                                <p class="text-[10px] text-zinc-600" x-text="config.address"></p>
                                <p class="text-[10px] text-zinc-600" x-text="'WA: ' + config.phone"></p>
                            </div>
                            <div class="border-b border-dashed border-zinc-400 py-1"></div>
                            <div class="flex justify-between"><span>Inv: INV-20260806-001</span><span>16:05</span></div>
                            <div class="flex justify-between"><span>Kasir: Kasir Sutan</span><span>Shift 1</span></div>
                            <div class="border-b border-dashed border-zinc-400 py-1"></div>
                            <div class="flex justify-between"><span>1x Rendang Special</span><span>24.000</span></div>
                            <div class="flex justify-between"><span>1x Teh Talua</span><span>12.000</span></div>
                            <div class="border-b border-dashed border-zinc-400 py-1"></div>
                            <div class="flex justify-between font-bold"><span>Total:</span><span>Rp 36.000</span></div>
                            <div class="flex justify-between"><span>Tunai:</span><span>Rp 50.000</span></div>
                            <div class="flex justify-between"><span>Kembali:</span><span>Rp 14.000</span></div>
                            <div class="border-b border-dashed border-zinc-400 py-1"></div>
                            <div class="text-center text-[10px] font-bold pt-1" x-text="config.receiptFooter"></div>
                        </div>
                    </div>

                    <!-- Koneksi Printer Thermal -->
                    <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-6 space-y-3">
                        <h3 class="text-sm font-extrabold text-zinc-900 flex items-center gap-2 pb-2 border-b border-zinc-100">
                            <i class="fa-solid fa-print text-maroon-primary"></i> Koneksi Printer POS
                        </h3>
                        <div class="space-y-2 text-xs">
                            <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between items-center">
                                <span class="font-bold text-emerald-800">Status Printer: Terhubung</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            </div>
                            <p class="text-[11px] text-zinc-500">Connected to <strong>RPP02N Bluetooth Thermal (58mm)</strong></p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminPengaturanSystem() {
            return {
                sidebarOpen: false,
                config: {
                    storeName: 'Lapau Uda Sutan - Masakan Padang Asli',
                    tagline: 'Lamang Di Sipaik, Sabana Rancak Rasa Minang',
                    phone: '0812-3456-7890',
                    address: 'Jl. Sudirman No. 45, Kota Padang, Sumatera Barat',
                    receiptFooter: 'Tarimo Kasiah Lah Belanja di Lapau Uda Sutan!',
                    paperWidth: '58mm',
                    taxRate: '10',
                    showLogo: true,
                    showQrCode: true
                },

                saveSettings() {
                    alert('Pengaturan Toko & Struk Thermal berhasil disimpan!');
                },

                testPrint() {
                    window.print();
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
