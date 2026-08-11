<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Authentication') - Library Management System
    </title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')


</head>

<body class="min-h-screen bg-gray-100">


    @yield('content')

    @stack('scripts')

    <script src="{{ asset('js/ui/password-eye.js') }}"></script>
</body>

</html>
