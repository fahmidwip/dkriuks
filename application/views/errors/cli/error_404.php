<!DOCTYPE html>  
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <meta http-equiv="refresh" content="5;url=<?= site_url('dashboard') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #e1bee7);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 1s ease;
        }
        .splash {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 350px;
            box-sizing: border-box;
            animation: scaleIn 0.6s ease;
        }
        .splash h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #e53935;
        }
        .splash p {
            color: #666;
            font-size: 15px;
            margin: 5px 0;
        }
        .cross-icon {
            font-size: 50px;
            color: #e53935;
            margin: 20px 0;
            animation: popIn 0.8s ease-out;
        }

        @keyframes popIn {
            0% { transform: scale(0.2); opacity: 0; }
            60% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
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
            .splash h1 {
                font-size: 20px;
            }
            .splash p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="splash">
        <h1>404 - Halaman Tidak Ditemukan</h1>
        <p>Anda akan diarahkan ke halaman utama dalam 5 detik...</p>
        <div class="cross-icon">✖</div>
        <p>Terima kasih</p>
    </div>
</body>
</html>
