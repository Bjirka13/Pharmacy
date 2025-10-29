@extends('admin.template.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
		  <!-- Total Supplier -->
		  <div class="col-lg-6 col-12">
			<div class="small-box bg-info">
			  <div class="inner">
				<h3>{{ $totalSupplier }}</h3>
				<p>Total Supplier</p>
			  </div>
			  <div class="icon">
				<i class="fas fa-truck"></i>
			  </div>
			  <a href="{{ route('supplier.index') }}" class="small-box-footer">
				Lihat Supplier <i class="fas fa-arrow-circle-right"></i>
			  </a>
			</div>
		  </div>

		  <!-- Total Obat -->
		  <div class="col-lg-6 col-12">
			<div class="small-box bg-success">
			  <div class="inner">
				<h3>{{ $totalObat }}</h3>
				<p>Total Obat</p>
			  </div>
			  <div class="icon">
				<i class="fas fa-pills"></i>
			  </div>
			  <a href="{{ route('obat.index') }}" class="small-box-footer">
				Lihat Obat <i class="fas fa-arrow-circle-right"></i>
			  </a>
			</div>
		  </div>
		</div>
    </section>
    <!-- /.content -->
  </div>
@endsection
