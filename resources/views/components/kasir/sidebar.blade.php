@props([
    'active' => null, // Opsi manual: 'dashboard', 'pesanan', 'hitung', 'stok', 'laporan'
])

@php
    // Deteksi otomatis halaman aktif berdasarkan route name atau URL path
    $currentRoute = $active ?? match(true) {
        request()->routeIs('kasir.pesanan') || request()->is('kasir/pesanan*') => 'pesanan',
        request()->routeIs('kasir.hitung') || request()->is('kasir/hitung*') => 'hitung',
        request()->routeIs('kasir.stok') || request()->is('kasir/stok*') => 'stok',
        request()->routeIs('kasir.laporan') || request()->is('kasir/laporan*') => 'laporan',
        default => 'pesanan', // Default aktif
    };

    // Daftar Menu Navigation Sidebar
    $menus = [
        [
            'id' => 'pesanan',
            'label' => 'Daftar Pesanan',
            'icon' => 'fa-solid fa-receipt',
            'route' => route('kasir.dashboard'),
            'badge' => 'Live',
            'badgeColor' => 'bg-amber-500/20 text-amber-300 border-amber-400/30',
        ],
        [
            'id' => 'hitung',
            'label' => 'Hitung / Kasir POS',
            'icon' => 'fa-solid fa-calculator',
            'route' => '#',
            'badge' => null,
        ],
        [
            'id' => 'stok',
            'label' => 'Manajemen Stok',
            'icon' => 'fa-solid fa-boxes-stacked',
            'route' => '#',
            'badge' => null,
        ],
        [
            'id' => 'laporan',
            'label' => 'Laporan Omset',
            'icon' => 'fa-solid fa-chart-line',
            'route' => '#',
            'badge' => null,
        ],
    ];
@endphp

<!-- Sidebar Container -->
<aside class="w-64 bg-gradient-to-b from-maroon-dark via-maroon-primary to-maroon-dark text-white flex flex-col h-screen fixed left-0 top-0 z-40 shadow-2xl transition-all duration-300">
    
    {{-- Header Logo / App Name --}}
    <div class="p-6 border-b border-white/10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center text-amber-400 shadow-inner">
            <i class="fa-solid fa-store text-xl"></i>
        </div>
        <div>
            <h1 class="font-black text-base tracking-wide text-white leading-tight">Lapau Uda Sutan</h1>
            <p class="text-[11px] text-white/60 font-medium">System Kasir POS</p>
        </div>
    </div>

    {{-- Menu List --}}
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <p class="px-3 text-[10px] font-bold text-white/40 uppercase tracking-widest mb-3">Menu Utama</p>

        @foreach($menus as $menu)
            @php
                $isActive = ($currentRoute === $menu['id']);
            @endphp
            <a href="{{ $menu['route'] }}"
               class="group relative flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-semibold transition-all duration-200 cursor-pointer
                      {{ $isActive 
                          ? 'bg-white text-maroon-dark shadow-lg shadow-black/20 font-bold translate-x-1' 
                          : 'text-white/70 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                
                {{-- Left Accent Bar for Active item --}}
                @if($isActive)
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-amber-400 rounded-r-full"></span>
                @endif

                <div class="flex items-center">
                    <i class="{{ $menu['icon'] }} text-base transition-transform group-hover:scale-110 {{ $isActive ? 'text-maroon-primary' : 'text-white/60 group-hover:text-amber-300' }}"></i>
                    <span>{{ $menu['label'] }}</span>
                </div>

                @if($menu['badge'])
                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full border backdrop-blur-sm {{ $menu['badgeColor'] ?? 'bg-white/20 text-white border-white/20' }}">
                        {{ $menu['badge'] }}
                    </span>
                @endif
            </a>
        @endforeach
    </nav>

    {{-- Footer User Info / Logout --}}
    <div class="p-4 m-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-amber-400 text-maroon-dark font-bold text-xs flex items-center justify-center shadow">
                US
            </div>
            <div>
                <p class="text-xs font-bold text-white leading-tight">Uda Sutan</p>
                <p class="text-[10px] text-white/60">Kasir Utama</p>
            </div>
        </div>
        <a href="{{ route('login') }}" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-rose-500/30 text-white/70 hover:text-rose-200 flex items-center justify-center transition" title="Keluar">
            <i class="fa-solid fa-power-off text-xs"></i>
        </a>
    </div>
</aside>
