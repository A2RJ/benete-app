<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- CSS files -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('build/assets/app-4d40cf75.css') }}">
    <script src="{{ asset('build/assets/app-02a8c15b.js') }}"></script>
</head>

<body class=" border-top-wide border-primary d-flex flex-column" style="background-color: #38348b;">
    <div class="page page-center">
        @yield('content')
    </div>
</body>

</html>