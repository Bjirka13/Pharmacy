@extends('admin.template.master')

@section('title', 'Data Obat')

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
    
    .btn-add {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: #fff !important;
        text-decoration: none !important;
    }
    
    /* Table Card */
    .table-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .modern-table thead tr {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
    }
    
    .modern-table th {
        padding: 15px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .modern-table td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        color: #333;
        font-size: 14px;
    }
    
    .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
    }
    
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Badges */
    .badge-stock {
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-high {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    .badge-medium {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }
    
    .badge-low {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    
    /* Action Buttons */
    .btn-action {
        padding: 8px 15px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        margin-right: 5px;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #fff;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: #fff;
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
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
                <h1>💊 Data Obat</h1>
                <a href="{{ route('obat.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Obat</span>
                </a>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="table-card">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
								<th>Deskripsi</th>
                                <th>Expired</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Supplier</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td><strong>{{ $obat->nama }}</strong></td>
								<td>{{ $obat->deskripsi }}</td>
                                <td>
                                    @php
                                        $expiredDate = \Carbon\Carbon::parse($obat->expired);
                                        $daysUntilExpired = now()->diffInDays($expiredDate, false);
                                    @endphp
                                    {{ $expiredDate->format('d M Y') }}
                                    @if($daysUntilExpired < 30 && $daysUntilExpired > 0)
                                        <span class="badge badge-low">{{ floor($daysUntilExpired) }} hari lagi</span>
                                    @elseif($daysUntilExpired <= 0)
                                        <span class="badge badge-low">Kadaluarsa</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                                <td>
                                    @if($obat->stok >= 50)
                                        <span class="badge-stock badge-high">{{ $obat->stok }}</span>
                                    @elseif($obat->stok >= 10)
                                        <span class="badge-stock badge-medium">{{ $obat->stok }}</span>
                                    @else
                                        <span class="badge-stock badge-low">{{ $obat->stok }}</span>
                                    @endif
                                </td>
                                <td>{{ $obat->supplier->perusahaan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('obat.edit', $obat->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-delete btn-delete-ajax" data-id="{{ $obat->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center" style="padding: 40px;">
                                    <i class="fas fa-pills" style="font-size: 48px; color: #ccc;"></i>
                                    <p style="margin-top: 15px; color: #999;">Belum ada data obat</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.btn-delete-ajax', function(e) {
        e.preventDefault();
        
        let id = $(this).data('id');
        let row = $(this).closest('tr');
        
        if(confirm("Yakin ingin menghapus obat ini?")) {
            $.ajax({
                type: "POST",
                url: "/obat/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    if (response.message) {
                        showNotification('success', response.message);
                    } else {
                        showNotification('success', 'Obat berhasil dihapus!');
                    }
                    
                    row.fadeOut(300, function() {
                        $(this).remove();
                        updateRowNumbers();
                    });
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        showNotification('error', xhr.responseJSON.message);
                    } else {
                        showNotification('error', 'Gagal menghapus obat!');
                    }
                }
            });
        }
    });
    
    function updateRowNumbers() {
        $('tbody tr').each(function(index) {
            $(this).find('td:first strong').text(index + 1);
        });
    }
</script>
@endsection