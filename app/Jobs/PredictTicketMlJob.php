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

class PredictTicketMlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120;   // max 2 menit
    public $tries = 3;       // retry 3x

    public function handle(): void
    {
        // 🔥 Ambil ticket yang masih pending & belum diprediksi
        $tickets = Ticket::where('status', 'pending')
            ->whereNull('is_spam')
            ->get();

        foreach ($tickets as $ticket) {
            try {
                $http = Http::timeout(60);

                // attach images kalau ada
                if (is_array($ticket->images)) {
                    foreach ($ticket->images as $path) {
                        $fullPath = storage_path('app/public/' . $path);

                        if (file_exists($fullPath)) {
                            $http = $http->attach(
                                'image[]',
                                fopen($fullPath, 'r'),
                                basename($path)
                            );
                        }
                    }
                }

                // hit API ML
                $response = $http->post('http://127.0.0.1:5000/predict', [
                    'keluhan' => $ticket->message,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    $ticket->update([
                        'is_spam'         => $data['text']['is_spam'] ?? 0,
                        'prioritas'       => $data['text']['prioritas'] ?? 'Normal',
                        'spam_confidence' => $data['text']['spam_confidence'] ?? null,
                        'image_relevant'  => $data['image_relevant'] ?? null,
                        'relevance_score' => $data['relevance_score'] ?? null,
                        'ml_response'     => $data,
                    ]);
                } else {
                    Log::error('ML API failed', [
                        'ticket_id' => $ticket->id,
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                }

            } catch (\Throwable $e) {
                Log::error('ML Job error', [
                    'ticket_id' => $ticket->id,
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }
}
