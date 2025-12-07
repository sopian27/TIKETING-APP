@extends('layout')

@section('content')

<div class="flex flex-col items-center justify-center min-h-screen py-8">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 max-w-lg w-full">
        {{ session('success') }}
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

    <h2 class="text-2xl font-semibold mb-6">Form Pengaduan</h2>

    <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data" 
          class="space-y-4 max-w-lg w-full bg-white p-6 shadow rounded-lg" id="ticketForm">
        @csrf

        <div class="form-group">
            <label class="font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required 
                   class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror"
                   placeholder="contoh@email.com">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">No HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" 
                   class="w-full border rounded px-3 py-2 @error('phone') border-red-500 @enderror"
                   placeholder="08123456789"
                   pattern="[0-9]+"
                   title="Hanya boleh angka">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Subjek</label>
            <input type="text" name="subject" value="{{ old('subject') }}" required 
                   class="w-full border rounded px-3 py-2 @error('subject') border-red-500 @enderror">
            @error('subject')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Deskripsi</label>
            <textarea name="message" required 
                      class="w-full border rounded px-3 py-2 h-32 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium block mb-2">Upload Gambar (Maksimal 1 MB per gambar)</label>
            <input type="file" name="images[]" multiple id="imageInput" accept="image/*" class="hidden">
            
            <div id="imagePreview" class="grid grid-cols-3 gap-3 mb-3"></div>
            
            <button type="button" onclick="document.getElementById('imageInput').click()" 
                    class="w-full border-2 border-dashed border-gray-300 rounded-lg py-8 flex flex-col items-center justify-center hover:border-blue-500 transition">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-gray-500 mt-2">Klik untuk upload gambar</span>
            </button>
            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 1 MB per file</p>
            @error('images.*')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">
            Kirim Ticket
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
                alert(`File "${file.name}" terlalu besar! Maksimal 1 MB. Ukuran file: ${(file.size / 1048576).toFixed(2)} MB`);
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