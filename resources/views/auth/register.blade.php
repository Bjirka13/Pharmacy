@extends('auth.master')

@section('title', 'Register')

@section('content')
<div class="auth-container">
  <div class="auth-card">
    <div class="auth-logo">
      <h1><i class="fas fa-hospital"></i> Ghani Pharmacy</h1>
      <p>Buat akun baru</p>
    </div>
    
    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Error!</strong> {{ $errors->first() }}
    </div>
    @endif
    
    <form action="{{ route('register') }}" method="POST">
      @csrf
      
      <!-- Hidden input untuk hak_akses otomatis pelanggan -->
      <input type="hidden" name="hak_akses" value="pelanggan">
      
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <div class="input-wrapper">
          <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
          <i class="fas fa-user input-icon"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-wrapper">
          <input type="email" id="email" name="email" placeholder="Masukkan email" required>
          <i class="fas fa-envelope input-icon"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>
          <i class="fas fa-lock input-icon"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <div class="input-wrapper">
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
          <i class="fas fa-lock input-icon"></i>
        </div>
      </div>
      
      <button type="submit" class="btn-primary">
        <i class="fas fa-user-plus"></i> Daftar Sekarang
      </button>
    </form>
    
    <div class="auth-link">
      Sudah punya akun? <a href="{{ route('login') }}">Login Sekarang</a>
    </div>
  </div>
</div>
@endsection