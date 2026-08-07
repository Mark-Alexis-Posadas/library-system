@extends('layouts.app')

@section('title', 'Members')

@section('content')

    <div class="space-y-6">


        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Members</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Manage your library members.
                </p>
            </div>

            <button type="button" onclick="openCreateModal()"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Member
            </button>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filters --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <form method="GET" action="{{ route('members.index') }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    {{-- Search --}}
                    <div class="md:col-span-2">
                        <label for="search" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Search
                        </label>

                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Search member ID, name, or email..."
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Status
                        </label>

                        <select name="status" id="status"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">All Status</option>
                            <option value="active" @selected(request('status') === 'active')>
                                Active
                            </option>
                            <option value="inactive" @selected(request('status') === 'inactive')>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <a href="{{ route('members.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Clear
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-800">
                        Search
                    </button>
                </div>
            </form>
        </div>

        {{-- Members Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Member
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Contact
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Address
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Status
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse ($members as $member)
                            <tr class="transition hover:bg-gray-50">

                                {{-- Member --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                                            {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                        </div>

                                        <div class="ml-3">
                                            <div class="font-medium text-gray-900">
                                                {{ $member->first_name }} {{ $member->last_name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $member->member_id }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                {{-- Contact --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $member->email }}
                                    </div>

                                    @if ($member->phone)
                                        <div class="mt-1 text-sm text-gray-500">
                                            {{ $member->phone }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Address --}}
                                <td class="max-w-xs px-6 py-4">
                                    <div class="truncate text-sm text-gray-600">
                                        {{ $member->address ?: '—' }}
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($member->status === 'active')
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">

                                        <button type="button" onclick="openEditModal({{ $member->id }})"
                                            class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                                            Edit
                                        </button>

                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this member?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-3 text-sm font-semibold text-gray-900">
                                        No members found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Add a new member to get started.
                                    </p>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($members->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $members->links() }}
                </div>
            @endif

        </div>


    </div>

    @include('components.members.create-modal')
    @include('components.members.edit-modal')

    <script src="{{ asset('js/members/open-create-modal.js') }}"></script>
    <script src="{{ asset('js/members/open-edit-modal.js') }}"></script>
    <script src="{{ asset('js/members/close-create-modal.js') }}"></script>
    <script src="{{ asset('js/members/close-edit-modal.js') }}"></script>
    <script>
        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
            }

        });
    </script>

@endsection
