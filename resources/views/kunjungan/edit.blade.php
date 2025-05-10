@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Kunjungan</h1>
            <a href="{{ route('kunjungan.show', $kunjungan) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-md mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="kunjunganForm" action="{{ route('kunjungan.update', $kunjungan) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="nama_tamu" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_tamu" id="nama_tamu" value="{{ old('nama_tamu', $kunjungan->nama_tamu) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="space-y-2">
                            <label for="instansi" class="block text-sm font-medium text-gray-700">Asal Instansi/Perusahaan</label>
                            <input type="text" name="instansi" id="instansi" value="{{ old('instansi', $kunjungan->instansi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Masukkan asal instansi">
                            <p class="text-xs text-gray-500">Opsional. Bisa diisi "Orang Tua Siswa", "Alumni", dll.</p>
                        </div>

                        <div class="space-y-2">
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon/HP</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $kunjungan->nomor_telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Masukkan nomor telepon" required>
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $kunjungan->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Masukkan alamat email">
                            <p class="text-xs text-gray-500">Opsional.</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="tujuan_kunjungan" class="block text-sm font-medium text-gray-700">Tujuan Kunjungan</label>
                        <textarea name="tujuan_kunjungan" id="tujuan_kunjungan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 resize-none" placeholder="Jelaskan tujuan kunjungan Anda" required>{{ old('tujuan_kunjungan', $kunjungan->tujuan_kunjungan) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="bertemu_dengan" class="block text-sm font-medium text-gray-700">Bertemu Dengan</label>
                        <input type="text" name="bertemu_dengan" id="bertemu_dengan" value="{{ old('bertemu_dengan', $kunjungan->bertemu_dengan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Masukkan nama yang dituju" required>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium mb-2">Foto Tamu</h3>
                            <input type="hidden" name="foto_tamu" id="foto_tamu" value="{{ $kunjungan->foto_tamu }}">

                            @if ($kunjungan->foto_tamu)
                            <div id="current-photo" class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
                                <div class="relative border rounded-md overflow-hidden w-full max-w-xs">
                                    <img src="{{ asset('storage/' . $kunjungan->foto_tamu) }}" alt="Foto tamu" class="w-full h-auto">
                                </div>
                            </div>
                            @endif

                            <div id="camera-container" class="w-full h-32 border-2 border-dashed border-gray-300 rounded-md flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm text-gray-500">Ambil Foto Baru (Opsional)</span>
                            </div>

                            <div id="video-container" class="hidden space-y-2">
                                <div class="relative border rounded-md overflow-hidden aspect-video">
                                    <video id="video" class="w-full h-full object-cover"></video>
                                </div>
                                <button type="button" id="capture-btn" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    Ambil Foto
                                </button>
                            </div>

                            <div id="photo-container" class="hidden space-y-2">
                                <div class="relative border rounded-md overflow-hidden aspect-video">
                                    <img id="photo" src="#" alt="Foto tamu" class="w-full h-full object-cover">
                                </div>
                                <button type="button" id="retake-btn" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    Ambil Ulang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('kunjungan.show', $kunjungan) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cameraContainer = document.getElementById('camera-container');
        const videoContainer = document.getElementById('video-container');
        const photoContainer = document.getElementById('photo-container');
        const video = document.getElementById('video');
        const captureBtn = document.getElementById('capture-btn');
        const retakeBtn = document.getElementById('retake-btn');
        const photo = document.getElementById('photo');
        const fotoTamuInput = document.getElementById('foto_tamu');

        let stream = null;

        // Start camera
        cameraContainer.addEventListener('click', function() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        video.srcObject = mediaStream;
                        video.play();

                        cameraContainer.classList.add('hidden');
                        videoContainer.classList.remove('hidden');
                    })
                    .catch(function(err) {
                        console.error("Error accessing camera:", err);
                        alert("Tidak dapat mengakses kamera. Pastikan browser Anda mengizinkan akses kamera.");
                    });
            } else {
                alert("Maaf, browser Anda tidak mendukung akses kamera.");
            }
        });

        // Capture photo
        captureBtn.addEventListener('click', function() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');

            if (ctx) {
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const data = canvas.toDataURL('image/jpeg');
                photo.src = data;
                fotoTamuInput.value = data;

                // Stop the camera stream
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }

                videoContainer.classList.add('hidden');
                photoContainer.classList.remove('hidden');

                // Hide current photo if exists
                const currentPhoto = document.getElementById('current-photo');
                if (currentPhoto) {
                    currentPhoto.classList.add('hidden');
                }
            }
        });

        // Retake photo
        retakeBtn.addEventListener('click', function() {
            photoContainer.classList.add('hidden');
            cameraContainer.classList.remove('hidden');

            // Show current photo if exists
            const currentPhoto = document.getElementById('current-photo');
            if (currentPhoto) {
                currentPhoto.classList.remove('hidden');
                fotoTamuInput.value = "{{ $kunjungan->foto_tamu }}";
            } else {
                fotoTamuInput.value = '';
            }
        });
    });
</script>
@endpush
@endsection
