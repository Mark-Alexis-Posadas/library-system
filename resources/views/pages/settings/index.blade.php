@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Settings
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Manage your library configuration.
        </p>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Settings navigation --}}
        <x-ui.card class="h-fit p-3">

            <a href="#library" class="block rounded-lg bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700">
                🏛️ Library Information
            </a>

            <a href="#borrowing" class="mt-1 block rounded-lg px-4 py-3 text-sm text-gray-600 hover:bg-gray-50">
                📖 Borrowing Rules
            </a>

            <a href="#account" class="mt-1 block rounded-lg px-4 py-3 text-sm text-gray-600 hover:bg-gray-50">
                👤 Account
            </a>

        </x-ui.card>


        <div class="space-y-6 lg:col-span-2">

            {{-- Library --}}
            <x-ui.card id="library" class="p-6">

                <div class="border-b border-gray-200 pb-5">

                    <h3 class="font-semibold">
                        Library Information
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Basic information about your library.
                    </p>

                </div>

                <div class="mt-5 space-y-5">

                    <x-ui.input name="library_name" label="Library Name" value="Pangasinan Public Library" />

                    <x-ui.input name="address" label="Address" value="Lingayen, Pangasinan" />

                    <div class="grid gap-5 sm:grid-cols-2">

                        <x-ui.input name="phone" label="Contact Number" value="075 123 4567" />

                        <x-ui.input name="email" type="email" label="Email" value="library@example.com" />

                    </div>

                </div>

                <div class="mt-6 flex justify-end">

                    <x-ui.button>
                        Save Changes
                    </x-ui.button>

                </div>

            </x-ui.card>


            {{-- Borrowing rules --}}
            <x-ui.card id="borrowing" class="p-6">

                <div class="border-b border-gray-200 pb-5">

                    <h3 class="font-semibold">
                        Borrowing Rules
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Configure borrowing and overdue policies.
                    </p>

                </div>

                <div class="mt-5 grid gap-5 sm:grid-cols-2">

                    <x-ui.input name="max_books" type="number" label="Maximum Books" value="3" />

                    <x-ui.input name="borrow_days" type="number" label="Borrow Duration (Days)" value="7" />

                    <x-ui.input name="fine_per_day" type="number" label="Fine Per Day" value="10" />

                </div>

                <div class="mt-6 flex justify-end">

                    <x-ui.button>
                        Save Rules
                    </x-ui.button>

                </div>

            </x-ui.card>


            {{-- Account --}}
            <x-ui.card id="account" class="p-6">

                <div class="border-b border-gray-200 pb-5">

                    <h3 class="font-semibold">
                        Account
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Update your administrator account.
                    </p>

                </div>

                <div class="mt-5 space-y-5">

                    <x-ui.input name="admin_name" label="Name" value="Admin" />

                    <x-ui.input name="admin_email" type="email" label="Email" value="admin@example.com" />

                    <x-ui.input name="password" type="password" label="New Password"
                        placeholder="Leave blank to keep current password" />

                </div>

                <div class="mt-6 flex justify-end">

                    <x-ui.button>
                        Update Account
                    </x-ui.button>

                </div>

            </x-ui.card>

        </div>

    </div>

@endsection
