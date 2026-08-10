@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Header --}}
    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Welcome back, {{ auth()->user()->name }} 👋
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Here's what's happening in your library today.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <x-stats-card title="Total Books" value="1,240" icon="📚" description="+12 this month" />

        <x-stats-card title="Total Members" value="328" icon="👥" description="+8 this month" />

        <x-stats-card title="Borrowed Books" value="86" icon="📖" description="Currently borrowed" />

        <x-stats-card title="Overdue Books" value="12" icon="⚠️" description="Needs attention" />

    </div>


    {{-- Main dashboard content --}}
    <div class="mt-6 grid gap-6 xl:grid-cols-3">

        {{-- Recent Borrowings --}}
        <x-ui.card class="xl:col-span-2">

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">

                <div>

                    <h3 class="font-semibold text-gray-900 dark:text-white">
                        Recent Borrowings
                    </h3>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Latest library transactions
                    </p>

                </div>

                <a href="{{ route('borrowings.index') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                    View all
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-800 dark:text-gray-400">

                        <tr>

                            <th class="px-6 py-3">
                                Member
                            </th>

                            <th class="px-6 py-3">
                                Book
                            </th>

                            <th class="px-6 py-3">
                                Due Date
                            </th>

                            <th class="px-6 py-3">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                        <tr>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                Juan Dela Cruz
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                Clean Code
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                Aug 08, 2026
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge variant="success">
                                    Active
                                </x-ui.badge>

                            </td>

                        </tr>


                        <tr>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                Maria Santos
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                Atomic Habits
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                Aug 06, 2026
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge variant="warning">
                                    Due Soon
                                </x-ui.badge>

                            </td>

                        </tr>


                        <tr>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                Pedro Reyes
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                The Hobbit
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                Aug 02, 2026
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge variant="danger">
                                    Overdue
                                </x-ui.badge>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </x-ui.card>


        {{-- Popular Books --}}
        <x-ui.card>

            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">

                <h3 class="font-semibold text-gray-900 dark:text-white">
                    Popular Books
                </h3>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Most borrowed books
                </p>

            </div>


            <div class="divide-y divide-gray-100 dark:divide-gray-700">

                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/30">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Clean Code
                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Robert C. Martin
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        42 loans
                    </span>

                </div>


                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/30">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Atomic Habits
                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            James Clear
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        35 loans
                    </span>

                </div>


                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/30">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-gray-900 dark:text-gray-100">
                            The Hobbit
                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            J.R.R. Tolkien
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        29 loans
                    </span>

                </div>

            </div>

        </x-ui.card>

    </div>


    {{-- Quick actions --}}
    <div class="mt-6">

        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            Quick Actions
        </h3>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Add Book --}}
            <a href="{{ route('books.create') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:border-indigo-500">

                <div class="mb-3 text-2xl">📚</div>

                <p class="font-semibold text-gray-900 dark:text-white">
                    Add Book
                </p>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Add a new book to inventory.
                </p>

            </a>


            {{-- Add Member --}}
            <a href="{{ route('members.create') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:border-indigo-500">

                <div class="mb-3 text-2xl">👤</div>

                <p class="font-semibold text-gray-900 dark:text-white">
                    Add Member
                </p>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Register a new library member.
                </p>

            </a>


            {{-- Borrow Book --}}
            <a href="{{ route('borrowings.index') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:border-indigo-500">

                <div class="mb-3 text-2xl">📖</div>

                <p class="font-semibold text-gray-900 dark:text-white">
                    Borrow Book
                </p>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Create a new borrowing transaction.
                </p>

            </a>


            {{-- Return Book --}}
            <a href="{{ route('returns.index') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:border-indigo-500">

                <div class="mb-3 text-2xl">🔄</div>

                <p class="font-semibold text-gray-900 dark:text-white">
                    Return Book
                </p>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Process returned library books.
                </p>

            </a>

        </div>

    </div>

@endsection
