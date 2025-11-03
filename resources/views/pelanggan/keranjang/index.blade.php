@extends('pelanggan.template.master')

@section('title', 'Keranjang Belanja')

@section('css')
<style>
    .orders-section {
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
        width: 50px;
        height: 50px;
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
    }

    .delete-btn {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .delete-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
    }

    .checkout-btn {
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }

    .checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
    }
</style>
@endsection

@section('content')
<div class="welcome-banner mb-4">
    <div class="welcome-content">
        <h1>🛒 Keranjang Belanja</h1>
        <p>Kelola produk yang ingin Anda pesan</p>
    </div>
</div>

<div class="orders-section">
    @if ($keranjang->isEmpty())
        <div class="text-center py-4">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Keranjang Anda masih kosong 😅</h5>
            <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-primary mt-3">
                <i class="fas fa-store"></i> Belanja Sekarang
            </a>
        </div>
    @else
        @foreach ($keranjang as $item)
            <div class="order-item" id="item_{{ $item->id }}">
                <div class="order-info">
                    <div class="order-icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div class="order-details">
                        <h4>{{ $item->obat->nama_obat }}</h4>
                        <p>Harga: Rp {{ number_format($item->obat->harga_jual, 0, ',', '.') }}</p>
                        <p>Jumlah: {{ $item->jumlah }}</p>
                    </div>
                </div>
					<form action="{{ route('pelanggan.keranjang.destroy', $item->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button class="delete-btn hapus-item" data-id="{{ $item->id }}"
                        data-url="{{ route('pelanggan.keranjang.destroy', $item->id) }}">
							Hapus
						</button>
					</form>
            </div>
        @endforeach

        <div class="text-end mt-4">
            <form action="{{ route('pelanggan.keranjang.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-btn">
                    <i class="fas fa-credit-card"></i> Checkout Sekarang
                </button>
            </form>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.hapus-item').click(function() {
        const id = $(this).data('id');
        const url = $(this).data('url');
        const row = $('#item_' + id);

        Swal.fire({
            title: 'Hapus produk ini?',
            text: "Produk akan dihapus dari keranjang Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        row.fadeOut(400, function() { $(this).remove(); });
                        Swal.fire('Dihapus!', 'Produk berhasil dihapus dari keranjang.', 'success');
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
