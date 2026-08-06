<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Akun Kasir - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminKelolaKasirSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="kelola-kasir" />

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
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Manajemen User Kasir & Otorisasi Hak Akses Wewenang</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Kelola Akun & Wewenang Kasir
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Pengaturan akun pengguna kasir, reset PIN transaksi 6-digit, penentuan batas wewenang void nota, dan pembagian jadwal shift harian.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="openAddKasirModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-user-plus text-base"></i>
                        <span>+ Tambah Kasir Baru</span>
                    </button>
                    <button @click="exportKasirExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Data (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Kasir --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Terdaftar</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900" x-text="kasirList.length + ' Kasir'">0 Kasir</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Semua Akun Aktif</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                {{-- Sedang Berjaga --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Sedang Berjaga Shift</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">2 Kasir</div>
                        <span class="text-[11px] text-emerald-600 font-bold">Shift 1 & 2 Active</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-user-clock"></i>
                    </div>
                </div>

                {{-- Kecepatan Transaksi --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Rata-rata Transaksi</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">142 Nota / Shift</div>
                        <span class="text-[11px] text-sky-600 font-bold">Akurasi Transaksi High</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                </div>

                {{-- Status Lock / Terkunci --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Akun Lock-Out PIN</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900">0 Terkunci</div>
                        <span class="text-[11px] text-zinc-400 font-medium">Status PIN Aman</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-zinc-100 text-zinc-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                </div>

            </div>

            {{-- 3. HAK AKSES & WEWENANG MATRIX (FITUR REKOMENDASI) --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-user-shield text-maroon-primary"></i>
                            Matriks Hak Akses Wewenang Operasional Kasir
                        </h3>
                        <p class="text-xs text-zinc-500">Konfigurasi batas otorisasi kasir untuk fitur berisiko tinggi (Void, Diskon, & Kas Out)</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg bg-rose-50 text-maroon-primary text-xs font-bold border border-rose-200">Keamanan POS</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    
                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900">Izin Void / Pembatalan Nota</span>
                            <i class="fa-solid fa-ban text-rose-500"></i>
                        </div>
                        <p class="text-zinc-500 text-[11px]">Setiap pembatalan item transaksi wajib memasukkan PIN Admin / Manager.</p>
                        <div class="pt-2 flex items-center justify-between border-t border-zinc-200/60">
                            <span class="text-[10px] font-bold text-maroon-primary">Butuh PIN Admin</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900">Batas Maksimal Diskon Kasir</span>
                            <i class="fa-solid fa-percent text-amber-600"></i>
                        </div>
                        <p class="text-zinc-500 text-[11px]">Kasir hanya berwenang memberi diskon promo maksimal 10% tanpa otorisasi.</p>
                        <div class="pt-2 flex items-center justify-between border-t border-zinc-200/60">
                            <span class="text-[10px] font-bold text-amber-700">Maks. 10% / Nota</span>
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-extrabold text-zinc-900">Pengajuan Kas Out Operasional</span>
                            <i class="fa-solid fa-receipt text-sky-600"></i>
                        </div>
                        <p class="text-zinc-500 text-[11px]">Maksimal pengeluaran laci tanpa persetujuan awal adalah Rp 50.000.</p>
                        <div class="pt-2 flex items-center justify-between border-t border-zinc-200/60">
                            <span class="text-[10px] font-bold text-sky-700">Limit Rp 50.000</span>
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 4. TABEL KELOLA AKUN KASIR --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Controls Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-users text-maroon-primary"></i>
                                Daftar Pengguna Kasir Lapau Uda Sutan
                            </h2>
                            <p class="text-xs text-zinc-500">Manajemen profil kasir, penugasan shift, dan status kredensial</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Shift Utama</label>
                            <select x-model="shiftFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Shift</option>
                                <option value="Shift 1 (Pagi)">Shift 1 (Pagi)</option>
                                <option value="Shift 2 (Sore)">Shift 2 (Sore)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Akun</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif / Cuti</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari nama kasir / NIP..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
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
                                <th class="py-3.5 px-4">Kasir & Avatar</th>
                                <th class="py-3.5 px-4">ID NIP</th>
                                <th class="py-3.5 px-4">Kontak WhatsApp</th>
                                <th class="py-3.5 px-4">Shift Tugas Default</th>
                                <th class="py-3.5 px-4">Level Akses</th>
                                <th class="py-3.5 px-4 text-center">Status PIN</th>
                                <th class="py-3.5 px-4 text-center">Status Akun</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="kasir in filteredKasirList" :key="kasir.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Profil Kasir -->
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl font-extrabold flex items-center justify-center text-xs shrink-0 bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 shadow-xs"
                                                 x-text="getInitials(kasir.name)">
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-zinc-900 text-xs" x-text="kasir.name"></h4>
                                                <span class="text-[10px] text-zinc-400 font-semibold" x-text="kasir.email"></span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- NIP -->
                                    <td class="py-3.5 px-4 text-zinc-500 font-mono text-[11px]" x-text="kasir.nip"></td>

                                    <!-- WhatsApp -->
                                    <td class="py-3.5 px-4 text-zinc-800 font-semibold" x-text="kasir.phone"></td>

                                    <!-- Shift Default -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-maroon-primary" x-text="kasir.defaultShift"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="kasir.shiftHours"></div>
                                    </td>

                                    <!-- Level Akses -->
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-zinc-100 text-zinc-800 border border-zinc-200" x-text="kasir.level"></span>
                                    </td>

                                    <!-- Status PIN -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-key mr-1"></i> PIN Set (******)
                                        </span>
                                    </td>

                                    <!-- Status Akun -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="kasir.status === 'Aktif' ? 'bg-emerald-100 text-emerald-800 border border-emerald-300/60' : 'bg-rose-100 text-rose-800 border border-rose-300/60'"
                                              x-text="kasir.status"></span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="editKasir(kasir)" class="px-2.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold transition cursor-pointer flex items-center gap-1">
                                                <i class="fa-solid fa-pen-to-square text-zinc-500"></i>
                                                <span>Edit</span>
                                            </button>
                                            <button @click="openResetPinModal(kasir)" class="px-2.5 py-1.5 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 text-maroon-dark text-xs font-extrabold transition cursor-pointer flex items-center gap-1 shadow-xs">
                                                <i class="fa-solid fa-key"></i>
                                                <span>Reset PIN</span>
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
                    <span>Menampilkan <strong x-text="filteredKasirList.length"></strong> pengguna kasir terdaftar</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL TAMBAH / EDIT KASIR --}}
        <div x-cloak x-show="showKasirModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showKasirModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showKasirModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-3 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900" x-text="isEdit ? 'Edit Profil Kasir' : 'Tambah Akun Kasir Baru'"></h3>
                    <p class="text-xs text-zinc-500">Lengkapi identitas kredensial & penugasan shift kasir</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Nama Lengkap Kasir</label>
                        <input type="text" x-model="formKasir.name" placeholder="Misal: Rahma Fitriani" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">ID NIP Kasir</label>
                            <input type="text" x-model="formKasir.nip" placeholder="KSR-004" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-mono focus:ring-2 focus:ring-maroon-primary">
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">No WhatsApp</label>
                            <input type="text" x-model="formKasir.phone" placeholder="0812-3456-7890" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-medium focus:ring-2 focus:ring-maroon-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Shift Tugas Default</label>
                            <select x-model="formKasir.defaultShift" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                                <option value="Shift 1 (Pagi)">Shift 1 (08:00 - 16:00)</option>
                                <option value="Shift 2 (Sore)">Shift 2 (16:00 - 22:00)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">Level Akses</label>
                            <select x-model="formKasir.level" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-bold focus:ring-2 focus:ring-maroon-primary">
                                <option value="Kasir Senior">Kasir Senior</option>
                                <option value="Kasir Standar">Kasir Standar</option>
                                <option value="Kasir Magang">Kasir Magang</option>
                            </select>
                        </div>
                    </div>

                    <template x-if="!isEdit">
                        <div>
                            <label class="block text-zinc-700 font-bold mb-1">PIN Keamanan (6-Digit)</label>
                            <input type="password" x-model="formKasir.pin" maxlength="6" placeholder="******" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2.5 font-mono text-center tracking-widest text-base font-extrabold focus:ring-2 focus:ring-maroon-primary">
                        </div>
                    </template>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex items-center justify-end gap-3">
                    <button @click="showKasirModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="saveKasir()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs shadow-md">
                        Simpan Akun
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL RESET PIN KASIR (FITUR OPSIONAL & KEAMANAN) --}}
        <div x-cloak x-show="showPinModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showPinModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showPinModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900" x-text="'Reset PIN: ' + selectedKasir.name"></h3>
                    <p class="text-xs text-zinc-500">Buat PIN 6-digit baru untuk otorisasi mesin kasir</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">PIN Baru (6-Digit Angka)</label>
                        <input type="password" x-model="newPin" maxlength="6" placeholder="******" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-3 font-mono text-center tracking-widest text-lg font-extrabold focus:ring-2 focus:ring-maroon-primary">
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <button @click="generateRandomPin()" class="w-full py-2 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl font-bold text-xs flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            <span>Generate PIN Acak</span>
                        </button>
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex justify-end gap-3">
                    <button @click="showPinModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="confirmResetPin()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-md">
                        Simpan PIN Baru
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminKelolaKasirSystem() {
            return {
                sidebarOpen: false,
                shiftFilter: 'all',
                statusFilter: 'all',
                searchQuery: '',
                showKasirModal: false,
                showPinModal: false,
                isEdit: false,
                newPin: '',
                selectedKasir: {},
                formKasir: { name: '', nip: '', phone: '', email: '', defaultShift: 'Shift 1 (Pagi)', level: 'Kasir Standar', pin: '' },

                kasirList: [
                    {
                        id: 1,
                        name: 'Kasir Sutan',
                        nip: 'KSR-001',
                        phone: '0812-6677-8899',
                        email: 'sutan@lapaudasutan.com',
                        defaultShift: 'Shift 1 (Pagi)',
                        shiftHours: '08:00 - 16:00',
                        level: 'Kasir Senior',
                        status: 'Aktif'
                    },
                    {
                        id: 2,
                        name: 'Kasir Rahma',
                        nip: 'KSR-002',
                        phone: '0813-1122-3344',
                        email: 'rahma@lapaudasutan.com',
                        defaultShift: 'Shift 2 (Sore)',
                        shiftHours: '16:00 - 22:00',
                        level: 'Kasir Standar',
                        status: 'Aktif'
                    },
                    {
                        id: 3,
                        name: 'Kasir Budi',
                        nip: 'KSR-003',
                        phone: '0819-9988-7766',
                        email: 'budi@lapaudasutan.com',
                        defaultShift: 'Shift 1 (Pagi)',
                        shiftHours: '08:00 - 16:00',
                        level: 'Kasir Magang',
                        status: 'Aktif'
                    }
                ],

                get filteredKasirList() {
                    return this.kasirList.filter(k => {
                        const matchShift = this.shiftFilter === 'all' || k.defaultShift === this.shiftFilter;
                        const matchStatus = this.statusFilter === 'all' || k.status === this.statusFilter;
                        const matchQuery = k.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || k.nip.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchShift && matchStatus && matchQuery;
                    });
                },

                getInitials(name) {
                    return name.split(' ').map(n => n[0]).join('').toUpperCase();
                },

                openAddKasirModal() {
                    this.isEdit = false;
                    this.formKasir = { name: '', nip: 'KSR-00' + (this.kasirList.length + 1), phone: '', email: '', defaultShift: 'Shift 1 (Pagi)', level: 'Kasir Standar', pin: '' };
                    this.showKasirModal = true;
                },

                editKasir(kasir) {
                    this.isEdit = true;
                    this.formKasir = { ...kasir };
                    this.showKasirModal = true;
                },

                saveKasir() {
                    if (this.isEdit) {
                        const idx = this.kasirList.findIndex(k => k.id === this.formKasir.id);
                        if (idx !== -1) this.kasirList[idx] = { ...this.formKasir };
                    } else {
                        this.formKasir.id = Date.now();
                        this.formKasir.status = 'Aktif';
                        this.formKasir.shiftHours = this.formKasir.defaultShift.includes('Pagi') ? '08:00 - 16:00' : '16:00 - 22:00';
                        this.formKasir.email = this.formKasir.name.toLowerCase().replace(/\s+/g, '') + '@lapaudasutan.com';
                        this.kasirList.push({ ...this.formKasir });
                    }
                    this.showKasirModal = false;
                    alert('Akun kasir berhasil disimpan!');
                },

                openResetPinModal(kasir) {
                    this.selectedKasir = kasir;
                    this.newPin = '';
                    this.showPinModal = true;
                },

                generateRandomPin() {
                    this.newPin = Math.floor(100000 + Math.random() * 900000).toString();
                },

                confirmResetPin() {
                    if (this.newPin.length !== 6) {
                        alert('PIN harus berupa 6 angka!');
                        return;
                    }
                    this.showPinModal = false;
                    alert(`PIN keamanan untuk ${this.selectedKasir.name} berhasil diubah ke: ${this.newPin}`);
                },

                exportKasirExcel() {
                    alert('Mengunduh Berkas Data Kredensial Kasir (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
