<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Yayasan Yatim Dhuafa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #f8f9fa;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #FF7F00;
        color: white;
        position: fixed;
        padding-top: 20px;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 12px;
        text-decoration: none;
        font-weight: bold;
    }

    .sidebar a:hover {
        background-color: #d97706;
    }

    .content {
        margin-left: 260px;
        padding: 20px;
    }

    .navbar {
        background-color: #FFA500;
    }

    .flash-message {
        position: fixed;
        top: 20px;
        left: 270px; /* disesuaikan agar tidak tabrakan dengan sidebar */
        right: 20px;
        z-index: 1050;
        font-size: 0.95rem;
        padding: 0.75rem 1.25rem;
        max-width: calc(100% - 300px);
        border-radius: 6px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        animation: slideFadeIn 0.5s ease-in-out;
    }

    @keyframes slideFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


</head>
<body>

@if (!in_array(Route::currentRouteName(), ['login', 'register']))
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Yayasan</h4>
        <a href="/dashboard">🏠 Dashboard</a>
        <a href="{{ route('users.index') }}">👤 Kelola Akun</a>
        <a href="/donations">💰 Donasi</a>
        <a href="{{ route('donors.index') }}">👥 Donatur</a>
        <a href="/events">📅 Kegiatan</a>
        <a href="/settings">⚙️ Pengaturan</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Dashboard</a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('password.edit') }}">🔐 Ganti Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">🚪 Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
@else
    <div class="container mt-5">
@endif

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show flash-message" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show flash-message" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show flash-message" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>

@if (!in_array(Route::currentRouteName(), ['login', 'register']))
    </div>
@endif

<!-- Auto Dismiss Flash Message -->
<script>
    setTimeout(() => {
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(el => {
            el.classList.remove('show');
            el.classList.add('fade');
            setTimeout(() => el.remove(), 500);
        });
    }, 3000);
</script>

</body>
</html>
