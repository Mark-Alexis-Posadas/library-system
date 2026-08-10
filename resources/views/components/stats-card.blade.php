@props(['title', 'value', 'icon'])

<x-ui.card class="p-5">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                {{ $title }}
            </p>

            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                {{ $value }}
            </p>

        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-xl dark:bg-indigo-900/40">
            {{ $icon }}
        </div>

    </div>

</x-ui.card>
