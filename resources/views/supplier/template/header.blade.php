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
            display: none;
            background: none;
            border: none;
            color: #eee;
            font-size: 24px;
            cursor: pointer;
        }
        
        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #4ecca3;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
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
            background: linear-gradient(135deg, #4ecca3, #0f3460);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        
        .user-name {
            font-size: 14px;
            color: #eee;
        }
        
        .user-role {
            font-size: 12px;
            color: #aaa;
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            .header-title {
                font-size: 16px;
            }
            
            .user-name {
                display: none;
            }
        }
    </style>
    
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">Supplier Dashboard</h1>
    </div>
    
    <div class="header-right">
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-name">
                <div>{{ Auth::user()->name }}</div>
                <div class="user-role">Supplier</div>
            </div>
        </div>
    </div>
</header>