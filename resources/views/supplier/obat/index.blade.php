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
     <h4 style="color:#4ecca3; margin-bottom:15px;">Produk Saya</h1>

    <section class="content">
        <div class="container-fluid">
            <div class="data-table-card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Produk Anda</h3>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Deskripsi</th>
                            <th>Expired</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($obats as $obat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $obat->nama }}</strong></td>
                            <td>{{ $obat->deskripsi }}</td>
                            <td>
                                @php
                                    $expiredDate = \Carbon\Carbon::parse($obat->expired);
                                    $daysUntilExpired = now()->diffInDays($expiredDate, false);
                                @endphp
                                {{ $expiredDate->format('d M Y') }}
                                @if($daysUntilExpired < 30 && $daysUntilExpired > 0)
                                    <span class="badge badge-low">{{ floor($daysUntilExpired) }} hari lagi</span>
                                @elseif($daysUntilExpired <= 0)
                                    <span class="badge badge-low">Kadaluarsa</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                @if($obat->stok >= 50)
                                    <span class="badge-stock badge-high">{{ $obat->stok }}</span>
                                @elseif($obat->stok >= 10)
                                    <span class="badge-stock badge-medium">{{ $obat->stok }}</span>
                                @else
                                    <span class="badge-stock badge-low">{{ $obat->stok }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center" style="padding: 40px;">
                                <i class="fas fa-pills" style="font-size: 48px; color: #ccc;"></i>
                                <p style="margin-top: 15px; color: #999;">Belum ada produk terdaftar</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection