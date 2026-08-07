@extends('layouts.app')

@section('title', 'Borrowings')

@section('content')

    <div class="space-y-6">


        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Borrowings</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Manage book borrowings and returns.
                </p>
            </div>

            <button type="button" onclick="openCreateModal()"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                New Borrowing
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

            <form method="GET" action="{{ route('borrowings.index') }}">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    {{-- Search --}}
                    <div class="md:col-span-2">

                        <label for="search" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Search
                        </label>

                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Search member, member ID, book title, or ISBN..."
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                    </div>


                    {{-- Status --}}
                    <div>

                        <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700">
                            Status
                        </label>

                        <select name="status" id="status"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            <option value="">
                                All Status
                            </option>

                            <option value="borrowed" @selected(request('status') === 'borrowed')>
                                Borrowed
                            </option>

                            <option value="returned" @selected(request('status') === 'returned')>
                                Returned
                            </option>

                            <option value="overdue" @selected(request('status') === 'overdue')>
                                Overdue
                            </option>

                        </select>

                    </div>

                </div>


                <div class="mt-4 flex justify-end gap-2">

                    <a href="{{ route('borrowings.index') }}"
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


        {{-- Borrowings Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Member
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Book
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Borrowed
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Due Date
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

                        @forelse ($borrowings as $borrowing)
                            <tr class="transition hover:bg-gray-50">

                                {{-- Member --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="flex items-center">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">

                                            {{ strtoupper(substr($borrowing->member->first_name, 0, 1) . substr($borrowing->member->last_name, 0, 1)) }}

                                        </div>

                                        <div class="ml-3">

                                            <div class="font-medium text-gray-900">
                                                {{ $borrowing->member->first_name }}
                                                {{ $borrowing->member->last_name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $borrowing->member->member_id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Book --}}
                                <td class="px-6 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $borrowing->book->title }}
                                    </div>

                                    @if ($borrowing->book->isbn)
                                        <div class="mt-1 text-sm text-gray-500">
                                            ISBN: {{ $borrowing->book->isbn }}
                                        </div>
                                    @endif

                                </td>


                                {{-- Borrowed Date --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                    {{ $borrowing->borrowed_at?->format('M d, Y') }}

                                </td>


                                {{-- Due Date --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="text-sm text-gray-600">
                                        {{ $borrowing->due_at?->format('M d, Y') }}
                                    </div>

                                    @if ($borrowing->status === 'borrowed' && $borrowing->due_at && $borrowing->due_at->isPast())
                                        <div class="mt-1 text-xs font-medium text-red-600">
                                            Past due
                                        </div>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @if ($borrowing->status === 'borrowed')
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700">
                                            Borrowed
                                        </span>
                                    @elseif ($borrowing->status === 'returned')
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                            Returned
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700">
                                            Overdue
                                        </span>
                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    <div class="flex justify-end gap-2">

                                        <button type="button" onclick="openEditModal({{ $borrowing->id }})"
                                            class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                                            Edit
                                        </button>


                                        <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this borrowing record?')">

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

                                <td colspan="6" class="px-6 py-12 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">

                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                        </svg>

                                    </div>

                                    <h3 class="mt-3 text-sm font-semibold text-gray-900">
                                        No borrowings found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Create a borrowing record to get started.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($borrowings->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">

                    {{ $borrowings->links() }}

                </div>
            @endif

        </div>


    </div>

    {{-- ========================================================= --}}
    {{-- CREATE BORROWING MODAL --}}
    {{-- ========================================================= --}}

    <div id="createBorrowingModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">


        <div class="fixed inset-0 bg-gray-900/50" onclick="closeCreateModal()"></div>


        <div class="relative flex min-h-screen items-center justify-center p-4">

            <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                    <div>

                        <h2 class="text-lg font-semibold text-gray-900">
                            New Borrowing
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Create a new book borrowing record.
                        </p>

                    </div>

                    <button type="button" onclick="closeCreateModal()"
                        class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>


                {{-- Form --}}
                <form action="{{ route('borrowings.store') }}" method="POST">

                    @csrf

                    <div class="space-y-5 px-6 py-6">

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Member --}}
                            <div class="sm:col-span-2">

                                <label for="member_id" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Member
                                </label>

                                <select name="member_id" id="member_id" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    <option value="">
                                        Select member
                                    </option>

                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                                            {{ $member->member_id }} —
                                            {{ $member->first_name }}
                                            {{ $member->last_name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('member_id')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Book --}}
                            <div class="sm:col-span-2">

                                <label for="book_id" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Book
                                </label>

                                <select name="book_id" id="book_id" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    <option value="">
                                        Select book
                                    </option>

                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                                            {{ $book->title }}
                                            @if ($book->isbn)
                                                — {{ $book->isbn }}
                                            @endif
                                        </option>
                                    @endforeach

                                </select>

                                @error('book_id')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Borrowed At --}}
                            <div>

                                <label for="borrowed_at" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Borrowed Date
                                </label>

                                <input type="date" name="borrowed_at" id="borrowed_at"
                                    value="{{ old('borrowed_at', now()->format('Y-m-d')) }}" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                @error('borrowed_at')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Due At --}}
                            <div>

                                <label for="due_at" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Due Date
                                </label>

                                <input type="date" name="due_at" id="due_at" value="{{ old('due_at') }}"
                                    required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                @error('due_at')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Status --}}
                            <div>

                                <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Status
                                </label>

                                <select name="status" id="status" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    <option value="borrowed" @selected(old('status', 'borrowed') === 'borrowed')>
                                        Borrowed
                                    </option>

                                    <option value="returned" @selected(old('status') === 'returned')>
                                        Returned
                                    </option>

                                    <option value="overdue" @selected(old('status') === 'overdue')>
                                        Overdue
                                    </option>

                                </select>

                            </div>


                            {{-- Fine --}}
                            <div>

                                <label for="fine" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Fine
                                </label>

                                <input type="number" name="fine" id="fine" value="{{ old('fine', 0) }}"
                                    min="0" step="0.01"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Returned At --}}
                            <div>

                                <label for="returned_at" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Returned Date
                                </label>

                                <input type="date" name="returned_at" id="returned_at"
                                    value="{{ old('returned_at') }}"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Notes --}}
                            <div class="sm:col-span-2">

                                <label for="notes" class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Notes
                                </label>

                                <textarea name="notes" id="notes" rows="3" placeholder="Optional notes..."
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ old('notes') }}</textarea>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                        <button type="button" onclick="closeCreateModal()"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700">
                            Create Borrowing
                        </button>

                    </div>

                </form>

            </div>

        </div>


    </div>

    {{-- ========================================================= --}}
    {{-- EDIT BORROWING MODAL --}}
    {{-- ========================================================= --}}

    <div id="editBorrowingModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">


        <div class="fixed inset-0 bg-gray-900/50" onclick="closeEditModal()"></div>


        <div class="relative flex min-h-screen items-center justify-center p-4">

            <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                    <div>

                        <h2 class="text-lg font-semibold text-gray-900">
                            Edit Borrowing
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Update borrowing information.
                        </p>

                    </div>

                    <button type="button" onclick="closeEditModal()"
                        class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>


                {{-- Form --}}
                <form id="editBorrowingForm" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="space-y-5 px-6 py-6">

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Member --}}
                            <div class="sm:col-span-2">

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Member
                                </label>

                                <select name="member_id" id="edit_member_id" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">
                                            {{ $member->member_id }} —
                                            {{ $member->first_name }}
                                            {{ $member->last_name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            {{-- Book --}}
                            <div class="sm:col-span-2">

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Book
                                </label>

                                <select name="book_id" id="edit_book_id" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->title }}
                                            @if ($book->isbn)
                                                — {{ $book->isbn }}
                                            @endif
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            {{-- Borrowed --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Borrowed Date
                                </label>

                                <input type="date" name="borrowed_at" id="edit_borrowed_at" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Due --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Due Date
                                </label>

                                <input type="date" name="due_at" id="edit_due_at" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Status --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Status
                                </label>

                                <select name="status" id="edit_status" required
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                    <option value="borrowed">
                                        Borrowed
                                    </option>

                                    <option value="returned">
                                        Returned
                                    </option>

                                    <option value="overdue">
                                        Overdue
                                    </option>

                                </select>

                            </div>


                            {{-- Fine --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Fine
                                </label>

                                <input type="number" name="fine" id="edit_fine" min="0" step="0.01"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Returned --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Returned Date
                                </label>

                                <input type="date" name="returned_at" id="edit_returned_at"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            {{-- Notes --}}
                            <div class="sm:col-span-2">

                                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                    Notes
                                </label>

                                <textarea name="notes" id="edit_notes" rows="3"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"></textarea>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                        <button type="button" onclick="closeEditModal()"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700">
                            Update Borrowing
                        </button>

                    </div>

                </form>

            </div>

        </div>


    </div>

    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        function openCreateModal() {
            document
                .getElementById('createBorrowingModal')
                .classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }


        function closeCreateModal() {
            document
                .getElementById('createBorrowingModal')
                .classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }


        function openEditModal(id) {

            fetch(`/borrowings/${id}/edit`)
                .then(response => {

                    if (!response.ok) {
                        throw new Error('Failed to fetch borrowing.');
                    }

                    return response.json();

                })
                .then(borrowing => {

                    document.getElementById('editBorrowingForm').action =
                        `/borrowings/${id}`;

                    document.getElementById('edit_member_id').value =
                        borrowing.member_id;

                    document.getElementById('edit_book_id').value =
                        borrowing.book_id;

                    document.getElementById('edit_borrowed_at').value =
                        borrowing.borrowed_at ?? '';

                    document.getElementById('edit_due_at').value =
                        borrowing.due_at ?? '';

                    document.getElementById('edit_returned_at').value =
                        borrowing.returned_at ?? '';

                    document.getElementById('edit_status').value =
                        borrowing.status;

                    document.getElementById('edit_fine').value =
                        borrowing.fine ?? 0;

                    document.getElementById('edit_notes').value =
                        borrowing.notes ?? '';

                    document
                        .getElementById('editBorrowingModal')
                        .classList.remove('hidden');

                    document.body.classList.add('overflow-hidden');

                })
                .catch(error => {

                    console.error(error);

                    alert('Unable to load borrowing information.');

                });
        }


        function closeEditModal() {

            document
                .getElementById('editBorrowingModal')
                .classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }


        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
            }

        });
    </script>

@endsection
