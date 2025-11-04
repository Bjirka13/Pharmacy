@extends('supplier.template.master')

@section('title', 'Produk Saya')

@section('css')
<style>
    .data-table-card {
        background: #16213e;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        margin-top: 20px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #0f3460;
    }

    .card-title {
        font-size: 20px;
        color: #4ecca3;
        font-weight: 600;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #0f3460;
        color: #4ecca3;
        padding: 12px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid #0f3460;
        color: #ddd;
        font-size: 14px;
    }

    .data-table tbody tr:hover {
        background: rgba(78, 204, 163, 0.05);
    }

    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-low {
        background: rgba(255, 99, 71, 0.15);
        color: #ff6347;
    }

    .badge-stock {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-stock.badge-high {
        background: rgba(78, 204, 163, 0.2);
        color: #4ecca3;
    }

    .badge-stock.badge-medium {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .badge-stock.badge-low {
        background: rgba(255, 71, 87, 0.2);
        color: #ff4757;
    }

    .text-center {
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h4 class="text-teal-400 mb-4"><i class="fas fa-receipt"></i> Riwayat Transaksi</h4>

    <div class="card bg-dark text-light shadow">
        <div class="card-body">
            <h6 class="text-muted mb-3">Daftar Transaksi Produk Anda</h6>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Total Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $key => $t)
                            <tr class="text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->tanggal_transaksi ? $t->tanggal_transaksi->format('d M Y') : '-' }}</td>
                                <td>{{ $t->pelanggan->name ?? '-' }}</td>
                                <td>
                                    @foreach($t->detailTransaksi as $detail)
                                        <span class="badge bg-info text-dark">{{ $detail->obat->nama ?? '-' }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($t->status == 'Selesai') bg-success 
                                        @elseif($t->status == 'Proses') bg-warning 
                                        @elseif($t->status == 'Batal') bg-danger 
                                        @else bg-secondary @endif">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="7" class="text-muted py-4">Belum ada transaksi untuk produk Anda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
