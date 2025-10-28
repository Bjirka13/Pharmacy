@extends('auth.master')
@section('content')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>Ghani</b>Pharmacy</a>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Daftar Akun</p>

      <form action="{{ route('register') }}" method="post">
        @csrf

        {{-- Nama Lengkap --}}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nama lengkap" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        {{-- Email --}}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        {{-- Role --}}
        <div class="input-group mb-3">
          <select name="hak_akses" id="hak_akses" class="form-control" required>
            <option value="">-- Pilih Hak Akses --</option>
            <option value="supplier">Supplier</option>
            <option value="pelanggan">Pelanggan</option>
          </select>
        </div>

        {{-- Input tambahan hanya untuk Supplier --}}
        <div id="supplier-fields" style="display: none;">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-building"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" name="alamat" placeholder="Alamat Perusahaan">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" name="telepon" placeholder="No. Telepon Perusahaan">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-phone"></span></div>
            </div>
          </div>
        </div>

        {{-- Tombol Register --}}
        <div class="row">
          <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Daftar</button>
          </div>
        </div>
      </form>

      <a href="{{ route('login') }}" class="text-center d-block mt-2">Sudah punya akun? Login</a>
    </div>
  </div>
</div>

{{-- Script untuk menampilkan field Supplier --}}
<script>
document.getElementById('hak_akses').addEventListener('change', function() {
    const supplierFields = document.getElementById('supplier-fields');
    supplierFields.style.display = this.value === 'supplier' ? 'block' : 'none';
});
</script>

@endsection
