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
    <h4 style="color:#4ecca3; margin-bottom:15px;">Daftar Transaksi</h4>
	
	<section class="content">
		<div class="container-fluid">
			<div class="data-table-card">
				<div class="card-header">
                    <h3 class="card-title">Riwayat Transaksi Pelanggan</h3>
                </div>
				
				<table class="data-table">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Pelanggan</th>
							<th>Daftar Obat</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@forelse($transaksis as $key => $t)
							<tr class="text-center">
								<td>{{ $key + 1 }}</td>
								<td>{{ $t->id }}</td>
								<td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') ?? '-' }}</td>
								<td>{{ $t->pelanggan->name ?? '-' }}</td>
								<td>
									@if($t->detail && count($t->detail) > 0)
										@foreach($t->detail as $detail)
											<span class="badge bg-info text-dark">{{ $detail->obat->nama ?? '-' }}</span>
										@endforeach
									@else
										<span class="text-muted">Tidak ada obat</span>
									@endif
								</td>
								<td>
									<span class="badge 
										{{ $t->status == 'pending' ? 'bg-warning' : ($t->status == 'proses' ? 'bg-info' : 'bg-success') }}">
										{{ ucfirst($t->status) }}
									</span>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection
