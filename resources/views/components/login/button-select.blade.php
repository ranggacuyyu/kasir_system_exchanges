{{-- resources/views/components/button-user-type.blade.php --}}

@props([
    'active' => false,
    'icon' => 'bi-person',
])

<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => '
            flex-1 p-4 border-2 rounded-xl bg-white
            transition-all duration-300 ease-in-out
            flex flex-col items-center gap-2
            relative overflow-hidden
            hover:border-maroon-primary
            hover:-translate-y-1
            hover:shadow-[0_5px_15px_rgba(114,28,36,0.2)]
            ' .
            ($active
                ? ' bg-liner-color border-maroon-primary text-white scale-105'
                : ' border-gray-300 text-gray-700')
    ]) }}>

    <i class="bi {{ $icon }}
        text-[2rem]
        transition-all duration-300
        {{ $active ? 'text-white' : '' }}">
    </i>

    <span class="font-semibold text-sm">
        {{ $slot }}
    </span>

</button>