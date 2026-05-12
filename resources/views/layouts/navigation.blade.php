<!-- Mobile Header -->
<div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-white border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center space-x-3">
            <button id="sidebar-toggle" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <span class="text-xl font-bold text-indigo-600">PlanoraAI</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-semibold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </div>
</div>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-50 h-screen w-64 bg-indigo-600 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-indigo-500">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <div class="text-2xl font-bold text-white sidebar-text">PlanoraAI</div>
            </a>
            <button id="sidebar-close" class="lg:hidden text-white hover:text-indigo-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <button id="sidebar-retract" class="hidden lg:block text-white hover:text-indigo-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </button>
        </div>

        <!-- User Profile -->
        <div class="px-6 py-4 border-b border-indigo-500">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-indigo-600 font-bold text-lg flex-shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0 sidebar-text">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-200 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-600' : 'text-white hover:bg-indigo-500' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium sidebar-text">Dashboard</span>
            </a>

            <!-- Rancangan Pembelajaran -->
            <a href="{{route('rpp.create')}}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-indigo-500 transition">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium sidebar-text">Buat Baru</span>
            </a>

            <!-- Histori -->
            <a href="{{route('antrian.list')}}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-indigo-500 transition">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium sidebar-text">Riwayat</span>
            </a>

            <!-- Pengaturan -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-indigo-500 transition {{ request()->routeIs('profile.edit') ? 'bg-indigo-500' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium sidebar-text">Pengaturan</span>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="px-4 py-4 border-t border-indigo-500">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-white hover:bg-indigo-500 transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Spacer for mobile header -->
<div class="h-14 lg:hidden"></div>
