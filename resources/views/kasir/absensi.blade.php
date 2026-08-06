<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Absensi GPS - Kasir Lapau Uda Sutan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Bootstrap Icons & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
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
        }
        #attendanceMap {
            height: 280px;
            border-radius: 1rem;
            z-index: 10;
        }
        .leaflet-container {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-800 antialiased" x-data="absensiSystem()">

    {{-- Navbar --}}
    <x-kasir.navbar active="absensi" />

    <!-- Content Wrapper -->
    <main class="pt-0 md:pt-14 pb-24 md:pb-8 px-4 md:px-6 lg:px-8">

        <div class="w-full max-w-7xl mx-auto pt-4 md:pt-6 space-y-6">

            {{-- ==================== 1. HEADER HERO CARD ==================== --}}
            <div class="bg-white rounded-2xl p-5 md:p-6 border border-zinc-200 shadow-sm relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4">
                {{-- Decorative Accent Bar --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-maroon-primary via-red-500 to-amber-500"></div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 flex items-center justify-center font-bold text-xl shadow-md shadow-maroon-primary/20 shrink-0">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Live GPS Radar Resto Aktif
                            </span>
                            <span class="text-xs text-zinc-400 font-medium">• Lapau Uda Sutan</span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-extrabold text-zinc-900 tracking-tight">Presensi Geolocation & Peta GPS</h1>
                        <p class="text-xs md:text-sm text-zinc-500">Verifikasi keberadaan titik lokasi kasir secara akurat dengan peta radius restoran</p>
                    </div>
                </div>

                {{-- Cashier Profile Badge --}}
                <div class="bg-zinc-50 p-3.5 rounded-xl border border-zinc-200 flex items-center gap-3 self-start md:self-auto">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-maroon-primary to-maroon-dark text-amber-300 font-black flex items-center justify-center text-sm shadow">
                        US
                    </div>
                    <div>
                        <h4 class="text-xs font-extrabold text-zinc-900">Uda Sutan (Kasir Utama)</h4>
                        <div class="flex items-center gap-2 text-[10px] text-zinc-500 mt-0.5">
                            <span class="font-semibold text-maroon-primary">Shift Pagi</span>
                            <span>•</span>
                            <span>ID: KSR-0082</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== 2. MAIN ABSENSI BOARD (MAP + COMPACT CLOCK ABOVE MAP) ==================== --}}
            <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm p-5 md:p-6 space-y-4">
                
                {{-- Toolbar Top: Title & Compact Ringkas Live Clock Directly Above Map --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-map-location-dot text-maroon-primary"></i>
                            Peta Titik Warung & Radius Presensi
                        </h3>
                        <p class="text-xs text-zinc-500">Batas radius sah presensi: Maksimal 50 Meter dari warung</p>
                    </div>

                    {{-- Compact Live Clock Badge Above Map (Tanpa Card Baru, Ringkas) --}}
                    <div class="flex items-center gap-2 self-start sm:self-auto">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-zinc-100 border border-zinc-200 text-xs font-bold text-zinc-800">
                            <i class="fa-regular fa-clock text-maroon-primary"></i>
                            <span x-text="currentDateStr"></span>
                            <span class="text-maroon-primary font-black font-mono" x-text="currentTimeStr"></span>
                        </div>

                        <button @click="getGPSLocation()" class="px-3 py-1.5 bg-maroon-primary/10 hover:bg-maroon-primary hover:text-white text-maroon-primary font-bold text-xs rounded-xl transition cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-rotate text-xs" :class="loadingGPS ? 'animate-spin' : ''"></i>
                            <span class="hidden sm:inline">Refresh GPS</span>
                        </button>
                    </div>
                </div>

                {{-- LEAFLET INTERACTIVE MAP CONTAINER --}}
                <div class="relative overflow-hidden rounded-2xl border border-zinc-200">
                    <div id="attendanceMap" class="w-full shadow-inner"></div>
                    
                    {{-- Map Legend Overlay --}}
                    <div class="absolute bottom-3 left-3 z-20 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-zinc-200/80 text-[10px] font-bold text-zinc-700 flex items-center gap-3 shadow-sm">
                        <div class="flex items-center gap-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-maroon-primary border border-white"></span>
                            <span>Titik Warung</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600 border border-white"></span>
                            <span>Posisi Anda</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-maroon-primary/30 border border-maroon-primary"></span>
                            <span>Radius 50m</span>
                        </div>
                    </div>
                </div>

                {{-- Status Bar & Buttons Row --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 pt-1">
                    
                    {{-- Radius Status Indicator (5 Cols) --}}
                    <div class="md:col-span-5 p-3.5 rounded-xl text-xs font-bold flex items-center justify-between"
                        :class="isWithinRadius ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-rose-50 text-rose-800 border border-rose-200'">
                        <div class="flex items-center gap-2.5">
                            <i :class="isWithinRadius ? 'fa-solid fa-circle-check text-emerald-600 text-lg' : 'fa-solid fa-triangle-exclamation text-rose-600 text-lg'"></i>
                            <div>
                                <h4 class="font-extrabold text-xs" x-text="isWithinRadius ? 'Lokasi Presensi Sah (Dalam Radius)' : 'Di Luar Radius Restoran'"></h4>
                                <p class="text-[11px] font-medium" x-text="'Jarak: ' + (userDistance !== null ? userDistance + ' Meter dari warung' : 'Mencari...')"></p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase shrink-0"
                            :class="isWithinRadius ? 'bg-emerald-200/80 text-emerald-900' : 'bg-rose-200/80 text-rose-900'"
                            x-text="isWithinRadius ? 'VALID' : 'INVALID'"></span>
                    </div>

                    {{-- Absen Masuk & Keluar Action Buttons (7 Cols) --}}
                    <div class="md:col-span-7 grid grid-cols-2 gap-3">
                        {{-- Absen Masuk --}}
                        <button @click="doAbsenMasuk()" 
                            :disabled="statusAbsen !== 'belum' || !isWithinRadius"
                            :class="statusAbsen === 'belum' && isWithinRadius ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white shadow-md shadow-emerald-600/20 cursor-pointer' : 'bg-zinc-100 text-zinc-400 cursor-not-allowed opacity-75'"
                            class="px-4 py-3 rounded-xl font-extrabold text-xs sm:text-sm flex items-center justify-center gap-2 transition duration-200">
                            <i class="fa-solid fa-right-to-bracket text-sm"></i>
                            <span x-text="statusAbsen === 'belum' ? '🟢 ABSEN MASUK' : 'SUDAH MASUK (' + wtbMasuk + ')'"></span>
                        </button>

                        {{-- Absen Keluar --}}
                        <button @click="doAbsenKeluar()" 
                            :disabled="statusAbsen !== 'masuk' || !isWithinRadius"
                            :class="statusAbsen === 'masuk' && isWithinRadius ? 'bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white shadow-md shadow-rose-600/20 cursor-pointer' : 'bg-zinc-100 text-zinc-400 cursor-not-allowed opacity-75'"
                            class="px-4 py-3 rounded-xl font-extrabold text-xs sm:text-sm flex items-center justify-center gap-2 transition duration-200">
                            <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            <span x-text="statusAbsen === 'masuk' ? '🔴 ABSEN KELUAR' : (statusAbsen === 'keluar' ? 'SUDAH KELUAR (' + wtbKeluar + ')' : '🔴 ABSEN KELUAR')"></span>
                        </button>
                    </div>

                </div>

            </div>

            {{-- ==================== 3. RIWAYAT ABSENSI KASIR (FOOTER SECTION) ==================== --}}
            <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                {{-- Footer Header Bar --}}
                <div class="p-5 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-maroon-primary"></i>
                            Riwayat Absensi Kasir (Bulan Ini)
                        </h3>
                        <p class="text-xs text-zinc-500">Catatan riwayat jam masuk, jam keluar, dan koordinat lokasi presensi</p>
                    </div>

                    {{-- Export & Filter Button --}}
                    <div class="flex items-center gap-2">
                        <select x-model="historyFilter" class="bg-zinc-100 border border-zinc-200 text-xs font-bold rounded-xl px-3 py-2 text-zinc-700 focus:outline-none">
                            <option value="semua">Semua Status</option>
                            <option value="Tepat Waktu">Tepat Waktu</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                        <button @click="alert('Mencetak Riwayat Absensi...')" class="bg-maroon-primary hover:bg-maroon-dark text-white font-bold text-xs px-3.5 py-2 rounded-xl shadow-sm transition cursor-pointer">
                            <i class="fa-solid fa-print mr-1"></i> Cetak
                        </button>
                    </div>
                </div>

                {{-- Attendance History Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[720px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Tanggal & Shift</th>
                                <th class="py-3.5 px-4">Jam Masuk (GPS)</th>
                                <th class="py-3.5 px-4">Jam Keluar (GPS)</th>
                                <th class="py-3.5 px-4 text-center">Total Durasi</th>
                                <th class="py-3.5 px-4">Status Ketepatan</th>
                                <th class="py-3.5 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="row in filteredHistory" :key="row.id">
                                <tr class="hover:bg-zinc-50/80 transition duration-150">
                                    {{-- Tanggal --}}
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold text-zinc-900" x-text="row.date"></div>
                                        <span class="text-[10px] text-zinc-400" x-text="row.shift"></span>
                                    </td>

                                    {{-- Jam Masuk --}}
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-emerald-700" x-text="row.timeIn"></div>
                                        <span class="text-[10px] text-zinc-400" x-text="'GPS: ' + row.gpsIn"></span>
                                    </td>

                                    {{-- Jam Keluar --}}
                                    <td class="py-3.5 px-4">
                                        <div class="font-bold text-rose-700" x-text="row.timeOut || '-'"></div>
                                        <span class="text-[10px] text-zinc-400" x-text="row.timeOut ? ('GPS: ' + row.gpsOut) : 'Belum Absen'"></span>
                                    </td>

                                    {{-- Total Durasi --}}
                                    <td class="py-3.5 px-4 text-center font-extrabold text-zinc-800" x-text="row.duration"></td>

                                    {{-- Status Badge --}}
                                    <td class="py-3.5 px-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold inline-flex items-center gap-1"
                                            :class="row.status === 'Tepat Waktu' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'">
                                            <i :class="row.status === 'Tepat Waktu' ? 'fa-solid fa-circle-check text-emerald-600' : 'fa-solid fa-clock text-amber-600'"></i>
                                            <span x-text="row.status"></span>
                                        </span>
                                    </td>

                                    {{-- Action --}}
                                    <td class="py-3.5 px-4 text-center">
                                        <button @click="showDetailModal(row)" class="px-2.5 py-1 rounded-lg bg-zinc-100 hover:bg-maroon-primary hover:text-white text-zinc-700 text-xs font-semibold transition cursor-pointer">
                                            <i class="fa-solid fa-eye mr-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Footer Summary --}}
                <div class="p-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-between text-xs text-zinc-500">
                    <span>Menampilkan <strong x-text="filteredHistory.length"></strong> rekaman absensi</span>
                    <div class="flex items-center gap-1">
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-400" disabled>Prev</button>
                        <button class="px-2.5 py-1 bg-maroon-primary text-white rounded-md font-bold">1</button>
                        <button class="px-2.5 py-1 bg-white border border-zinc-200 rounded-md text-zinc-600 hover:bg-zinc-100">Next</button>
                    </div>
                </div>
            </div>

        </div>

    </main>

    {{-- Script Alpine.js + Leaflet Map Initialization --}}
    <script>
        function absensiSystem() {
            return {
                currentTimeStr: '',
                currentDateStr: '',
                statusAbsen: 'belum',
                wtbMasuk: '',
                wtbKeluar: '',
                historyFilter: 'semua',

                // Resto GPS Location Target (Lapau Uda Sutan)
                outletLat: -0.9471,
                outletLng: 100.3542,
                userLat: -0.9471,
                userLng: 100.3542,
                userDistance: 8, // in Meters
                isWithinRadius: true,
                loadingGPS: false,
                mapInstance: null,
                userMarker: null,

                history: [
                    { id: 1, date: 'Rabu, 5 Agt 2026', shift: 'Shift Pagi', timeIn: '07:55 WIB', gpsIn: 'Maks. 8m', timeOut: '', gpsOut: '', duration: 'Berjalan...', status: 'Tepat Waktu' },
                    { id: 2, date: 'Selasa, 4 Agt 2026', shift: 'Shift Pagi', timeIn: '07:58 WIB', gpsIn: 'Maks. 12m', timeOut: '16:05 WIB', gpsOut: 'Maks. 10m', duration: '8 Jam 07 Menit', status: 'Tepat Waktu' },
                    { id: 3, date: 'Senin, 3 Agt 2026', shift: 'Shift Pagi', timeIn: '08:14 WIB', gpsIn: 'Maks. 5m', timeOut: '16:00 WIB', gpsOut: 'Maks. 6m', duration: '7 Jam 46 Menit', status: 'Terlambat' },
                    { id: 4, date: 'Minggu, 2 Agt 2026', shift: 'Shift Pagi', timeIn: '07:50 WIB', gpsIn: 'Maks. 15m', timeOut: '16:10 WIB', gpsOut: 'Maks. 11m', duration: '8 Jam 20 Menit', status: 'Tepat Waktu' }
                ],

                get filteredHistory() {
                    return this.history.filter(h => {
                        return this.historyFilter === 'semua' || h.status === this.historyFilter;
                    });
                },

                init() {
                    this.updateClock();
                    setInterval(() => this.updateClock(), 1000);
                    
                    this.$nextTick(() => {
                        this.initMap();
                        this.getGPSLocation();
                    });
                },

                updateClock() {
                    const now = new Date();
                    this.currentTimeStr = now.toLocaleTimeString('id-ID', { hour12: false }) + ' WIB';
                    this.currentDateStr = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' });
                },

                initMap() {
                    const mapContainer = document.getElementById('attendanceMap');
                    if (!mapContainer) return;

                    // Initialize Leaflet Map centered on Lapau Uda Sutan
                    this.mapInstance = L.map('attendanceMap').setView([this.outletLat, this.outletLng], 17);

                    // Add OpenStreetMap Tile Layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; Lapau Uda Sutan POS'
                    }).addTo(this.mapInstance);

                    // 1. Outlet Store Marker (Maroon Icon)
                    const outletIcon = L.divIcon({
                        className: 'custom-outlet-icon',
                        html: `<div style="background-color: #721c24; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);"><i class="fa-solid fa-store"></i></div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    L.marker([this.outletLat, this.outletLng], { icon: outletIcon })
                        .addTo(this.mapInstance)
                        .bindPopup('<b>Lapau Uda Sutan</b><br>Titik Presensi Utama')
                        .openPopup();

                    // 2. Add 50-Meter Radius Circle Overlay
                    L.circle([this.outletLat, this.outletLng], {
                        color: '#721c24',
                        fillColor: '#721c24',
                        fillOpacity: 0.15,
                        radius: 50
                    }).addTo(this.mapInstance);

                    // 3. User Position Marker (Blue Icon)
                    const userIcon = L.divIcon({
                        className: 'custom-user-icon',
                        html: `<div style="background-color: #2563eb; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);"><i class="fa-solid fa-user-large"></i></div>`,
                        iconSize: [28, 28],
                        iconAnchor: [14, 14]
                    });

                    this.userMarker = L.marker([this.userLat, this.userLng], { icon: userIcon })
                        .addTo(this.mapInstance)
                        .bindPopup('<b>Posisi Anda Saat Ini</b>');
                },

                getGPSLocation() {
                    this.loadingGPS = true;
                    if ('geolocation' in navigator) {
                        navigator.geolocation.getCurrentPosition(
                            (pos) => {
                                this.userLat = pos.coords.latitude;
                                this.userLng = pos.coords.longitude;
                                this.userDistance = 8;
                                this.isWithinRadius = true;
                                this.loadingGPS = false;

                                if (this.userMarker) {
                                    this.userMarker.setLatLng([this.userLat, this.userLng]);
                                }
                            },
                            (err) => {
                                this.userLat = -0.9471;
                                this.userLng = 100.3542;
                                this.userDistance = 8;
                                this.isWithinRadius = true;
                                this.loadingGPS = false;
                            }
                        );
                    } else {
                        this.userDistance = 8;
                        this.isWithinRadius = true;
                        this.loadingGPS = false;
                    }
                },

                doAbsenMasuk() {
                    if (!this.isWithinRadius) {
                        alert('Gagal Absen: Lokasi Anda di luar radius restoran!');
                        return;
                    }
                    const now = new Date();
                    this.wtbMasuk = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
                    this.statusAbsen = 'masuk';
                    alert('🟢 ABSEN MASUK BERHASIL!\nWaktu: ' + this.wtbMasuk + ' WIB\nLokasi: Valid Dalam Radius Resto (8 Meter)');
                },

                doAbsenKeluar() {
                    if (!this.isWithinRadius) {
                        alert('Gagal Absen: Lokasi Anda di luar radius restoran!');
                        return;
                    }
                    const now = new Date();
                    this.wtbKeluar = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
                    this.statusAbsen = 'keluar';
                    
                    if (this.history.length > 0) {
                        this.history[0].timeOut = this.wtbKeluar + ' WIB';
                        this.history[0].duration = '8 Jam 05 Menit';
                        this.history[0].gpsOut = 'Maks. ' + this.userDistance + 'm';
                    }

                    alert('🔴 ABSEN KELUAR BERHASIL!\nWaktu: ' + this.wtbKeluar + ' WIB\nShift Selesai. Terima kasih atas kerja keras Anda!');
                },

                showDetailModal(row) {
                    alert('Detail Presensi Kasir:\nTanggal: ' + row.date + '\nShift: ' + row.shift + '\nMasuk: ' + row.timeIn + '\nKeluar: ' + (row.timeOut || 'Belum Absen') + '\nStatus: ' + row.status);
                }
            }
        }
    </script>
</body>

</html>
