@extends('layouts.app')

@section('title', 'Reports')
@section('page-title', 'Reports')

@section('content')

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            Reports
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            View library statistics and activity reports.
        </p>
    </div>


    {{-- Filters --}}
    <x-ui.card class="mb-6 p-5">

        <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col gap-4 md:flex-row md:items-end">

            <div class="w-full md:w-64">
                <x-ui.select name="period" label="Period">

                    <option value="this_month" @selected($period === 'this_month')>
                        This Month
                    </option>

                    <option value="last_month" @selected($period === 'last_month')>
                        Last Month
                    </option>

                    <option value="this_year" @selected($period === 'this_year')>
                        This Year
                    </option>

                </x-ui.select>
            </div>

            <x-ui.button type="submit">
                Generate Report
            </x-ui.button>

        </form>

    </x-ui.card>


    {{-- Report Period --}}
    <div class="mb-5 text-sm text-gray-500">
        Showing reports from
        <span class="font-medium text-gray-700">
            {{ $startDate->format('M d, Y') }}
        </span>
        to
        <span class="font-medium text-gray-700">
            {{ $endDate->format('M d, Y') }}
        </span>
    </div>


    {{-- Statistics --}}
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

        <x-stats-card title="Total Borrowings" value="{{ number_format($totalBorrowings) }}" icon="📖" />

        <x-stats-card title="Returned Books" value="{{ number_format($returnedBooks) }}" icon="🔄" />

        <x-stats-card title="Overdue" value="{{ number_format($overdueBooks) }}" icon="⚠️" />

        <x-stats-card title="Collected Fines" value="₱{{ number_format($collectedFines, 2) }}" icon="💰" />

    </div>


    {{-- Reports --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-2">

        {{-- Borrowing Activity --}}
        <x-ui.card class="p-6">

            <div>
                <h3 class="font-semibold text-gray-900">
                    Borrowing Activity
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Monthly borrowing overview
                </p>
            </div>


            {{-- Chart --}}
            <div class="mt-6 flex h-64 items-end gap-3 border-b border-l border-gray-200 px-4 pb-2">

                @php
                    $maxBorrowings = max($monthlyData->max('count'), 1);
                @endphp

                @foreach ($monthlyData as $data)
                    <div class="flex h-full flex-1 flex-col items-center justify-end">

                        <div class="mb-2 text-xs text-gray-500">
                            {{ $data['count'] }}
                        </div>

                        <div class="w-full max-w-8 rounded-t-md bg-indigo-500"
                            style="
                                height: {{ ($data['count'] / $maxBorrowings) * 85 }}%;
                                min-height: {{ $data['count'] > 0 ? '4px' : '0' }};
                            ">
                        </div>

                    </div>
                @endforeach

            </div>


            {{-- Month Labels --}}
            <div class="mt-3 flex gap-3 px-4">

                @foreach ($monthlyData as $data)
                    <div class="flex-1 text-center text-xs text-gray-500">
                        {{ $data['month'] }}
                    </div>
                @endforeach

            </div>

        </x-ui.card>


        {{-- Popular Books --}}
        <x-ui.card class="p-6">

            <div>
                <h3 class="font-semibold text-gray-900">
                    Most Borrowed Books
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Top performing books
                </p>
            </div>


            @if ($popularBooks->count())

                @php
                    $maxBorrowCount = max($popularBooks->max('borrow_count'), 1);
                @endphp

                <div class="mt-5 space-y-5">

                    @foreach ($popularBooks as $book)
                        <div>

                            <div class="mb-2 flex justify-between gap-4 text-sm">

                                <span class="truncate font-medium text-gray-900">
                                    {{ $book->book?->title ?? 'Unknown Book' }}
                                </span>

                                <span class="shrink-0 text-gray-500">
                                    {{ $book->borrow_count }}
                                    {{ $book->borrow_count === 1 ? 'loan' : 'loans' }}
                                </span>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                                <div class="h-full rounded-full bg-indigo-500"
                                    style="
                                        width: {{ ($book->borrow_count / $maxBorrowCount) * 100 }}%;
                                    ">
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="mt-8 text-center">

                    <div class="text-3xl">
                        📚
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        No borrowing data available for this period.
                    </p>

                </div>

            @endif

        </x-ui.card>

    </div>

@endsection
