@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">
        <div class="w-full max-w-md">

            {{-- Logo / Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Library Management System
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    Create your account
                </p>
            </div>

            {{-- Register Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Register
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Fill in the details below to create your account.
                    </p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4">
                        <div class="text-sm font-medium text-red-800">
                            Please fix the following errors:
                        </div>

                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- Profile Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Profile Image
                        </label>

                        <div class="mt-2 flex items-center gap-4">
                            {{-- Preview --}}
                            <div id="image-preview"
                                class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-gray-100">
                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.65 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <div class="flex-1">
                                <input type="file" id="profile_image" name="profile_image"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="block w-full text-sm text-gray-500
                                file:mr-3 file:rounded-lg file:border-0
                                file:bg-indigo-50 file:px-4 file:py-2
                                file:text-sm file:font-medium
                                file:text-indigo-700
                                hover:file:bg-indigo-100">

                                <p class="mt-1.5 text-xs text-gray-500">
                                    JPG, PNG, or WEBP. Max 2MB.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Full Name
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="Enter your full name"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email Address
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" placeholder="Enter your email"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>

                        <input type="password" id="password" name="password" required autocomplete="new-password"
                            placeholder="Enter your password"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">

                        <p class="mt-1.5 text-xs text-gray-500">
                            Password must be at least 8 characters.
                        </p>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Confirm your password"
                            class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Create Account
                    </button>
                </form>

                {{-- Login Link --}}
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?

                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-700">
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Preview --}}
    <script>
        const profileImageInput = document.getElementById('profile_image');
        const imagePreview = document.getElementById('image-preview');

        profileImageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (!file) {
                imagePreview.innerHTML = `
                <svg
                    class="h-10 w-10 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.65 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                </svg>
            `;

                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.innerHTML = `
                <img
                    src="${e.target.result}"
                    alt="Profile Preview"
                    class="h-full w-full object-cover"
                >
            `;
            };

            reader.readAsDataURL(file);
        });
    </script>

@endsection
