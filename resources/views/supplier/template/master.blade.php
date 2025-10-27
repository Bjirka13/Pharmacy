<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Supplier Dashboard') - Sistem Apotek</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            margin-left: 260px;
            transition: margin-left 0.3s;
        }
        
        .main-content {
            padding: 20px 30px;
            min-height: calc(100vh - 140px);
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
        @include('supplier.template.sidebar')
        
        <div class="content-wrapper">
            @include('supplier.template.header')
            
            <main class="main-content">
                @yield('content')
            </main>
            
            @include('supplier.template.footer')
        </div>
    </div>
    
    <!-- JS -->
    <script src="{{ asset('js/supplier.js') }}"></script>
    <script>
        // Toggle sidebar untuk mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
    @yield('js')
</body>
</html>