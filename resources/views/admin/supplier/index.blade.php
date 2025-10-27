@extends('admin.template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $menu }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ $subMenu }}</a></li>
                            <li class="breadcrumb-item active">{{ $menu }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-2">Data {{ $menu }}</h3>
                                <a href="{{ route('supplier.create') }}" class="btn btn-primary float-right"><i
                                        class="fas fa-plus"></i>Tambah</a>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $supplier->perusahaan }}</td>
                                                <td>{{ $supplier->alamat }}</td>
                                                <td>{{ $supplier->telepon }}</td>
                                                <td>
													<a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning">
														<i class="fas fa-edit"></i>
													</a>

													<button type="button" class="btn btn-danger btn-delete" data-id="{{ $supplier->id }}">
														<i class="fas fa-trash"></i>
													</button>
												</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
<script>
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');

        if(confirm("Yakin ingin menghapus data ini?")) {
            $.ajax({
                type: "POST",
                url: "/supplier/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function() {
                    alert("Gagal menghapus data!");
                }
            });
        }
    });
</script>
@endsection
