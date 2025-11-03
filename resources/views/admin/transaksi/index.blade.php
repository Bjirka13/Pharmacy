@extends('admin.template.master')

@section('title', 'Data Transaksi')

@section('css')
<style>
    /* Dark Background */
    .content-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
        min-height: 100vh;
    }

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
        margin: 0;
    }

    .table-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

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
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <!-- Header -->
            <div class="page-header-card">
                <h1>📦 Data Transaksi</h1>
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
                                <th>No. Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $transaksi)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td><strong>{{ $transaksi->notransaksi }}</strong></td>
                                <td>{{ $transaksi->pelanggan->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y H:i') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($transaksi->status) {
                                            'pending' => 'badge badge-warning',
                                            'proses' => 'badge badge-primary',
                                            'selesai' => 'badge badge-success',
                                            'batal' => 'badge badge-danger',
                                            default => 'badge badge-secondary'
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ ucfirst($transaksi->status) }}</span>
                                </td>
                                <td>Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-delete btn-delete-ajax" data-id="{{ $transaksi->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px;">
                                    <i class="fas fa-box" style="font-size: 48px; color: #ccc;"></i>
                                    <p style="margin-top: 15px; color: #999;">Belum ada transaksi</p>
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

        if(confirm("Yakin ingin menghapus transaksi ini?")) {
            $.ajax({
                type: "POST",
                url: "/transaksi/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    showNotification('success', response.message || 'Transaksi berhasil dihapus!');
                    row.fadeOut(300, function() {
                        $(this).remove();
                        updateRowNumbers();
                    });
                },
                error: function(xhr) {
                    showNotification('error', xhr.responseJSON?.message || 'Gagal menghapus transaksi!');
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
