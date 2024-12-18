<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
        }

        .center-content {
            text-align: center;
        }

        .center-content img {
            max-width: 300px;
            margin-bottom: 20px;
        }

        .center-content h1 {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="center-content">
        <img src="{{ asset('frontend/img/UnderDev.png') }}" alt="Under Development">
        <h1>Halaman Dalam Proses Development</h1>
    </div>
</body>
</html>