<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 30px; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        a { text-decoration: none; color: #1f2937; }
        .btn { display: inline-block; padding: 10px 15px; background: #1f2937; color: white; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="topbar">
            <h2>Selamat datang, Admin {{ $adminId }}</h2>
            <a class="btn" href="{{ route('admin.logout') }}">Logout</a>
        </div>
        <p>Halaman admin Anda sudah siap.</p>
        <p>Gunakan ID admin: <strong>admin01</strong></p>
        <p>Password: <strong>admin123</strong></p>
    </div>
</body>
</html>
