@extends('layouts.app')

@section('title', 'Borrow Book')
@section('page-title', 'Borrow Book')

@section('content')

    <div class="mx-auto max-w-3xl">

        <div class="mb-6">

            <a href="{{ route('borrowings.index') }}" class="text-sm font-medium text-indigo-600">
                ← Back to Borrowings
            </a>

            <h2 class="mt-3 text-2xl font-bold">
                Borrow Book
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Create a new borrowing transaction.
            </p>

        </div>


        <x-ui.card class="p-6">

            <form>

                <div class="space-y-5">

                    <x-ui.select name="member" label="Member">
                        <option>Select member</option>
                        <option>Juan Dela Cruz</option>
                        <option>Maria Santos</option>
                        <option>Pedro Reyes</option>
                    </x-ui.select>


                    <x-ui.select name="book" label="Book">
                        <option>Select available book</option>
                        <option>Clean Code</option>
                        <option>Atomic Habits</option>
                        <option>The Hobbit</option>
                    </x-ui.select>


                    <div class="grid gap-5 sm:grid-cols-2">

                        <x-ui.input name="borrowed_date" type="date" label="Borrowed Date" />

                        <x-ui.input name="due_date" type="date" label="Due Date" />

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Notes
                        </label>

                        <textarea name="notes" rows="4" placeholder="Optional notes..."
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"></textarea>

                    </div>

                </div>


                <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-5">

                    <a href="{{ route('borrowings.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700">
                        Cancel
                    </a>

                    <x-ui.button type="submit">
                        Confirm Borrowing
                    </x-ui.button>

                </div>

            </form>

        </x-ui.card>

    </div>

@endsection
