@extends('layouts.app')

@section('title', 'Add Member')
@section('page-title', 'Add Member')

@section('content')

    <div class="mx-auto max-w-4xl">

        <div class="mb-6">
            <a href="{{ route('members.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Back to Members
            </a>

            <h2 class="mt-3 text-2xl font-bold">
                Add New Member
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Register a new member in the library.
            </p>
        </div>

        <x-ui.card class="p-6">

            <form>

                <div class="grid gap-5 md:grid-cols-2">

                    <x-ui.input name="first_name" label="First Name" placeholder="Juan" />

                    <x-ui.input name="last_name" label="Last Name" placeholder="Dela Cruz" />

                    <x-ui.input name="email" type="email" label="Email Address" placeholder="juan@example.com" />

                    <x-ui.input name="phone" label="Phone Number" placeholder="0917 123 4567" />

                    <x-ui.input name="member_id" label="Member ID" placeholder="LIB-0001" />

                    <x-ui.select name="status" label="Status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </x-ui.select>

                    <div class="md:col-span-2">
                        <x-ui.input name="address" label="Address" placeholder="Complete address" />
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-5">

                    <a href="{{ route('members.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <x-ui.button type="submit">
                        Save Member
                    </x-ui.button>

                </div>

            </form>

        </x-ui.card>

    </div>

@endsection
