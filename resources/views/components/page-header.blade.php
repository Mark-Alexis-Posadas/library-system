@props(['title', 'description' => null])

<div class="mb-6 flex items-center justify-between">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">
            {{ $title }}
        </h2>

        @if ($description)
            <p class="mt-1 text-sm text-gray-500">
                {{ $description }}
            </p>
        @endif
    </div>

    @if (isset($action))
        <div>
            {{ $action }}
        </div>
    @endif

</div>
