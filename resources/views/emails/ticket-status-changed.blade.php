<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4F46E5; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9fafb; }
        .status { padding: 10px; border-radius: 5px; text-align: center; font-weight: bold; margin: 20px 0; }
        .status.pending { background: #FEF3C7; color: #92400E; }
        .status.progress { background: #DBEAFE; color: #1E40AF; }
        .status.finish { background: #D1FAE5; color: #065F46; }
        .footer { text-align: center; padding: 20px; color: #6B7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Update Status Pengaduan</h2>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $ticket->name }}</strong>,</p>
            <p>Status pengaduan Anda telah diperbarui:</p>
            
            <div class="status {{ $ticket->status }}">
                @if($ticket->status === 'pending')
                    ⏳ PENDING - Menunggu Proses
                @elseif($ticket->status === 'progress')
                    🔄 PROGRESS - Sedang Dikerjakan
                @else
                    ✅ SELESAI - Pengaduan Telah Ditangani
                @endif
            </div>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;"><strong>No Tiket:</strong></td>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;">#{{ $ticket->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;"><strong>Subjek:</strong></td>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;">{{ $ticket->subject }}</td>
                </tr>
                @if($ticket->admin_notes)
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;"><strong>Catatan Admin:</strong></td>
                    <td style="padding: 8px; border-bottom: 1px solid #E5E7EB;">{{ $ticket->admin_notes }}</td>
                </tr>
                @endif
            </table>

            <p style="margin-top: 20px;">Terima kasih atas kesabaran Anda.</p>
        </div>
        <div class="footer">
            <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>