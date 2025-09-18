<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="assets/images/logo/logo-removebg-preview.png" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome’s icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div id="sidebar" 
            class="w-64 h-screen overflow-x-hidden overflow-y-auto text-white bg-gray-900 hover-scroll">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 h-screen overflow-y-auto">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
