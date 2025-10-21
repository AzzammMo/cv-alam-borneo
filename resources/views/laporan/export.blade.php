<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>{{ $title ?? 'Laporan Penjualan - CV Alam Borneo' }}</title>
<style>
    body {
        font-family: "DejaVu Sans", sans-serif;
        margin: 24px;
        color: #1e293b;
        background: #fff;
        font-size: 12px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #0c4a6e;
        padding-bottom: 10px;
    }

    .company-info .name {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .company-info .sub {
        font-size: 11px;
        color: #64748b;
    }

    .meta {
        text-align: right;
        font-size: 11px;
        color: #334155;
        line-height: 1.4;
    }

    .meta .title {
        font-weight: 700;
        color: #0f172a;
        font-size: 13px;
    }

    /* Summary Cards */
    .summary {
        display: flex;
        justify-content: space-between;
        margin: 18px 0 28px 0; /* tambahkan margin bawah lebih besar */
        gap: 10px;
    }

    .card {
        flex: 1;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 10px 14px;
    }

    .card .label {
        font-size: 11px;
        color: #475569;
        text-transform: uppercase;
    }

    .card .value {
        font-weight: 700;
        font-size: 15px;
        margin-top: 4px;
        color: #0f172a;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    thead th {
        background: #0c4a6e;
        color: #fff;
        text-align: center;
        font-size: 12px;
        padding: 8px 6px;
        border: 1px solid #0a3b58;
    }

    tbody td {
        border: 1px solid #e2e8f0;
        padding: 8px;
        vertical-align: middle;
    }

    tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    tbody tr:nth-child(odd) {
        background: #ffffff;
    }

    .text-right { text-align: right; }
    .text-center { text-align: center; }

    /* Notes */
    .notes {
        margin-top: 12px;
        font-size: 11px;
        color: #475569;
    }

    /* Footer */
    @page { margin: 24px; }
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 32px;
        border-top: 1px solid #e2e8f0;
        font-size: 10px;
        color: #475569;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 24px;
    }

    .footer .page-number:after {
        content: "Halaman " counter(page) " dari " counter(pages);
    }
</style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-info">
            <div class="name">CV Alam Borneo</div>
            <div class="sub">Jl. Contoh No.1 — Telp (021) 000-0000 — info@alamborneo.example</div>
        </div>

        <div class="meta">
            <div class="title">{{ $title ?? 'Laporan Penjualan' }}</div>
            <div>
                Periode:
                @if(isset($start) && isset($end))
                    {{ \Carbon\Carbon::parse($start)->format('d M Y') }} – {{ \Carbon\Carbon::parse($end)->format('d M Y') }}
                @else
                    Semua Transaksi
                @endif
            </div>
            <div>Dicetak: {{ now()->format('d M Y H:i:s') }}</div>
        </div>
    </div>

    <!-- Summary -->
    <div class="summary">
        <div class="card">
            <div class="label">Total Penjualan</div>
            <div class="value">Rp {{ number_format($total_penjualan ?? 0, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="label">Barang Terjual</div>
            <div class="value">{{ $barang_terjual ?? 0 }}</div>
        </div>
        <div class="card">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ $total_transaksi ?? 0 }}</div>
        </div>
        <div class="card">
            <div class="label">Pelanggan Aktif</div>
            <div class="value">{{ $pelanggan_aktif ?? 0 }}</div>
        </div>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Transaksi</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $trx)
                <tr>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}</td>
                    <td class="text-center">{{ $trx->kode ?? $trx->id }}</td>
                    <td>{{ optional($trx->pelanggan)->nama_lengkap ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color:#94a3b8; padding:10px;">
                        Tidak ada transaksi pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Notes -->
    @if(!empty($notes))
    <div class="notes">
        <strong>Catatan:</strong> {{ $notes }}
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <div>Dicetak oleh CV Alam Borneo</div>
        <div class="page-number"></div>
    </div>
</body>
</html>
