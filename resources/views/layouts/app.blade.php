<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('icon.ico')}}" type="image/x-icon">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Floating Expand Button (shown when sidebar is collapsed on desktop) -->
            <button id="sidebar-expand" class="hidden fixed top-4 left-4 z-30 bg-indigo-600 text-white p-3 rounded-lg shadow-lg hover:bg-indigo-700 transition lg:flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Main Content -->
            <div id="main-content" class="lg:pl-64 transition-all duration-300">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="py-6 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @livewireScripts
        <script>
            // Initialize sidebar state
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                const toggleBtn = document.getElementById('sidebar-toggle');
                const closeBtn = document.getElementById('sidebar-close');
                const retractBtn = document.getElementById('sidebar-retract');
                const expandBtn = document.getElementById('sidebar-expand');
                const mainContent = document.getElementById('main-content');
                const sidebarTexts = document.querySelectorAll('.sidebar-text');

                let isCollapsed = false;

                // Mobile functions
                function openSidebar() {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }

                // Desktop collapse/expand functions
                function collapseSidebar() {
                    isCollapsed = true;
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                    mainContent.classList.remove('lg:pl-64');
                    mainContent.classList.add('lg:pl-20');

                    // Hide all text elements
                    sidebarTexts.forEach(text => {
                        text.classList.add('hidden');
                    });

                    // Show expand button
                    expandBtn.classList.remove('hidden');

                    // Change retract icon to expand
                    retractBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>';
                }

                function expandSidebar() {
                    isCollapsed = false;
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                    mainContent.classList.remove('lg:pl-20');
                    mainContent.classList.add('lg:pl-64');

                    // Show all text elements
                    sidebarTexts.forEach(text => {
                        text.classList.remove('hidden');
                    });

                    // Hide expand button
                    expandBtn.classList.add('hidden');

                    // Change expand icon back to retract
                    retractBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>';
                }

                // Mobile toggle
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', openSidebar);
                }

                if (closeBtn) {
                    closeBtn.addEventListener('click', closeSidebar);
                }

                if (overlay) {
                    overlay.addEventListener('click', closeSidebar);
                }

                // Desktop retract/expand
                if (retractBtn) {
                    retractBtn.addEventListener('click', function() {
                        if (isCollapsed) {
                            expandSidebar();
                        } else {
                            collapseSidebar();
                        }
                    });
                }

                if (expandBtn) {
                    expandBtn.addEventListener('click', expandSidebar);
                }

                // Load saved state from localStorage
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true' && window.innerWidth >= 1024) {
                    collapseSidebar();
                }

                // Save state to localStorage when changed
                if (retractBtn) {
                    retractBtn.addEventListener('click', function() {
                        localStorage.setItem('sidebarCollapsed', isCollapsed ? 'false' : 'true');
                    });
                }
            });
        </script>
    </body>
</html>
