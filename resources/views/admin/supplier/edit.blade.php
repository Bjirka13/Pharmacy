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
                                <h3 class="card-title mb-2">Edit {{ $menu }}</h3>
                                <a href="{{ route('supplier.index') }}" class="btn btn-warning float-right">Kembali</a>
                            </div>
                            <div class="card-body">
                                <form method="post" id="form-supplier">
                                    @csrf
                                    @method('PUT')
									
                                    <label for="">Perusahaan</label>
                                    <input type="text" class="form-control mb-3" name="perusahaan" id="perusahaan"
                                        value="{{ $supplier->perusahaan }}">

                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control mb-3" name="alamat" id="alamat"
                                        value="{{ $supplier->alamat }}">

                                    <label for="">Telp</label>
                                    <input type="text" class="form-control mb-3" name="telepon" id="telepon"
                                        value="{{ $supplier->telepon }}">

                                    <button type="submit" class="btn btn-primary">Update !</button>
                                </form>
                            </div>
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
                    type: "POST",
                    url: "{{ route('supplier.update', $supplier->id) }}", // URL update
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        alert(response.message);
                        window.location.href = "{{ route('supplier.index') }}";
                    },
                    error: function(response) {
                        alert("Terjadi kesalahan!");
                    }
                });
            });
        });
    </script>
@endsection
