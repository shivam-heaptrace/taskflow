<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <a href="{{ route('files.index') }}" class="flex items-center">
                <span class="font-semibold text-gray-800">{{ config('app.name') }}</span>
            </a>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
