<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Periksa.id - Layanan Kesehatan Pintar</title>
    <meta name="title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
    <meta name="description" content="Periksa.id adalah platform medical checkup terintegrasi untuk menemukan dokter, melakukan konsultasi kesehatan, cek gejala dengan AI, dan menemukan apotek terdekat secara mudah dan aman." />
    <meta name="keywords" content="medical checkup, konsultasi dokter online, cek gejala AI, apotek terdekat, rumah sakit terdekat, kesehatan digital, platform kesehatan Indonesia, telemedicine" />
    <meta name="author" content="Periksa.id" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="#" />
    <meta property="og:title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
    <meta property="og:description" content="Periksa.id adalah platform medical checkup terintegrasi untuk menemukan dokter, melakukan konsultasi kesehatan, cek gejala dengan AI, dan menemukan apotek terdekat secara mudah dan aman." />
    <meta property="og:image" content="#" />
    <meta property="og:image:alt" content="Periksa.id Logo" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="#" />
    <meta property="twitter:title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
    <meta property="twitter:description" content="Platform kesehatan digital terintegrasi dengan AI gejala, konsultasi dokter, dan pencarian apotek & rumah sakit terdekat." />
    <meta property="twitter:image" content="#" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="#" />
    <link rel="shortcut icon" href="#" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC]">

    @include('components.loader')

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
    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/js/aos-init.js') }}"></script>
</body>
</html>
