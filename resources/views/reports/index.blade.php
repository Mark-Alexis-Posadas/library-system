@extends('layouts.app')

@section('title', 'Reports')
@section('page-title', 'Reports')

@section('content')

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Reports
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            View library statistics and activity reports.
        </p>

    </div>


    {{-- Filters --}}
    <x-ui.card class="mb-6 p-5">

        <div class="flex flex-col gap-4 md:flex-row md:items-end">

            <x-ui.select name="period" label="Period">
                <option>This Month</option>
                <option>Last Month</option>
                <option>This Year</option>
            </x-ui.select>

            <x-ui.button>
                Generate Report
            </x-ui.button>

        </div>

    </x-ui.card>


    {{-- Statistics --}}
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

        <x-stats-card title="Total Borrowings" value="1,240" icon="📖" />

        <x-stats-card title="Returned Books" value="980" icon="🔄" />

        <x-stats-card title="Overdue" value="42" icon="⚠️" />

        <x-stats-card title="Collected Fines" value="₱8,420" icon="💰" />

    </div>


    <div class="mt-6 grid gap-6 lg:grid-cols-2">

        {{-- Borrowing activity --}}
        <x-ui.card class="p-6">

            <h3 class="font-semibold">
                Borrowing Activity
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                Monthly borrowing overview
            </p>

            <div class="mt-6 flex h-64 items-end justify-around gap-3 border-b border-l border-gray-200 px-5 pb-2">

                @foreach ([45, 70, 55, 85, 65, 90, 75] as $height)
                    <div class="w-8 rounded-t-md bg-indigo-500" style="height: {{ $height }}%"></div>
                @endforeach

            </div>

            <div class="mt-3 flex justify-around text-xs text-gray-500">
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>May</span>
                <span>Jun</span>
                <span>Jul</span>
            </div>

        </x-ui.card>


        {{-- Popular books --}}
        <x-ui.card class="p-6">

            <h3 class="font-semibold">
                Most Borrowed Books
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                Top performing books
            </p>

            <div class="mt-5 space-y-5">

                @foreach ([['title' => 'Clean Code', 'count' => 42], ['title' => 'Atomic Habits', 'count' => 35], ['title' => 'The Hobbit', 'count' => 29], ['title' => 'The Pragmatic Programmer', 'count' => 25]] as $book)
                    <div>

                        <div class="mb-2 flex justify-between text-sm">

                            <span class="font-medium">
                                {{ $book['title'] }}
                            </span>

                            <span class="text-gray-500">
                                {{ $book['count'] }} loans
                            </span>

                        </div>

                        <div class="h-2 rounded-full bg-gray-100">

                            <div class="h-2 rounded-full bg-indigo-500" style="width: {{ ($book['count'] / 42) * 100 }}%">
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </x-ui.card>

    </div>

@endsection
