<header class="h-16 bg-white border-b border-zinc-200 fixed top-0 right-0 left-0 md:left-64 z-30 px-4 md:px-8 flex items-center justify-between shadow-xs">
    
    <!-- Left: Mobile Toggle & Page Title -->
    <div class="flex items-center gap-4">
        <!-- Sidebar Mobile Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-maroon-primary hover:text-maroon-dark p-1 rounded-lg hover:bg-zinc-100">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-zinc-400">Panel Admin</span>
                <span class="text-xs text-zinc-300">•</span>
                <span class="text-xs font-extrabold text-maroon-primary bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">Audit Laporan Kasir</span>
            </div>
            <h1 class="text-base md:text-lg font-extrabold text-zinc-900 leading-tight">Dashboard Audit Laporan Kasir</h1>
        </div>
    </div>

    <!-- Right: Search & Actions -->
    <div class="flex items-center gap-3">
        <!-- Status Shift Monitor Dropdown -->
        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Kasir Berjaga: <strong>Sutan & Rahma</strong></span>
        </div>

        <!-- Notification Bell -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false" 
                    class="relative p-2 rounded-xl text-zinc-600 hover:text-maroon-primary hover:bg-rose-50 transition cursor-pointer">
                <i class="fa-solid fa-bell text-lg"></i>
                <span class="absolute top-1 right-1 w-2.5 h-2.5 rounded-full bg-maroon-secondary border-2 border-white animate-ping"></span>
                <span class="absolute top-1 right-1 w-2.5 h-2.5 rounded-full bg-maroon-primary border-2 border-white"></span>
            </button>

            <!-- Notification Dropdown -->
            <div x-show="open" x-transition 
                 class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-zinc-200 py-3 z-50">
                <div class="px-4 pb-2 border-b border-zinc-100 flex items-center justify-between">
                    <span class="font-extrabold text-xs text-zinc-900">Notifikasi Laporan Kasir</span>
                    <span class="text-[10px] font-extrabold text-white bg-maroon-primary px-2 py-0.5 rounded-full">3 Baru</span>
                </div>

                <div class="divide-y divide-zinc-100 max-h-64 overflow-y-auto">
                    <a href="#laporan-kasir" class="block p-3 hover:bg-zinc-50 transition">
                        <div class="flex items-start gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs shrink-0">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div>
                                <p class="text-xs font-extrabold text-zinc-800">Kasir Sutan Menutup Shift 1</p>
                                <p class="text-[11px] text-zinc-500">Laporan disetor: Rp 1.900.000 (Fisik Laci Pas)</p>
                                <span class="text-[10px] text-zinc-400 font-medium">10 menit yang lalu</span>
                            </div>
                        </div>
                    </a>

                    <a href="#laporan-kasir" class="block p-3 hover:bg-zinc-50 transition">
                        <div class="flex items-start gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-rose-100 text-maroon-primary flex items-center justify-center font-bold text-xs shrink-0">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <div>
                                <p class="text-xs font-extrabold text-zinc-800">Pengajuan Kas Out oleh Kasir Rahma</p>
                                <p class="text-[11px] text-zinc-500">Beli Es Batu & Plastik Takeaway (Rp 35.000)</p>
                                <span class="text-[10px] text-zinc-400 font-medium">25 menit yang lalu</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="p-2 pt-2 border-t border-zinc-100 text-center">
                    <a href="#laporan-kasir" class="text-xs font-extrabold text-maroon-primary hover:text-maroon-dark hover:underline">Lihat Semua Laporan →</a>
                </div>
            </div>
        </div>

        <!-- Admin Profile Menu -->
        <div class="flex items-center gap-3 pl-2 border-l border-zinc-200">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-maroon-primary via-maroon-secondary to-amber-500 text-white flex items-center justify-center font-extrabold text-xs shadow-sm">
                UD
            </div>
            <div class="hidden sm:block text-left">
                <span class="block text-xs font-extrabold text-zinc-900 leading-tight">Uda Sutan</span>
                <span class="block text-[10px] font-semibold text-maroon-primary">Pemilik & Admin</span>
            </div>
        </div>
    </div>

</header>
