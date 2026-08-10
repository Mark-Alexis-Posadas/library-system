@props([
    'label' => null,
    'name',
    'type' => 'text',
    'placeholder' => '',
])

@if ($label)
    <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
        {{ $label }} </label>
@endif

<input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
    value="{{ old($name, $attributes->get('value')) }}"
    {{ $attributes->merge([
        'class' =>
            'block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20',
    ]) }}>

@error($name)
    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
        {{ $message }} </p>
@enderror
