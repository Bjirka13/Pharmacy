<aside class="sidebar" role="navigation" aria-label="Main Navigation">
    <style>
        .sidebar {
            width: 280px;
            background: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 20px rgba(102, 126, 234, 0.15);
            overflow-y: auto;
            transition: transform 0.3s;
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 30px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #fff;
            text-decoration: none;
        }
        
        .brand-icon {
            width: 55px;
            height: 55px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        
        .brand-text h2 {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 3px;
        }
        
        .brand-text p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .sidebar-menu {
            padding: 25px 0;
        }
        
        .menu-item {
            margin: 8px 20px;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 18px;
            color: #666;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .menu-link:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
            transform: translateX(5px);
        }
        
        .menu-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 18px;
        }
        
        .menu-text {
            font-size: 15px;
        }
        
        .menu-badge {
            margin-left: auto;
            background: #ff6b6b;
            color: #fff;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
        }
        
        .logout-section {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 20px;
        }
        
        .logout-form {
            margin: 0;
        }
        
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 18px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }
        
        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
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
        <a href="{{ route('pelanggan.dashboard') }}" class="brand-logo">
            <div class="brand-icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="brand-text">
                <h2>Ghani Pharmacy</h2>
                <p>Belanja Mudah & Aman</p>
            </div>
        </a>
    </div>
    
    <nav class="sidebar-menu">
        <div class="menu-item">
            <a href="{{ route('pelanggan.dashboard') }}" class="menu-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home menu-icon"></i>
                <span class="menu-text">Home</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('pelanggan.pesanan') }}" class="menu-link {{ request()->routeIs('pelanggan.pesanan*') ? 'active' : '' }}">
                <i class="fas fa-box menu-icon"></i>
                <span class="menu-text">Pesanan Saya</span>
                <span class="menu-badge">2</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('pelanggan.keranjang.index') }}" class="menu-link {{ request()->routeIs('pelanggan.keranjang*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart menu-icon"></i>
                <span class="menu-text">Keranjang</span>
                <span class="menu-badge">3</span>
            </a>
        </div>
        
        <div class="menu-item">
            <a href="{{ route('pelanggan.profil') }}" class="menu-link {{ request()->routeIs('pelanggan.profil*') ? 'active' : '' }}">
                <i class="fas fa-user-circle menu-icon"></i>
                <span class="menu-text">Profil</span>
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