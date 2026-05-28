<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Periksa.id - Layanan Kesehatan Pintar</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body class="bg-[#F8FAFC]">

    <div>
        @if(!request()->routeIs('login') && !request()->routeIs('register'))
            @include('landing.layouts.navbar')
        @endif
        
        <main>
            @yield('content')
        </main>
    </div>

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        @include('landing.layouts.footer')
    @endif <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>