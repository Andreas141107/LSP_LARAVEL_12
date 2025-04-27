@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block p-2 rounded duration-300 transform hover:scale-105 font-semibold hover:text-white hover:bg-white/10 flex items-center'
            : 'block p-2 rounded duration-300 transform hover:scale-105 font-semibold hover:text-gray-700 hover:bg-white/10 hover:text-gray-500 flex text-white/50 hover:text-white items-center';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

