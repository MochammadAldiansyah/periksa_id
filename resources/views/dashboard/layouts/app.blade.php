<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
         <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
         <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    </head>
    <body >
    
    @include('components.loader')

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
