<aside class="fixed inset-y-0 left-0 w-64 border-r border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">

    <div class="flex h-16 items-center border-b border-gray-200 px-6 dark:border-gray-700">
        <div class="flex items-center gap-2">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                📚
            </div>

            <span class="text-lg font-bold text-gray-900 dark:text-white">
                Library
            </span>

        </div>
    </div>


    <nav class="space-y-1 p-4">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            📊
            Dashboard
        </a>


        {{-- Books --}}
        <a href="{{ route('books.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            📚
            Books
        </a>


        {{-- Members --}}
        <a href="{{ route('members.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            👥
            Members
        </a>


        {{-- Borrowings --}}
        <a href="{{ route('borrowings.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            📖
            Borrowings
        </a>


        {{-- Returns --}}
        <a href="{{ route('returns.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            🔄
            Returns
        </a>


        {{-- Categories --}}
        <a href="{{ route('categories.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            🏷️
            Categories
        </a>


        {{-- Divider --}}
        <div class="my-4 border-t border-gray-200 dark:border-gray-700"></div>


        {{-- Reports --}}
        <a href="{{ route('reports.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            📈
            Reports
        </a>


        {{-- Settings --}}
        <a href="{{ route('settings.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            ⚙️
            Settings
        </a>

    </nav>
</aside>
