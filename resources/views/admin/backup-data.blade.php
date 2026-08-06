<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Backup & Database - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminBackupDatabaseSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="backup-data" />

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
                        <i class="fa-solid fa-database"></i>
                        <span>Pemeliharaan Cadangan Database & Proteksi Data Transaksi</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Backup & Export Database Kasir
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Unduh salinan cadangan SQL database sistem kasir Lapau Uda Sutan, ekspor rekapitulasi data keuangan, dan atur pemulihan data (restore).
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="createBackupNow()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-download text-base"></i>
                        <span>Unduh Backup SQL Instant</span>
                    </button>
                    <button @click="exportAllExcel()" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Export Semua Data (.xlsx)</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS (4 METRICS) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Status Backup --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Status Backup Terakhir</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">Hari Ini 04:00</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Auto Daily Backup OK</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                {{-- Ukuran Database --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Ukuran Database</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">14.8 MB</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Tabel Transaksi & Menu</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-database"></i>
                    </div>
                </div>

                {{-- Berkas Cadangan --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Total File Cadangan</span>
                        <div class="text-xl md:text-2xl font-extrabold text-amber-700">12 File SQL</div>
                        <span class="text-[11px] text-amber-800 font-bold bg-amber-50 px-2 py-0.5 rounded">Tersimpan Aman</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-hard-drive"></i>
                    </div>
                </div>

                {{-- Kesehetan DB --}}
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Integritas Database</span>
                        <div class="text-xl md:text-2xl font-extrabold text-sky-700">100% Sehat</div>
                        <span class="text-[11px] text-sky-600 font-bold">InnoDB Engine Normal</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                </div>

            </div>

            {{-- 3. TABEL ARSIP BERKAS CADANGAN --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <div class="p-5 md:p-6 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-box-archive text-maroon-primary"></i>
                            Daftar Berkas Cadangan SQL Database
                        </h2>
                        <p class="text-xs text-zinc-500">Arsip backup harian dan cadangan manual sebelum perbaikan sistem</p>
                    </div>

                    <button @click="showRestoreModal = true" class="px-4 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-bold text-xs rounded-xl flex items-center gap-2 transition">
                        <i class="fa-solid fa-upload"></i> Restore Database Dari File SQL
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[850px]">
                        <thead>
                            <tr class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                                <th class="py-3.5 px-4">Nama File Backup</th>
                                <th class="py-3.5 px-4">Tanggal Dibuat</th>
                                <th class="py-3.5 px-4">Tipe Cadangan</th>
                                <th class="py-3.5 px-4 text-right">Ukuran Berkas</th>
                                <th class="py-3.5 px-4 text-center">Status Integritas</th>
                                <th class="py-3.5 px-4 text-center">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 text-xs font-medium text-zinc-700">
                            <template x-for="file in backupFiles" :key="file.id">
                                <tr class="hover:bg-zinc-50/90 transition duration-150">
                                    
                                    <!-- Nama File -->
                                    <td class="py-3.5 px-4">
                                        <div class="font-extrabold font-mono text-zinc-900 text-xs" x-text="file.filename"></div>
                                        <div class="text-[10px] text-zinc-400" x-text="file.engine"></div>
                                    </td>

                                    <!-- Tanggal Dibuat -->
                                    <td class="py-3.5 px-4 text-zinc-800 font-semibold" x-text="file.createdAt"></td>

                                    <!-- Tipe -->
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold"
                                              :class="file.type === 'Otomatis System' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800'"
                                              x-text="file.type"></span>
                                    </td>

                                    <!-- Ukuran Berkas -->
                                    <td class="py-3.5 px-4 text-right font-extrabold text-maroon-primary" x-text="file.size"></td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                            <i class="fa-solid fa-check mr-1"></i> Valid SQL
                                        </span>
                                    </td>

                                    <!-- Aksi Admin -->
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button @click="downloadBackup(file)" class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white font-extrabold text-xs transition shadow-xs flex items-center gap-1">
                                                <i class="fa-solid fa-download"></i> Unduh
                                            </button>
                                            <button @click="deleteBackup(file)" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs transition">
                                                <i class="fa-solid fa-trash-can text-rose-500"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- MODAL RESTORE DATABASE --}}
        <div x-cloak x-show="showRestoreModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showRestoreModal = false" class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showRestoreModal = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900">Restore Database dari File SQL</h3>
                    <p class="text-xs text-zinc-500">Pilih file cadangan SQL untuk pemulihan data</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-900">
                        <i class="fa-solid fa-triangle-exclamation mr-1 text-amber-600"></i>
                        <strong>Peringatan:</strong> Memulihkan database akan menimpa data transaksi kasir saat ini dengan data dari file backup.
                    </div>

                    <div>
                        <label class="block text-zinc-700 font-bold mb-1">Pilih Berkas SQL (.sql / .gz)</label>
                        <input type="file" accept=".sql,.gz" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl p-2 font-medium">
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex justify-end gap-3">
                    <button @click="showRestoreModal = false" class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 font-bold text-xs">
                        Batal
                    </button>
                    <button @click="confirmRestore()" class="px-5 py-2 rounded-xl bg-rose-600 text-white font-extrabold text-xs shadow-md">
                        Proses Restore Now
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Alpine.js -->
    <script>
        function adminBackupDatabaseSystem() {
            return {
                sidebarOpen: false,
                showRestoreModal: false,

                backupFiles: [
                    {
                        id: 1,
                        filename: 'backup_kasir_lapau_uda_sutan_20260806_040000.sql',
                        engine: 'MySQL 8.0 • InnoDB Engine',
                        createdAt: '6 Agustus 2026, 04:00 WIB',
                        type: 'Otomatis System',
                        size: '14.8 MB'
                    },
                    {
                        id: 2,
                        filename: 'backup_kasir_lapau_uda_sutan_20260805_040000.sql',
                        engine: 'MySQL 8.0 • InnoDB Engine',
                        createdAt: '5 Agustus 2026, 04:00 WIB',
                        type: 'Otomatis System',
                        size: '14.2 MB'
                    },
                    {
                        id: 3,
                        filename: 'manual_backup_sebelum_update_stok_20260804.sql',
                        engine: 'MySQL 8.0 • InnoDB Engine',
                        createdAt: '4 Agustus 2026, 18:30 WIB',
                        type: 'Manual Admin',
                        size: '13.9 MB'
                    }
                ],

                createBackupNow() {
                    alert('Membuat Cadangan Database SQL Instant... Mengunduh file backup_kasir_lapau_uda_sutan_20260806_instant.sql');
                },

                downloadBackup(file) {
                    alert(`Mengunduh berkas cadangan: ${file.filename}`);
                },

                deleteBackup(file) {
                    if (confirm(`Hapus file backup '${file.filename}'?`)) {
                        this.backupFiles = this.backupFiles.filter(f => f.id !== file.id);
                    }
                },

                confirmRestore() {
                    if (confirm('Konfirmasi pemulihan database?')) {
                        this.showRestoreModal = false;
                        alert('Database berhasil dipulihkan!');
                    }
                },

                exportAllExcel() {
                    alert('Mengunduh Semua Data Rekap Transaksi (.xlsx)...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
