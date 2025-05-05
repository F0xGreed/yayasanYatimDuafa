<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Donasi - Yayasan Yatim Dhuafa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #fdf6f0;
            color: #333;
        }

        header {
            background-color: #FF7F00;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #FF7F00;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            background-color: #FF7F00;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #e56f00;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

    <header>
        <h1>Form Donasi</h1>
        <p>Bantu kami berbagi dengan sesama</p>
    </header>

    <main>
        <form action="#" method="POST">
            @csrf
            <label for="nama">Nama Donatur</label>
            <input type="text" id="nama" name="nama" required>

            <label for="nominal">Nominal Donasi (Rp)</label>
            <input type="number" id="nominal" name="nominal" required>

            <label for="pesan">Pesan atau Doa</label>
            <textarea id="pesan" name="pesan" rows="4"></textarea>

            <button type="submit">Kirim Donasi</button>
        </form>
    </main>

    <footer>
        &copy; {{ date('Y') }} Yayasan Yatim Dhuafa
    </footer>
</body>
</html>
