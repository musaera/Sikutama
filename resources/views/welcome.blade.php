<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKUTAMA - Sistem Informasi Kunjungan Tamu Bazma</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-emerald-600">SIKUTAMA</h1>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            <section class="bg-emerald-50 py-16">
                <div class="container mx-auto px-4 text-center">
                    <h1 class="text-4xl font-bold mb-4">Sistem Informasi Kunjungan Tamu Bazma</h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Selamat datang di sistem pencatatan kunjungan digital SMK TI BAZMA. Silahkan isi data kunjungan Anda untuk
                        memulai.
                    </p>
                    <a href="{{ route('kunjungan.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Isi Buku Tamu <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </section>

            <section class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold mb-8 text-center">Fitur Utama</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center text-center">
                                <div class="bg-emerald-100 p-3 rounded-full mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-medium mb-2">Pencatatan Digital</h3>
                                <p class="text-gray-500">
                                    Tinggalkan buku tamu manual dan beralih ke sistem digital yang lebih efisien
                                </p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center text-center">
                                <div class="bg-emerald-100 p-3 rounded-full mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-medium mb-2">Database Terpusat</h3>
                                <p class="text-gray-500">
                                    Semua data tamu tersimpan dalam database yang aman dan mudah diakses
                                </p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center text-center">
                                <div class="bg-emerald-100 p-3 rounded-full mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-medium mb-2">Pencatatan Waktu</h3>
                                <p class="text-gray-500">Catat waktu masuk dan keluar tamu secara otomatis dengan presisi</p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center text-center">
                                <div class="bg-emerald-100 p-3 rounded-full mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-medium mb-2">Statistik & Laporan</h3>
                                <p class="text-gray-500">Lihat statistik kunjungan dan buat laporan dengan mudah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-gray-50 border-t">
            <div class="container mx-auto px-4 py-6">
                <p class="text-center text-gray-500">
                    &copy; {{ date('Y') }} SIKUTAMA - SMK TI BAZMA. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
