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
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-950">
        <!-- Decorative Background Elements -->
        <div class="fixed top-20 left-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="fixed bottom-20 right-10 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-1 pt-12">
                <a href="/" class="flex items-center justify-center">
                    <div class="text-3xl sm:text-4xl font-bold text-white">
                        PlanoraAI
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-indigo-300 text-sm">
                <p>&copy; {{ date('Y') }} PlanoraAI. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
