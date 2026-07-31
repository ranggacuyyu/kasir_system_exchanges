{{-- ============================================================
     CARD PESANAN
     Mobile  : 2 kolom × 2 baris  → layout vertikal (icon atas, teks bawah)
     Desktop : 1 baris × 4 kolom  → layout horizontal (icon kiri, teks kanan)
     ============================================================ --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">

    {{-- ===== Card 1 – Total Pesanan ===== --}}
    <div class="group relative overflow-hidden rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-default">

        <div class="absolute inset-0 bg-gradient-to-br from-maroon-dark via-maroon-primary to-maroon-secondary"></div>
        <div class="absolute -right-4 -top-4 w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-white/10 group-hover:bg-white/15 transition-all duration-300"></div>
        <div class="absolute -right-1 -bottom-5 w-12 h-12 lg:w-16 lg:h-16 rounded-full bg-white/5"></div>

        {{-- Mobile: header atas, icon kiri + angka kanan --}}
        <div class="relative flex flex-col p-3 lg:hidden">
            {{-- Label header --}}
            <p class="text-white/90 text-[10px] font-bold tracking-widest uppercase pb-2 mb-2 border-b border-white/20">Total Pesanan</p>
            {{-- Baris: icon kiri | angka + sub kanan --}}
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-cart-shopping text-xs text-white"></i>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold text-white leading-none">0</h2>
                    <span class="text-white/50 text-[10px] mt-0.5">Hari ini</span>
                </div>
            </div>
        </div>

        {{-- Desktop: horizontal (icon kiri + teks kanan) --}}
        <div class="relative hidden lg:flex items-center gap-4 p-5">
            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                <i class="fa-solid fa-cart-shopping text-xl text-white"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-white/70 text-xs font-medium tracking-wide uppercase truncate">Total Pesanan</p>
                <h2 class="text-3xl font-bold text-white leading-tight mt-0.5">0</h2>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-arrow-trend-up text-xs text-white/50"></i>
                    <span class="text-xs text-white/50">Hari ini</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-0.5 lg:h-1 bg-white/25"></div>
    </div>

    {{-- ===== Card 2 – Pesanan Dibuat ===== --}}
    <div class="group relative overflow-hidden rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-default">

        <div class="absolute inset-0 bg-gradient-to-br from-[#5d1a1a] via-[#721c24] to-[#9b2335]"></div>
        <div class="absolute -right-4 -top-4 w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-white/10 group-hover:bg-white/15 transition-all duration-300"></div>
        <div class="absolute -right-1 -bottom-5 w-12 h-12 lg:w-16 lg:h-16 rounded-full bg-white/5"></div>

        {{-- Mobile --}}
        <div class="relative flex flex-col p-3 lg:hidden">
            <p class="text-white/90 text-[10px] font-bold tracking-widest uppercase pb-2 mb-2 border-b border-white/20">Pesanan Dibuat</p>
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-clipboard-check text-xs text-white"></i>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold text-white leading-none">0</h2>
                    <span class="text-white/50 text-[10px] mt-0.5">Diproses</span>
                </div>
            </div>
        </div>

        {{-- Desktop --}}
        <div class="relative hidden lg:flex items-center gap-4 p-5">
            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                <i class="fa-solid fa-clipboard-check text-xl text-white"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-white/70 text-xs font-medium tracking-wide uppercase truncate">Pesanan Dibuat</p>
                <h2 class="text-3xl font-bold text-white leading-tight mt-0.5">0</h2>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-check-circle text-xs text-white/50"></i>
                    <span class="text-xs text-white/50">Sudah diproses</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-0.5 lg:h-1 bg-white/25"></div>
    </div>

    {{-- ===== Card 3 – Pendapatan ===== --}}
    <div class="group relative overflow-hidden rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-default">

        <div class="absolute inset-0 bg-gradient-to-br from-[#642930] via-[#a52834] to-[#b8345e]"></div>
        <div class="absolute -right-4 -top-4 w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-white/10 group-hover:bg-white/15 transition-all duration-300"></div>
        <div class="absolute -right-1 -bottom-5 w-12 h-12 lg:w-16 lg:h-16 rounded-full bg-white/5"></div>

        {{-- Mobile --}}
        <div class="relative flex flex-col p-3 lg:hidden">
            <p class="text-white/90 text-[10px] font-bold tracking-widest uppercase pb-2 mb-2 border-b border-white/20">Pendapatan</p>
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-wave text-xs text-white"></i>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-lg font-bold text-white leading-none">Rp 0</h2>
                    <span class="text-white/50 text-[10px] mt-0.5">Hari ini</span>
                </div>
            </div>
        </div>

        {{-- Desktop --}}
        <div class="relative hidden lg:flex items-center gap-4 p-5">
            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                <i class="fa-solid fa-money-bill-wave text-xl text-white"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-white/70 text-xs font-medium tracking-wide uppercase truncate">Pendapatan</p>
                <h2 class="text-2xl font-bold text-white leading-tight mt-0.5">Rp 0</h2>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-wallet text-xs text-white/50"></i>
                    <span class="text-xs text-white/50">Hari ini</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-0.5 lg:h-1 bg-white/25"></div>
    </div>

    {{-- ===== Card 4 – Total Pelanggan ===== --}}
    <div class="group relative overflow-hidden rounded-xl lg:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-default">

        <div class="absolute inset-0 bg-gradient-to-br from-[#220707] via-[#642930] to-[#ac9185]"></div>
        <div class="absolute -right-4 -top-4 w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-white/10 group-hover:bg-white/15 transition-all duration-300"></div>
        <div class="absolute -right-1 -bottom-5 w-12 h-12 lg:w-16 lg:h-16 rounded-full bg-white/5"></div>

        {{-- Mobile --}}
        <div class="relative flex flex-col p-3 lg:hidden">
            <p class="text-white/90 text-[10px] font-bold tracking-widest uppercase pb-2 mb-2 border-b border-white/20">Pelanggan</p>
            <div class="flex items-center gap-2.5">
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-users text-xs text-white"></i>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold text-white leading-none">0</h2>
                    <span class="text-white/50 text-[10px] mt-0.5">Terdaftar</span>
                </div>
            </div>
        </div>

        {{-- Desktop --}}
        <div class="relative hidden lg:flex items-center gap-4 p-5">
            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                <i class="fa-solid fa-users text-xl text-white"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-white/70 text-xs font-medium tracking-wide uppercase truncate">Total Pelanggan</p>
                <h2 class="text-3xl font-bold text-white leading-tight mt-0.5">0</h2>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-user-plus text-xs text-white/50"></i>
                    <span class="text-xs text-white/50">Terdaftar</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-0.5 lg:h-1 bg-white/25"></div>
    </div>

</div>
