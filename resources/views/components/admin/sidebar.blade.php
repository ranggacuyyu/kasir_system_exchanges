@props(['active' => 'dashboard'])

<style>
    /* Custom Theme Scrollbar for Admin Sidebar */
    .sidebar-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .sidebar-scrollbar::-webkit-scrollbar-track {
        background: rgba(60, 15, 15, 0.6);
        border-radius: 9999px;
    }
    .sidebar-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #a52834, #721c24);
        border-radius: 9999px;
        border: 1px solid rgba(251, 191, 36, 0.4);
    }
    .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #fbbf24, #a52834);
        box-shadow: 0 0 8px rgba(251, 191, 36, 0.6);
    }
</style>

<aside class="fixed top-0 left-0 bottom-0 w-64 bg-maroon-dark border-r border-maroon-primary/40 text-zinc-200 z-40 flex flex-col justify-between transition-transform duration-300 transform -translate-x-full md:translate-x-0 shadow-2xl overflow-y-auto sidebar-scrollbar"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

    <!-- Top Section: Brand & Navigation -->
    <div class="pb-6">
        <!-- Brand Header -->
        <div class="h-16 px-5 flex items-center justify-between border-b border-maroon-primary/40 bg-gradient-to-r from-maroon-dark via-maroon-primary to-maroon-dark sticky top-0 z-10 shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 via-amber-500 to-amber-600 p-0.5 shadow-md shadow-maroon-dark/60 transform group-hover:scale-105 transition">
                    <div class="w-full h-full bg-maroon-dark rounded-[10px] flex items-center justify-center">
                        <i class="fa-solid fa-store text-amber-300 text-sm"></i>
                    </div>
                </div>
                <div>
                    <span class="block font-extrabold text-xs text-white group-hover:text-amber-300 transition-colors tracking-tight uppercase">
                        LAPAU UDA SUTAN
                    </span>
                    <span class="block text-[9px] font-bold tracking-wider text-amber-400/90 uppercase">
                        Panel Super Admin
                    </span>
                </div>
            </a>
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" class="md:hidden text-zinc-300 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Admin Profile Info Strip -->
        <div class="p-3 mx-3 my-3 rounded-2xl bg-maroon-primary/60 border border-maroon-secondary/50 flex items-center gap-3 shadow-inner">
            <div class="relative">
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-400 to-amber-600 text-maroon-dark flex items-center justify-center font-extrabold text-xs shadow">
                    US
                </div>
                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-400 border-2 border-maroon-dark animate-pulse"></span>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-xs font-extrabold text-white truncate">Uda Sutan (Admin)</h4>
                <p class="text-[10px] text-amber-300 font-semibold truncate">Pemilik & Manager Utama</p>
            </div>
        </div>

        <!-- Navigation Menu Groups -->
        <nav class="px-3 space-y-4 pt-1">

            <!-- KATEGORI 1: PUSAT KONTROL & LAPORAN -->
            <div>
                <div class="px-3 text-[10px] font-extrabold text-amber-400 uppercase tracking-wider mb-2 flex items-center justify-between">
                    <span>PUSAT KONTROL & LAPORAN</span>
                </div>

                <div class="space-y-1">
                    <!-- Dashboard & Audit -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'dashboard' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg shadow-maroon-dark/60 border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-chart-line text-sm {{ $active === 'dashboard' ? 'text-amber-300' : 'text-amber-400/80' }}"></i>
                            <span>Dashboard & Audit</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-400 text-maroon-dark shadow-xs">
                            3 Baru
                        </span>
                    </a>

                    <!-- Laporan Shift Kasir -->
                    <a href="{{ route('admin.laporan-shift') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'laporan-shift' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg shadow-maroon-dark/60 border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-invoice-dollar text-sm {{ $active === 'laporan-shift' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Laporan Shift Kasir</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-extrabold bg-rose-500/30 text-rose-300">
                            Realtime
                        </span>
                    </a>

                    <!-- Absensi & Shift Kasir -->
                    <a href="{{ route('admin.absensi') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'absensi' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-clock text-sm {{ $active === 'absensi' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Absensi & Shift Kasir</span>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </a>

                    <!-- Audit Kas & Laci -->
                    <a href="{{ route('admin.audit-kas') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'audit-kas' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-vault text-sm {{ $active === 'audit-kas' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Audit Kas & Laci</span>
                        </div>
                        <span class="text-[10px] font-extrabold text-emerald-400">Pas</span>
                    </a>
                </div>
            </div>

            <!-- KATEGORI 2: MANAJEMEN TOKO -->
            <div>
                <div class="px-3 text-[10px] font-extrabold text-amber-400 uppercase tracking-wider mb-2 flex items-center justify-between">
                    <span>MANAJEMEN TOKO</span>
                </div>

                <div class="space-y-1">
                    <!-- Stok & Menu Masakan -->
                    <a href="{{ route('admin.stok') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'stok' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-boxes-stacked text-sm {{ $active === 'stok' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Stok & Menu Masakan</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-amber-500/30 text-amber-300">
                            40+ Menu
                        </span>
                    </a>

                    <!-- Kelola QR & Meja Resto -->
                    <a href="{{ route('admin.kelola-meja') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'kelola-meja' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-qrcode text-sm {{ $active === 'kelola-meja' ? 'text-amber-300' : 'text-amber-400/80' }}"></i>
                            <span>Kelola QR & Meja Resto</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-emerald-500/30 text-emerald-300">
                            20 Meja
                        </span>
                    </a>



                    <!-- Kelola Akun Kasir -->
                    <a href="{{ route('admin.kelola-kasir') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'kelola-kasir' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-users-gear text-sm {{ $active === 'kelola-kasir' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Kelola Akun Kasir</span>
                        </div>
                        <span class="text-[10px] font-bold text-zinc-300">3 Kasir</span>
                    </a>

                    <!-- Diskon & Promo Paket -->
                    <a href="{{ route('admin.diskon-promo') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'diskon-promo' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-tags text-sm {{ $active === 'diskon-promo' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Diskon & Promo Paket</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-emerald-500/30 text-emerald-300">Aktif</span>
                    </a>

                    <!-- Audit Void & Pembatalan -->
                    <a href="{{ route('admin.audit-void') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'audit-void' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-ban text-sm {{ $active === 'audit-void' ? 'text-amber-300' : 'text-rose-400' }}"></i>
                            <span>Audit Void & Pembatalan</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-rose-500/30 text-rose-300">2 Void</span>
                    </a>
                </div>
            </div>

            <!-- KATEGORI 3: KEUANGAN & AUDIT -->
            <div>
                <div class="px-3 text-[10px] font-extrabold text-amber-400 uppercase tracking-wider mb-2 flex items-center justify-between">
                    <span>KEUANGAN & AUDIT</span>
                </div>

                <div class="space-y-1">
                    <!-- Audit Pembayaran QRIS & EDC -->
                    <a href="{{ route('admin.audit-qris') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'audit-qris' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-qrcode text-sm {{ $active === 'audit-qris' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Laporan QRIS & EDC</span>
                        </div>
                        <span class="text-[10px] font-bold text-sky-300">49% Non-Tunai</span>
                    </a>

                    <!-- Verifikasi Kas Out -->
                    <a href="{{ route('admin.kas-out') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'kas-out' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-hand-holding-dollar text-sm {{ $active === 'kas-out' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Persetujuan Kas Out</span>
                        </div>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-amber-400 text-maroon-dark">1 Pending</span>
                    </a>

                    <!-- Pelanggan & Catering Box -->
                    <a href="{{ route('admin.pelanggan') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'pelanggan' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-address-book text-sm {{ $active === 'pelanggan' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Pelanggan & Catering</span>
                        </div>
                        <span class="text-[10px] font-bold text-zinc-300">Langganan</span>
                    </a>
                </div>
            </div>

            <!-- KATEGORI 4: PENGATURAN & SISTEM -->
            <div>
                <div class="px-3 text-[10px] font-extrabold text-amber-400 uppercase tracking-wider mb-2 flex items-center justify-between">
                    <span>PENGATURAN & SISTEM</span>
                </div>

                <div class="space-y-1">
                    <!-- Pengaturan Toko & Struk -->
                    <a href="{{ route('admin.pengaturan') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'pengaturan' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-sliders text-sm {{ $active === 'pengaturan' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Pengaturan Toko & Struk</span>
                        </div>
                    </a>

                    <!-- Log Aktivitas & Keamanan -->
                    <a href="{{ route('admin.log-aktivitas') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'log-aktivitas' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-shield-halved text-sm {{ $active === 'log-aktivitas' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Log Keamanan & Audit</span>
                        </div>
                    </a>

                    <!-- Backup & Export Data -->
                    <a href="{{ route('admin.backup-data') }}" 
                       class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition duration-200 text-left border {{ $active === 'backup-data' ? 'bg-gradient-to-r from-maroon-primary to-maroon-secondary text-white shadow-lg border-amber-400/50 ring-1 ring-amber-400/30' : 'text-zinc-200 hover:text-white hover:bg-maroon-primary/40 border-transparent' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-database text-sm {{ $active === 'backup-data' ? 'text-amber-300' : 'text-zinc-400' }}"></i>
                            <span>Backup & Database</span>
                        </div>
                        <i class="fa-solid fa-download text-xs text-zinc-400"></i>
                    </a>
                </div>
            </div>

        </nav>
    </div>

    <!-- Bottom Section: Quick Switch & Logout -->
    <div class="p-3 border-t border-maroon-primary/40 bg-maroon-dark sticky bottom-0 z-10 space-y-2">
        <a href="{{ route('kasir.dashboard') }}" 
           class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-maroon-primary/80 hover:bg-maroon-primary border border-amber-400/30 text-amber-300 text-xs font-extrabold transition shadow">
            <i class="fa-solid fa-cash-register"></i>
            <span>Mode Layar Kasir</span>
        </a>

        <a href="{{ route('login') }}" 
           class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-maroon-dark hover:bg-maroon-secondary/60 border border-maroon-primary/50 text-zinc-300 hover:text-white text-xs font-semibold transition">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Keluar (Logout)</span>
        </a>
    </div>

</aside>
