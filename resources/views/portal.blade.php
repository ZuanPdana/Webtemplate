<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #111827, #1f2937);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .box {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        h1 { margin-bottom: 10px; }
        p { margin-bottom: 20px; color: #d1d5db; }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            color: white;
        }
        .admin { background: #ef4444; }
        .user { background: #3b82f6; }
        .shop { background: #10b981; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Portal Masuk</h1>
        <p>Pilih akses sesuai kebutuhan Anda.</p>

        <a class="btn admin" href="{{ route('login') }}#admin-login">Login Admin</a>
        <a class="btn user" href="{{ route('shop.home') }}">Login Pengguna</a>
        <a class="btn shop" href="{{ route('shop.home') }}">Lanjut ke Toko</a>
    </div>
</body>
</html>
