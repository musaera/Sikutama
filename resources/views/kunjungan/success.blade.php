@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto text-center">
            <div class="flex justify-center mb-6">
                <div class="bg-emerald-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-bold mb-4">Data Kunjungan Berhasil Disimpan</h1>
            <p class="text-gray-600 mb-8">
                Terima kasih telah mengisi buku tamu digital SMK TI BAZMA.
                Data kunjungan Anda telah berhasil disimpan dalam sistem kami.
            </p>

            <div class="space-y-4">
                <a href="{{ route('home') }}"
                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Kembali ke Beranda
                </a>

                <a href="{{ route('kunjungan.create') }}"
                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Isi Kunjungan Baru
                </a>
            </div>
        </div>
    </div>
@endsection
