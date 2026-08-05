<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-gray-200 bg-white lg:block">

    <div class="flex h-16 items-center border-b border-gray-200 px-6">
        <div class="flex items-center gap-2">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                📚
            </div>

            <span class="text-lg font-bold">
                Library
            </span>
        </div>
    </div>

    <nav class="space-y-1 p-4">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            📊
            Dashboard
        </a>

        <a href="{{ route('books.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            📚
            Books
        </a>

        <a href="{{ route('members.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            👥
            Members
        </a>

        <a href="{{ route('borrowings.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            📖
            Borrowings
        </a>

        <a href="{{ route('returns.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            🔄
            Returns
        </a>

        <a href="{{ route('categories.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            🏷️
            Categories
        </a>

        <div class="my-4 border-t border-gray-200"></div>

        <a href="{{ route('reports.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            📈
            Reports
        </a>

        <a href="{{ route('settings.index') }}"
            class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
            ⚙️
            Settings
        </a>

    </nav>

</aside>
