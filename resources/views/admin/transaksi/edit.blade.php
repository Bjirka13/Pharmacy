@extends('admin.template.master')

@section('title', 'Edit Transaksi')

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
		color: #667eea;
		font-weight: 600;
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
                    <h1>✏️ Edit Transaksi</h1>
                </div>
                <a href="{{ route('admin.transaksi.index') }}" class="btn-back">
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
                    <strong>Info:</strong> Anda sedang mengedit transaksi <strong>{{ $transaksi->notransaksi }}</strong>
                </div>
                
                <form id="form-transaksi">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status Transaksi <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-save mr-2"></i>Update Status
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
        $('#form-transaksi').submit(function(e) {
            e.preventDefault();
            
            let btnSubmit = $('#btnSubmit');
            btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');
            
            $.ajax({
                type: "POST",
                url: "{{ route('admin.transaksi.update', $transaksi->id) }}",
                data: $(this).serialize() + "&_method=PUT",
                success: function(response) {
                    showNotification('success', 'Status transaksi berhasil diperbarui!');
                    setTimeout(function() {
                        window.location.href = "{{ route('admin.transaksi.index') }}";
                    }, 1000);
                },
                error: function(xhr) {
                    btnSubmit.prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Update Status');
                    showNotification('error', 'Gagal memperbarui status transaksi!');
                }
            });
        });
    });
</script>
@endsection