@extends('layouts.app')

@section('title', 'Categories')

@section('content') <div class="space-y-6">

        ```
        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Categories
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your library book categories.
                </p>
            </div>

            <button type="button" onclick="openCreateModal()"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Add Category
            </button>
        </div>


        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 p-4">
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


        {{-- Categories Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                #
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Category
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Description
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Books
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse ($categories as $category)
                            <tr class="transition hover:bg-gray-50">

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $category->name }}
                                    </div>
                                </td>

                                <td class="max-w-md px-6 py-4 text-sm text-gray-500">
                                    {{ $category->description ?: 'No description' }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                                        {{ $category->books_count }} {{ Str::plural('book', $category->books_count) }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">

                                        {{-- Edit --}}
                                        <button type="button"
                                            onclick="openEditModal(
                                            {{ $category->id }},
                                            @js($category->name),
                                            @js($category->description)
                                        )"
                                            class="rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 transition hover:bg-indigo-50">
                                            Edit
                                        </button>

                                        {{-- Delete --}}
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                                <td colspan="5" class="px-6 py-12 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-gray-900">
                                        No categories found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Get started by creating your first category.
                                    </p>

                                    <button type="button" onclick="openCreateModal()"
                                        class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                                        Add a category
                                    </button>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>


            {{-- Pagination --}}
            @if ($categories->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $categories->links() }}
                </div>
            @endif

        </div>

    </div>


    {{-- Category Modal --}}
    <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="categoryModalTitle"
        aria-modal="true" role="dialog">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/50" onclick="closeCategoryModal()"></div>


        {{-- Modal Container --}}
        <div class="relative flex min-h-screen items-center justify-center p-4">

            <div class="relative w-full max-w-lg rounded-xl bg-white shadow-xl">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

                    <div>
                        <h2 id="categoryModalTitle" class="text-lg font-semibold text-gray-900">
                            Add Category
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Create a category for your library books.
                        </p>
                    </div>

                    <button type="button" onclick="closeCategoryModal()"
                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>


                {{-- Form --}}
                <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">

                    @csrf

                    <div class="space-y-5 px-6 py-5">

                        {{-- Name --}}
                        <div>
                            <label for="categoryName" class="mb-2 block text-sm font-medium text-gray-700">
                                Category Name
                            </label>

                            <input type="text" id="categoryName" name="name" value="{{ old('name') }}" required
                                maxlength="255" placeholder="e.g. Fiction"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>


                        {{-- Description --}}
                        <div>
                            <label for="categoryDescription" class="mb-2 block text-sm font-medium text-gray-700">
                                Description
                            </label>

                            <textarea id="categoryDescription" name="description" rows="4" placeholder="Enter category description..."
                                class="block w-full resize-none rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ old('description') }}</textarea>
                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">

                        <button type="button" onclick="closeCategoryModal()"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Save Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- JavaScript --}}
    <script>
        const categoryModal = document.getElementById('categoryModal');
        const categoryForm = document.getElementById('categoryForm');
        const categoryModalTitle = document.getElementById('categoryModalTitle');
        const categoryName = document.getElementById('categoryName');
        const categoryDescription = document.getElementById('categoryDescription');

        function openCreateModal() {
            categoryModalTitle.textContent = 'Add Category';

            categoryForm.action = "{{ route('categories.store') }}";

            categoryForm.querySelector('input[name="_method"]')?.remove();

            categoryName.value = '';
            categoryDescription.value = '';

            categoryModal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            categoryName.focus();
        }

        function openEditModal(id, name, description) {
            categoryModalTitle.textContent = 'Edit Category';

            categoryForm.action = `/categories/${id}`;

            categoryForm.querySelector('input[name="_method"]')?.remove();

            const methodInput = document.createElement('input');

            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';

            categoryForm.appendChild(methodInput);

            categoryName.value = name ?? '';
            categoryDescription.value = description ?? '';

            categoryModal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            categoryName.focus();
        }

        function closeCategoryModal() {
            categoryModal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCategoryModal();
            }
        });

        @if ($errors->any() && old('name'))
            openCreateModal();
        @endif
    </script>
    ```

@endsection
