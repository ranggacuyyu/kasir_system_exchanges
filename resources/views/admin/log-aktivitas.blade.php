<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log Keamanan & Audit - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminLogAktivitasSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="log-aktivitas" />

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
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Audit Trail Keamanan & Monitoring Aktivitas Pengguna</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Log Keamanan & Audit Aktivitas
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Catatan riwayat audit lengkap seluruh aktivitas pengguna, verifikasi login IP terminal kasir, perubahan stok, dan otorisasi void.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="exportLogExcel()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        <span>Export Log (.xlsx)</span>
                    </button>
                    <button @click="refreshLogs()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-rotate" :class="loading ? 'animate-spin' : ''"></i>
                        <span>Refresh Logs</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Total Log --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total Log (Hari Ini)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900" x-text="logs.length + ' Aktivitas'">0 Aktivitas</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Recorded System</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                </div>

                {{-- Login Berhasil --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Sesi Login Aktif</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">3 Device IP</div>
                        <span class="text-[11px] text-emerald-600 font-bold">Autentikasi Valid</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </div>
                </div>

                {{-- Warning Alert --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Percobaan Gagal (Attempt)</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900">0 Warning</div>
                        <span class="text-[11px] text-zinc-400 font-medium">Status PIN Aman</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-zinc-100 text-zinc-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                {{-- Transaksi Void --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Otorisasi Disetujui</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">2 Transaksi</div>
                        <span class="text-[11px] text-sky-600 font-bold">PIN Admin Verified</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                </div>

            </div>

            {{-- 3. TABEL AUDIT LOG KELOLA KEAMANAN --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Header Control Bar -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Log Jejak Audit Keamanan Sistem POS
                            </h2>
                            <p class="text-xs text-zinc-500">Log kronologis perubahan data dan otorisasi pengguna</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Pengguna</label>
                            <select x-model="userFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Pengguna</option>
                                <option value="Uda Sutan (Admin)">Uda Sutan (Admin)</option>
                                <option value="Kasir Sutan">Kasir Sutan</option>
                                <option value="Kasir Rahma">Kasir Rahma</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Kategori Aktivitas</label>
                            <select x-model="categoryFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kategori</option>
                                <option value="Presensi GPS">Presensi GPS</option>
                                <option value="Audit Void">Audit Void</option>
                                <option value="Master Stok">Master Stok</option>
                                <option value="Autentikasi">Autentikasi Login</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari aktivitas / IP..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
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
                                <th class="py-3.5 px-4">Waktu Event</th>
                                <th class="py-3.5 px-4">Pengguna</th>
                                <th class="py-3.5 px-4">Aktivitas System</th>
                                <th class="py-3.5 px-4">Kategori Audit</th>
                                <th class="py-3.5 px-4">IP Address Terminal</th>
                                <th class="py-3.5 px-4 text-center">Status Level</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="log in filteredLogs" :key="log.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Waktu -->
                                    <td class="py-3.5 px-4">
                                        <div class="text-zinc-900 font-bold" x-text="log.date"></div>
                                        <div class="text-[10px] text-zinc-400 font-mono" x-text="log.time"></div>
                                    </td>

                                    <!-- Pengguna -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900" x-text="log.user"></div>
                                        <div class="text-[10px] text-maroon-primary font-semibold" x-text="log.role"></div>
                                    </td>

                                    <!-- Aktivitas -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-zinc-800" x-text="log.action"></div>
                                        <div class="text-[10px] text-zinc-500" x-text="log.detail"></div>
                                    </td>

                                    <!-- Kategori Audit -->
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-zinc-100 text-zinc-700" x-text="log.category"></span>
                                    </td>

                                    <!-- IP Address -->
                                    <td class="py-3.5 px-4 font-mono text-zinc-600 text-[11px]" x-text="log.ip"></td>

                                    <!-- Status Level -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold"
                                              :class="{
                                                  'bg-emerald-100 text-emerald-800': log.level === 'Info',
                                                  'bg-amber-100 text-amber-800': log.level === 'Warning',
                                                  'bg-rose-100 text-rose-800': log.level === 'Security'
                                              }">
                                            <i class="fa-solid mr-1" :class="log.level === 'Info' ? 'fa-info-circle' : 'fa-triangle-exclamation'"></i>
                                            <span x-text="log.level"></span>
                                        </span>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredLogs.length"></strong> jejak audit log keamanan</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminLogAktivitasSystem() {
            return {
                sidebarOpen: false,
                loading: false,
                userFilter: 'all',
                categoryFilter: 'all',
                searchQuery: '',

                logs: [
                    {
                        id: 1,
                        date: '6 Agustus 2026',
                        time: '16:05:12 WIB',
                        user: 'Kasir Sutan',
                        role: 'Kasir Shift 1',
                        action: 'Submisi Laporan Penutupan Shift 1',
                        detail: 'Fisik laci Rp 1.900.000 (Balanced / PAS)',
                        category: 'Audit Kas',
                        ip: '192.168.1.15',
                        level: 'Info'
                    },
                    {
                        id: 2,
                        date: '6 Agustus 2026',
                        time: '14:20:45 WIB',
                        user: 'Uda Sutan (Admin)',
                        role: 'Super Admin',
                        action: 'Otorisasi PIN Void Transaksi INV-20260806-004',
                        detail: 'Item Ayam Pop (1 Porsi) dibatalkan',
                        category: 'Audit Void',
                        ip: '192.168.1.100',
                        level: 'Info'
                    },
                    {
                        id: 3,
                        date: '6 Agustus 2026',
                        time: '07:52:01 WIB',
                        user: 'Kasir Sutan',
                        role: 'Kasir Shift 1',
                        action: 'Presensi Clock-In Geolocation GPS',
                        detail: 'Radius RESTO locked (12 meter dari warung)',
                        category: 'Presensi GPS',
                        ip: '192.168.1.15',
                        level: 'Info'
                    }
                ],

                get filteredLogs() {
                    return this.logs.filter(log => {
                        const matchUser = this.userFilter === 'all' || log.user === this.userFilter;
                        const matchCategory = this.categoryFilter === 'all' || log.category === this.categoryFilter;
                        const matchQuery = log.action.toLowerCase().includes(this.searchQuery.toLowerCase()) || log.ip.includes(this.searchQuery);
                        return matchUser && matchCategory && matchQuery;
                    });
                },

                refreshLogs() {
                    this.loading = true;
                    setTimeout(() => this.loading = false, 600);
                },

                exportLogExcel() {
                    alert('Mengunduh Log Keamanan & Audit System (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
