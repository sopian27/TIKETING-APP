<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Jobs\ScanTicketML;

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
        'ticket_uuid',
        'status',
        'admin_notes',
        'is_spam',
        'prioritas',
        'spam_confidence',
        'image_relevant',
        'relevance_score',
        'ml_response'
    ];

    protected $casts = [
        'images' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'image_relevant' => 'boolean',
        'ml_response' => 'array'
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

        static::creating(function ($ticket) {
            if (empty($ticket->ticket_uuid)) {
                $ticket->ticket_uuid = (string) Str::uuid();
            }

        });

        // Email awal
        static::created(function ($ticket) {
            $ticket->sendStatusEmail($ticket->status);
            ScanTicketML::dispatch($ticket->id);
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