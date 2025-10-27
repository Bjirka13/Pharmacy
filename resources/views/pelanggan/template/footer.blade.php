<footer class="main-footer" role="contentinfo">
    <style>
        .main-footer {
            background: #fff;
            padding: 25px 30px;
            border-top: 3px solid #667eea;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 50px;
            box-shadow: 0 -2px 15px rgba(102, 126, 234, 0.1);
        }
        
        .footer-text {
            font-size: 14px;
            color: #666;
        }
        
        .footer-text strong {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        
        .footer-links {
            display: flex;
            gap: 25px;
        }
        
        .footer-links a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            padding: 8px 15px;
            border-radius: 8px;
        }
        
        .footer-links a:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
        }
        
        .footer-social {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
        
        .social-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        @media (max-width: 768px) {
            .main-footer {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }
        }
    </style>
    
    <div>
        <div class="footer-text">
            © {{ date('Y') }} <strong>Apotek Online</strong> — Kesehatan Anda, Prioritas Kami 💊
        </div>
        <div class="footer-social">
            <a href="#" class="social-icon" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-icon" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
    
    <div class="footer-links">
        <a href="#">Tentang Kami</a>
        <a href="#">Bantuan</a>
        <a href="#">Syarat & Ketentuan</a>
        <a href="#">Hubungi Kami</a>
    </div>
</footer>