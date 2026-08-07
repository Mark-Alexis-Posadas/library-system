@extends('layouts.app')

@section('title', 'Profile')

@section('page-title', 'Profile')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">


        {{-- Page Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                My Profile
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage your account information and password.
            </p>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">

                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>

                <span>
                    {{ session('success') }}
                </span>

            </div>
        @endif


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3.14l-7.5-13a2 2 0 00-3.42 0z" />
                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-red-700">
                            Please check the following:
                        </p>

                        <ul class="mt-1 list-disc pl-5 text-sm text-red-600">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>
        @endif


        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Profile Summary --}}
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

                <div class="flex flex-col items-center px-6 py-8 text-center">

                    {{-- Avatar --}}
                    <div
                        class="flex h-24 w-24 items-center justify-center rounded-full bg-indigo-100 text-3xl font-bold text-indigo-600">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                    <h2 class="mt-4 text-lg font-semibold text-gray-900">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-1 break-all text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>


                    <div
                        class="mt-5 inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-1.5 text-xs font-medium text-green-700">

                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                        Active Account

                    </div>

                </div>

            </div>


            {{-- Profile Information --}}
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm lg:col-span-2">

                <div class="border-b border-gray-200 px-6 py-5">

                    <h2 class="font-semibold text-gray-900">
                        Profile Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Update your name and email address.
                    </p>

                </div>


                <form action="{{ route('profile.update') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="space-y-5 px-6 py-6">

                        {{-- Name --}}
                        <div>

                            <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Full Name
                            </label>

                            <input type="text" name="name" id="name"
                                value="{{ old('name', auth()->user()->name) }}" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            @error('name')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div>

                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Email Address
                            </label>

                            <input type="email" name="email" id="email"
                                value="{{ old('email', auth()->user()->email) }}" required
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            @error('email')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    <div class="flex justify-end border-t border-gray-200 px-6 py-4">

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>


            {{-- Change Password --}}
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm lg:col-span-3">

                <div class="border-b border-gray-200 px-6 py-5">

                    <h2 class="font-semibold text-gray-900">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Make sure your new password is at least 8 characters.
                    </p>

                </div>


                <form action="{{ route('profile.password') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 px-6 py-6 md:grid-cols-3">

                        {{-- Current Password --}}
                        <div>

                            <label for="current_password" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Current Password
                            </label>

                            <input type="password" name="current_password" id="current_password" required
                                autocomplete="current-password"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            @error('current_password')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- New Password --}}
                        <div>

                            <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                                New Password
                            </label>

                            <input type="password" name="password" id="password" required autocomplete="new-password"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                            @error('password')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Confirm Password --}}
                        <div>

                            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Confirm New Password
                            </label>

                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                autocomplete="new-password"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                        </div>

                    </div>


                    <div class="flex justify-end border-t border-gray-200 px-6 py-4">

                        <button type="submit"
                            class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                            Update Password
                        </button>

                    </div>

                </form>

            </div>

        </div>


    </div>

@endsection
