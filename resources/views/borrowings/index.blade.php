@extends('layouts.app')

@section('title', 'Borrowings')
@section('page-title', 'Borrowings')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-2xl font-bold">
                Borrowings
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Track currently borrowed books.
            </p>
        </div>

        <a href="{{ route('borrowings.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
            + Borrow Book
        </a>

    </div>


    <x-ui.card>

        <div class="flex flex-col gap-3 border-b border-gray-200 p-5 md:flex-row">

            <input type="text" placeholder="Search member or book..."
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm md:max-w-sm">

            <select class="rounded-lg border border-gray-300 px-3 py-2.5 text-sm">
                <option>All Status</option>
                <option>Borrowed</option>
                <option>Due Soon</option>
                <option>Overdue</option>
                <option>Returned</option>
            </select>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                    <tr>
                        <th class="px-6 py-3">Member</th>
                        <th class="px-6 py-3">Book</th>
                        <th class="px-6 py-3">Borrowed Date</th>
                        <th class="px-6 py-3">Due Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-semibold">
                            Juan Dela Cruz
                        </td>

                        <td class="px-6 py-4">
                            Clean Code
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Aug 01, 2026
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Aug 08, 2026
                        </td>

                        <td class="px-6 py-4">
                            <x-ui.badge variant="success">
                                Borrowed
                            </x-ui.badge>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('returns.index') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-800">
                                Return
                            </a>
                        </td>

                    </tr>


                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-semibold">
                            Maria Santos
                        </td>

                        <td class="px-6 py-4">
                            Atomic Habits
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Jul 30, 2026
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Aug 06, 2026
                        </td>

                        <td class="px-6 py-4">
                            <x-ui.badge variant="warning">
                                Due Soon
                            </x-ui.badge>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('returns.index') }}" class="font-medium text-indigo-600">
                                Return
                            </a>
                        </td>

                    </tr>


                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-semibold">
                            Pedro Reyes
                        </td>

                        <td class="px-6 py-4">
                            The Hobbit
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Jul 20, 2026
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Jul 27, 2026
                        </td>

                        <td class="px-6 py-4">
                            <x-ui.badge variant="danger">
                                Overdue
                            </x-ui.badge>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('returns.index') }}" class="font-medium text-red-600">
                                Return
                            </a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </x-ui.card>

@endsection
