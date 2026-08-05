@props([
    'label' => null,
    'name',
])

<div>

    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->merge([
            'class' =>
                'block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100',
        ]) }}>

        {{ $slot }}

    </select>

    @error($name)
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror

</div>
