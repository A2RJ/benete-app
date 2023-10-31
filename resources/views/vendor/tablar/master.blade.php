<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {{-- Custom Meta Tags --}}
    @yield('meta_tags')
    {{-- Title --}}
    <title>
        @yield('title_prefix', config('tablar.title_prefix', 'Benete APP'))
        @yield('title', config('tablar.title', 'Benete APP'))
        @yield('title_postfix', config('tablar.title_postfix', 'Benete APP'))
    </title>
    <title>Dashboard</title>
    <!-- CSS files -->
    @if(config('tablar','vite'))
    @vite('resources/js/app.js')
    @endif
    {{-- Custom Stylesheets (post Benete APP) --}}
    @yield('tablar_css')
    <link rel="stylesheet" href="{{ asset('build/assets/app-4d40cf75.css') }}">
    <script src="{{ asset('build/assets/app-02a8c15b.js') }}"></script>
</head>

<body class="@yield('classes_body')" @yield('body_data')>
    @yield('body')
    @include('tablar::extra.modal')
    @yield('tablar_js')
</body>

</html>