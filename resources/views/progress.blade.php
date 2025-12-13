@extends('layout')

@section('content')

<div class="w-full max-w-7xl mx-auto py-8 px-4 mt-6">

    <!-- Search Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <form action="{{ route('progress') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan Ticket ID ..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('progress') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    @if(request('search'))
    <!-- Results Info -->
    @if($tickets->count() <= 0) <div
        class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg mb-4">
        Tidak ditemukan ticket dengan kata kunci "<strong>{{ request('search') }}</strong>"
</div>
@endif

<!-- Table with Data -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden min-h-[50vh] flex flex-col justify-start">
    <table class="w-full">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">ID Ticket</th>
                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                <th class="px-6 py-4 text-left font-semibold">Email</th>
                <th class="px-6 py-4 text-left font-semibold">Subjek</th>
                <th class="px-6 py-4 text-left font-semibold">Pengaduan</th>
                <th class="px-6 py-4 text-left font-semibold">Status</th>
                <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                <th class="px-6 py-4 text-left font-semibold">Photo</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @forelse($tickets as $t)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-mono text-blue-600">{{ $t->ticket_uuid }}</td>
                <td class="px-6 py-4">{{ $t->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $t->email }}</td>
                <td class="px-6 py-4">{{ Str::limit($t->subject, 30) }}</td>
                <td class="px-6 py-4">{{ Str::limit($t->message, 30) }}</td>
                <td class="px-6 py-4">
                    @if($t->status == 'pending')
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                        Pending
                    </span>
                    @elseif($t->status == 'proses')
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                        Proses
                    </span>
                    @elseif($t->status == 'selesai')
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                        Selesai
                    </span>
                    @else
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                        {{ ucfirst($t->status) }}
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        @foreach ($t->images ?? [] as $img)
                        <a href="{{ asset('storage/' . $img) }}" target="_blank">
                            <img src="{{ asset('storage/' . $img) }}"
                                class="w-14 h-14 object-cover rounded hover:scale-110 transition">
                        </a>
                        @endforeach
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-20 text-center">
                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-xl font-semibold text-gray-600 mb-2">Ticket tidak ditemukan</p>
                        <p class="text-gray-500">Coba kata kunci lain atau reset pencarian</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($tickets->hasPages())
<div class="mt-6">
    {{ $tickets->links() }}
</div>
@endif

@else
<!-- Empty State - Before Search -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden min-h-[50vh] flex flex-col justify-start">
    <table class="w-full">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">Ticket ID</th>
                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                <th class="px-6 py-4 text-left font-semibold">Email</th>
                <th class="px-6 py-4 text-left font-semibold">Subjek</th>
                <th class="px-6 py-4 text-left font-semibold">Pengaduan</th>
                <th class="px-6 py-4 text-left font-semibold">Status</th>
                <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                <th class="px-6 py-4 text-left font-semibold">Photo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="px-6 py-20 text-center">
                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <p class="text-xl font-semibold text-gray-600 mb-2">Gunakan pencarian untuk melihat ticket
                        </p>
                        <p class="text-gray-500">Masukkan ID Ticket di kolom pencarian</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endif
</div>

@endsection