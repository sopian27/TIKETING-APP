<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLaporanController;

Route::get('/', function () {
    return view('home');
});

Route::get('/pengaduan', function () {
    return view('pengaduan');
})->name('pengaduan');

Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');

// Route::get('/progress', [TicketController::class, 'progress']);

Route::get('/progress', [App\Http\Controllers\TicketController::class, 'index'])->name('progress');



Route::middleware(['auth'])
    ->prefix('admin-tools')
    ->group(function () {
        Route::get('/laporan/download', [AdminLaporanController::class, 'download'])
            ->name('admin.laporan.download');
    });
