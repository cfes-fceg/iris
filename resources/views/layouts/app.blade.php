<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::disk('assets')->url('meta/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Storage::disk('assets')->url('/meta/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::disk('assets')->url('/meta/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Storage::disk('assets')->url('/meta/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ Storage::disk('assets')->url('/meta/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ Storage::disk('assets')->url('/meta/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="{{ Storage::disk('assets')->url('/meta/browserconfig.xml') }}">
    <meta name="theme-color" content="#005ea4">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <link rel="stylesheet" href=" {{ asset('css/style.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ config('app.analytics') }}');
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 flex flex-col justify-between">

@include('layouts.nav')

<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <div>
        @include('layouts.footer')
    </div>
</div>
{{ $bodyEnd ?? "" }}
</body>
</html>
