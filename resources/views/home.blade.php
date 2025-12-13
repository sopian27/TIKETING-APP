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
    <img src="/images/banner1.png" class="w-screen h-[380px] md:h-[480px] lg:h-[580px] object-cover">

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

<!-- ALUR PENGADUAN -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Alur Pengaduan Masyarakat
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-12">
            Ikuti langkah sederhana berikut untuk menyampaikan laporan Anda
            dan memantau proses penanganannya.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Step 1 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl font-bold mb-3">1</div>
                <h3 class="font-semibold text-lg mb-2">Isi Form Pengaduan</h3>
                <p class="text-gray-600 text-sm">
                    Masukkan identitas, subjek, dan deskripsi masalah yang ingin dilaporkan.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl font-bold mb-3">2</div>
                <h3 class="font-semibold text-lg mb-2">Unggah Bukti</h3>
                <p class="text-gray-600 text-sm">
                    Lampirkan foto pendukung agar laporan lebih jelas dan valid.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl font-bold mb-3">3</div>
                <h3 class="font-semibold text-lg mb-2">Proses Verifikasi</h3>
                <p class="text-gray-600 text-sm">
                    Laporan Anda akan diverifikasi dan diteruskan ke pihak terkait.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl font-bold mb-3">4</div>
                <h3 class="font-semibold text-lg mb-2">Pantau Progress</h3>
                <p class="text-gray-600 text-sm">
                    Gunakan Ticket ID untuk memantau status pengaduan secara berkala.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">
            Mengapa Menggunakan Laporin?
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2 text-blue-600">Mudah Digunakan</h3>
                <p class="text-gray-600 text-sm">
                    Antarmuka sederhana dan ramah pengguna untuk semua kalangan.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2 text-blue-600">Transparan</h3>
                <p class="text-gray-600 text-sm">
                    Setiap pengaduan memiliki Ticket ID untuk memantau progres penanganan.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2 text-blue-600">Aman & Tercatat</h3>
                <p class="text-gray-600 text-sm">
                    Data pengaduan tersimpan dengan aman dan terdokumentasi dengan baik.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- STATISTIK PENGADUAN -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Statistik Pengaduan Masyarakat
        </h2>
        <p class="text-gray-600 mb-12">
            Data pengaduan yang telah tercatat dalam sistem Laporin
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Total -->
            <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="text-4xl font-extrabold text-blue-600 mb-2">
                    {{ $totalTickets }}
                </div>
                <p class="text-gray-700 font-medium">Total Pengaduan</p>
            </div>

            <!-- Pending -->
            <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="text-4xl font-extrabold text-yellow-500 mb-2">
                    {{ $pendingTickets }}
                </div>
                <p class="text-gray-700 font-medium">Menunggu Proses</p>
            </div>

            <!-- Proses -->
            <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="text-4xl font-extrabold text-blue-500 mb-2">
                    {{ $processTickets }}
                </div>
                <p class="text-gray-700 font-medium">Dalam Proses</p>
            </div>

            <!-- Selesai -->
            <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="text-4xl font-extrabold text-green-600 mb-2">
                    {{ $doneTickets }}
                </div>
                <p class="text-gray-700 font-medium">Selesai</p>
            </div>

        </div>
    </div>
</section>


@endsection