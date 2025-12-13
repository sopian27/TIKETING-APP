<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Mail\TicketCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->has('search') || $request->search == '') {
            $tickets = collect();
            return view('progress', compact('tickets'));
        }

        $search = $request->search;
        
        $tickets = Ticket::query()
            ->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('progress', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'phone.numeric' => 'Nomor HP harus berupa angka',
            'phone.digits_between' => 'Nomor HP harus antara 10-15 digit',
            'subject.required' => 'Subjek wajib diisi',
            'message.required' => 'Deskripsi wajib diisi',
            'message.min' => 'Deskripsi minimal 10 karakter',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'images.*.max' => 'Ukuran gambar maksimal 1 MB'
        ]);

        $ticket = Ticket::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending'
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('tickets', 'public');
                $imagePaths[] = $path;
            }
            $ticket->update(['images' => json_encode($imagePaths)]);
        }

        // Kirim email notifikasi
        try {
            Mail::to($ticket->email)->send(new TicketCreated($ticket));
        } catch (\Exception $e) {
            // Log error tapi tetap lanjutkan (jangan gagal karena email)
            \Log::error('Failed to send email: ' . $e->getMessage());
        }

        return redirect()->route('pengaduan')->with(
            'success',
            'Pengaduan Anda berhasil dikirim. ' .
            'Tiket ID: #' . $ticket->ticket_uuid . '. ' .
            'Silakan gunakan Tiket ID ini untuk mengecek perkembangan pengaduan melalui menu Progress.'
        );

    }
}