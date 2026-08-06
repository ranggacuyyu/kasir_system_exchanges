<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pelanggan & Catering - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminPelangganCateringSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="pelanggan" />

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
                        <i class="fa-solid fa-address-book"></i>
                        <span>Manajemen CRM Pelanggan VIP & Order Catering Box</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Pelanggan & Order Catering Box
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Kelola data pelanggan langganan kantor/corporate, jadwal pengiriman catering nasi box besar, dan penukaran poin reward pelanggan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddCateringModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-box-archive text-base"></i>
                        <span>+ Order Catering Baru</span>
                    </button>
                    <button @click="openAddPelangganModal()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>+ Pelanggan VIP</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Pelanggan --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Pelanggan VIP & Corporate</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900" x-text="pelangganList.length + ' Member'">0 Member</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">18 Instansi Langganan</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-building-user"></i>
                    </div>
                </div>

                {{-- Catering Aktif --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Order Catering Aktif</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600" x-text="cateringList.length + ' Pesanan'">0 Pesanan</div>
                        <span class="text-[11px] text-emerald-600 font-bold">Sedang Dalam Jadwal</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-truck-ramp-box"></i>
                    </div>
                </div>

                {{-- Total Box Dipesan --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Box Minggu Ini</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700">450 Box</div>
                        <span class="text-[11px] text-amber-800 font-bold bg-amber-50 px-2 py-0.5 rounded">Kapasitas Dapur 80%</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-box font-bold"></i>
                    </div>
                </div>

                {{-- Omset Catering --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Estimasi Omset Catering</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">Rp 14.500.000</div>
                        <span class="text-[11px] text-sky-600 font-bold">DP Masuk 60%</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>

            </div>

            {{-- 3. TAB NAVIGASI & CONTROL FILTER --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-3 border-b border-zinc-100">
                    <!-- Tab Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button @click="activeTab = 'catering'" 
                                class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2"
                                :class="activeTab === 'catering' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            <i class="fa-solid fa-truck-ramp-box"></i>
                            <span>Daftar Order Catering Box (<span x-text="cateringList.length"></span>)</span>
                        </button>
                        <button @click="activeTab = 'pelanggan'" 
                                class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2"
                                :class="activeTab === 'pelanggan' ? 'bg-maroon-primary text-white shadow-xs' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200'">
                            <i class="fa-solid fa-users"></i>
                            <span>Database Pelanggan VIP (<span x-text="pelangganList.length"></span>)</span>
                        </button>
                    </div>

                    <!-- Search Box -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" x-model="searchQuery" placeholder="Cari pesanan / nama..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                    </div>
                </div>

                {{-- CONTENT 1: TABEL PESANAN CATERING --}}
                <div x-show="activeTab === 'catering'" class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[900px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Pemesan & Instansi</th>
                                <th class="py-3.5 px-4">Paket Nasi Box</th>
                                <th class="py-3.5 px-4 text-center">Jumlah Box</th>
                                <th class="py-3.5 px-4">Jadwal Kirim</th>
                                <th class="py-3.5 px-4 text-right">Total Tagihan</th>
                                <th class="py-3.5 px-4 text-center">Status DP / Pembayaran</th>
                                <th class="py-3.5 px-4 text-center">Status Dapur</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="item in filteredCateringList" :key="item.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Pemesan -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900 text-xs" x-text="item.customerName"></div>
                                        <div class="text-[10px] text-zinc-400 font-semibold" x-text="item.phone + ' • ' + item.type"></div>
                                    </td>

                                    <!-- Paket Box -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-maroon-primary" x-text="item.packageName"></div>
                                        <div class="text-[10px] text-zinc-500 truncate max-w-xs" x-text="item.note"></div>
                                    </td>

                                    <!-- Jumlah Box -->
                                    <td class="py-3.5 px-4 text-center font-extrabold text-zinc-900" x-text="item.qty + ' Box'"></td>

                                    <!-- Jadwal Kirim -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-zinc-800" x-text="item.deliverDate"></div>
                                        <div class="text-[10px] text-amber-800 font-bold" x-text="'Jam: ' + item.deliverTime + ' WIB'"></div>
                                    </td>

                                    <!-- Total Tagihan -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-maroon-primary" x-text="formatRupiah(item.totalPrice)"></td>

                                    <!-- Status DP -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold"
                                              :class="item.payStatus === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'"
                                              x-text="item.payStatus"></span>
                                    </td>

                                    <!-- Status Dapur -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="item.kitchenStatus === 'Diproses Dapur' ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-emerald-100 text-emerald-800 border border-emerald-300'"
                                              x-text="item.kitchenStatus"></span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="updateCateringStatus(item)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition">
                                                <i class="fa-solid fa-truck-fast text-zinc-500 mr-1"></i> Update Status
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- CONTENT 2: TABEL DATABASE PELANGGAN VIP --}}
                <div x-show="activeTab === 'pelanggan'" class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Nama Pelanggan / Instansi</th>
                                <th class="py-3.5 px-4">Kontak WhatsApp</th>
                                <th class="py-3.5 px-4">Tipe Member</th>
                                <th class="py-3.5 px-4 text-center">Poin Reward</th>
                                <th class="py-3.5 px-4 text-right">Total Transaksi</th>
                                <th class="py-3.5 px-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="p in filteredPelangganList" :key="p.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900 text-xs" x-text="p.name"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="p.address"></div>
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-zinc-800" x-text="p.phone"></td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold"
                                              :class="p.type === 'Corporate' ? 'bg-maroon-primary text-amber-300' : 'bg-zinc-100 text-zinc-800'"
                                              x-text="p.type"></span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center font-extrabold text-amber-700" x-text="p.points + ' Pts'"></td>
                                    <td class="py-3.5 px-4 text-right font-extrabold text-emerald-700" x-text="formatRupiah(p.totalSpend)"></td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold">Member VIP</span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        {{-- MODAL TAMBAH CATERING --}}
        <div x-cloak x-show="showAddCateringModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showAddCateringModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showAddCateringModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900">Buat Pesanan Catering Nasi Box Baru</h3>
                    <p class="text-xs text-zinc-500">Catat pesanan nasi box instansi / rombongan</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Nama Pemesan / Instansi</label>
                        <input type="text" x-model="formCatering.customerName" placeholder="Misal: PT Semen Padang" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">No WhatsApp</label>
                            <input type="text" x-model="formCatering.phone" placeholder="0812-3456-7890" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Jumlah Box</label>
                            <input type="number" x-model.number="formCatering.qty" placeholder="100" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-extrabold">
                        </div>
                    </div>

                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Paket Nasi Box Dipesan</label>
                        <select x-model="formCatering.packageName" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold">
                            <option value="Paket Nasi Rendang Special Box">Paket Nasi Rendang Special Box (Rp 32.000/box)</option>
                            <option value="Paket Nasi Ayam Pop Komplit">Paket Nasi Ayam Pop Komplit (Rp 30.000/box)</option>
                            <option value="Paket Nasi Dendeng Balado Box">Paket Nasi Dendeng Balado Box (Rp 32.000/box)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Tanggal Pengiriman</label>
                            <input type="text" x-model="formCatering.deliverDate" placeholder="7 Agustus 2026" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Jam Tiba Lokasi</label>
                            <input type="text" x-model="formCatering.deliverTime" placeholder="11:30" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium">
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex justify-end gap-3">
                    <button @click="showAddCateringModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="saveCatering()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan Order Catering
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminPelangganCateringSystem() {
            return {
                sidebarOpen: false,
                activeTab: 'catering',
                searchQuery: '',
                showAddCateringModal: false,
                showAddPelangganModal: false,
                formCatering: { customerName: '', phone: '', qty: 100, packageName: 'Paket Nasi Rendang Special Box', deliverDate: '7 Agustus 2026', deliverTime: '11:30' },

                cateringList: [
                    {
                        id: 1,
                        customerName: 'PT Semen Padang',
                        phone: '0811-6655-4433',
                        type: 'Corporate',
                        packageName: 'Paket Nasi Rendang Special Box',
                        qty: 100,
                        deliverDate: '7 Agustus 2026',
                        deliverTime: '11:30',
                        totalPrice: 3200000,
                        payStatus: 'DP 50%',
                        kitchenStatus: 'Diproses Dapur',
                        note: 'Nasi hangat terpisah, sambal ijo dipisah plastik.'
                    },
                    {
                        id: 2,
                        customerName: 'Bank Nagari Cab. Utama',
                        phone: '0812-9988-7711',
                        type: 'Corporate',
                        packageName: 'Paket Nasi Ayam Pop Komplit',
                        qty: 50,
                        deliverDate: '8 Agustus 2026',
                        deliverTime: '12:00',
                        totalPrice: 1500000,
                        payStatus: 'Menunggu DP',
                        kitchenStatus: 'Jadwal Pesanan',
                        note: 'Tambahan Teh Talua 50 Cup.'
                    },
                    {
                        id: 3,
                        customerName: 'Keluarga Uda Rahmad',
                        phone: '0813-4455-6677',
                        type: 'Personal VIP',
                        packageName: 'Paket Nasi Mixed Rendang & Dendeng',
                        qty: 150,
                        deliverDate: '10 Agustus 2026',
                        deliverTime: '10:00',
                        totalPrice: 4800000,
                        payStatus: 'Lunas',
                        kitchenStatus: 'Diproses Dapur',
                        note: 'Untuk acara syukuran keluarga.'
                    }
                ],

                pelangganList: [
                    { id: 101, name: 'PT Semen Padang', phone: '0811-6655-4433', type: 'Corporate', points: 340, totalSpend: 18500000, address: 'Indarung, Kec. Lubuk Kilangan, Kota Padang' },
                    { id: 102, name: 'Bank Nagari Cab. Utama', phone: '0812-9988-7711', type: 'Corporate', points: 180, totalSpend: 9200000, address: 'Jl. Pemuda No.21, Kota Padang' },
                    { id: 103, name: 'Uda Rahmad (VIP Member)', phone: '0813-4455-6677', type: 'Personal VIP', points: 120, totalSpend: 5400000, address: 'Kuranji, Kota Padang' }
                ],

                get filteredCateringList() {
                    return this.cateringList.filter(c => c.customerName.toLowerCase().includes(this.searchQuery.toLowerCase()) || c.packageName.toLowerCase().includes(this.searchQuery.toLowerCase()));
                },

                get filteredPelangganList() {
                    return this.pelangganList.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                openAddCateringModal() {
                    this.showAddCateringModal = true;
                },

                openAddPelangganModal() {
                    alert('Form Registrasi Pelanggan VIP Baru...');
                },

                saveCatering() {
                    this.formCatering.id = Date.now();
                    this.formCatering.totalPrice = this.formCatering.qty * 32000;
                    this.formCatering.type = 'Corporate';
                    this.formCatering.payStatus = 'DP 50%';
                    this.formCatering.kitchenStatus = 'Diproses Dapur';
                    this.cateringList.unshift({ ...this.formCatering });
                    this.showAddCateringModal = false;
                    alert('Order Catering berhasil dibuat!');
                },

                updateCateringStatus(item) {
                    item.kitchenStatus = 'Siap Dikirim / Selesai';
                    alert(`Status order ${item.customerName} diperbarui ke Siap Dikirim!`);
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
