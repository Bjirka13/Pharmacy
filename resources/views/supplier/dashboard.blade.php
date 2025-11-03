@extends('supplier.template.master')

@section('title', 'Dashboard Supplier')

@section('css')
<style>
    .dashboard-header {
        margin-bottom: 30px;
    }
    
    .dashboard-header h1 {
        font-size: 28px;
        color: #4ecca3;
        margin-bottom: 8px;
    }
    
    .dashboard-header p {
        color: #aaa;
        font-size: 14px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #0f3460, #16213e);
        padding: 25px;
        border-radius: 12px;
        border-left: 4px solid #4ecca3;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        transition: transform 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        background: rgba(78, 204, 163, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #4ecca3;
    }
    
    .stat-title {
        color: #aaa;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 5px;
    }
    
    .stat-change {
        font-size: 12px;
        color: #4ecca3;
    }
    
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }
    
    .data-table-card {
        background: #16213e;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
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
        font-size: 18px;
        color: #4ecca3;
        font-weight: 600;
    }
    
    .action-btn {
        padding: 8px 16px;
        background: #4ecca3;
        color: #16213e;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .action-btn:hover {
        background: #3db88f;
        transform: translateY(-2px);
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
    
    .badge-success {
        background: rgba(78, 204, 163, 0.2);
        color: #4ecca3;
    }
    
    .badge-warning {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }
    
    .quick-actions {
        background: #16213e;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    
    .quick-action-item {
        padding: 15px;
        background: #0f3460;
        border-radius: 8px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .quick-action-item:hover {
        background: linear-gradient(135deg, #4ecca3, #0f3460);
        transform: translateX(5px);
    }
    
    .quick-action-icon {
        width: 40px;
        height: 40px;
        background: rgba(78, 204, 163, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4ecca3;
    }
    
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-header">
    <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
    <p>Berikut adalah ringkasan aktivitas supplier Anda hari ini</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Total Produk</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="stat-value">{{ $totalProduk }}</div>
        <div class="stat-change"><i class="fas fa-arrow-up"></i> +12 bulan ini</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Transaksi Aktif</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-receipt"></i>
            </div>
        </div>
        <div class="stat-value">{{ $transaksiAktif }}</div>
        <div class="stat-change"><i class="fas fa-arrow-up"></i> +5 hari ini</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Pending Order</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-value">{{ $pendingOrder }}</div>
        <div class="stat-change">Perlu segera diproses</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-title">Stok Menipis</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stokMenipis }}</div>
        <div class="stat-change">Perlu restock</div>
    </div>
</div>

<div class="content-grid">
    <div class="data-table-card">
        <div class="card-header">
            <h3 class="card-title">Transaksi Terbaru</h3>
            <button class="action-btn">Lihat Semua</button>
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
						<td>{{ $trx->pelanggan->nama ?? 'Tidak Diketahui' }}</td>
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
						<td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
					</tr>
				@endforelse
			</tbody>
        </table>
    </div>
    
    <div class="quick-actions">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        
        <div class="quick-action-item">
            <div class="quick-action-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div>
                <strong>Tambah Produk Baru</strong>
                <p style="font-size: 12px; color: #aaa; margin-top: 4px;">Daftarkan produk baru</p>
            </div>
        </div>
        
        <div class="quick-action-item">
            <div class="quick-action-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <strong>Cek Pending Order</strong>
                <p style="font-size: 12px; color: #aaa; margin-top: 4px;">8 order menunggu</p>
            </div>
        </div>
        
        <div class="quick-action-item">
            <div class="quick-action-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <strong>Laporan Penjualan</strong>
                <p style="font-size: 12px; color: #aaa; margin-top: 4px;">Lihat performa bulan ini</p>
            </div>
        </div>
        
        <div class="quick-action-item">
            <div class="quick-action-icon">
                <i class="fas fa-warehouse"></i>
            </div>
            <div>
                <strong>Kelola Stok</strong>
                <p style="font-size: 12px; color: #aaa; margin-top: 4px;">Update inventori</p>
            </div>
        </div>
    </div>
</div>
@endsection