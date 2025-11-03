@extends('pelanggan.template.master')

@section('title', 'Dashboard Customer')

@section('css')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px;
        border-radius: 20px;
        color: #fff;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-content {
        position: relative;
        z-index: 1;
    }
    
    .welcome-banner h1 {
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: 700;
    }
    
    .welcome-banner p {
        font-size: 16px;
        opacity: 0.9;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 35px;
    }
    
    .stat-card {
        background: #fff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
        border-color: #667eea;
    }
    
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .stat-title {
        color: #999;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .stat-value {
        font-size: 36px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
    }
    
    .stat-change {
        font-size: 13px;
        color: #4ecdc4;
        font-weight: 600;
    }
    
    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 35px;
    }
    
    .product-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.25);
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: rgba(255, 255, 255, 0.8);
        position: relative;
    }
    
    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ff6b6b;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    
    .product-info {
        padding: 20px;
    }
    
    .product-name {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .product-desc {
        font-size: 13px;
        color: #999;
        margin-bottom: 15px;
    }
    
    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .product-price {
        font-size: 20px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .add-to-cart-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .add-to-cart-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
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
    
    .order-status {
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
    
    .status-proses {
        background: rgba(255, 193, 7, 0.2);
        color: #f39c12;
    }
    
    .status-selesai {
        background: rgba(78, 205, 196, 0.2);
        color: #4ecdc4;
    }
    
    @media (max-width: 768px) {
        .welcome-banner h1 {
            font-size: 24px;
        }
        
        .products-grid {
            grid-template-columns: 1fr;
        }
        
        .order-item {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="welcome-banner">
    <div class="welcome-content">
        <h1>Selamat Datang, {{ Auth::user()->name }}! 🎉</h1>
        <p>Temukan produk kesehatan terbaik untuk Anda dan keluarga</p>
    </div>
</div>

{{-- Statistik Pesanan --}}
<div class="stats-grid">
    {{-- ... (bagian statistik tetap sama) --}}
</div>

{{-- ==============================
     Produk Populer
============================== --}}
<h2 class="section-title">🔥 Produk Populer</h2>
<div class="products-grid">
    @forelse ($produkPopuler as $produk)
        <div class="product-card">
            <div class="product-image">
                <i class="fas fa-pills"></i>
                <span class="product-badge">Baru</span>
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $produk->nama_obat }}</h3>
                <p class="product-desc">
                    {{ Str::limit($produk->deskripsi ?? 'Tidak ada deskripsi', 60) }}
                </p>
                <div class="product-footer">
                    <button type="button" class="add-to-cart-btn" 
							data-id="{{ $produk->id }}" 
							data-nama="{{ $produk->nama_obat }}"
							data-harga="{{ $produk->harga_jual }}"
							onclick="openModal(this)">
						<i class="fas fa-cart-plus"></i> Beli
					</button>
                    <span class="product-price">Rp {{ number_format($produk->harga_jual) }}</span>
                </div>
            </div>
        </div>
    @empty
        <p>Tidak ada produk populer saat ini.</p>
    @endforelse
		<!-- Modal Tambah ke Keranjang -->
		<div id="modalKeranjang" style="display:none; 
			position:fixed; inset:0; background:rgba(0,0,0,0.5); 
			justify-content:center; align-items:center; z-index:9999;">
			<div style="background:#fff; padding:25px; border-radius:15px; width:350px; text-align:center;">
				<h3 id="modalNamaObat"></h3>
				<p id="modalHargaObat" style="margin-bottom:10px; color:#666;"></p>

				<form id="formKeranjang" method="POST" action="{{ route('pelanggan.keranjang.store') }}">
					@csrf
					<input type="hidden" name="obat_id" id="modalObatId">
					<div style="margin-bottom:15px;">
						<label>Jumlah:</label>
						<input type="number" name="jumlah" min="1" value="1" required 
							   style="width:100px; text-align:center;">
					</div>
					<button type="submit" 
							style="background:#667eea; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;">
						Tambah ke Keranjang
					</button>
					<button type="button" onclick="closeModal()" 
							style="background:#ccc; border:none; padding:10px 20px; border-radius:8px; margin-left:10px;">
						Batal
					</button>
				</form>
			</div>
		</div>
</div>

{{-- ==============================
     Pesanan Terbaru
============================== --}}
<h2 class="section-title">📦 Pesanan Terbaru</h2>
<div class="orders-section">
    @forelse ($pesananTerbaru as $pesanan)
        <div class="order-item">
            <div class="order-info">
                <div class="order-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="order-details">
                    <h4>Order #{{ $pesanan->notransaksi }}</h4>
                    <p>Total: Rp {{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}</p>
                </div>
            </div>
            @php
                $statusClass = match($pesanan->status) {
                    'proses' => 'status-proses',
                    'selesai' => 'status-selesai',
                    'batal' => 'status-batal',
                    default => 'status-pending'
                };
            @endphp
            <span class="order-status {{ $statusClass }}">
                {{ ucfirst($pesanan->status) }}
            </span>
        </div>
    @empty
        <p>Tidak ada pesanan terbaru.</p>
    @endforelse
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openModal(btn) {
        document.getElementById('modalKeranjang').style.display = 'flex';
        document.getElementById('modalObatId').value = btn.getAttribute('data-id');
        document.getElementById('modalNamaObat').textContent = btn.getAttribute('data-nama');
        document.getElementById('modalHargaObat').textContent =
            'Harga: Rp ' + parseInt(btn.getAttribute('data-harga')).toLocaleString();
    }

    function closeModal() {
        document.getElementById('modalKeranjang').style.display = 'none';
    }

    // Tutup modal kalau klik area gelap
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('modalKeranjang');
        if (e.target === modal) closeModal();
    });

    // Tangani submit form tambah ke keranjang
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formKeranjang');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menambahkan ke keranjang');
                return res.text();
            })
            .then(() => {
                closeModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk telah ditambahkan ke keranjang 😊',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menambahkan ke keranjang!'
                });
            });
        });
    });
</script>
@endsection
