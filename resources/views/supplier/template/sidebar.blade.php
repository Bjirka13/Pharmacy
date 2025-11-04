<aside class="sidebar" role="navigation" aria-label="Main Navigation">
    <style>
        .sidebar {
            width: 260px;
            background: #16213e;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            overflow-y: auto;
            transition: transform 0.3s;
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 25px 20px;
            background: #0f3460;
            border-bottom: 2px solid #4ecca3;
        }
        
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            text-decoration: none;
        }
        
        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4ecca3, #0f3460);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .brand-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: #4ecca3;
        }
        
        .brand-text p {
            font-size: 12px;
            color: #aaa;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            margin: 5px 15px;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            color: #ddd;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .menu-link:hover {
            background: #0f3460;
            color: #4ecca3;
            transform: translateX(5px);
        }
        
        .menu-link.active {
            background: linear-gradient(135deg, #4ecca3, #0f3460);
            color: #fff;
        }
        
        .menu-icon {
            width: 20px;
            text-align: center;
        }
        
        .logout-section {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 15px;
        }
        
        .logout-form {
            margin: 0;
        }
        
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
    
    <div class="sidebar-brand">
        <a href="{{ route('supplier.dashboard') }}" class="brand-logo">
            <div class="brand-icon">
                <i class="fas fa-pills"></i>
            </div>
            <div class="brand-text">
                <h2>Ghani Pharmacy</h2>
                <p>Supplier Panel</p>
            </div>
        </a>
    </div>
    
    <nav class="sidebar-menu">
        <div class="menu-item">
            <a href="{{ route('supplier.dashboard') }}" class="menu-link {{ request()->routeIs('supplier.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt menu-icon"></i>
                <span>Dashboard</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('supplier.produk') }}" class="menu-link {{ request()->routeIs('supplier.produk*') ? 'active' : '' }}">
                <i class="fas fa-box menu-icon"></i>
                <span>Obat</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('supplier.transaksi.index') }}" class="menu-link {{ request()->routeIs('supplier.transaksi*') ? 'active' : '' }}">
                <i class="fas fa-receipt menu-icon"></i>
                <span>Transaksi</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('supplier.profil') }}" class="menu-link {{ request()->routeIs('supplier.profil*') ? 'active' : '' }}">
                <i class="fas fa-user menu-icon"></i>
                <span>Profil</span>
            </a>
        </div>
    </nav>
    
    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt menu-icon"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>