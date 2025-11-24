<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Artikel E-Mading</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }
        .header p {
            margin: 8px 0;
            color: #666;
            font-size: 14px;
        }
        .print-btn {
            text-align: center;
            margin-bottom: 20px;
        }
        .print-btn button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .print-btn button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            font-size: 11px;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>
<body>

    
    <div class="header">
        <h1>LAPORAN ARTIKEL E-MADING</h1>
        <p>Artikel yang Diterbitkan dan Ditolak</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    @if($artikels->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Judul Artikel</th>
                    <th width="15%">Penulis</th>
                    <th width="15%">Kategori</th>
                    <th width="15%">Status</th>
                    <th width="20%">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artikels as $index => $artikel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $artikel->judul }}</td>
                    <td>{{ $artikel->user->nama }}</td>
                    <td>{{ $artikel->kategori->nama_kategori }}</td>
                    <td>{{ $artikel->status == 'published' ? 'Diterbitkan' : 'Ditolak' }}</td>
                    <td>{{ $artikel->created_at->format('d/m/Y') }}</td>
                </tr>
                @if($artikel->status == 'rejected' && $artikel->alasan_penolakan)
                <tr style="background-color: #fff2f2;">
                    <td colspan="6" style="font-size: 10px; color: #d32f2f;">
                        <strong>Alasan Penolakan:</strong> {{ $artikel->alasan_penolakan }}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        
        <div class="summary">
            <h3 style="margin-top: 0;">Ringkasan Laporan</h3>
            <p><strong>Total Artikel Diterbitkan: {{ $artikels->where('status', 'published')->count() }}</strong></p>
            <p><strong>Total Artikel Ditolak: {{ $artikels->where('status', 'rejected')->count() }}</strong></p>
            <p><strong>Total Keseluruhan: {{ $artikels->count() }}</strong></p>
            <p><strong>Periode: </strong>Semua artikel yang diterbitkan dan ditolak</p>
        </div>
    @else
        <p style="text-align: center; margin-top: 50px;">Belum ada artikel yang diterbitkan atau ditolak.</p>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>