@extends('layouts.app')

@section('title', 'Books')

@section('content')
    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Books
            </h1>

            <p class="mt-1 text-sm text-gray-500">
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
        <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <div class="flex items-start">

                <svg class="mr-3 mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 19h14.68a2 2 0 001.73-2.41L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>

                <div>
                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    @endif


    {{-- Search and Filter --}}
    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">

        <form action="{{ route('books.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- Search --}}
            <div class="md:col-span-2">
                <label for="search" class="mb-2 block text-sm font-medium text-gray-700">
                    Search
                </label>

                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Search by title, author, or ISBN..."
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
            </div>


            {{-- Category --}}
            <div>
                <label for="category_id" class="mb-2 block text-sm font-medium text-gray-700">
                    Category
                </label>

                <select id="category_id" name="category_id"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                    <option value="">
                        All Categories
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2 md:col-span-3">

                <button type="submit"
                    class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                    Search
                </button>

                @if (request('search') || request('category_id'))
                    <a href="{{ route('books.index') }}"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                        Clear
                    </a>
                @endif

            </div>

        </form>

    </div>


    {{-- Books Table --}}
    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            #
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Book
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ISBN
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Category
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Inventory
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Shelf
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($books as $book)
                        <tr class="transition hover:bg-gray-50">

                            {{-- Number --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $books->firstItem() + $loop->index }}
                            </td>


                            {{-- Book --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">
                                    {{ $book->title }}
                                </div>

                                <div class="mt-1 text-sm text-gray-500">
                                    by {{ $book->author }}
                                </div>
                            </td>


                            {{-- ISBN --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $book->isbn }}
                            </td>


                            {{-- Category --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span
                                    class="inline-flex rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                                    {{ $book->category->name }}
                                </span>

                            </td>


                            {{-- Inventory --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="text-sm font-medium text-gray-900">
                                    {{ $book->available_quantity }} available
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    {{ $book->quantity }} total
                                </div>

                            </td>


                            {{-- Shelf --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $book->shelf_location ?: '—' }}
                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex justify-end gap-2">

                                    {{-- Edit --}}
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
                                        class="rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 transition hover:bg-indigo-50">
                                        Edit
                                    </button>


                                    {{-- Delete --}}
                                    <form action="{{ route('books.destroy', $book) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')"
                                        class="m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-12 text-center">

                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">

                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />

                                    </svg>

                                </div>

                                <h3 class="mt-4 text-sm font-semibold text-gray-900">
                                    No books found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Get started by adding your first book.
                                </p>

                                <button type="button" onclick="openCreateModal()"
                                    class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                                    Add a book
                                </button>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($books->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">
                {{ $books->links() }}
            </div>
        @endif

    </div>


    {{-- Book Modal --}}
    <div id="bookModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="bookModalTitle"
        aria-modal="true" role="dialog">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/50" onclick="closeBookModal()">
        </div>


        {{-- Modal Container --}}
        <div class="relative flex min-h-screen items-center justify-center p-4">

            <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                    <div>

                        <h2 id="bookModalTitle" class="text-lg font-semibold text-gray-900">
                            Add Book
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Add a new book to your library collection.
                        </p>

                    </div>


                    <button type="button" onclick="closeBookModal()"
                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>


                {{-- Form --}}
                <form id="bookForm" action="{{ route('books.store') }}" method="POST">

                    @csrf

                    <div class="max-h-[70vh] space-y-5 overflow-y-auto px-6 py-5">

                        {{-- Category --}}
                        <div>
                            <label for="bookCategory" class="mb-2 block text-sm font-medium text-gray-700">
                                Category
                            </label>

                            <select id="bookCategory" name="category_id" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                                <option value="">
                                    Select a category
                                </option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- Title --}}
                        <div>
                            <label for="bookTitle" class="mb-2 block text-sm font-medium text-gray-700">
                                Title
                            </label>

                            <input type="text" id="bookTitle" name="title" value="{{ old('title') }}" required
                                maxlength="255" placeholder="e.g. Clean Code"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>


                        {{-- ISBN + Author --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>

                                <label for="bookIsbn" class="mb-2 block text-sm font-medium text-gray-700">
                                    ISBN
                                </label>

                                <input type="text" id="bookIsbn" name="isbn" value="{{ old('isbn') }}"
                                    required maxlength="255" placeholder="e.g. 9780132350884"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            <div>

                                <label for="bookAuthor" class="mb-2 block text-sm font-medium text-gray-700">
                                    Author
                                </label>

                                <input type="text" id="bookAuthor" name="author" value="{{ old('author') }}"
                                    required maxlength="255" placeholder="e.g. Robert C. Martin"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>

                        </div>


                        {{-- Publisher + Publication Year --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>

                                <label for="bookPublisher" class="mb-2 block text-sm font-medium text-gray-700">
                                    Publisher
                                </label>

                                <input type="text" id="bookPublisher" name="publisher"
                                    value="{{ old('publisher') }}" maxlength="255" placeholder="e.g. Prentice Hall"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            <div>

                                <label for="bookPublicationYear" class="mb-2 block text-sm font-medium text-gray-700">
                                    Publication Year
                                </label>

                                <input type="number" id="bookPublicationYear" name="publication_year"
                                    value="{{ old('publication_year') }}" min="1000" max="9999"
                                    placeholder="e.g. 2008"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>

                        </div>


                        {{-- Quantity + Shelf Location --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>

                                <label for="bookQuantity" class="mb-2 block text-sm font-medium text-gray-700">
                                    Quantity
                                </label>

                                <input type="number" id="bookQuantity" name="quantity"
                                    value="{{ old('quantity', 0) }}" required min="0" placeholder="e.g. 10"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>


                            <div>

                                <label for="bookShelfLocation" class="mb-2 block text-sm font-medium text-gray-700">
                                    Shelf Location
                                </label>

                                <input type="text" id="bookShelfLocation" name="shelf_location"
                                    value="{{ old('shelf_location') }}" maxlength="255" placeholder="e.g. A-01"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            </div>

                        </div>


                        {{-- Description --}}
                        <div>

                            <label for="bookDescription" class="mb-2 block text-sm font-medium text-gray-700">
                                Description
                            </label>

                            <textarea id="bookDescription" name="description" rows="4" placeholder="Enter book description..."
                                class="block w-full resize-none rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ old('description') }}</textarea>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                        <button type="button" onclick="closeBookModal()"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Save Book
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- JavaScript --}}
    <script>
        const bookModal = document.getElementById('bookModal');
        const bookForm = document.getElementById('bookForm');
        const bookModalTitle = document.getElementById('bookModalTitle');

        const bookCategory = document.getElementById('bookCategory');
        const bookTitle = document.getElementById('bookTitle');
        const bookIsbn = document.getElementById('bookIsbn');
        const bookAuthor = document.getElementById('bookAuthor');
        const bookPublisher = document.getElementById('bookPublisher');
        const bookPublicationYear = document.getElementById('bookPublicationYear');
        const bookQuantity = document.getElementById('bookQuantity');
        const bookShelfLocation = document.getElementById('bookShelfLocation');
        const bookDescription = document.getElementById('bookDescription');


        function openCreateModal() {

            bookModalTitle.textContent = 'Add Book';

            bookForm.action = "{{ route('books.store') }}";

            bookForm.querySelector('input[name="_method"]')?.remove();

            bookCategory.value = '';
            bookTitle.value = '';
            bookIsbn.value = '';
            bookAuthor.value = '';
            bookPublisher.value = '';
            bookPublicationYear.value = '';
            bookQuantity.value = 0;
            bookShelfLocation.value = '';
            bookDescription.value = '';

            bookModal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            bookCategory.focus();
        }


        function openEditModal(
            id,
            categoryId,
            title,
            isbn,
            author,
            publisher,
            publicationYear,
            quantity,
            shelfLocation,
            description
        ) {

            bookModalTitle.textContent = 'Edit Book';

            bookForm.action = `/books/${id}`;

            bookForm.querySelector('input[name="_method"]')?.remove();

            const methodInput = document.createElement('input');

            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';

            bookForm.appendChild(methodInput);

            bookCategory.value = categoryId ?? '';
            bookTitle.value = title ?? '';
            bookIsbn.value = isbn ?? '';
            bookAuthor.value = author ?? '';
            bookPublisher.value = publisher ?? '';
            bookPublicationYear.value = publicationYear ?? '';
            bookQuantity.value = quantity ?? 0;
            bookShelfLocation.value = shelfLocation ?? '';
            bookDescription.value = description ?? '';

            bookModal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            bookCategory.focus();
        }


        function closeBookModal() {

            bookModal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }


        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeBookModal();
            }

        });


        @if ($errors->any() && old('title'))

            openCreateModal();
        @endif
    </script>


@endsection
