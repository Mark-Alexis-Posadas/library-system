@extends('layouts.app')

@section('title', 'Book Details')
@section('page-title', 'Book Details')

@section('content')

    <div class="mb-6 flex items-center justify-between">

        <div>
            <a href="{{ route('books.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Back to Books
            </a>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('books.edit', 1) }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold hover:bg-gray-50">
                Edit
            </a>

            <x-ui.button variant="danger">
                Delete
            </x-ui.button>

        </div>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Book information --}}
        <x-ui.card class="p-6">

            <div class="flex aspect-[3/4] items-center justify-center rounded-xl bg-gray-100 text-7xl">
                📕
            </div>

            <div class="mt-5">

                <h2 class="text-xl font-bold">
                    Clean Code
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Robert C. Martin
                </p>

                <div class="mt-4">
                    <x-ui.badge variant="success">
                        Available
                    </x-ui.badge>
                </div>

            </div>

        </x-ui.card>


        {{-- Details --}}
        <x-ui.card class="p-6 lg:col-span-2">

            <h3 class="text-lg font-semibold">
                Book Information
            </h3>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">

                <div>
                    <p class="text-xs text-gray-500">ISBN</p>
                    <p class="mt-1 font-medium">9780132350884</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Category</p>
                    <p class="mt-1 font-medium">Programming</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Publisher</p>
                    <p class="mt-1 font-medium">Prentice Hall</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Publication Year</p>
                    <p class="mt-1 font-medium">2008</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Shelf Location</p>
                    <p class="mt-1 font-medium">A-01-03</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Total Copies</p>
                    <p class="mt-1 font-medium">10</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Available Copies</p>
                    <p class="mt-1 font-medium text-green-600">7</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Borrowed Copies</p>
                    <p class="mt-1 font-medium text-orange-600">3</p>
                </div>

            </div>

            <div class="mt-6 border-t border-gray-200 pt-6">

                <h3 class="font-semibold">
                    Description
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    Clean Code is a handbook of agile software craftsmanship
                    that teaches developers how to write readable, maintainable,
                    and high-quality code.
                </p>

            </div>

        </x-ui.card>

    </div>

@endsection
