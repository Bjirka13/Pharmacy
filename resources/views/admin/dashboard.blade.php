@extends('admin.template.master')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Total Supplier -->
          <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
              <div class="inner text-center">
                <h3>{{ $totalSupplier }}</h3>
                <p>Total Supplier</p>
              </div>
              <a href="{{ route('supplier.index') }}" class="small-box-footer">
                Lihat Supplier <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Total Obat -->
          <div class="col-lg-4 col-12">
            <div class="small-box bg-success">
              <div class="inner text-center">
                <h3>{{ $totalObat }}</h3>
                <p>Total Obat</p>
              </div>
              <a href="{{ route('obat.index') }}" class="small-box-footer">
                Lihat Obat <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Total Pelanggan -->
          <div class="col-lg-4 col-12">
            <div class="small-box bg-primary">
              <div class="inner text-center">
                <h3>{{ $totalPelanggan }}</h3>
                <p>Total Pelanggan</p>
              </div>
              <a href="#" class="small-box-footer">
                Lihat Pelanggan <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Obat stok menipis -->
          <div class="col-lg-6 col-12">
            <div class="small-box bg-warning">
              <div class="inner text-center">
                <h3>{{ $stokMenipis }}</h3>
                <p>Obat dengan Stok Menipis (&lt; 10)</p>
              </div>
              <a href="{{ route('obat.index') }}" class="small-box-footer">
                Cek Obat <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Obat hampir kadaluarsa -->
          <div class="col-lg-6 col-12">
            <div class="small-box bg-danger">
              <div class="inner text-center">
                <h3>{{ $obatExpired }}</h3>
                <p>Obat Akan Kadaluarsa (&lt;= 30 Hari)</p>
              </div>
              <a href="{{ route('obat.index') }}" class="small-box-footer">
                Cek Obat <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
