<header class="sticky top-0 z-30 border-b border-gray-200 bg-white">
    <div class="flex h-16 items-center justify-between px-6">


        <div>
            <h1 class="text-lg font-semibold">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>

        <div class="flex items-center gap-4">

            <button class="rounded-lg p-2 hover:bg-gray-100">
                🔔
            </button>

            @auth
                <div class="flex items-center gap-3">

                    {{-- User Initial --}}
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    {{-- User Information --}}
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                            Logout
                        </button>
                    </form>

                </div>
            @endauth

        </div>


    </div>


</header>
