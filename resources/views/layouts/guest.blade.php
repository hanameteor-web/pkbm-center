<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- JUDUL TAB --}}
    <title>PKBM Center</title>

    {{-- ICON TAB --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/tutwuri.png') }}"
    >

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    {{-- FONT AWESOME --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }

        /* =========================================
           BACKGROUND
        ========================================= */

        .login-page {

            min-height: 100vh;

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            position: relative;

            padding: 20px;

            overflow: hidden;

            background-image:
                linear-gradient(
                    rgba(40, 75, 160, 0.48),
                    rgba(25, 45, 100, 0.55)
                ),
                url('{{ asset('images/login-bg.jpg') }}');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;
        }


        /* =========================================
           OVERLAY BIRU
        ========================================= */

        .login-page::before {

            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    135deg,
                    rgba(94, 114, 228, 0.18),
                    rgba(23, 43, 77, 0.28)
                );

            pointer-events: none;
        }


        /* =========================================
           CONTAINER
        ========================================= */

        .login-container {

            position: relative;

            z-index: 2;

            width: 100%;

            max-width: 360px;
        }


        /* =========================================
           LOGIN CARD
        ========================================= */

        .login-card {

            width: 100%;

            background: rgba(255, 255, 255, 0.98);

            padding: 26px 28px 24px;

            border-radius: 12px;

            box-shadow:
                0 18px 45px rgba(23, 43, 77, 0.35);

            border: 1px solid rgba(255, 255, 255, 0.9);
        }


        /* =========================================
           LOGO
        ========================================= */

        .login-logo {

            text-align: center;

            margin-bottom: 15px;
        }


        .logo-circle {

            width: 68px;

            height: 68px;

            margin: 0 auto 8px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;

            border: 1px solid #e6e9f0;

            box-shadow:
                0 4px 12px rgba(23, 43, 77, 0.12);
        }


        .logo-circle img {

            width: 56px;

            height: 56px;

            object-fit: contain;
        }


        /* =========================================
           JUDUL PKBM
        ========================================= */

        .login-title {

            margin: 0;

            color: #172b4d;

            font-size: 23px;

            font-weight: 700;

            letter-spacing: 0.2px;
        }


        .login-subtitle {

            margin: 3px 0 0;

            color: #8898aa;

            font-size: 11px;
        }


        /* =========================================
           JUDUL LOGIN
        ========================================= */

        .login-heading {

            text-align: center;

            color: #172b4d;

            font-size: 18px;

            font-weight: 700;

            margin: 12px 0 7px;
        }


        .login-line {

            height: 3px;

            width: 50px;

            margin: 0 auto 18px;

            border-radius: 20px;

            background: #5e72e4;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {

            margin-bottom: 15px;
        }


        .form-label {

            display: block;

            margin-bottom: 6px;

            color: #344563;

            font-size: 12px;

            font-weight: 600;
        }


        .input-wrapper {

            position: relative;

            width: 100%;
        }


        /* =========================================
           ICON INPUT
        ========================================= */

        .input-icon {

            position: absolute;

            left: 12px;

            top: 50%;

            transform: translateY(-50%);

            color: #5e72e4;

            font-size: 12px;

            pointer-events: none;
        }


        /* =========================================
           INPUT
        ========================================= */

        .login-input {

            width: 100%;

            height: 39px;

            padding: 8px 10px 8px 34px;

            color: #172b4d;

            background: #ffffff;

            border: 1px solid #dfe3e8;

            border-radius: 7px;

            outline: none;

            font-family: inherit;

            font-size: 12px;

            transition: 0.2s;
        }


        .login-input::placeholder {

            color: #a0aec0;
        }


        .login-input:focus {

            border-color: #5e72e4;

            box-shadow:
                0 0 0 3px rgba(94, 114, 228, 0.12);
        }


        /* =========================================
           ERROR
        ========================================= */

        .form-error {

            margin-top: 5px;

            color: #f5365c;

            font-size: 10px;
        }


        /* =========================================
           REMEMBER ME
        ========================================= */

        .remember-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin: 3px 0 17px;
        }


        .remember-left {

            display: flex;

            align-items: center;
        }


        .remember-checkbox {

            width: 13px;

            height: 13px;

            margin: 0 6px 0 0;

            accent-color: #5e72e4;

            cursor: pointer;
        }


        .remember-label {

            color: #6b778c;

            font-size: 10px;

            cursor: pointer;
        }


        /* =========================================
           LUPA PASSWORD
        ========================================= */

        .forgot-link {

            color: #5e72e4;

            text-decoration: none;

            font-size: 10px;
        }


        .forgot-link:hover {

            color: #324cdd;

            text-decoration: underline;
        }


        /* =========================================
           BUTTON MASUK
        ========================================= */

        .login-button {

            width: 100%;

            height: 39px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            border: none;

            border-radius: 20px;

            color: #ffffff;

            background: #5e72e4;

            box-shadow:
                0 5px 12px rgba(94, 114, 228, 0.25);

            font-family: inherit;

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }


        .login-button:hover {

            background: #324cdd;

            transform: translateY(-1px);

            box-shadow:
                0 7px 16px rgba(94, 114, 228, 0.30);
        }


        .login-button:active {

            transform: translateY(0);
        }


        /* =========================================
           FOOTER
        ========================================= */

        .login-footer {

            margin-top: 12px;

            text-align: center;

            color: rgba(255, 255, 255, 0.90);

            font-size: 10px;

            text-shadow:
                0 1px 3px rgba(0, 0, 0, 0.35);
        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 480px) {

            .login-page {

                padding: 18px;
            }


            .login-container {

                max-width: 340px;
            }


            .login-card {

                padding: 24px 21px 22px;
            }


            .login-title {

                font-size: 21px;
            }
        }

    </style>

</head>


<body>

    <div class="login-page">

        <div class="login-container">

            {{-- =================================
                 LOGIN CARD
            ================================== --}}

            <div class="login-card">

                {{-- LOGO TUT WURI --}}

                <div class="login-logo">

                    <div class="logo-circle">

                        <img
                            src="{{ asset('images/tutwuri.png') }}"
                            alt="Tut Wuri Handayani"
                        >

                    </div>

                    <h1 class="login-title">
                        PKBM Center
                    </h1>

                    <p class="login-subtitle">
                        Sistem Informasi PKBM
                    </p>

                </div>


                {{-- JUDUL LOGIN --}}

                <h2 class="login-heading">
                    LOGIN
                </h2>


                <div class="login-line"></div>


                {{-- FORM LOGIN --}}

                @yield('content')

            </div>


            {{-- FOOTER --}}

            <div class="login-footer">
                © {{ date('Y') }} PKBM Center
            </div>

        </div>

    </div>

</body>

</html>