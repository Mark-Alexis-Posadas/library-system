@extends('layouts.app')

@section('title', 'Members')
@section('page-title', 'Members')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Members</h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage registered library members.
            </p>
        </div>

        <a href="{{ route('members.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
            + Add Member
        </a>
    </div>

    <x-ui.card>

        {{-- Filters --}}
        <div class="flex flex-col gap-3 border-b border-gray-200 p-5 md:flex-row">

            <input type="text" placeholder="Search members..."
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 md:max-w-sm">

            <select
                class="rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Member</th>
                        <th class="px-6 py-3">Contact</th>
                        <th class="px-6 py-3">Borrowed</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach ([['name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'phone' => '0917 123 4567', 'borrowed' => 2, 'status' => 'Active'], ['name' => 'Maria Santos', 'email' => 'maria@example.com', 'phone' => '0918 234 5678', 'borrowed' => 1, 'status' => 'Active'], ['name' => 'Pedro Reyes', 'email' => 'pedro@example.com', 'phone' => '0919 345 6789', 'borrowed' => 0, 'status' => 'Inactive']] as $member)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                                        {{ strtoupper(substr($member['name'], 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $member['name'] }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            Member #001
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <p>{{ $member['email'] }}</p>
                                <p class="text-xs text-gray-500">{{ $member['phone'] }}</p>
                            </td>

                            <td class="px-6 py-4">
                                {{ $member['borrowed'] }} books
                            </td>

                            <td class="px-6 py-4">
                                @if ($member['status'] === 'Active')
                                    <x-ui.badge variant="success">Active</x-ui.badge>
                                @else
                                    <x-ui.badge>Inactive</x-ui.badge>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('members.show', 1) }}"
                                    class="mr-3 font-medium text-indigo-600 hover:text-indigo-800">
                                    View
                                </a>

                                <a href="#" class="font-medium text-gray-600 hover:text-gray-900">
                                    Edit
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between border-t border-gray-200 px-6 py-4">

            <p class="text-sm text-gray-500">
                Showing 1 to 3 of 328 members
            </p>

            <div class="flex gap-1">
                <button class="rounded-lg border px-3 py-1.5 text-sm">Previous</button>
                <button class="rounded-lg bg-indigo-600 px-3 py-1.5 text-sm text-white">1</button>
                <button class="rounded-lg border px-3 py-1.5 text-sm">2</button>
                <button class="rounded-lg border px-3 py-1.5 text-sm">3</button>
                <button class="rounded-lg border px-3 py-1.5 text-sm">Next</button>
            </div>

        </div>

    </x-ui.card>

@endsection
