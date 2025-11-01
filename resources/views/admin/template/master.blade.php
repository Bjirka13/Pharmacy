<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Sistem Apotek</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1a2e;
            color: #eee;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .content-wrapper {
            flex: 1;
            margin-left: 0; /* Changed from 260px to 0 */
            transition: margin-left 0.3s;
        }
        
        .main-content {
            padding: 20px 30px;
            min-height: calc(100vh - 140px);
        }
    </style>
    
    @yield('css')
</head>
<body>
    <div class="main-wrapper">
        @include('admin.template.sidebar')
        
        <div class="content-wrapper">
            @include('admin.template.header')
            
            <main class="main-content">
                {{-- Notifikasi --}}
                @if(session('success'))
                <div class="alert alert-success" style="background: rgba(78, 204, 163, 0.2); color: #4ecca3; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #4ecca3;">
                    <strong>✓ Berhasil!</strong> {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" style="background: rgba(231, 76, 60, 0.2); color: #e74c3c; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #e74c3c;">
                    <strong>✗ Gagal!</strong> {{ session('error') }}
                </div>
                @endif
                
                @yield('content')
            </main>
            
            @include('admin.template.footer')
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showNotification(type, message) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                timeOut: 5000,
                positionClass: 'toast-top-right'
            };
            toastr[type](message);
        }

        // Toggle sidebar (buka/tutup)
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when sidebar is open
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Tutup sidebar
        function closeSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const menuLinks = document.querySelectorAll('.menu-link');
            
            // Auto close sidebar saat klik menu
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    closeSidebar();
                });
            });

            // Tutup sidebar dengan tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                }
            });
        });

        // Auto hide alerts
        setTimeout(() => $('.alert').fadeOut(), 5000);
    </script>
    
    @yield('js')
</body>
</html>