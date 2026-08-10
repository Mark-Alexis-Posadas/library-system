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
                <div class="relative" id="userMenu">

                    {{-- User Button --}}
                    <button type="button" onclick="toggleUserMenu()"
                        class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-gray-100">

                        {{-- User Avatar --}}
                        @if (auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                alt="{{ auth()->user()->name }}"
                                class="h-9 w-9 rounded-full object-cover ring-2 ring-white">
                        @else
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        {{-- User Information --}}
                        <div class="hidden text-left sm:block">

                            <p class="text-sm font-semibold text-gray-900">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </p>

                        </div>

                        {{-- Chevron --}}
                        <svg id="userMenuChevron" class="hidden h-4 w-4 text-gray-400 transition-transform sm:block"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>

                    </button>


                    {{-- Dropdown --}}
                    <div id="userDropdown"
                        class="absolute right-0 top-full z-50 mt-2 hidden w-64 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">

                        {{-- User Info --}}
                        <div class="border-b border-gray-100 px-4 py-4">

                            <div class="flex items-center gap-3">

                                {{-- Dropdown Avatar --}}
                                @if (auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                        alt="{{ auth()->user()->name }}"
                                        class="h-10 w-10 shrink-0 rounded-full object-cover">
                                @else
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-gray-900">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="truncate text-xs text-gray-500">
                                        {{ auth()->user()->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Menu --}}
                        <div class="p-2">

                            {{-- Profile --}}
                            <a href="{{ route('profile.index') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-700 transition hover:bg-gray-50">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                                </svg>

                                <span>Profile</span>
                            </a>


                            {{-- Logout --}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-3H9m0 0 3-3m-3 3 3 3" />
                                    </svg>

                                    <span>Logout</span>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            @endauth


            <script>
                function toggleUserMenu() {
                    const dropdown = document.getElementById('userDropdown');
                    const chevron = document.getElementById('userMenuChevron');

                    dropdown.classList.toggle('hidden');
                    chevron.classList.toggle('rotate-180');
                }


                document.addEventListener('click', function(event) {

                    const menu = document.getElementById('userMenu');
                    const dropdown = document.getElementById('userDropdown');

                    if (!menu || !dropdown) {
                        return;
                    }

                    if (!menu.contains(event.target)) {

                        dropdown.classList.add('hidden');

                        const chevron = document.getElementById('userMenuChevron');

                        if (chevron) {
                            chevron.classList.remove('rotate-180');
                        }
                    }

                });


                document.addEventListener('keydown', function(event) {

                    if (event.key === 'Escape') {

                        const dropdown = document.getElementById('userDropdown');
                        const chevron = document.getElementById('userMenuChevron');

                        if (dropdown) {
                            dropdown.classList.add('hidden');
                        }

                        if (chevron) {
                            chevron.classList.remove('rotate-180');
                        }
                    }

                });
            </script>

        </div>



    </div>


</header>
