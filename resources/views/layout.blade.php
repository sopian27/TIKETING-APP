<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? "Laporin" }}</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/background.css">

</head>

<body>

    <!-- NAVBAR GLOBAL -->
    <nav class="flex items-center px-6 py-4 bg-white shadow gap-8">
        <div class="text-xl font-bold">
            <img src="/images/logo2.png" alt="Logo" class="h-16 w-auto">
        </div>

        <div class="flex gap-4 text-lg">
            <a href="/"
                class="px-4 py-2 rounded-lg transition {{ request()->is('/') ? 'text-white bg-blue-500' : 'text-gray-700 hover:bg-blue-100' }}">
                Beranda
            </a>

            <a href="/pengaduan"
                class="px-4 py-2 rounded-lg transition {{ request()->is('pengaduan') ? 'text-white bg-blue-500' : 'text-gray-700 hover:bg-blue-100' }}">
                Pengaduan
            </a>

            <a href="/progress"
                class="px-4 py-2 rounded-lg transition {{ request()->is('progress') ? 'text-white bg-blue-500' : 'text-gray-700 hover:bg-blue-100' }}">
                Progress
            </a>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="p-0 w-full">
        @yield('content')
    </div>

</body>
<!-- FOOTER -->
<footer class="bg-white border-t mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- BRAND -->
        <div>
            <img src="/images/logo2.png" alt="Laporin" class="h-12 mb-4">
            <p class="text-gray-600 text-sm leading-relaxed">
                Laporin adalah platform pengaduan masyarakat untuk menyampaikan laporan
                secara cepat, transparan, dan terpantau.
            </p>
        </div>

        <!-- NAVIGATION -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4">Menu</h3>
            <ul class="space-y-2 text-gray-600">
                <li><a href="/" class="hover:text-blue-600">Beranda</a></li>
                <li><a href="/pengaduan" class="hover:text-blue-600">Pengaduan</a></li>
                <li><a href="/progress" class="hover:text-blue-600">Progress</a></li>
            </ul>
        </div>

        <!-- SOCIAL MEDIA -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-4">Ikuti Kami</h3>
            <div class="flex gap-4">

                <!-- Instagram -->
                <a href="#" class="text-gray-500 hover:text-pink-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5a4.25 4.25 0 00-4.25-4.25h-8.5z" />
                        <path
                            d="M12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7zM17.25 6.75a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </a>

                <!-- Twitter / X -->
                <a href="#" class="text-gray-500 hover:text-black transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M18.244 2H21l-6.55 7.486L22 22h-6.78l-5.31-6.74L4.6 22H2l7.02-8.02L2 2h6.78l4.8 6.1L18.244 2z" />
                    </svg>
                </a>

                <!-- Facebook -->
                <a href="#" class="text-gray-500 hover:text-blue-700 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22 12a10 10 0 10-11.5 9.9v-7h-2.3V12h2.3V9.8c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.4.7-1.4 1.4V12h2.4l-.4 2.9h-2v7A10 10 0 0022 12z" />
                    </svg>
                </a>

            </div>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="border-t text-center py-4 text-sm text-gray-500">
        © {{ date('Y') }} Laporin. All rights reserved.
    </div>
</footer>

</html>