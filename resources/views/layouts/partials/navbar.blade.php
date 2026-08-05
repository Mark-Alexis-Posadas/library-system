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

            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                    A
                </div>

                <div class="hidden sm:block">
                    <p class="text-sm font-semibold">
                        Admin
                    </p>

                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>
                </div>

            </div>

        </div>

    </div>

</header>
