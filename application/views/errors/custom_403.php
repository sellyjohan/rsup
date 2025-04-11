<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>403 - Access Denied</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .error-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .error-container h1 {
            font-size: 48px;
            color: #e74c3c;
        }

        .error-container p {
            font-size: 18px;
            margin: 20px 0;
        }

        .error-container a {
            background-color: #007bff;
            padding: 12px 20px;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }

        .error-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>403</h1>
        <p>Access Denied. Anda tidak memiliki hak akses untuk halaman ini.</p>
        <a href="<?= base_url('dashboard') ?>">Kembali ke Dashboard</a>
    </div>
</body>
</html>
