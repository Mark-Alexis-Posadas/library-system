@extends('layouts.app')

@section('title', 'Member Details')
@section('page-title', 'Member Details')

@section('content')

    <div class="mb-6">
        <a href="{{ route('members.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
            ← Back to Members
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Profile --}}
        <x-ui.card class="p-6">

            <div class="text-center">

                <div
                    class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-indigo-100 text-3xl font-bold text-indigo-700">
                    J
                </div>

                <h2 class="mt-4 text-xl font-bold">
                    Juan Dela Cruz
                </h2>

                <p class="text-sm text-gray-500">
                    LIB-0001
                </p>

                <div class="mt-3">
                    <x-ui.badge variant="success">
                        Active
                    </x-ui.badge>
                </div>

            </div>

            <div class="mt-6 space-y-4 border-t border-gray-200 pt-6">

                <div>
                    <p class="text-xs text-gray-500">Email</p>
                    <p class="mt-1 text-sm font-medium">juan@example.com</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Phone</p>
                    <p class="mt-1 text-sm font-medium">0917 123 4567</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Address</p>
                    <p class="mt-1 text-sm font-medium">Lingayen, Pangasinan</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Member Since</p>
                    <p class="mt-1 text-sm font-medium">January 10, 2026</p>
                </div>

            </div>

        </x-ui.card>


        {{-- Borrowing history --}}
        <x-ui.card class="lg:col-span-2">

            <div class="border-b border-gray-200 px-6 py-4">

                <h3 class="font-semibold">
                    Borrowing History
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Member's borrowing activity
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                        <tr>
                            <th class="px-6 py-3">Book</th>
                            <th class="px-6 py-3">Borrowed</th>
                            <th class="px-6 py-3">Due Date</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        <tr>
                            <td class="px-6 py-4 font-medium">
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
                                    Active
                                </x-ui.badge>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-medium">
                                Atomic Habits
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                Jul 10, 2026
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                Jul 17, 2026
                            </td>

                            <td class="px-6 py-4">
                                <x-ui.badge variant="info">
                                    Returned
                                </x-ui.badge>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </x-ui.card>

    </div>

@endsection
