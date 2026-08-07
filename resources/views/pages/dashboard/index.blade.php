@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Header --}}
    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Welcome back, Admin 👋
        </h2>

        <p class="mt-1 text-sm text-gray-500">
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

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                <div>

                    <h3 class="font-semibold text-gray-900">
                        Recent Borrowings
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Latest library transactions
                    </p>

                </div>

                <a href="{{ route('borrowings.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                    View all
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">

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


                    <tbody class="divide-y divide-gray-100">

                        <tr>

                            <td class="px-6 py-4 font-medium">
                                Juan Dela Cruz
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                Clean Code
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                Aug 08, 2026
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge variant="success">
                                    Active
                                </x-ui.badge>

                            </td>

                        </tr>


                        <tr>

                            <td class="px-6 py-4 font-medium">
                                Maria Santos
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                Atomic Habits
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                Aug 06, 2026
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge variant="warning">
                                    Due Soon
                                </x-ui.badge>

                            </td>

                        </tr>


                        <tr>

                            <td class="px-6 py-4 font-medium">
                                Pedro Reyes
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                The Hobbit
                            </td>

                            <td class="px-6 py-4 text-gray-600">
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

            <div class="border-b border-gray-200 px-6 py-4">

                <h3 class="font-semibold text-gray-900">
                    Popular Books
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Most borrowed books
                </p>

            </div>


            <div class="divide-y divide-gray-100">

                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold">
                            Clean Code
                        </p>

                        <p class="text-xs text-gray-500">
                            Robert C. Martin
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500">
                        42 loans
                    </span>

                </div>


                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold">
                            Atomic Habits
                        </p>

                        <p class="text-xs text-gray-500">
                            James Clear
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500">
                        35 loans
                    </span>

                </div>


                <div class="flex items-center gap-4 px-6 py-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        📕
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold">
                            The Hobbit
                        </p>

                        <p class="text-xs text-gray-500">
                            J.R.R. Tolkien
                        </p>

                    </div>

                    <span class="text-xs font-medium text-gray-500">
                        29 loans
                    </span>

                </div>

            </div>

        </x-ui.card>

    </div>


    {{-- Quick actions --}}
    {{-- Quick actions --}}
    <div class="mt-6">
        <h3 class="mb-4 text-lg font-semibold">Quick Actions</h3>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Add Book --}}
            <a href="{{ route('books.create') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow">
                <div class="mb-3 text-2xl">📚</div>
                <p class="font-semibold">Add Book</p>
                <p class="mt-1 text-sm text-gray-500">Add a new book to inventory.</p>
            </a>

            {{-- Add Member --}}
            <a href="{{ route('members.create') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow">
                <div class="mb-3 text-2xl">👤</div>
                <p class="font-semibold">Add Member</p>
                <p class="mt-1 text-sm text-gray-500">Register a new library member.</p>
            </a>

            {{-- Borrow Book --}}
            <a href="{{ route('borrowings.index') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow">
                <div class="mb-3 text-2xl">📖</div>
                <p class="font-semibold">Borrow Book</p>
                <p class="mt-1 text-sm text-gray-500">Create a new borrowing transaction.</p>
            </a>

            {{-- Return Book --}}
            <a href="{{ route('returns.index') }}"
                class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow">
                <div class="mb-3 text-2xl">🔄</div>
                <p class="font-semibold">Return Book</p>
                <p class="mt-1 text-sm text-gray-500">Process returned library books.</p>
            </a>

        </div>
    </div>

@endsection
