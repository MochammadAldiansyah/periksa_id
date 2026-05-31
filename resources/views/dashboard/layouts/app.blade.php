<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>Periksa.id - Layanan Kesehatan Pintar</title>
  <meta name="title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
  <meta name="description" content="Periksa.id adalah platform medical checkup terintegrasi untuk menemukan dokter, melakukan konsultasi kesehatan, cek gejala dengan AI, dan menemukan apotek terdekat secara mudah dan aman." />
  <meta name="keywords" content="medical checkup, konsultasi dokter online, cek gejala AI, apotek terdekat, rumah sakit terdekat, kesehatan digital, platform kesehatan Indonesia, telemedicine" />
  <meta name="author" content="Periksa.id" />
  <meta name="robots" content="index, follow" />

  <!--Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="#" />
  <meta property="og:title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
  <meta property="og:description" content="Periksa.id adalah platform medical checkup terintegrasi untuk menemukan dokter, melakukan konsultasi kesehatan, cek gejala dengan AI, dan menemukan apotek terdekat secara mudah dan aman." />
  <meta property="og:image" content="#" />
  <meta property="og:image:alt" content="Periksa.id Logo" />
  <meta property="og:image:type" content="image/png" />

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="#" />
  <meta property="twitter:title" content="Periksa.id - Platform Medical Checkup Terpercaya & Terverifikasi" />
  <meta property="twitter:description" content="Platform kesehatan digital terintegrasi dengan AI gejala, konsultasi dokter, dan pencarian apotek & rumah sakit terdekat." />
  <meta property="twitter:image" content="#" />

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="#" />
  <link rel="shortcut icon" href="#" type="image/x-icon" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
         <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
         <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    </head>
    <body >

@auth
    @include('dashboard.layouts.sidebar')
@endauth

        <div>

            <!-- Page Content -->
            <main class="flex-1 lg:pl-64 pt-20 px-4 pb-6 md:p-8 w-full overflow-x-hidden">
                @yield('content')
            </main>
        </div>
    </body>
  @if(!request()->routeIs('login') && !request()->routeIs('register'))

    @include('dashboard.layouts.footer')
    @endif)
    <script src="{{ asset('assets/js/main.js') }}"></script>
</html>
