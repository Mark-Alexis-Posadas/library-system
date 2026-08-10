@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

    {{-- Page Header --}}

    <div class="mb-6">


        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Settings
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Manage your library configuration.
        </p>


    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div
            class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-800 dark:bg-green-950/40 dark:text-green-400">
            {{ session('success') }} </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 dark:border-red-800 dark:bg-red-950/40">


            <p class="text-sm font-medium text-red-800 dark:text-red-400">
                Please fix the following errors:
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-700 dark:text-red-400">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>


    @endif

    <div class="grid gap-6 lg:grid-cols-3">


        {{-- Settings Navigation --}}
        <x-ui.card class="sticky top-24 h-fit p-3">

            <a href="#library"
                class="block rounded-lg bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-400">
                🏛️ Library Information
            </a>

            <a href="#borrowing"
                class="mt-1 block rounded-lg px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800">
                📖 Borrowing Rules
            </a>

            <a href="#account"
                class="mt-1 block rounded-lg px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800">
                👤 Account
            </a>

        </x-ui.card>


        <div class="space-y-6 lg:col-span-2">

            {{-- Library Information --}}
            <x-ui.card id="library" class="p-6">

                <div class="border-b border-gray-200 pb-5 dark:border-gray-700">

                    <h3 class="font-semibold text-gray-900 dark:text-white">
                        Library Information
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Basic information about your library.
                    </p>

                </div>


                <form action="{{ route('settings.library.update') }}" method="POST" class="mt-5">

                    @csrf
                    @method('PUT')

                    <div class="space-y-5">

                        <x-ui.input name="library_name" label="Library Name"
                            value="{{ old('library_name', $settings->library_name) }}" />

                        <x-ui.input name="address" label="Address" value="{{ old('address', $settings->address) }}" />

                        <div class="grid gap-5 sm:grid-cols-2">

                            <x-ui.input name="phone" label="Contact Number"
                                value="{{ old('phone', $settings->phone) }}" />

                            <x-ui.input name="email" type="email" label="Email"
                                value="{{ old('email', $settings->email) }}" />

                        </div>

                    </div>


                    <div class="mt-6 flex justify-end">

                        <x-ui.button type="submit">
                            Save Changes
                        </x-ui.button>

                    </div>

                </form>

            </x-ui.card>


            {{-- Borrowing Rules --}}
            <x-ui.card id="borrowing" class="p-6">

                <div class="border-b border-gray-200 pb-5">

                    <h3 class="font-semibold text-gray-900 dark:text-white">
                        Borrowing Rules
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Configure borrowing and overdue policies.
                    </p>

                </div>


                <form action="{{ route('settings.borrowing.update') }}" method="POST" class="mt-5">

                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 sm:grid-cols-2">

                        <x-ui.input name="max_books" type="number" label="Maximum Books"
                            value="{{ old('max_books', $settings->max_books) }}" min="1" />

                        <x-ui.input name="borrow_days" type="number" label="Borrow Duration (Days)"
                            value="{{ old('borrow_days', $settings->borrow_days) }}" min="1" />

                        <x-ui.input name="fine_per_day" type="number" step="0.01" label="Fine Per Day"
                            value="{{ old('fine_per_day', $settings->fine_per_day) }}" min="0" />

                    </div>


                    <div class="mt-6 flex justify-end">

                        <x-ui.button type="submit">
                            Save Rules
                        </x-ui.button>

                    </div>

                </form>

            </x-ui.card>


            {{-- Account --}}
            <x-ui.card id="account" class="p-6">

                <div class="border-b border-gray-200 pb-5">

                    <h3 class="font-semibold text-gray-900 dark:text-white">
                        Account
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Update your administrator account.
                    </p>

                </div>


                <div class="mt-5 space-y-5">

                    <x-ui.input name="admin_name" label="Name" value="{{ auth()->user()->name }}" disabled />

                    <x-ui.input name="admin_email" type="email" label="Email" value="{{ auth()->user()->email }}"
                        disabled />

                </div>


                <div class="mt-6 flex justify-end">

                    <a href="{{ route('profile.index') }}"
                        class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-800">
                        Manage Account
                    </a>

                </div>

            </x-ui.card>

        </div>


    </div>

@endsection
