<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{--    @include('components.share.menu-main')--}}

        <x-share.menu-main/>
        <x-alerts.alert-header/>

        <!-- Page Content -->
        @yield('content')

        <x-share.footer-main/>

    </div>
    @stack('scripts')

</body>
</html>
