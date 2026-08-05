@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php

    $variants = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
        'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'success' => 'bg-green-600 text-white hover:bg-green-700',
    ];

@endphp

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold transition {$variants[$variant]}",
    ]) }}>
    {{ $slot }}
</button>
