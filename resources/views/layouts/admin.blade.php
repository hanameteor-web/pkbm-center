<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKBM Center</title>

    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css') }}">
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('partials.sidebar')

    <main class="main-content position-relative border-radius-lg">

        @include('partials.navbar')

        <div class="container-fluid py-4">
            @if(session('success'))

                <div style="
                background:#2dce89;
                color:white;
                padding:15px;
                border-radius:10px;
                margin-bottom:20px;
                font-weight:bold;
                ">
                    {{ session('success') }}
                </div>

                @endif
            @yield('content')
        </div>

    </main>

    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>

</body>

</html>