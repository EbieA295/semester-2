<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan KostKita - {{ $periodName }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0F172A;
            background: #fff;
            padding: 40px;
            font-size: 13px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #FF6B00;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #FF6B00, #FF9138);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        
        .logo-text h1 {
            font-size: 22px;
            font-weight: 800;
            color: #FF6B00;
            margin-bottom: 2px;
        }
        
        .logo-text p {
            font-size: 11px;
            color: #64748B;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .report-meta {
            text-align: right;
        }
        
        .report-meta .badge {
            display: inline-block;
            background: #FFF0E5;
            color: #FF6B00;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 6px;
        }
        
        .report-meta p {
            font-size: 11px;
            color: #64748B;
        }
        
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        
        .summary-card.primary {
            background: linear-gradient(135deg, #FF6B00, #FF9138);
            color: white;
            border: none;
        }
        
        .summary-card .label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            opacity: 0.8;
            margin-bottom: 6px;
        }
        
        .summary-card .value {
            font-size: 20px;
            font-weight: 800;
        }
        
        .summary-card.primary .label { color: rgba(255,255,255,0.8); }
        .summary-card.primary .value { color: white; }
        .summary-card .label { color: #64748B; }
        .summary-card .value { color: #0F172A; }
        
        h2 {
            font-size: 16px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #F1F5F9;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        thead th {
            background: #F8FAFC;
            padding: 12px 14px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #64748B;
            border-bottom: 2px solid #E2E8F0;
        }
        
        thead th:last-child { text-align: right; }
        
        tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #F1F5F9;
            font-size: 12px;
        }
        
        tbody td:last-child { text-align: right; }
        
        tbody tr:nth-child(even) { background: #FAFBFC; }
        
        .text-success { color: #10B981; }
        .text-orange { color: #FF6B00; }
        .fw-bold { font-weight: 700; }
        .fw-800 { font-weight: 800; }
        
        .total-row td {
            background: #FFF0E5 !important;
            font-weight: 800;
            font-size: 14px;
            padding: 14px;
            border-top: 2px solid #FF6B00;
            border-bottom: none;
        }
        
        .badge-paid {
            display: inline-block;
            background: #D1FAE5;
            color: #059669;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .footer p {
            font-size: 10px;
            color: #94A3B8;
        }
        
        .signature {
            text-align: center;
            min-width: 200px;
        }
        
        .signature .line {
            border-bottom: 1px solid #0F172A;
            margin-top: 60px;
            margin-bottom: 6px;
        }
        
        .signature p {
            font-size: 12px;
            color: #0F172A;
            font-weight: 600;
        }
        
        .no-print { display: flex; gap: 10px; margin-bottom: 20px; }
        .no-print button {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
        }
        .btn-print { background: #FF6B00; color: white; }
        .btn-back { background: #F1F5F9; color: #0F172A; }
        
        @media print {
            body { padding: 20px; }
            .no-print { display: none !important; }
            .header { break-after: avoid; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
        <button class="btn-back" onclick="window.history.back()">← Kembali</button>
    </div>

    <div class="header">
        <div class="logo">
            <div class="logo-icon">🏠</div>
            <div class="logo-text">
                <h1>KostKita</h1>
                <p>Sistem Manajemen Kost Modern</p>
            </div>
        </div>
        <div class="report-meta">
            <div class="badge">LAPORAN KEUANGAN</div>
            <p>Periode: {{ $periodName }}</p>
            <p>Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
        </div>
    </div>

    <div class="summary-cards">
        <div class="summary-card primary">
            <div class="label">Total Pemasukan</div>
            <div class="value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Jumlah Transaksi</div>
            <div class="value">{{ count($transaksiSelesai) }} Booking</div>
        </div>
        <div class="summary-card">
            <div class="label">Rata-rata per Transaksi</div>
            <div class="value">Rp {{ count($transaksiSelesai) > 0 ? number_format($totalPemasukan / count($transaksiSelesai), 0, ',', '.') : 0 }}</div>
        </div>
    </div>

    <h2>📋 Rincian Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Penyewa</th>
                <th>Unit</th>
                <th>Tipe</th>
                <th>Status</th>
                <th>Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiSelesai as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($t->updated_at)->format('d/m/Y H:i') }}</td>
                <td class="fw-bold">{{ $t->nama_penyewa }}</td>
                <td>{{ $t->unit_id }}</td>
                <td>{{ $t->unit ? $t->unit->tipe : '-' }}</td>
                <td><span class="badge-paid">✓ Paid</span></td>
                <td class="text-success fw-800">+{{ number_format($t->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 30px; color: #94A3B8;">
                    Tidak ada transaksi pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
        @if(count($transaksiSelesai) > 0)
        <tbody>
            <tr class="total-row">
                <td colspan="6" style="text-align: right;">TOTAL PEMASUKAN</td>
                <td class="text-orange fw-800" style="text-align: right;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        @endif
    </table>

    <div class="footer">
        <div>
            <p>Dokumen ini dihasilkan otomatis oleh sistem KostKita.</p>
            <p>© {{ date('Y') }} KostKita - Sistem Manajemen Kost Modern</p>
        </div>
        <div class="signature">
            <p style="font-size: 11px; color: #64748B;">Mengetahui,</p>
            <div class="line"></div>
            <p>Pengelola KostKita</p>
        </div>
    </div>
</body>
</html>
