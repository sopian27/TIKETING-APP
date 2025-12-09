<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .ticket-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .ticket-info h3 {
            margin-top: 0;
            color: #3b82f6;
        }
        .info-row {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-label {
            font-weight: bold;
            color: #6b7280;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            margin-top: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✓ Ticket Pengaduan Diterima</h1>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $ticket->name }}</strong>,</p>
        
        <p>Terima kasih telah mengirimkan pengaduan Anda. Ticket Anda telah berhasil diterima dan akan segera kami proses.</p>
        
        <div class="ticket-info">
            <h3>Detail Ticket</h3>
            
            <div class="info-row">
                <span class="info-label">ID Ticket:</span>
                <strong>#{{ $ticket->id }}</strong>
            </div>
            
            <div class="info-row">
                <span class="info-label">Subjek:</span>
                {{ $ticket->subject }}
            </div>
            
            <div class="info-row">
                <span class="info-label">Deskripsi:</span>
                <p style="margin: 10px 0;">{{ $ticket->message }}</p>
            </div>
            
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="status-badge">{{ strtoupper($ticket->status) }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                {{ $ticket->created_at->format('d F Y, H:i') }} WIB
            </div>
            
            @if($ticket->phone)
            <div class="info-row">
                <span class="info-label">No HP:</span>
                {{ $ticket->phone }}
            </div>
            @endif
        </div>
        
        <p><strong>Langkah Selanjutnya:</strong></p>
        <ul>
            <li>Tim kami akan meninjau pengaduan Anda dalam 1-2 hari kerja</li>
            <li>Anda akan menerima email update jika ada perkembangan</li>
            <li>Simpan ID Ticket <strong>#{{ $ticket->id }}</strong> untuk referensi</li>
        </ul>
        
        <p>Anda dapat mengecek status ticket Anda kapan saja melalui halaman Progress di website kami.</p>
        
        <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</p>
        
        <p>Terima kasih,<br>
        <strong>Tim Support</strong></p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis. Mohon tidak membalas email ini.</p>
        <p>&copy; {{ date('Y') }} Sistem Ticketing Pengaduan. All rights reserved.</p>
    </div>
</body>
</html>