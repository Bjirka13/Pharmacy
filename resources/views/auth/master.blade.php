<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Login') - Sistem Apotek</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .auth-container {
      width: 100%;
      max-width: 450px;
    }
    
    .auth-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }
    
    .auth-logo {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .auth-logo h1 {
      font-size: 32px;
      font-weight: 700;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 8px;
    }
    
    .auth-logo p {
      color: #666;
      font-size: 14px;
    }
    
    .form-title {
      text-align: center;
      color: #333;
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 25px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      color: #555;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
    }
    
    .input-wrapper {
      position: relative;
    }
    
    .input-wrapper input,
    .input-wrapper select {
      width: 100%;
      padding: 12px 15px 12px 45px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 14px;
      transition: all 0.3s;
      background: #fff;
    }
    
    .input-wrapper input:focus,
    .input-wrapper select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 16px;
    }
    
    .input-wrapper input:focus ~ .input-icon,
    .input-wrapper select:focus ~ .input-icon {
      color: #667eea;
    }
    
    .checkbox-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }
    
    .checkbox-wrapper input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }
    
    .checkbox-wrapper label {
      color: #555;
      font-size: 14px;
      cursor: pointer;
      margin: 0;
    }
    
    .btn-primary {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    .auth-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }
    
    .auth-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }
    
    .auth-link a:hover {
      text-decoration: underline;
    }
    
    .alert {
      padding: 12px 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
    }
    
    .alert-danger {
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      border: 1px solid rgba(220, 53, 69, 0.3);
    }
    
    .alert-success {
      background: rgba(40, 167, 69, 0.1);
      color: #28a745;
      border: 1px solid rgba(40, 167, 69, 0.3);
    }
    
    @media (max-width: 480px) {
      .auth-card {
        padding: 30px 25px;
      }
      
      .auth-logo h1 {
        font-size: 28px;
      }
    }
  </style>
  
  @yield('css')
</head>
<body>
  @yield('content')
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
</body>
</html>