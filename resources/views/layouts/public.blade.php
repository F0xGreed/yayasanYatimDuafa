<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Yayasan Yatim Dhuafa')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            color: #333;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* latar gelap transparan */
            z-index: -1;
        }

        header {
            background-color: #FF7F00;
            color: white;
            padding: 20px;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* =================== */
        /* UNIVERSAL BUTTON CSS */
        /* =================== */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }

        

        /* =================== */
        /* FORM STYLES */
        /* =================== */
        form label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        form input:focus,
        form textarea:focus {
            border-color: #FF7F00;
            outline: none;
        }

        form button {
            margin-top: 20px;
            background-color: #FF7F00;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
        }

        form button:hover {
            background-color: #e56f00;
        }

        /* =================== */
        /* RESPONSIVE */
        /* =================== */
        @media (max-width: 600px) {
            header img {
                height: 35px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

    @stack('styles')
</head>

<body style="background-image: url('{{ asset('images/pic2.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; position: relative;">
    
    <header style="background-color: #FF7F00; color: white; padding: 20px; text-align: center;">
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <img src="{{ asset('images/pic3.png') }}" alt="Logo" style="height: 50px;">
            <h1>@yield('header-title', 'Form Donasi')</h1>
        </div>
        <p>@yield('header-subtitle', 'Bantu kami berbagi dengan sesama')</p>
    </header>

    <main class="container" style="@yield('container-style')">
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Yayasan Yatim Dhuafa
    </footer>

</body>
</html>
