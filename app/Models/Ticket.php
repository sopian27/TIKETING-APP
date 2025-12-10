<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'images',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'images' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    /** 
     * 1) AUTOMATIS: Kirim email setiap status berubah
     */
    protected static function booted()
    {
        static::updating(function ($ticket) {

            // Hanya kirim email jika status berubah
            if ($ticket->isDirty('status')) {
                $ticket->sendStatusEmail($ticket->status);
            }
        });
    }

    /**
     * 2) Fungsi untuk mengirim email status
     */
    public function sendStatusEmail(string $newStatus)
    {
        Mail::send(
            'emails.ticket-status-changed',   // <- sesuai nama file
            [
                'ticket' => $this,
                'status' => $newStatus,
            ],
            function ($msg) {
                $msg->to($this->email)
                    ->subject('Update Status Pengaduan');
            }
        );
    }
}
