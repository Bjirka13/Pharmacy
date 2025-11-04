@extends('admin.template.master')

@section('title', 'Dashboard Admin')

@section('css')
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
        min-height: 100vh;
        padding-bottom: 50px;
    }

    /* ===== Header Card ===== */
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border: none;
    }

    .welcome-card h1 {
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }

    .welcome-card p {
        color: #666;
        margin: 0;
        font-size: 16px;
    }

    /* ===== Grid Cards (seperti supplier) ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
    }

    .card-cyan::before { background: linear-gradient(90deg, #17a2b8, #138496); }
    .card-green::before { background: linear-gradient(90deg, #28a745, #218838); }
    .card-blue::before { background: linear-gradient(90deg, #007bff, #0056b3); }
    .card-warning::before { background: linear-gradient(90deg, #ffc107, #e0a800); }
    .card-danger::before { background: linear-gradient(90deg, #dc3545, #c82333); }

    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #fff;
        margin-bottom: 20px;
    }

    .card-cyan .stat-icon-wrapper { background: linear-gradient(135deg, #17a2b8, #138496); }
    .card-green .stat-icon-wrapper { background: linear-gradient(135deg, #28a745, #218838); }
    .card-blue .stat-icon-wrapper { background: linear-gradient(135deg, #007bff, #0056b3); }
    .card-warning .stat-icon-wrapper { background: linear-gradient(135deg, #ffc107, #e0a800); }
    .card-danger .stat-icon-wrapper { background: linear-gradient(135deg, #dc3545, #c82333); }

    .stat-title {
        font-size: 14px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 48px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        line-height: 1;
    }

    .stat-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        color: #fff;
    }

    .card-cyan .stat-link { background: linear-gradient(135deg, #17a2b8, #138496); }
    .card-green .stat-link { background: linear-gradient(135deg, #28a745, #218838); }
    .card-blue .stat-link { background: linear-gradient(135deg, #007bff, #0056b3); }
    .card-warning .stat-link { background: linear-gradient(135deg, #ffc107, #e0a800); }
    .card-danger .stat-link { background: linear-gradient(135deg, #dc3545, #c82333); }

    .stat-link:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* ===== Data Table ===== */
    .data-table-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .data-table-card .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
    }

    .data-table-card .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .data-table-card .action-btn {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    .data-table-card .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th,
    .data-table td {
        padding: 14px 20px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    .data-table th {
        background: #f0f2f5;
        font-weight: 600;
        color: #333;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        color: white;
    }

    .badge-success { background: #28a745; }
    .badge-warning { background: #ffc107; color: #000; }
    .badge-secondary { background: #6c757d; }

    @media (max-width: 768px) {
        .stat-value { font-size: 36px; }
        .data-table th, .data-table td { padding: 10px 12px; }
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="welcome-card">
                <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p>Berikut adalah ringkasan sistem apotek Anda hari ini</p>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Statistik Grid -->
            <div class="stats-grid">
                <div class="stat-card card-cyan">
                    <div class="stat-icon-wrapper"><i class="fas fa-truck"></i></div>
                    <div class="stat-title">Total Supplier</div>
                    <div class="stat-value">{{ $totalSupplier }}</div>
                    <a href="{{ route('admin.supplier.index') }}" class="stat-link">
                        Lihat Supplier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="stat-card card-green">
                    <div class="stat-icon-wrapper"><i class="fas fa-pills"></i></div>
                    <div class="stat-title">Total Obat</div>
                    <div class="stat-value">{{ $totalObat }}</div>
                    <a href="{{ route('obat.index') }}" class="stat-link">
                        Lihat Obat <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="stat-card card-blue">
                    <div class="stat-icon-wrapper"><i class="fas fa-users"></i></div>
                    <div class="stat-title">Total Pelanggan</div>
                    <div class="stat-value">{{ $totalPelanggan }}</div>
               
                </div>

                <div class="stat-card card-warning">
                    <div class="stat-icon-wrapper"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-title">Obat Stok Menipis</div>
                    <div class="stat-value">{{ $stokMenipis }}</div>
                    <p style="color: #666; margin-bottom: 15px;">Obat dengan stok kurang dari 10 unit</p>
                    <a href="{{ route('obat.index') }}" class="stat-link">
                        Cek Obat <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="stat-card card-danger">
                    <div class="stat-icon-wrapper"><i class="fas fa-calendar-times"></i></div>
                    <div class="stat-title">Obat Akan Kadaluarsa</div>
                    <div class="stat-value">{{ $obatExpired }}</div>
                    <p style="color: #666; margin-bottom: 15px;">Kadaluarsa dalam waktu = 30 hari</p>
                    <a href="{{ route('obat.index') }}" class="stat-link">
                        Cek Obat <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- ===== Tabel Transaksi Terbaru ===== -->
            <div class="data-table-card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Terbaru</h3>
                    <button class="action-btn" onclick="window.location='{{ route('admin.transaksi.index') }}'">Lihat Semua</button>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksiTerbaru as $trx)
                            <tr>
                                <td>#{{ $trx->notransaksi }}</td>
                                <td>{{ $trx->pelanggan->name }}</td>
                                <td>{{ $trx->detail->first()->obat->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($trx->total_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    @if($trx->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($trx->status == 'proses')
                                        <span class="badge badge-warning">Proses</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($trx->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted" style="padding: 40px;">
                                    <i class="fas fa-receipt" style="font-size: 48px; color: #ccc;"></i>
                                    <p style="margin-top: 15px; color: #999;">Belum ada transaksi</p>
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
