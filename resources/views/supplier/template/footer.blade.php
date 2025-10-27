<footer class="main-footer" role="contentinfo">
    <style>
        .main-footer {
            background: #16213e;
            padding: 20px 30px;
            border-top: 2px solid #0f3460;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
        }
        
        .footer-text {
            font-size: 14px;
            color: #aaa;
        }
        
        .footer-text strong {
            color: #4ecca3;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-links a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #4ecca3;
        }
        
        @media (max-width: 768px) {
            .main-footer {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    
    <div class="footer-text">
        © {{ date('Y') }} <strong>Sistem Apotek</strong> — Supplier Area
    </div>
    
    <div class="footer-links">
        <a href="#">Bantuan</a>
        <a href="#">Dokumentasi</a>
        <a href="#">Kontak Support</a>
    </div>
</footer>