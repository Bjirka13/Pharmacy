@extends('admin.template.master')

@section('title', 'Edit Obat')

@section('css')
<style>
    /* Dark Background */
    .content-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
        min-height: 100vh;
    }
    
    /* Page Header Card */
    .page-header-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 25px 30px;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .page-header-card h1 {
        font-size: 28px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #fff;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        color: #fff;
    }
    
    /* Form Card */
    .form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    /* Form Style */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .form-control {
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 12px 40px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    /* Info Badge */
    .info-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 4px solid #667eea;
    }
    
    .info-badge strong {
        color: #667eea;
    }
    
    /* Content Header */
    .content-header {
        padding: 25px 15px 0 15px !important;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header-card">
                <div>
                    <h1>✏️ Edit {{ $menu }}</h1>
                </div>
                <a href="{{ route('obat.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="form-card">
                <!-- Info Badge -->
                <div class="info-badge">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Info:</strong> Anda sedang mengedit data obat <strong>{{ $obat->nama }}</strong>
                </div>
                
                <form id="form-obat">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Obat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $obat->nama }}" placeholder="Masukkan nama obat" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expired">Tanggal Kedaluwarsa <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="expired" id="expired" value="{{ $obat->expired }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga_beli" id="harga_beli" value="{{ $obat->harga_beli }}" placeholder="0" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga_jual" id="harga_jual" value="{{ $obat->harga_jual }}" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok">Stok <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="stok" id="stok" value="{{ $obat->stok }}" placeholder="0" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_supplier">Supplier <span class="text-danger">*</span></label>
                                <select name="id_supplier" id="id_supplier" class="form-control" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $supplier->id == $obat->id_supplier ? 'selected' : '' }}>
                                            {{ $supplier->perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right mt-4">
                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-save mr-2"></i>Update Obat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#form-obat').submit(function(e) {
            e.preventDefault();
            
            let btnSubmit = $('#btnSubmit');
            btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');
            
            $.ajax({
                type: "POST",
                url: "{{ route('obat.update', $obat->id) }}",
                data: $(this).serialize() + "&_method=PUT",
                success: function(response) {
                    if (response.message) {
                        showNotification('success', response.message);
                    } else {
                        showNotification('success', 'Obat berhasil diupdate!');
                    }
                    
                    setTimeout(function() {
                        window.location.href = "{{ route('obat.index') }}";
                    }, 1000);
                },
                error: function(xhr) {
                    btnSubmit.prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Update Obat');
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        showNotification('error', xhr.responseJSON.message);
                    } else {
                        showNotification('error', 'Gagal mengupdate obat!');
                    }
                }
            });
        });
    });
</script>
@endsection