<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Yatim Dhuafa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: relative;
            background: url('{{ asset('images/pic2.png') }}') no-repeat center center fixed;
            background-size: cover;
            z-index: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(50, 50, 50, 0.4); /* overlay abu-abu gelap */
            z-index: -1;
        }

        header {
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 8px 16px;
            border: 2px solid white;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background-color: white;
            color: #FF7F00;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
            z-index: 1;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-bottom: 30px;
        }

        .btn {
            font-size: 1rem;
            padding: 12px 24px;
            margin: 0 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-donasi {
            background-color: white;
            color: #FF7F00;
        }

        .btn-login {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-donasi:hover {
            background-color: #f1f1f1;
        }

        .btn-login:hover {
            background-color: white;
            color: #FF7F00;
        }

        footer {
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
            z-index: 1;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/pic3.png') }}" alt="Logo" style="height: 50px; vertical-align: middle;">
            <span style="margin-left: 10px;">
                <a href="/" style="text-decoration: none; color: white;">Yayasan Yatim Dhuafa</a>
            </span>
        </div>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
        </div>
    </header>

    <main>
        <h1>Berbagi Kebahagiaan Bersama</h1>
        <p>Bantu anak-anak yatim dan dhuafa mendapatkan kehidupan yang lebih layak melalui program donasi dan kegiatan sosial kami.</p>
        <div>
            <a href="{{ route('donasi') }}" class="btn btn-donasi">Donasi Sekarang</a>
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Yayasan Yatim Dhuafa. All rights reserved.
    </footer>
</body>
</html>
