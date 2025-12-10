@extends('layout')

@section('content')
<!-- Konten 
<div class="container mx-auto px-4">
    <div class="flex flex-col items-center justify-center min-h-[80vh] py-8">
        <div class="text-center max-w-4xl w-full">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-4">
                Selamat Datang
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 px-4">
                Silakan pilih menu pengaduan untuk memulai laporan.
            </p>
        </div>
    </div>
</div>
-->

<!-- HERO BANNER FULL WIDTH -->
<div class="relative w-screen left-1/2 right-1/2 ml-[-50vw] mr-[-50vw]">
    <!-- Background Image -->
    <img src="/images/banner1.png" 
         class="w-screen h-[380px] md:h-[480px] lg:h-[580px] object-cover">

    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-4">
        
        <!-- Judul -->
        <h1 class="text-white text-3xl md:text-5xl lg:text-6xl font-extrabold drop-shadow-lg">
            Suara Anda, Perubahan Kami
        </h1>

        <!-- Subjudul -->
        <p class="text-gray-200 text-lg md:text-2xl mt-4 max-w-2xl drop-shadow">
            Laporkan masalah Anda secara cepat, mudah, dan aman.
        </p>

        <!-- Tombol (Opsional) -->
        <a href="/pengaduan"
           class="mt-6 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-lg font-semibold shadow-lg transition">
            Buat Pengaduan
        </a>
    </div>
</div>



@endsection