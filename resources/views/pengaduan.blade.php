@extends('layout')

@section('content')

<div class="flex flex-col items-center justify-center min-h-screen py-8">
    @if(session('success'))
    <div id="success-alert"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 max-w-lg w-full flex items-start justify-between gap-4">

        <span>{{ session('success') }}</span>

        <button onclick="document.getElementById('success-alert').remove()"
            class="text-green-700 font-bold text-xl leading-none hover:text-green-900">
            &times;
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5 max-w-lg w-full">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full max-w-5xl mx-auto py-8 px-4">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Formulir Pengaduan</h2>

        <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 max-w-4xl w-full bg-white p-8 shadow-lg rounded-lg" id="ticketForm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-semibold text-gray-700 block mb-2">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Nama">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="font-semibold text-gray-700 block mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="contoh@email.com">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div style="display: none;">
                    <label class="font-semibold text-gray-700 block mb-2">No HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                        placeholder="08123456789" pattern="[0-9]+" title="Hanya boleh angka">
                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="font-semibold text-gray-700 block mb-2">Subjek Pengaduan</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                        placeholder="Subjek Pengaduan">
                    @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="font-semibold text-gray-700 block mb-2">Deskripsi Lengkap</label>
                <textarea name="message" required rows="6"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical @error('message') border-red-500 @enderror"
                    placeholder="Deskripsi Lengkap">{{ old('message') }}</textarea>
                @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="font-semibold text-gray-700 block mb-2">Upload Photo</label>
                <p class="text-sm text-gray-600 mb-3">Maksimal 1 MB per File. Format: JPG, PNG, GIF</p>
                <input type="file" name="images[]" multiple id="imageInput" accept="image/*" class="hidden" require>

                <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4"></div>

                <button type="button" onclick="document.getElementById('imageInput').click()"
                    class="w-full border-2 border-dashed border-gray-300 rounded-lg py-12 flex flex-col items-center justify-center hover:border-blue-500 hover:bg-blue-50 transition">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-gray-500 mt-3 font-medium">Klik untuk upload Photo</span>
                </button>
                @error('images.*')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg transition text-lg shadow-md">
                Kirim Pengaduan
            </button>
        </form>
    </div>

    <script>
    let selectedFiles = [];

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const files = Array.from(e.target.files);

        // Validasi ukuran file
        let hasError = false;
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                // Cek ukuran file (1 MB = 1048576 bytes)
                if (file.size > 1048576) {
                    alert(
                        `File "${file.name}" terlalu besar! Maksimal 1 MB. Ukuran file: ${(file.size / 1048576).toFixed(2)} MB`
                    );
                    hasError = true;
                    return;
                }

                selectedFiles.push(file);

                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border">
                    <button type="button" onclick="removeImage('${file.name}')" 
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                        ×
                    </button>
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 text-center">
                        ${(file.size / 1024).toFixed(0)} KB
                    </div>
                `;
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        });

        // Reset input
        e.target.value = '';
    });

    function removeImage(fileName) {
        selectedFiles = selectedFiles.filter(f => f.name !== fileName);

        // Update preview
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        selectedFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border">
                <button type="button" onclick="removeImage('${file.name}')" 
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                    ×
                </button>
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 text-center">
                    ${(file.size / 1024).toFixed(0)} KB
                </div>
            `;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }

    // Update form submit
    document.getElementById('ticketForm').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('imageInput');
        const dt = new DataTransfer();

        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    });

    // Validasi nomor HP hanya angka
    document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    </script>

    @endsection