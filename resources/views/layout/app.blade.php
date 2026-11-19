<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title', 'GETA Laboratorium')</title>
</head>
<style>
    .research-detail {
        font-family: sans-serif;
    }

    @media (max-width: 991px) {
        .navbar-nav .nav-link {
            padding: 14px 10px;
            border-bottom: 1px solid #ddd;
        }
    }

</style>

<body class="research-detail">
    <nav class="navbar navbar-expand-lg"
        style="width: 100%; min-height: 90px; padding: 10px 70px; background-color: white; border-bottom: 1px solid #e5e5e5;">
        <div class="container-fluid">
            <div>
                <a href="/" style="text-decoration: none">
                    <h2 style="font-size: 30px; font-weight: bold; color: #222; letter-spacing: 2px; margin: 0;"
                        class="mt-2">
                        GETA LAB
                    </h2>
                </a>
                <p style="font-size: 15px">Green Energy, Transportation, And Application Laboratory</p>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
            aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu" style="font-size: 13px; color: #333 ;">
            <ul class="navbar-nav ms-auto gap-lg-1 fw-bold">
                <li>
                    <a href="/akses" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                        onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                        onmousedown="this.style.backgroundColor='#4298d5';">
                        {{ __('Access') }}
                    </a>
                </li>

                @if (session()->has('key'))
                    <li>
                        <a href="/penelitian" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Researches') }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="/depanp" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Researches') }}
                        </a>
                    </li>
                @endif

                @if (session()->has('key'))
                    <li>
                        <a href="/anggota" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Member') }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="/adepan" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Member') }}
                        </a>
                    </li>
                @endif

                @if (session()->has('key'))
                    <li>
                        <a href="/berita" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Berita') }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="/depanb" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4298d5';">
                            {{ __('Berita') }}
                        </a>
                    </li>
                @endif

                <li>
                    <a href="/info" class="nav-link px-3 rounded-pill text-nowrap" style="transition: 0.2s;"
                        onmouseover="this.style.backgroundColor='#6bb5e8'; this.style.color='#08345c';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                        onmousedown="this.style.backgroundColor='#4298d5';">
                        {{ __('Lab Information') }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    @if (View::hasSection('page-title'))
        <div style="background-color: #367fb5; color: white; text-align: center; padding: 25px; width: 100%;">
            <h2>@yield('page-title')</h2>
        </div>
    @endif

    <div style="padding: 5px 80px; border-bottom: 1px solid #eee; display: flex; gap: 5px; font-size: 12px;">
        <p style="margin: 0">
            <i class="bi bi-house-fill"></i>
            <a href="/" style="color: darkgray;text-decoration: none">RUMAH /</a>
        </p>

        <p style="margin: 0">
            @if (session()->has('key'))
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="color: #222; text-decoration: none; background: none; border: none; padding: 0; cursor: pointer;">
                        LOGOUT
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color: #222; text-decoration: none;">LOGIN</a>
            @endif
        </p>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
