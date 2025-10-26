<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/dashboard') }}" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">
      Halo, {{ Auth::user()->name }}
    </span>
  </a>

  <!-- Sidebar -->
<!-- Sidebar -->
<div class="sidebar" style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh;">

  <!-- Bagian Atas (User + Menu) -->
  <div>
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Obat -->
        <li class="nav-item">
          <a href="{{ route('obat.index') }}" class="nav-link">
            <i class="nav-icon fas fa-pills"></i>
            <p>
              Obat
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>

        <!-- Supplier -->
        <li class="nav-item">
          <a href="{{ route('supplier.index') }}" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Supplier
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>

      </ul>
    </nav>
  </div>

  <!-- Bagian Bawah (Logout) -->
  <div class="p-3 text-right">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-sign-out-alt"></i> Logout
      </button>
    </form>
  </div>

</div>
<!-- /.sidebar -->
  <!-- /.sidebar -->
</aside>
