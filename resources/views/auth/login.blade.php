@extends('auth.master')

@section('title', 'Login')

@section('content')
<div class="auth-container">
  <div class="auth-card">
    <div class="auth-logo">
      <h1><i class="fas fa-hospital"></i> Ghani Pharmacy</h1>
      <p>Masuk ke akun Anda</p>
    </div>
    
    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Error!</strong> {{ $errors->first() }}
    </div>
    @endif
    
    @if (session('success'))
    <div class="alert alert-success">
      <strong>Berhasil!</strong> {{ session('success') }}
    </div>
    @endif
    
    <form action="{{ route('login') }}" method="POST">
      @csrf
      
      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-wrapper">
          <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
          <i class="fas fa-envelope input-icon"></i>
        </div>
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
          <i class="fas fa-lock input-icon"></i>
        </div>
      </div>
      
      <div class="checkbox-wrapper">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Ingat Saya</label>
      </div>
      
      <button type="submit" class="btn-primary">
        <i class="fas fa-sign-in-alt"></i> Login
      </button>
    </form>
    
    <div class="auth-link">
      Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
    </div>
  </div>
</div>
@endsection