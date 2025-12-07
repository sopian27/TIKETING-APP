<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/pengaduan', function () {
    return view('pengaduan');
})->name('pengaduan');

Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');

// Route::get('/progress', [TicketController::class, 'progress']);

Route::get('/progress', [App\Http\Controllers\TicketController::class, 'index'])->name('progress');


