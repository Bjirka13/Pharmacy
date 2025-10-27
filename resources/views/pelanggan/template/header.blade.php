<header class="top-header" role="banner">
    <style>
        .top-header {
            background: #fff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(102, 126, 234, 0.1);
            border-bottom: 3px solid #667eea;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .menu-toggle {
            display: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 10px;
        }
        
        .header-title {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        
        .cart-icon {
            position: relative;
            background: linear-gradient(135deg, #667eea, #764ba2);
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .cart-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff6b6b;
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .user-info:hover {
            background: #e9ecef;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            color: #fff;
            box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }
        
        .user-role {
            font-size: 12px;
            color: #764ba2;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
            
            .header-title {
                font-size: 18px;
            }
            
            .user-details {
                display: none;
            }
            
            .cart-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
    
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">✨ Selamat Belanja!</h1>
    </div>
    
    <div class="header-right">
        <div class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-badge">3</span>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Customer</div>
            </div>
        </div>
    </div>
</header>