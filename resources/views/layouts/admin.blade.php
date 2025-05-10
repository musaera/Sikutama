<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIKUTAMA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <div class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true" id="mobile-menu" style="display: none;">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true" id="mobile-backdrop"></div>

            <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-emerald-700">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" id="close-mobile-menu">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-shrink-0 flex items-center px-4">
                    <h1 class="text-white text-2xl font-bold">SIKUTAMA</h1>
                </div>
                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    <nav class="px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('dashboard.kunjungan') }}" class="{{ request()->routeIs('dashboard.kunjungan') || request()->routeIs('kunjungan.*') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard.kunjungan') || request()->routeIs('kunjungan.*') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Kunjungan
                        </a>

                        <a href="{{ route('kunjungan.create') }}" class="{{ request()->routeIs('kunjungan.create') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('kunjungan.create') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Kunjungan
                        </a>
                    </nav>
                </div>
            </div>

            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <!-- Sidebar component -->
            <div class="flex-1 flex flex-col min-h-0 bg-emerald-700">
                <div class="flex items-center h-16 flex-shrink-0 px-4 bg-emerald-800">
                    <h1 class="text-white text-xl font-bold">SIKUTAMA</h1>
                </div>
                <div class="flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('dashboard.kunjungan') }}" class="{{ request()->routeIs('dashboard.kunjungan') || request()->routeIs('kunjungan.*') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard.kunjungan') || request()->routeIs('kunjungan.*') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Kunjungan
                        </a>

                        <a href="{{ route('kunjungan.create') }}" class="{{ request()->routeIs('kunjungan.create') ? 'bg-emerald-800 text-white' : 'text-white hover:bg-emerald-600' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('kunjungan.create') ? 'text-emerald-300' : 'text-emerald-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Kunjungan
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="md:pl-64 flex flex-col">
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500 md:hidden" id="open-mobile-menu">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <div class="w-full flex md:ml-0">
                            <div class="relative w-full flex items-center">
                                <div class="text-gray-900 font-medium">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <a href="{{ route('home') }}" class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <span class="sr-only">View home</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-4">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openMobileMenuBtn = document.getElementById('open-mobile-menu');
            const closeMobileMenuBtn = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileBackdrop = document.getElementById('mobile-backdrop');

            openMobileMenuBtn.addEventListener('click', function() {
                mobileMenu.style.display = 'flex';
            });

            closeMobileMenuBtn.addEventListener('click', function() {
                mobileMenu.style.display = 'none';
            });

            mobileBackdrop.addEventListener('click', function() {
                mobileMenu.style.display = 'none';
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
