<!DOCTYPE html> 
<html>
<head>
    <title>Pemesanan Stokis</title>
    <meta http-equiv="refresh" content="4;url=<?= site_url('dashboard') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
         body {
            background: linear-gradient(135deg, #e0f7fa, #e1bee7);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 1s ease;
        }
        .splash {
            background-color: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 90%;
            width: 350px;
            box-sizing: border-box;
            animation: scaleIn 0.6s ease;
        }
        .logo {
            width: 60px;
            margin-bottom: 20px;
        }
        .splash h1 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #333;
        }
        .splash p {
            color: #666;
            font-size: 15px;
            margin: 5px 0;
        }
        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #7e57c2;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 20px;
            }
            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="splash">
        <h1>Selamat Datang, <?= htmlspecialchars($username) ?>!</h1>
        <p>Anda berhasil login.</p>
        <div class="loader"></div>
        <p>Sedang Menyiapkan Konten</p>
    </div>
</body>
</html>
