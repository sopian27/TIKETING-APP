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
    <div class="p-0">
        @yield('content')
    </div>

</body>
</html>
