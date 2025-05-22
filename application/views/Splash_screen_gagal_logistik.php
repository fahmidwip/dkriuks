<!DOCTYPE html> 
<html>
<head>
    <title>Pemesanan Stokis</title>
    <meta http-equiv="refresh" content="5;url=<?= site_url('dashboard') ?>">
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
        .cross-icon {
            font-size: 48px;
            color: #e53935;
            margin: 20px auto;
            animation: popIn 0.8s ease-out;
        }

        @keyframes popIn {
            0% {
                transform: scale(0.2);
                opacity: 0;
            }
            60% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
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
        <h1>Afwan Akses ini hanya untuk Logistik</h1>
        <p>Silahkan tunggu</p>
        <div class="cross-icon">✖</div>
        <p>Syukron</p>
    </div>
</body>
</html>
