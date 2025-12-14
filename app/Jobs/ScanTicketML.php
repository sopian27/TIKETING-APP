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
                    $fullPath = storage_path('app/public/' . $path);

                    if (file_exists($fullPath)) {
                        $http = $http->attach(
                            'image[]',
                            file_get_contents($fullPath),
                            basename($path)
                        );
                    }

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

            $imageRelevant = false;
            $maxRelevance = null;

            foreach ($data['images'] ?? [] as $img) {


                if (isset($img['relevance_score'])) {
                    $maxRelevance = max($maxRelevance ?? 0, $img['relevance_score']);
                }

                if (isset($img['image_relevant'])) {
                    $imageRelevant = $img['relevance_score'];
                }
            }

            $ticket->update([
                'is_spam'         => $data['text']['is_spam'],
                'prioritas'       => $data['text']['prioritas'],
                'spam_confidence' => $data['text']['spam_confidence'],
                'image_relevant'  => $imageRelevant,
                'relevance_score' => $maxRelevance,
                'ml_response'     => $data,
                'status'         => 'Processing'
            ]);

        } catch (\Throwable $e) {
            Log::error('ML Job error: ' . $e->getMessage());
        }
    }
}
