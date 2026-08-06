@props([
    'active' => null, // Opsional: 'pesanan', 'hitung', 'stok', 'absensi', 'laporan'
])

@php
    // Deteksi otomatis halaman mana yang sedang dibuka
    $currentRoute = $active ?? match(true) {
        request()->routeIs('kasir.pesanan') || request()->is('kasir/pesanan*') => 'pesanan',
        request()->routeIs('kasir.hitung') || request()->is('kasir/hitung*') => 'hitung',
        request()->routeIs('kasir.stok') || request()->is('kasir/stok*') => 'stok',
        request()->routeIs('kasir.absensi') || request()->is('kasir/absensi*') => 'absensi',
        request()->routeIs('kasir.laporan') || request()->is('kasir/laporan*') => 'laporan',
        default => 'pesanan',
    };

    $menus = [
        [
            'id' => 'pesanan',
            'label' => 'Pesanan',
            'icon' => 'fa-solid fa-cart-shopping',
            'route' => route('kasir.dashboard'),
        ],
        [
            'id' => 'hitung',
            'label' => 'Hitung',
            'icon' => 'fa-solid fa-calculator',
            'route' => route('kasir.hitung'),
        ],
        [
            'id' => 'stok',
            'label' => 'Stok',
            'icon' => 'fa-solid fa-boxes-stacked',
            'route' => route('kasir.stok'),
        ],
        [
            'id' => 'absensi',
            'label' => 'Absensi',
            'icon' => 'fa-solid fa-user-check',
            'route' => route('kasir.absensi'),
        ],
        [
            'id' => 'laporan',
            'label' => 'Laporan',
            'icon' => 'fa-solid fa-chart-line',
            'route' => route('kasir.laporan'),
        ],
    ];
@endphp

<!-- Navbar (Auto Active Navigation) -->
<div class="fixed z-50 md:flex w-auto flex-row bg-gradient-to-r md:right-0 md:left-0 from-maroon-primary to-maroon-dark md:mb-0 mb-4 left-4 right-4 bottom-0 md:top-0 md:bottom-auto rounded-3xl md:rounded-none shadow-xl md:shadow-md border-t md:border-t-0 border-white/10">

    {{-- Brand Logo / Name --}}
    <div class="p-4 text-zinc-100 font-extrabold text-lg pl-8 hidden md:flex items-center gap-3">
        <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-2 text-white hover:text-amber-300 transition">
            <span>Kasir System</span>
        </a>
    </div>

    {{-- Dynamic Menu Links --}}
    <div class="flex-1 flex justify-evenly flex-wrap md:justify-end items-center p-2 text-white font-bold md:gap-8 text-sm md:text-base md:pr-12">

        @foreach($menus as $menu)
            @php
                $isActive = ($currentRoute === $menu['id']);
            @endphp
            
            <a href="{{ $menu['route'] }}" 
               class="group relative flex flex-col md:flex-row items-center gap-1.5 md:gap-2 px-1 py-1.5 rounded-xl transition-all duration-200 cursor-pointer
                      {{ $isActive 
                          ? 'text-amber-300 font-extrabold bg-white/10 md:bg-white/15 shadow-inner' 
                          : 'text-white/80 hover:text-amber-200 hover:bg-white/5' }}">
                
                {{-- Active Indicator Line (Desktop: Bottom, Mobile: Dot) --}}
                @if($isActive)
                    <span class="hidden md:block absolute -bottom-2 left-3 right-3 h-1 bg-amber-400 rounded-t-full shadow-sm"></span>
                @endif

                <div class="text-base md:text-lg transition-transform group-hover:scale-110 {{ $isActive ? 'text-amber-400' : 'text-white/70' }}">
                    <i class="{{ $menu['icon'] }}"></i>
                </div>

                <span class="text-xs md:text-sm tracking-wide">{{ $menu['label'] }}</span>
            </a>
        @endforeach

    </div>
</div>