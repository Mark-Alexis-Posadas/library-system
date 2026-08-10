@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">


            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600">
                    <span class="text-xl font-bold text-white">L</span>
                </div>

                <h1 class="text-2xl font-bold text-gray-900">
                    Library Management System
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Sign in to your account
                </p>
            </div>

            {{-- Login Card --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Welcome Back
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Enter your credentials to continue.
                    </p>
                </div>

                {{-- Validation / Login Error --}}
                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4">
                        <p class="text-sm font-medium text-red-800">
                            Unable to login.
                        </p>

                        <ul class="mt-2 list-inside list-disc text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email Address
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="email" placeholder="Enter your email"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                        </div>

                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" value="1"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Sign In
                    </button>
                </form>

                {{-- Register --}}
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-700">
                            Create an account
                        </a>
                    </p>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Library Management System
            </p>

        </div>


    </div>
@endsection
