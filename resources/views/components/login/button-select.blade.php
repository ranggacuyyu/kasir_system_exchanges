@props([
    'icon' => 'bi-person',
    'value',
])

<button
    type="button"
    @click="selected = @js($value)"
    wire:click="setUserType(@js($value))"
    :class="selected === @js($value)
        ? 'bg-var border-red-500 text-white scale-105'
        : 'bg-white border-gray-300 text-gray-700'"
    {{ $attributes->merge(['class' => '
        flex-1 p-4 border-2 rounded-xl
        transition-all duration-300 ease-in-out
        flex flex-col items-center gap-2
        relative overflow-hidden
        hover:border-maroon-primary
        hover:-translate-y-1
        hover:shadow-[0_5px_15px_rgba(114,28,36,0.2)]
    ']) }}>

    <i class="bi {{ $icon }} text-[2rem] transition-all duration-300"></i>

    <span class="font-semibold text-sm">
        {{ $slot }}
    </span>

</button>
