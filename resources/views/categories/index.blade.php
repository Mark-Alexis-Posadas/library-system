@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-2xl font-bold">
                Categories
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Organize books by category.
            </p>
        </div>

        <x-ui.button>
            + Add Category
        </x-ui.button>

    </div>


    <x-ui.card>

        <div class="border-b border-gray-200 p-5">

            <input type="text" placeholder="Search category..."
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm md:max-w-sm">

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                    <tr>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Books</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    <tr>

                        <td class="px-6 py-4 font-semibold">
                            Programming
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Software development and programming books.
                        </td>

                        <td class="px-6 py-4">
                            45
                        </td>

                        <td class="px-6 py-4 text-right">

                            <button class="mr-3 font-medium text-indigo-600">
                                Edit
                            </button>

                            <button class="font-medium text-red-600">
                                Delete
                            </button>

                        </td>

                    </tr>


                    <tr>

                        <td class="px-6 py-4 font-semibold">
                            Fiction
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Fictional stories and novels.
                        </td>

                        <td class="px-6 py-4">
                            32
                        </td>

                        <td class="px-6 py-4 text-right">

                            <button class="mr-3 font-medium text-indigo-600">
                                Edit
                            </button>

                            <button class="font-medium text-red-600">
                                Delete
                            </button>

                        </td>

                    </tr>


                    <tr>

                        <td class="px-6 py-4 font-semibold">
                            Science
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            Science and research materials.
                        </td>

                        <td class="px-6 py-4">
                            21
                        </td>

                        <td class="px-6 py-4 text-right">

                            <button class="mr-3 font-medium text-indigo-600">
                                Edit
                            </button>

                            <button class="font-medium text-red-600">
                                Delete
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </x-ui.card>

@endsection
