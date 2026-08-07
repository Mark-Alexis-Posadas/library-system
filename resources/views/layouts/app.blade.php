
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Library Management System')
    </title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: Tailwind Configuration --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {}
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900">

    <div class="min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Main Content --}}
        <div class="lg:pl-64">

            {{-- Navbar --}}
            @include('layouts.partials.navbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>

