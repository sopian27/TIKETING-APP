<?php

namespace App\Jobs;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ScanTicketML implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $ticketId;

    public function __construct(int $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handle(): void
    {
        $ticket = Ticket::find($this->ticketId);
        Log::info('ScanTicketML started for ticket ' . $ticket);

        if (!$ticket) return;

        try {
            $http = Http::timeout(60)
                ->attach('keluhan', $ticket->message);

            if (is_array($ticket->images)) {
                foreach ($ticket->images as $path) {
                    $http = $http->attach(
                        'image',
                        fopen(storage_path('app/public/' . $path), 'r'),
                        basename($path)
                    );
                }
            }

            $response = $http->post('http://127.0.0.1:5000/predict');
            Log::info('ML Response', $response->json());

            if (!$response->successful()) {
                Log::error('ML API failed', $response->json());
                return;
            }

            $data = $response->json();
            Log::info('ML Response', $data);

            $ticket->update([
                'is_spam'         => $data['text']['is_spam'] ?? 0,
                'prioritas'       => $data['text']['prioritas'] ?? 'Normal',
                'spam_confidence' => $data['text']['spam_confidence'] ?? null,
                'image_relevant'  => $data['image_relevant'] ?? null,
                'relevance_score' => $data['relevance_score'] ?? null,
                'ml_response'     => $data,
                'status'         => 'Processing',
            ]);

        } catch (\Throwable $e) {
            Log::error('ML Job error: ' . $e->getMessage());
        }
    }
}
