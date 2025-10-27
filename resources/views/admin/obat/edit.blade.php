@extends('admin.template.master')
@section('content')
    <div class="content-wrapper">
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-2">Edit {{ $menu }}</h3>
                                <a href="{{ route('obat.index') }}" class="btn btn-warning float-right">Kembali</a>
                            </div>
                            <div class="card-body">
                                <form id="form-obat">
                                    @csrf

                                    <label>Nama Obat</label>
                                    <input type="text" class="form-control mb-3" name="nama" value="{{ $obat->nama }}">

                                    <label>Expired</label>
                                    <input type="date" class="form-control mb-3" name="expired" value="{{ $obat->expired }}">

                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control mb-3" name="harga_beli" value="{{ $obat->harga_beli }}">

                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control mb-3" name="harga_jual" value="{{ $obat->harga_jual }}">

                                    <label>Stok</label>
                                    <input type="number" class="form-control mb-3" name="stok" value="{{ $obat->stok }}">

                                    <label>Supplier</label>
                                    <select name="id_supplier" class="form-control mb-3">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ $supplier->id == $obat->id_supplier ? 'selected' : '' }}>
                                                {{ $supplier->perusahaan }}
                                            </option>
                                        @endforeach
                                    </select>

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
    $('#form-obat').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('obat.update', $obat->id) }}",
            data: $(this).serialize() + "&_method=PUT",
            success: function(response) {
                alert(response.message);
                window.location.href = "{{ route('obat.index') }}";
            },
            error: function() {
                alert("Gagal memperbarui data, periksa input!");
            }
        });
    });
</script>
@endsection
