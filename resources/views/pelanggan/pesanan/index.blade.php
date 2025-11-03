@extends('pelanggan.template.master')

@section('title', 'Pesanan Saya')

@section('css')
<style>
    .order-section {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s;
    }

    .order-item:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        transform: translateX(5px);
    }

    .order-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .order-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
    }

    .order-details h4 {
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    .order-details p {
        font-size: 13px;
        color: #999;
        margin: 0;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-proses { background: #cce5ff; color: #004085; }
    .status-selesai { background: #d4edda; color: #155724; }
    .status-batal { background: #f8d7da; color: #721c24; }

    .btn-cancel {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-cancel:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
    }
</style>
@endsection

@section('content')
<div class="welcome-banner mb-4">
    <div class="welcome-content">
        <h1>📦 Pesanan Saya</h1>
        <p>Lihat dan kelola status pesanan Anda</p>
    </div>
</div>

<div class="order-section">
    @forelse ($transaksi as $trx)
        <div class="order-item" id="trx_{{ $trx->id }}">
            <div class="order-info">
                <div class="order-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="order-details">
                    <h4>{{ $trx->notransaksi }}</h4>
                    <p>Tanggal: {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}</p>
                    <p>Total: <strong>Rp{{ number_format($trx->total_pembayaran, 0, ',', '.') }}</strong></p>
                    <span class="status-badge status-{{ strtolower($trx->status) }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </div>
            </div>

            <div>
                @if ($trx->status === 'pending')
                    <button class="btn-cancel btn-cancel-order" data-id="{{ $trx->id }}" data-url="{{ route('pelanggan.transaksi.batal', $trx->id) }}">
                        <i class="fas fa-times me-1"></i> Batalkan
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center py-4">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada pesanan 😅</h5>
            <a href="{{ route('pelanggan.home') }}" class="text-primary fw-bold">Belanja Sekarang</a>
        </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Batalkan pesanan
    $('.btn-cancel-order').click(function() {
        const id = $(this).data('id');
        const url = $(this).data('url');
        const row = $('#trx_' + id);

        Swal.fire({
            title: 'Batalkan pesanan ini?',
            text: "Pesanan akan dibatalkan permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function() {
                        Swal.fire('Dibatalkan!', 'Pesanan berhasil dibatalkan.', 'success');
                        row.fadeOut(400, function() { $(this).remove(); });
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan, coba lagi nanti.', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
