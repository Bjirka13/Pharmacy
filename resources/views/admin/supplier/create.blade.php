@extends('admin.template.master')

@section('title', 'Tambah Supplier')

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
    
    /* Section Title */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
    }
    
    /* Section Separator */
    .section-separator {
        margin-top: 40px;
        margin-bottom: 30px;
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
                    <h1>➕ Tambah {{ $menu }}</h1>
                </div>
                <a href="{{ route('admin.supplier.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="form-card">
                <form method="post" id="form-supplier">
                    @csrf
                    
                    <!-- Informasi Login -->
                    <h5 class="section-title">👤 Informasi Login Supplier</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="supplier@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Supplier -->
                    <div class="section-separator">
                        <h5 class="section-title">🏢 Data Supplier</h5>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="perusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="perusahaan" id="perusahaan" placeholder="PT. Nama Perusahaan" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telepon">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="08xxxxxxxxxx" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right mt-4">
                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-save mr-2"></i>Simpan Supplier
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
        $('#form-supplier').submit(function(e) {
            e.preventDefault();
            
            let btnSubmit = $('#btnSubmit');
            btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');
            
            $.ajax({
                url: '{{ route("admin.supplier.store") }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.message) {
                        showNotification('success', response.message);
                    } else {
                        showNotification('success', 'Supplier berhasil ditambahkan!');
                    }
                    
                    setTimeout(function() {
                        window.location.href = "{{ route('admin.supplier.index') }}";
                    }, 1000);
                },
                error: function(xhr) {
                    btnSubmit.prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Simpan Supplier');
                    
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = '';
                        for (let key in errors) {
                            errorMsg += errors[key][0] + '<br>';
                        }
                        showNotification('error', errorMsg);
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        showNotification('error', xhr.responseJSON.message);
                    } else {
                        showNotification('error', 'Terjadi kesalahan pada server!');
                    }
                }
            });
        });
    });
</script>
@endsection