@extends('layout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-col items-center justify-center min-h-[80vh] py-8">
        <div class="text-center max-w-4xl w-full">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-4">
                Selamat Datang
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 px-4">
                Silakan pilih menu pengaduan untuk memulai laporan.
            </p>
            
            <div class="w-full mb-8">
                <img src="/images/banner.png" 
                     alt="Banner" 
                     class="w-full h-auto max-w-3xl mx-auto rounded-lg shadow-lg object-contain">
            </div>
        </div>
    </div>
</div>
@endsection