<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login PENS</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f8fc;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            min-height: 580px;
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px #19416417;
        }

        .branding {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #eaf4fc, #f5fbfa);
            text-align: center;
        }

        .brand-content {
            text-align: center;
        }

        .logo {
            width: 190px;
            height: 190px;
            object-fit: contain;
        }

        .tagline {
            color: #8298aa;
            font-size: 13px;
            letter-spacing: 2px;
            margin-top: 10px;
        }

        .login {
            width: 45%;
            padding: 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login h2 {
            color: #174879;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #8b9bad;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .login label {
            display: block;
            color: #355b7c;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .login input {
            width: 100%;
            height: 49px;
            padding: 0 15px;
            border: 1px solid #dce6ef;
            border-radius: 8px;
            outline: none;
            margin-bottom: 22px;
            background: #fbfdff;
        }

        .login input:focus {
            border-color: #35b9a5;
        }

        .login button {
            width: 100%;
            height: 50px;
            background: #174879;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: .3s;
        }

        .login button:hover {
            background: #2eaa9a;
        }

        .footer {
            color: #a0adba;
            text-align: center;
            font-size: 11px;
            margin-top: 35px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                margin: 25px 0;
            }

            .branding,
            .login {
                width: 100%;
            }

            .branding {
                padding: 40px 20px;
            }

            .login {
                padding: 35px 25px;
            }

            .logo {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="branding">
            <div class="brand-content">
                <img src="{{ asset('images/logo pens.png') }}" class="logo" alt="Logo PENS">

                <p class="tagline">BRIDGE TO THE FUTURE</p>
            </div>
        </div>

        <div class="login">
            <h2>Selamat Datang!</h2>
            <p class="subtitle">Silahkan login untuk mengelola data penelitian dan anggota.</p>

        @if (session('success'))
            <div style="background: #d1e7dd; color: #0f5132; padding: 13px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: #f8d7da; color: #842029; padding: 13px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background: #f8d7da; color: #842029; padding: 13px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                {{ $errors->first() }}
            </div>
        @endif


            <form action="{{ url('login') }}" method="POST">
                @csrf

                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}"
                    required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>

                <button type="submit">Login →</button>
            </form>

            <div class="footer">
                © Politeknik Elektronika Negeri Surabaya
            </div>
        </div>

    </div>
</body>

</html>
