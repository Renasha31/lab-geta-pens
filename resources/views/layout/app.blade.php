
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title', 'GETA Laboratorium')</title>

    <style>
        .research-detail {
            font-family: sans-serif;
            scrollbar-gutter: stable;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1050;
            background: white;
            min-height: 90px;
            padding: 10px 70px;
            border-bottom: 1px solid #e5e5e5;
            transition: box-shadow 0.4s ease;
        }

        .navbar .brand {
            transition: box-shadow 0.4s ease;
        }

        .navbar .brand h2 {
            color: #2F6B3C !important;
        }

        .navbar .brand p {
            color: #68736c;
        }

        .navbar.navbar-small {
            min-height: 60px;
            padding: 5px 70px !important;
            box-shadow: 0 2px 10px rgba(47, 107, 60, 0.10);
        }

        .navbar.navbar-small .brand {
            display: none;
        }

        /* Hilangkan background hover saat navbar mengecil */
        .navbar.navbar-small .navbar-nav .nav-link:hover,
        .navbar.navbar-small .navbar-nav .nav-link:active {
            background-color: transparent !important;
            color: #2F6B3C !important;
        }

        @media (min-width: 992px) {
            .navbar.navbar-small .container-fluid {
                display: block;
                padding: 0;
            }

            .navbar.navbar-small .navbar-collapse {
                width: 100%;
            }

            .navbar.navbar-small .navbar-nav {
                display: flex;
                flex-direction: row;
                width: 100%;
                margin: 0 !important;
            }

            .navbar.navbar-small .navbar-nav li {
                flex: 1;
                text-align: center;
            }

            .navbar.navbar-small .navbar-nav .nav-link {
                padding: 18px 10px;
                border-radius: 0 !important;
            }
        }

        @media (max-width: 991px) {
            .navbar {
                padding: 10px 20px;
            }

            .navbar.navbar-small {
                padding: 5px 20px !important;
            }

            .navbar-nav .nav-link {
                padding: 14px 10px;
                border-bottom: 1px solid #e4ece2;
            }
        }

        .navbar-nav .nav-link {
            transition: 0.2s;
        }

        .navbar-toggler {
            border-color: #c8dcc4;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(74, 148, 62, 0.15);
        }

        .page-heading {
            background: linear-gradient(135deg, #4A943E, #76C457);
            color: white;
            text-align: center;
            padding: 25px;
            width: 100%;
        }

        .page-heading h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }

        .breadcrumb-area {
            padding: 5px 80px;
            border-bottom: 1px solid #eee;
            display: flex;
            gap: 5px;
            font-size: 12px;
        }

        .breadcrumb-area a {
            color: #4A943E;
            text-decoration: none;
        }

        .breadcrumb-area a:hover {
            color: #2F6B3C;
        }

        @media (max-width: 576px) {
            .breadcrumb-area {
                padding: 8px 20px;
            }

            .page-heading {
                padding: 20px;
            }

            .page-heading h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body class="research-detail">

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <div class="brand">
                <a href="/" style="text-decoration: none">
                    <h2 style="font-size: 30px; font-weight: bold; letter-spacing: 2px; margin: 0;"
                        class="mt-2">
                        GETA LAB
                    </h2>
                </a>
                <p style="font-size: 15px; margin-bottom: 0;">
                    Green Energy, Transportation, And Application Laboratory
                </p>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu" style="font-size: 13px; color: #333;">
                <ul class="navbar-nav ms-auto gap-lg-1 fw-bold">

                    <li>
                        <a href="/akses" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';"
                            onmousedown="this.style.backgroundColor='#4A943E'; this.style.color='white';">
                            {{ __('Access') }}
                        </a>
                    </li>

                    @if (session()->has('key'))
                        <li>
                            <a href="/penelitian" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Researches') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/depanp" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Researches') }}
                            </a>
                        </li>
                    @endif

                    @if (session()->has('key'))
                        <li>
                            <a href="/anggota" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Member') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/adepan" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Member') }}
                            </a>
                        </li>
                    @endif

                    @if (session()->has('key'))
                        <li>
                            <a href="/berita" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Berita') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/depanb" class="nav-link px-3 rounded-pill" style="transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                                {{ __('Berita') }}
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="/info" class="nav-link px-3 rounded-pill text-nowrap" style="transition: 0.2s;"
                            onmouseover="this.style.backgroundColor='#EDF7E9'; this.style.color='#2F6B3C';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#333';">
                            {{ __('Lab Information') }}
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    @if (View::hasSection('page-title'))
        <div class="page-heading">
            <h2>@yield('page-title')</h2>
        </div>
    @endif

    <div class="breadcrumb-area">
        <p style="margin: 0">
            <i class="bi bi-house-fill" style="color: #4A943E;"></i>
            <a href="/">RUMAH /</a>
        </p>

        <p style="margin: 0">
            @if (session()->has('key'))
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="color: #2F6B3C; text-decoration: none; background: none; border: none; padding: 0; cursor: pointer;">
                        LOGOUT
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color: #2F6B3C;">LOGIN</a>
            @endif
        </p>
    </div>

    <div class="container">
        @yield('top-content')

        @if (request()->is('penelitian*', 'anggota*', 'berita', 'berita/*', 'login'))
            @yield('content')
        @else
            <div class="row">
                <div class="col-lg-8">
                    @yield('content')
                </div>

                <div class="col-lg-4 mt-3">
                    @include('sidebar')
                </div>
            </div>
        @endif
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        const navbar = document.querySelector('.navbar');
        let navbarKecil = false;

        window.addEventListener('scroll', function () {
            const posisi = window.scrollY;

            if (!navbarKecil && posisi > 150) {
                navbar.classList.add('navbar-small');
                navbarKecil = true;
            } else if (navbarKecil && posisi < 50) {
                navbar.classList.remove('navbar-small');
                navbarKecil = false;
            }
        });
    </script>

</body>

</html>
