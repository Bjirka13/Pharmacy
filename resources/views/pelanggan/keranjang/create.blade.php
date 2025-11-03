@extends('pelanggan.template.master')

@section('title', 'Buat Pesanan Baru')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        border-radius: 20px;
        color: #fff;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .form-card {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    }
    
    .obat-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 15px;
    }
    
    .btn-add-item {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 12px 30px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-add-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-remove {
        background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #4ecca3, #3db88f);
        color: #fff;
        padding: 15px 40px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(78, 204, 163, 0.4);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>🛒 Buat Pesanan Baru</h1>
    <p>Pilih obat yang ingin Anda pesan</p>
</div>

<div class="form-card">
    <form action="{{ route('pelanggan.transaksi.store') }}" method="POST">
        @csrf
        
        <div id="obat-list">
            <div class="row obat-item">
                <div class="col-md-6">
                    <label class="form-label">Nama Obat</label>
                    <select name="obat_id[]" class="form-select select-obat" required>
                        <option value="">-- Pilih Obat --</option>
                        @foreach($obat as $o)
                            <option value="{{ $o->id }}">
                                {{ $o->nama }} - Rp {{ number_format($o->harga_jual, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control" min="1" value="1" required>
                </div>
                <div class="col-md-3 text-end">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-remove remove-obat">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>

        <button type="button" id="add-obat" class="btn-add-item mb-3">
            <i class="fas fa-plus"></i> Tambah Obat
        </button>

        <div class="text-end mt-4">
            <a href="{{ route('pelanggan.pesanan') }}" class="btn btn-secondary" style="padding: 15px 30px; border-radius: 12px;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Buat Pesanan
            </button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select-obat').select2({
        placeholder: "-- Pilih atau cari obat --",
        allowClear: true,
        width: '100%'
    });

    // Add new item
    $('#add-obat').click(function() {
        const item = $('.obat-item').first().clone();
        item.find('select').val('').trigger('change');
        item.find('input').val(1);
        $('#obat-list').append(item);
        
        // Reinitialize Select2
        item.find('.select-obat').select2({
            placeholder: "-- Pilih atau cari obat --",
            allowClear: true,
            width: '100%'
        });
    });

    // Remove item
    $(document).on('click', '.remove-obat', function() {
        if ($('.obat-item').length > 1) {
            $(this).closest('.obat-item').remove();
        } else {
            alert('Minimal harus ada 1 item!');
        }
    });
});
</script>
@endsection