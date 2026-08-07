@extends('layouts.app')

@section('title', 'Add Book')
@section('page-title', 'Add Book')

@section('content')

    <div class="mx-auto max-w-5xl">

        <div class="mb-6">

            <a href="{{ route('books.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Back to Books
            </a>

            <h2 class="mt-3 text-2xl font-bold">
                Add New Book
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Add a new book to your library inventory.
            </p>

        </div>


        <x-ui.card class="p-6">

            <form>

                <div class="grid gap-5 md:grid-cols-2">

                    <x-ui.input name="title" label="Book Title" placeholder="Enter book title" />

                    <x-ui.input name="isbn" label="ISBN" placeholder="978-0132350884" />

                    <x-ui.input name="author" label="Author" placeholder="Robert C. Martin" />

                    <x-ui.select name="category" label="Category">
                        <option>Select category</option>
                        <option>Programming</option>
                        <option>Fiction</option>
                        <option>Science</option>
                        <option>History</option>
                    </x-ui.select>

                    <x-ui.input name="publisher" label="Publisher" placeholder="Publisher name" />

                    <x-ui.input name="publication_year" type="number" label="Publication Year" placeholder="2026" />

                    <x-ui.input name="quantity" type="number" label="Total Copies" placeholder="10" />

                    <x-ui.input name="location" label="Shelf Location" placeholder="A-01-03" />

                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <textarea name="description" rows="5" placeholder="Book description..."
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"></textarea>

                    </div>

                </div>


                <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-5">

                    <a href="{{ route('books.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <x-ui.button type="submit">
                        Save Book
                    </x-ui.button>

                </div>

            </form>

        </x-ui.card>

    </div>

@endsection
