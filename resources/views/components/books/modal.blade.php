<div id="bookModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="bookModalTitle" aria-modal="true"
    role="dialog">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/50" onclick="closeBookModal()"></div>

    {{-- Modal Container --}}
    <div class="relative flex min-h-screen items-center justify-center p-4">
        <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                <div>
                    <h2 id="bookModalTitle" class="text-lg font-semibold text-gray-900">Add Book</h2>
                    <p class="mt-1 text-sm text-gray-500">Add a new book to your library collection.</p>
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
                        <label for="bookCategory" class="mb-2 block text-sm font-medium text-gray-700">Category</label>
                        <select id="bookCategory" name="category_id" required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Title --}}
                    <div>
                        <label for="bookTitle" class="mb-2 block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="bookTitle" name="title" value="{{ old('title') }}" required
                            maxlength="255" placeholder="e.g. Clean Code"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- ISBN + Author --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="bookIsbn" class="mb-2 block text-sm font-medium text-gray-700">ISBN</label>
                            <input type="text" id="bookIsbn" name="isbn" value="{{ old('isbn') }}" required
                                maxlength="255" placeholder="e.g. 9780132350884"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <div>
                            <label for="bookAuthor" class="mb-2 block text-sm font-medium text-gray-700">Author</label>
                            <input type="text" id="bookAuthor" name="author" value="{{ old('author') }}" required
                                maxlength="255" placeholder="e.g. Robert C. Martin"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                    </div>

                    {{-- Publisher + Publication Year --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="bookPublisher"
                                class="mb-2 block text-sm font-medium text-gray-700">Publisher</label>
                            <input type="text" id="bookPublisher" name="publisher" value="{{ old('publisher') }}"
                                maxlength="255" placeholder="e.g. Prentice Hall"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <div>
                            <label for="bookPublicationYear"
                                class="mb-2 block text-sm font-medium text-gray-700">Publication Year</label>
                            <input type="number" id="bookPublicationYear" name="publication_year"
                                value="{{ old('publication_year') }}" min="1000" max="9999"
                                placeholder="e.g. 2008"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                    </div>

                    {{-- Quantity + Shelf Location --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="bookQuantity"
                                class="mb-2 block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" id="bookQuantity" name="quantity" value="{{ old('quantity', 0) }}"
                                required min="0" placeholder="e.g. 10"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <div>
                            <label for="bookShelfLocation" class="mb-2 block text-sm font-medium text-gray-700">Shelf
                                Location</label>
                            <input type="text" id="bookShelfLocation" name="shelf_location"
                                value="{{ old('shelf_location') }}" maxlength="255" placeholder="e.g. A-01"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="bookDescription"
                            class="mb-2 block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="bookDescription" name="description" rows="4" placeholder="Enter book description..."
                            class="block w-full resize-none rounded-lg border border-gray-300 px-3 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- Modal Footer --}}
                <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4">
                    <button type="button" onclick="closeBookModal()"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">Cancel</button>
                    <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">Save
                        Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
