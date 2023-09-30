<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/dashboard/assets/css/main/app.css">
    <link rel="stylesheet" href="/dashboard/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/icon.png" type="image/png">
    <link rel="stylesheet" href="/dashboard/assets/css/shared/iconly.css">
    <title>@yield('title') | Bouquet Satgaz</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid" style="z-index: 999;background: #f8f9fa;border-radius: 5px;">
        <a href="#" class="navbar-brand">
            <img src="/icon.png" height="28" alt="Bouquet Satgaz">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="{{route('home')}}" class="nav-item nav-link active">Beranda</a>
                <a href="{{route('index-bouquet-custom')}}" class="nav-item nav-link">Bouquet Custom</a>
                <a href="{{route('index-cart')}}" class="nav-item nav-link">Keranjang</a>
                <a href="{{route('index-order')}}" class="nav-item nav-link">Pesanan</a>
                <a href="{{route('index-notifikasi')}}" class="nav-item nav-link">Pemberitahuan</a>
            </div>
            <div class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </div>
        </div>
    </div>
</nav>
<div class="app">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>
<script src="/dashboard/assets/js/bootstrap.js"></script>
<script src="/dashboard/assets/js/app.js"></script>
</body>
</html>
