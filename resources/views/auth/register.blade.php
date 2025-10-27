@extends('auth.master')
@section('content')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>Apotik</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftar Akun</p>

      <form action="{{ route('register_store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <select name="hak_akses" id="hak_akses" class="form-control">
                <option value="admin">Admin</option>
                <option value="supplier">Supplier</option>
                <option value="pelanggan">Pelanggan</option>
            </select>
        </div>
		<div class="row">
		  <div class="col-12 d-flex justify-content-end">
			<button type="submit" class="btn btn-primary">Register</button>
		  </div>
		</div>
      </form>

      <a href="login.html" class="text-center">Sudah punya akun? Login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

    
@endsection


