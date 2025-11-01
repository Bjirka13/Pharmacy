<header class="top-header" role="banner">
    <style>
        .top-header {
            background: #16213e;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border-bottom: 2px solid #0f3460;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .menu-toggle {
            background: none;
            border: none;
            color: #eee;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #667eea;
        }
        
        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #667eea;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .header-search {
            position: relative;
        }
        
        .search-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 8px 35px 8px 15px;
            border-radius: 8px;
            color: #eee;
            font-size: 14px;
            width: 250px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255,255,255,0.1);
        }
        
        .search-input::placeholder {
            color: rgba(255,255,255,0.5);
        }
        
        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: #eee;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
        }
        
        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #e74c3c;
            color: #fff;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 10px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-size: 14px;
            color: #eee;
            font-weight: 600;
        }
        
        .user-role {
            font-size: 12px;
            color: #aaa;
        }
        
        @media (max-width: 768px) {
            .header-title {
                font-size: 16px;
            }
            
            .header-search {
                display: none;
            }
            
            .user-details {
                display: none;
            }
        }
    </style>
    
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">Admin Dashboard</h1>
    </div>
    
    <div class="header-right">
        <div class="header-search">
            <input type="text" class="search-input" placeholder="Cari obat atau supplier...">
            <i class="fas fa-search search-icon"></i>
        </div>
        
        <button class="notification-btn" aria-label="Notifications">
            <i class="far fa-bell"></i>
            <span class="notification-badge">3</span>
        </button>
        
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->hak_akses) }}</div>
            </div>
        </div>
    </div>
</header>