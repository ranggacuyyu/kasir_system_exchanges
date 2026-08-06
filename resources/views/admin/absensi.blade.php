<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Absensi & Shift Kasir - Panel Admin | Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet.js Interactive Map CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f3ed; /* --color-base */
        }
        #adminMap {
            height: 280px;
            border-radius: 1rem;
            z-index: 10;
        }
        .leaflet-container {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminAbsensiSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="absensi" />

    <!-- Top Navbar Component -->
    <x-admin.navbar />

    <!-- Main Content Area -->
    <main class="pt-20 pb-16 md:pl-64 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- 1. HEADER BANNER ABSENSI --}}
            <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary rounded-3xl p-6 md:p-8 border border-maroon-light/30 shadow-xl relative overflow-hidden text-white flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Background Accent Glows -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="space-y-2 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-dark/80 border border-amber-400/30 text-amber-300 text-xs font-bold shadow-inner">
                        <i class="fa-solid fa-user-clock"></i>
                        <span>Audit Geolocation GPS & Penjadwalan Shift Kasir</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Absensi & Shift Kasir
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Monitoring kehadiran jam kerja kasir real-time, verifikasi koordinat lokasi GPS radius warung, dan kelola penugasan shift harian.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="alert('Form Atur Jadwal Shift Kasir...')" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <span>Atur Jadwal Shift</span>
                    </button>
                    <button @click="exportAbsensi()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        <span>Export Rekap Absensi (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Kasir Hadir Hari Ini</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">2 / 3 Kasir</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">66.7% Tingkat Kehadiran</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Tingkat Ketepatan Waktu</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-700">100% On-Time</div>
                        <span class="text-[11px] text-emerald-600 font-bold">Tidak Ada Keterlambatan</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-stopwatch text-xl"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Akumulasi Jam Kerja</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">14.2 Jam</div>
                        <span class="text-[11px] text-sky-600 font-bold">Total Shift 1 & 2</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-business-time"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Pengajuan Izin / Cuti</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-800">0 Permohonan</div>
                        <span class="text-[11px] font-bold text-zinc-400">Semua Terproses</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                </div>
            </div>

            {{-- 3. INTERACTIVE GPS RADAR MAP & LIVE STATUS --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs p-5 md:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-map-location-dot text-maroon-primary"></i>
                            Radar Kehadiran GPS Geolocation Resto
                        </h3>
                        <p class="text-xs text-zinc-500">Peta titik lokasi presensi kasir & verifikasi radius 50 meter Lapau Uda Sutan</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Koordinat Resto Locked: Padang (-0.9471, 100.3543)
                        </span>
                    </div>
                </div>

                <!-- Leaflet Map Canvas -->
                <div id="adminMap" class="w-full"></div>
            </div>

            {{-- 4. TABEL REKAP ABSENSI & KINERJA KASIR --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <!-- Table Controls Header -->
                <div class="p-5 md:p-6 border-b border-zinc-100 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                                <i class="fa-solid fa-list-check text-maroon-primary"></i>
                                Log Kehadiran & Audit Absensi Kasir
                            </h2>
                            <p class="text-xs text-zinc-500">Daftar presensi clock-in & clock-out terverifikasi GPS</p>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Periode</label>
                            <select x-model="periodFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="today">Hari Ini (6 Agustus 2026)</option>
                                <option value="yesterday">Kemarin</option>
                                <option value="this_week">Minggu Ini</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Filter Kasir</label>
                            <select x-model="cashierFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Kasir</option>
                                <option value="Kasir Sutan">Kasir Sutan</option>
                                <option value="Kasir Rahma">Kasir Rahma</option>
                                <option value="Kasir Budi">Kasir Budi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Status Kehadiran</label>
                            <select x-model="statusFilter" class="w-full bg-zinc-50 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-800 focus:ring-2 focus:ring-maroon-primary">
                                <option value="all">Semua Status</option>
                                <option value="Hadir">Hadir (Tepat Waktu)</option>
                                <option value="Izin">Izin / Sakit</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-zinc-500 mb-1 uppercase">Pencarian</label>
                            <div class="relative">
                                <input type="text" x-model="searchQuery" placeholder="Cari nama kasir..." class="w-full bg-zinc-50 border border-zinc-200 text-xs rounded-xl pl-8 pr-3 py-2 font-medium">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[850px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Kasir & Avatar</th>
                                <th class="py-3.5 px-4">Shift Tugas</th>
                                <th class="py-3.5 px-4">Clock-In (Masuk)</th>
                                <th class="py-3.5 px-4">Clock-Out (Keluar)</th>
                                <th class="py-3.5 px-4">Durasi Kerja</th>
                                <th class="py-3.5 px-4 text-center">Verifikasi GPS</th>
                                <th class="py-3.5 px-4 text-center">Status</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="log in filteredAttendanceLogs" :key="log.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Kasir & Avatar -->
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl font-extrabold flex items-center justify-center text-xs shrink-0 bg-maroon-primary text-amber-300"
                                                 x-text="getInitials(log.cashierName)">
                                            </div>
                                            <div>
                                                <h4 class="font-extrabold text-zinc-900 text-xs" x-text="log.cashierName"></h4>
                                                <span class="text-[10px] text-zinc-400 font-semibold" x-text="'ID: ' + log.cashierId"></span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Shift Tugas -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-zinc-800" x-text="log.shiftName"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="log.shiftHours"></div>
                                    </td>

                                    <!-- Clock In -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-emerald-700" x-text="log.clockIn"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="log.date"></div>
                                    </td>

                                    <!-- Clock Out -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-800" x-text="log.clockOut || 'Sedang Bertugas'"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="log.clockOut ? log.date : 'Shift Aktif'"></div>
                                    </td>

                                    <!-- Durasi Kerja -->
                                    <td class="py-3.5 px-4 font-bold text-zinc-700" x-text="log.duration"></td>

                                    <!-- Verifikasi GPS -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-circle-check mr-1"></i> Radius OK (&lt; 20m)
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold"
                                              :class="log.status === 'Hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'"
                                              x-text="log.status"></span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <button @click="openLogDetail(log)" class="px-3 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-bold transition cursor-pointer">
                                            <i class="fa-solid fa-eye text-zinc-500 mr-1"></i> Audit GPS
                                        </button>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Summary -->
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-zinc-500 gap-2">
                    <span>Menampilkan <strong x-text="filteredAttendanceLogs.length"></strong> dari <strong x-text="attendanceLogs.length"></strong> log absensi</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400 disabled:opacity-50" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL DETAIL GPS & VERIFIKASI PRESENSI --}}
        <div x-cloak x-show="showDetailModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showDetailModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative space-y-5">
                <button @click="showDetailModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="flex items-center gap-4 pb-3 border-b border-zinc-100">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 flex items-center justify-center font-extrabold text-lg shadow shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900" x-text="'Audit Presensi GPS: ' + selectedLog.cashierName"></h3>
                        <p class="text-xs text-zinc-500" x-text="selectedLog.shiftName + ' • ' + selectedLog.date"></p>
                    </div>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex justify-between">
                        <span class="text-zinc-500 font-bold">Jam Masuk (Clock-In):</span>
                        <strong class="text-emerald-700 font-extrabold" x-text="selectedLog.clockIn"></strong>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-xl border border-zinc-200 flex justify-between">
                        <span class="text-zinc-500 font-bold">Koordinat GPS Presisi:</span>
                        <strong class="text-zinc-900 font-mono">-0.94712, 100.35431</strong>
                    </div>

                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 flex justify-between">
                        <span class="text-emerald-800 font-bold">Akurasi Radius Resto:</span>
                        <strong class="text-emerald-800 font-extrabold">12 Meter (Di Dalam Toko)</strong>
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <button @click="showDetailModal = false" class="px-5 py-2.5 rounded-xl bg-maroon-primary text-white text-xs font-bold">
                        Tutup Audit
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js & Leaflet Init -->
    <script>
        function adminAbsensiSystem() {
            return {
                sidebarOpen: false,
                periodFilter: 'today',
                cashierFilter: 'all',
                statusFilter: 'all',
                searchQuery: '',
                showDetailModal: false,
                selectedLog: {},

                attendanceLogs: [
                    {
                        id: 1,
                        cashierName: 'Kasir Sutan',
                        cashierId: 'KSR-001',
                        shiftName: 'Shift 1 (Pagi)',
                        shiftHours: '08:00 - 16:00',
                        date: '6 Agustus 2026',
                        clockIn: '07:52 WIB',
                        clockOut: '16:05 WIB',
                        duration: '8 Jam 13 Menit',
                        status: 'Hadir'
                    },
                    {
                        id: 2,
                        cashierName: 'Kasir Rahma',
                        cashierId: 'KSR-002',
                        shiftName: 'Shift 2 (Sore)',
                        shiftHours: '16:00 - 22:00',
                        date: '6 Agustus 2026',
                        clockIn: '15:48 WIB',
                        clockOut: null,
                        duration: '6 Jam (Aktif)',
                        status: 'Hadir'
                    },
                    {
                        id: 3,
                        cashierName: 'Kasir Budi',
                        cashierId: 'KSR-003',
                        shiftName: 'Shift 1 (Pagi)',
                        shiftHours: '08:00 - 16:00',
                        date: '5 Agustus 2026',
                        clockIn: '07:55 WIB',
                        clockOut: '16:02 WIB',
                        duration: '8 Jam 07 Menit',
                        status: 'Hadir'
                    }
                ],

                get filteredAttendanceLogs() {
                    return this.attendanceLogs.filter(log => {
                        const matchCashier = this.cashierFilter === 'all' || log.cashierName === this.cashierFilter;
                        const matchStatus = this.statusFilter === 'all' || log.status === this.statusFilter;
                        const matchQuery = log.cashierName.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCashier && matchStatus && matchQuery;
                    });
                },

                getInitials(name) {
                    return name.split(' ').map(n => n[0]).join('').toUpperCase();
                },

                openLogDetail(log) {
                    this.selectedLog = log;
                    this.showDetailModal = true;
                },

                exportAbsensi() {
                    alert('Mengunduh Rekap Berkas Absensi Kasir (.xlsx)...');
                },

                init() {
                    this.$nextTick(() => {
                        this.initMap();
                    });
                },

                initMap() {
                    const restoLat = -0.9471;
                    const restoLng = 100.3543;

                    const map = L.map('adminMap').setView([restoLat, restoLng], 17);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(map);

                    // Circle Geofence Radius
                    L.circle([restoLat, restoLng], {
                        color: '#721c24',
                        fillColor: '#a52834',
                        fillOpacity: 0.2,
                        radius: 50
                    }).addTo(map).bindPopup("Radius Valid Presensi Lapau Uda Sutan (50m)");

                    // Restaurant Marker
                    L.marker([restoLat, restoLng]).addTo(map)
                        .bindPopup("<b>Lapau Uda Sutan</b><br>Lokasi Utama Warung.").openPopup();
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
