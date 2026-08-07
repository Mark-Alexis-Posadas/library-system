@extends('layouts.app')

@section('title', 'Returns')
@section('page-title', 'Returns')

@section('content')

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Return Books
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Process returned books and manage overdue fines.
        </p>

    </div>


    <x-ui.card>

        <div class="border-b border-gray-200 p-5">

            <input type="text" placeholder="Search member, book, or transaction..."
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm md:max-w-md">

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                    <tr>
                        <th class="px-6 py-3">Member</th>
                        <th class="px-6 py-3">Book</th>
                        <th class="px-6 py-3">Due Date</th>
                        <th class="px-6 py-3">Days Overdue</th>
                        <th class="px-6 py-3">Fine</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    <tr>

                        <td class="px-6 py-4 font-semibold">
                            Juan Dela Cruz
                        </td>

                        <td class="px-6 py-4">
                            Clean Code
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Aug 08, 2026
                        </td>

                        <td class="px-6 py-4">
                            0
                        </td>

                        <td class="px-6 py-4 font-semibold text-green-600">
                            ₱0.00
                        </td>

                        <td class="px-6 py-4 text-right">

                            <button
                                class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700">
                                Return
                            </button>

                        </td>

                    </tr>


                    <tr>

                        <td class="px-6 py-4 font-semibold">
                            Pedro Reyes
                        </td>

                        <td class="px-6 py-4">
                            The Hobbit
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Jul 27, 2026
                        </td>

                        <td class="px-6 py-4 font-semibold text-red-600">
                            9 days
                        </td>

                        <td class="px-6 py-4 font-semibold text-red-600">
                            ₱90.00
                        </td>

                        <td class="px-6 py-4 text-right">

                            <button
                                class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                Return
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </x-ui.card>

@endsection
