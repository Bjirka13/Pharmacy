<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Customer Dashboard') - Sistem Apotek</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .content-wrapper {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s;
            background: #f8f9fa;
        }
        
        .main-content {
            padding: 30px;
            min-height: calc(100vh - 160px);
        }
        
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
    
    @yield('css')
</head>
<body>
    <div class="main-wrapper">
        @include('pelanggan.template.sidebar')
        
        <div class="content-wrapper">
            @include('pelanggan.template.header')
            
            <main class="main-content">
                @yield('content')
            </main>
            
            @include('pelanggan.template.footer')
        </div>
    </div>
    
    <!-- JS -->
    <script src="{{ asset('js/customer.js') }}"></script>
    <script>
        // Toggle sidebar untuk mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
    @yield('js')
</body>
</html>