<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
{
    $useDummy = true; // ganti false kalau sudah pakai database

    if ($useDummy) {
        $pending = 25;
        $process = 40;
        $done    = 63;

        return view('home', [
            'totalTickets'   => $pending + $process + $done,
            'pendingTickets' => $pending,
            'processTickets' => $process,
            'doneTickets'    => $done,
        ]);
    }

    // versi real
    return view('home', [
        'totalTickets'   => Ticket::count(),
        'pendingTickets' => Ticket::where('status', 'pending')->count(),
        'processTickets' => Ticket::where('status', 'process')->count(),
        'doneTickets'    => Ticket::where('status', 'done')->count(),
    ]);
}

}