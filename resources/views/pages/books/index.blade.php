@extends('layouts.app')

@section('title', 'Books')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Books
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Manage your library books and inventory.
            </p>
        </div>

        <button type="button" onclick="openCreateModal()"
            class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Book
        </button>

    </div>


    {{-- Flash Messages --}}
    @if (session('success'))
        <div
            class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/30">

            <div class="flex items-start">

                <svg class="mr-3 mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 19h14.68a2 2 0 001.73-2.41L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>

                <div>

                    <h3 class="text-sm font-semibold text-red-800 dark:text-red-300">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-300">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>
    @endif


    {{-- Search and Filter --}}
    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <form action="{{ route('books.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <div class="md:col-span-2">

                <label for="search" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Search
                </label>

                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Search by title, author, or ISBN..."
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400">
            </div>


            <div>

                <label for="category_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Category
                </label>

                <select id="category_id" name="category_id"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                    <option value="">All Categories</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

            </div>


            <div class="flex items-end gap-2 md:col-span-3">

                <button type="submit"
                    class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500">
                    Search
                </button>

                @if (request('search') || request('category_id'))
                    <a href="{{ route('books.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Clear
                    </a>
                @endif

            </div>

        </form>

    </div>


    {{-- Books Table --}}
    <div
        class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                <thead class="bg-gray-50 dark:bg-gray-700/50">

                    <tr>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            #
                        </th>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Book
                        </th>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            ISBN
                        </th>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Category
                        </th>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Inventory
                        </th>

                        <th
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Shelf
                        </th>

                        <th
                            class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

                    @forelse ($books as $book)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50">

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $books->firstItem() + $loop->index }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $book->title }}
                                </div>

                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    by {{ $book->author }}
                                </div>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                {{ $book->isbn }}
                            </td>


                            <td class="whitespace-nowrap px-6 py-4">

                                <span
                                    class="inline-flex rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                    {{ $book->category->name }}
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $book->available_quantity }} available
                                </div>

                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $book->quantity }} total
                                </div>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                {{ $book->shelf_location ?: '—' }}
                            </td>


                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex justify-end gap-2">

                                    <button type="button"
                                        onclick="openEditModal(
                                        {{ $book->id }},
                                        @js($book->category_id),
                                        @js($book->title),
                                        @js($book->isbn),
                                        @js($book->author),
                                        @js($book->publisher),
                                        @js($book->publication_year),
                                        @js($book->quantity),
                                        @js($book->shelf_location),
                                        @js($book->description)
                                    )"
                                        class="rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 transition hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900/30">
                                        Edit
                                    </button>


                                    <form action="{{ route('books.destroy', $book) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')"
                                        class="m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-12 text-center">

                                <div
                                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">

                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />

                                    </svg>

                                </div>


                                <h3 class="mt-4 text-sm font-semibold text-gray-900 dark:text-white">
                                    No books found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Get started by adding your first book.
                                </p>

                                <button type="button" onclick="openCreateModal()"
                                    class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Add a book
                                </button>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        @if ($books->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                {{ $books->links() }}
            </div>
        @endif

    </div>


    {{-- Include Modal Partial --}}
    @include('components.books.modal')


    {{-- JS Dynamic Config --}}
    <script>
        window.bookRoutes = {
            store: "{{ route('books.store') }}"
        };
    </script>

    <script src="{{ asset('js/books/books-modal.js') }}"></script>


    @if ($errors->any() && old('title'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openCreateModal();
            });
        </script>
    @endif

@endsection
