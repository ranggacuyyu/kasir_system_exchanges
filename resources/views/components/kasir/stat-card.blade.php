@props([
    'title' => 'Statistik',
    'value' => '0',
    'icon' => 'fa-solid fa-chart-line',
    'color' => 'maroon', // maroon, emerald, amber, indigo, rose, violet
    'trend' => null, // e.g. '+12.5%'
    'trendType' => 'up', // 'up' or 'down'
    'subtext' => 'vs minggu lalu',
])

@php
    // Theme presets
    $themes = [
        'maroon' => [
            'bg' => 'from-maroon-dark via-maroon-primary to-maroon-secondary',
            'iconBg' => 'bg-white/20',
            'accent' => 'bg-white/25',
        ],
        'emerald' => [
            'bg' => 'from-emerald-900 via-emerald-700 to-emerald-600',
            'iconBg' => 'bg-white/20',
            'accent' => 'bg-white/25',
        ],
        'amber' => [
            'bg' => 'from-amber-900 via-amber-700 to-amber-600',
            'iconBg' => 'bg-white/20',
            'accent' => 'bg-white/25',
        ],
        'indigo' => [
            'bg' => 'from-indigo-950 via-indigo-800 to-indigo-600',
            'iconBg' => 'bg-white/20',
            'accent' => 'bg-white/25',
        ],
        'rose' => [
            'bg' => 'from-rose-950 via-rose-800 to-rose-600',
            'iconBg' => 'bg-white/20',
            'accent' => 'bg-white/25',
        ],
    ];

    $currentTheme = $themes[$color] ?? $themes['maroon'];
@endphp

<div x-data="{ 
    hovered: false, 
    val: '{{ $value }}',
    title: '{{ $title }}'
}" 
@mouseenter="hovered = true" 
@mouseleave="hovered = false"
class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">

    {{-- Background Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br {{ $currentTheme['bg'] }}"></div>
    
    {{-- Decorative Background Elements --}}
    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-white/10 group-hover:scale-110 transition-transform duration-500"></div>
    <div class="absolute -right-2 -bottom-6 w-16 h-16 rounded-full bg-white/5"></div>

    <div class="relative p-5 flex flex-col justify-between h-full min-h-[120px]">
        {{-- Card Header --}}
        <div class="flex items-center justify-between gap-2">
            <p class="text-white/80 text-xs font-semibold uppercase tracking-wider truncate" x-text="title"></p>
            <div class="flex-shrink-0 w-9 h-9 rounded-xl {{ $currentTheme['iconBg'] }} backdrop-blur-sm flex items-center justify-center text-white transition-transform group-hover:rotate-6">
                <i class="{{ $icon }} text-base"></i>
            </div>
        </div>

        {{-- Card Value & Trend --}}
        <div class="mt-3 flex items-baseline justify-between gap-2">
            <h3 class="text-2xl lg:text-3xl font-extrabold text-white leading-tight tracking-tight" x-text="val"></h3>
            
            @if($trend)
                <div class="flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold backdrop-blur-sm {{ $trendType === 'up' ? 'bg-emerald-500/20 text-emerald-200 border border-emerald-400/30' : 'bg-rose-500/20 text-rose-200 border border-rose-400/30' }}">
                    <i class="fa-solid {{ $trendType === 'up' ? 'fa-arrow-up-right' : 'fa-arrow-down-right' }} text-[10px]"></i>
                    <span>{{ $trend }}</span>
                </div>
            @endif
        </div>

        {{-- Subtext --}}
        @if($subtext)
            <p class="text-white/60 text-[11px] mt-1 flex items-center gap-1">
                <span>{{ $subtext }}</span>
            </p>
        @endif
    </div>

    {{-- Bottom Accent Bar --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 {{ $currentTheme['accent'] }}"></div>
</div>
