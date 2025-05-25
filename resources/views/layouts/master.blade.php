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
        left: 270px;
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

    @stack('styles')
</head>

<body>
@php
    $currentRoute = Route::currentRouteName();
@endphp

@if (!in_array($currentRoute, ['login', 'register']))
    @include('layouts.sidebar') <!-- ✅ Sidebar include -->

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light mb-4">
            <div class="container-fluid">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ auth()->user()->name ?? 'User' }}
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

@if (!in_array($currentRoute, ['login', 'register']))
    </div> <!-- end div.content -->
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

@stack('scripts')
@yield('scripts')
</body>
</html>
