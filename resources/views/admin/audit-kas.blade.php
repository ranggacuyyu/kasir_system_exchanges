<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Kas & Laci - Panel Admin | Lapau Uda Sutan</title>

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

<body class="min-h-screen text-zinc-800 antialiased" x-data="adminAuditKasSystem()">

    <!-- Sidebar Component -->
    <x-admin.sidebar active="audit-kas" />

    <!-- Top Navbar Component -->
    <x-admin.navbar />

    <!-- Main Content Area -->
    <main class="pt-20 pb-16 md:pl-64 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- 1. HEADER BANNER --}}
            <div class="bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-secondary rounded-3xl p-6 md:p-8 border border-maroon-light/30 shadow-xl relative overflow-hidden text-white flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-2 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-maroon-dark/80 border border-amber-400/30 text-amber-300 text-xs font-bold shadow-inner">
                        <i class="fa-solid fa-vault"></i>
                        <span>Rekonsiliasi Fisik Uang Tunai & Audit Laci Kasir</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        Audit Kas & Laci Tunai
                    </h1>
                    <p class="text-xs md:text-sm text-zinc-200 max-w-2xl leading-relaxed">
                        Pencocokan saldo modal float awal, hasil penjualan tunai, pengeluaran kas out, dan rekapitulasi setoran fisik bank.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 relative z-10 shrink-0">
                    <button @click="showDenominationCalculator = true" class="px-4 py-2.5 rounded-xl bg-maroon-dark/80 hover:bg-maroon-dark border border-amber-400/30 text-amber-300 font-bold text-xs flex items-center gap-2 transition cursor-pointer shadow">
                        <i class="fa-solid fa-calculator"></i>
                        <span>Kalkulator Pecahan Uang</span>
                    </button>
                    <button @click="exportAuditKas()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-maroon-dark font-extrabold text-xs shadow-lg flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        <span>Cetak Berita Acara</span>
                    </button>
                </div>
            </div>

            {{-- 2. METRIC CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Wajib Ada di Laci</span>
                        <div class="text-xl md:text-2xl font-extrabold text-maroon-primary">Rp 4.050.000</div>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded">Hasil Penjualan Tunai</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-maroon-primary/10 text-maroon-primary flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Modal Float Kasir</span>
                        <div class="text-xl md:text-2xl font-extrabold text-zinc-900">Rp 500.000</div>
                        <span class="text-[11px] text-zinc-500 font-semibold">Dipakai Untuk Kembalian</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-zinc-100 text-zinc-700 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Pengeluaran Kas Out</span>
                        <div class="text-xl md:text-2xl font-extrabold text-rose-600">Rp 85.000</div>
                        <span class="text-[11px] text-rose-600 font-bold">Petty Cash Disetujui</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-zinc-200/80 shadow-xs flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider block">Akurasi Selisih Laci</span>
                        <div class="text-xl md:text-2xl font-extrabold text-emerald-600">PAS (Rp 0)</div>
                        <span class="text-[11px] font-bold text-emerald-600">100% Balanced</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                </div>
            </div>

            {{-- 3. TABEL REKONSILIASI KAS --}}
            <div class="bg-white rounded-2xl border border-zinc-200/80 shadow-xs overflow-hidden">
                <div class="p-5 md:p-6 border-b border-zinc-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-extrabold text-zinc-900 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-maroon-primary"></i>
                            Riwayat Audit & Penyetoran Kas Laci
                        </h2>
                        <p class="text-xs text-zinc-500">Berita acara penutupan kasir dan pencocokan uang fisik</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-zinc-50 text-zinc-400 font-bold uppercase border-b border-zinc-200">
                            <tr>
                                <th class="py-3 px-4">Kasir & Shift</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4 text-right">Modal Float</th>
                                <th class="py-3 px-4 text-right">Uang Masuk</th>
                                <th class="py-3 px-4 text-right">Kas Out</th>
                                <th class="py-3 px-4 text-right">Fisik Laci</th>
                                <th class="py-3 px-4 text-center">Selisih</th>
                                <th class="py-3 px-4 text-center">Status Audit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 font-medium">
                            <tr class="hover:bg-zinc-50">
                                <td class="py-3.5 px-4 font-bold text-zinc-900">Kasir Sutan (Shift Pagi)</td>
                                <td class="py-3.5 px-4 text-zinc-500">6 Agustus 2026</td>
                                <td class="py-3.5 px-4 text-right">Rp 500.000</td>
                                <td class="py-3.5 px-4 text-right text-emerald-700 font-bold">Rp 1.450.000</td>
                                <td class="py-3.5 px-4 text-right text-rose-600">Rp 50.000</td>
                                <td class="py-3.5 px-4 text-right font-extrabold text-zinc-900">Rp 1.900.000</td>
                                <td class="py-3.5 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-50 text-emerald-700">PAS</span></td>
                                <td class="py-3.5 px-4 text-center"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-zinc-50">
                                <td class="py-3.5 px-4 font-bold text-zinc-900">Kasir Rahma (Shift Sore)</td>
                                <td class="py-3.5 px-4 text-zinc-500">6 Agustus 2026</td>
                                <td class="py-3.5 px-4 text-right">Rp 500.000</td>
                                <td class="py-3.5 px-4 text-right text-emerald-700 font-bold">Rp 2.600.000</td>
                                <td class="py-3.5 px-4 text-right text-rose-600">Rp 35.000</td>
                                <td class="py-3.5 px-4 text-right font-extrabold text-zinc-900">Rp 3.065.000</td>
                                <td class="py-3.5 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-50 text-emerald-700">PAS</span></td>
                                <td class="py-3.5 px-4 text-center"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Menunggu Review</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- MODAL KALKULATOR PECAHAN UANG --}}
        <div x-cloak x-show="showDenominationCalculator" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.outside="showDenominationCalculator = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative space-y-4">
                <button @click="showDenominationCalculator = false" class="absolute right-5 top-5 text-zinc-400 hover:text-zinc-700">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <div class="pb-2 border-b border-zinc-100">
                    <h3 class="text-base font-extrabold text-zinc-900">Kalkulator Uang Kertas & Koin Laci</h3>
                    <p class="text-xs text-zinc-500">Hitung fisik uang tunai laci kasir</p>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between gap-3">
                        <span class="font-bold text-zinc-700">Rp 100.000</span>
                        <input type="number" x-model.number="denom.d100k" placeholder="0" class="w-24 bg-zinc-50 border border-zinc-200 rounded-lg px-2.5 py-1.5 text-right font-bold">
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="font-bold text-zinc-700">Rp 50.000</span>
                        <input type="number" x-model.number="denom.d50k" placeholder="0" class="w-24 bg-zinc-50 border border-zinc-200 rounded-lg px-2.5 py-1.5 text-right font-bold">
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="font-bold text-zinc-700">Rp 20.000</span>
                        <input type="number" x-model.number="denom.d20k" placeholder="0" class="w-24 bg-zinc-50 border border-zinc-200 rounded-lg px-2.5 py-1.5 text-right font-bold">
                    </div>
                </div>

                <div class="pt-3 border-t border-zinc-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-zinc-500">Total Fisik Dihitung:</span>
                    <span class="text-base font-extrabold text-maroon-primary" x-text="formatRupiah(calculatedTotal)">Rp 0</span>
                </div>
            </div>
        </div>

    </main>

    <script>
        function adminAuditKasSystem() {
            return {
                sidebarOpen: false,
                showDenominationCalculator: false,
                denom: { d100k: 0, d50k: 0, d20k: 0 },

                get calculatedTotal() {
                    return (this.denom.d100k * 100000) + (this.denom.d50k * 50000) + (this.denom.d20k * 20000);
                },

                formatRupiah(num) {
                    return 'Rp ' + (num || 0).toLocaleString('id-ID');
                },

                exportAuditKas() {
                    alert('Mencetak Berita Acara Audit Kas & Laci...');
                }
            }
        }
    </script>

    @livewireScripts
</body>

</html>
