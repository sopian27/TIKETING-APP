<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class AdminLaporanController extends Controller
{
    public function download()
    {
        $fileName = 'laporan_' . date('Ymd_His') . '.csv';

        return response()->streamDownload(function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID','Nama','Email','Subjek','Status','Tanggal']);

            foreach (Ticket::all() as $t) {
                fputcsv($file, [
                    $t->id,
                    $t->name,
                    $t->email,
                    $t->subject,
                    $t->status,
                    $t->created_at,
                ]);
            }

            fclose($file);
        }, $fileName);
    }
}
