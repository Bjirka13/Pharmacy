@extends('admin.template.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ $subMenu }}</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-2">Data {{ $menu }}</h3>
                            <a href="{{ route('supplier.index') }}" class="btn btn-warning float-right">Kembali</a>
                        </div>

                        <div class="card-body">
                            <form method="post" id="form-supplier">
                                @csrf

                                <h5 class="mb-3">Informasi Login Supplier</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mb-3">Data Supplier</h5>
                                <label for="perusahaan">Perusahaan</label>
                                <input type="text" class="form-control mb-3" name="perusahaan" id="perusahaan" required>

                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control mb-3" name="alamat" id="alamat" required>

                                <label for="telepon">Telp</label>
                                <input type="text" class="form-control mb-3" name="telepon" id="telepon"
                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                       maxlength="15" required>

                                <button type="submit" class="btn btn-primary">Buat !</button>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                </div>
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

        $.ajax({
            url: '/admin/supplier',
            type: 'POST',
            data: $('#form-supplier').serialize(),
            success: function(response) {
                alert(response.message);
                $('#form-supplier')[0].reset();
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let pesan = '';
                    for (let key in errors) {
                        pesan += errors[key][0] + '\n';
                    }
                    alert(pesan);
                } else {
                    alert('Terjadi kesalahan pada server.');
                }
            }
        });
    });
});
</script>
@endsection
