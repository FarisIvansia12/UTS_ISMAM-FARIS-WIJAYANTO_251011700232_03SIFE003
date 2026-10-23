<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Portal resep masakan Nusantara: resep lengkap dengan bahan, langkah, dan waktu memasak.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Bootstrap/icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
