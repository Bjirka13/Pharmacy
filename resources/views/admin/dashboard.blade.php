@extends('admin.template.master')

@section('title', 'Dashboard Admin')

@section('css')
<style>
    /* Dark Background */
    .content-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
        min-height: 100vh;
    }
    
    /* Welcome Header Card - White */
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border: none;
    }
    
    .welcome-card h1 {
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 8px 0;
    }
    
    .welcome-card p {
        color: #666;
        margin: 0;
        font-size: 16px;
    }
    
    /* Stat Cards - White Background */
    .stat-card {
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 15px !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
        transition: all 0.3s ease !important;
        border: none !important;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
        padding: 30px;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
    }
    
    /* Gradient Top Border */
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
    }
    
    .stat-card.card-cyan::before {
        background: linear-gradient(90deg, #17a2b8, #138496);
    }
    
    .stat-card.card-green::before {
        background: linear-gradient(90deg, #28a745, #218838);
    }
    
    .stat-card.card-blue::before {
        background: linear-gradient(90deg, #007bff, #0056b3);
    }
    
    .stat-card.card-warning::before {
        background: linear-gradient(90deg, #ffc107, #e0a800);
    }
    
    .stat-card.card-danger::before {
        background: linear-gradient(90deg, #dc3545, #c82333);
    }
    
    /* Stat Icon Wrapper */
    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 20px;
        color: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    
    .stat-card.card-cyan .stat-icon-wrapper {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }
    
    .stat-card.card-green .stat-icon-wrapper {
        background: linear-gradient(135deg, #28a745, #218838);
    }
    
    .stat-card.card-blue .stat-icon-wrapper {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .stat-card.card-warning .stat-icon-wrapper {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .stat-card.card-danger .stat-icon-wrapper {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    /* Stat Content */
    .stat-title {
        font-size: 14px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .stat-value {
        font-size: 48px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        line-height: 1;
    }
    
    .stat-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
        color: #fff;
    }
    
    .stat-card.card-cyan .stat-link {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }
    
    .stat-card.card-green .stat-link {
        background: linear-gradient(135deg, #28a745, #218838);
    }
    
    .stat-card.card-blue .stat-link {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .stat-card.card-warning .stat-link {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .stat-card.card-danger .stat-link {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    .stat-link:hover {
        color: #fff;
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .stat-link i {
        font-size: 16px;
    }
    
    /* Content Header */
    .content-header {
        padding: 25px 15px 0 15px !important;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .welcome-card h1 {
            font-size: 24px;
        }
        
        .welcome-card p {
            font-size: 14px;
        }
        
        .stat-value {
            font-size: 36px;
        }
        
        .stat-icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Welcome Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="welcome-card">
                <h1>👋 Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p>Berikut adalah ringkasan sistem apotek Anda hari ini</p>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Baris Pertama: 3 Kartu -->
            <div class="row">
                <!-- Total Supplier -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="stat-card card-cyan">
                        <div class="stat-icon-wrapper">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="stat-title">Total Supplier</div>
                        <div class="stat-value">{{ $totalSupplier }}</div>
                        <a href="{{ route('admin.supplier.index') }}" class="stat-link">
                            Lihat Supplier <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Total Obat -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="stat-card card-green">
                        <div class="stat-icon-wrapper">
                            <i class="fas fa-pills"></i>
                        </div>
                        <div class="stat-title">Total Obat</div>
                        <div class="stat-value">{{ $totalObat }}</div>
                        <a href="{{ route('obat.index') }}" class="stat-link">
                            Lihat Obat <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Total Pelanggan -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="stat-card card-blue">
                        <div class="stat-icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-title">Total Pelanggan</div>
                        <div class="stat-value">{{ $totalPelanggan }}</div>
                        <a href="#" class="stat-link">
                            Lihat Pelanggan <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Baris Kedua: 2 Kartu Alert -->
            <div class="row">
                <!-- Obat stok menipis -->
                <div class="col-lg-6 col-12">
                    <div class="stat-card card-warning">
                        <div class="stat-icon-wrapper">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-title">Obat Stok Menipis</div>
                        <div class="stat-value">{{ $stokMenipis }}</div>
                        <p style="color: #666; margin-bottom: 15px; font-size: 14px;">Obat dengan stok kurang dari 10 unit</p>
                        <a href="{{ route('obat.index') }}" class="stat-link">
                            Cek Obat <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Obat hampir kadaluarsa -->
                <div class="col-lg-6 col-12">
                    <div class="stat-card card-danger">
                        <div class="stat-icon-wrapper">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="stat-title">Obat Akan Kadaluarsa</div>
                        <div class="stat-value">{{ $obatExpired }}</div>
                        <p style="color: #666; margin-bottom: 15px; font-size: 14px;">Kadaluarsa dalam waktu ≤ 30 hari</p>
                        <a href="{{ route('obat.index') }}" class="stat-link">
                            Cek Obat <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection