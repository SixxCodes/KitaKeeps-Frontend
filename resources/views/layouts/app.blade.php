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
    <div id="sidebar-app" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div id="sidebar" 
            :class="[
                'w-64 overflow-x-hidden overflow-y-auto text-white bg-gray-900 hover-scroll transition-transform duration-300',
                { 
                    '-translate-x-full fixed md:static top-0 left-0 z-40 h-full md:h-screen': !isSidebarOpen && isMobile,
                    'fixed md:static top-0 left-0 z-40 h-full md:h-screen': isSidebarOpen && isMobile
                }
            ]">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 h-screen overflow-x-hidden">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Page Content -->
            <main class="w-screen h-screen mx-10 my-6">
                <!-- HOME Section-->
                <div v-if="currentPage === 'Dashboard'">
                    <h2>Hardware Name</h2>  
                </div>
                <div v-else-if="currentPage === 'POS'">
                    <h2>POS</h2>
                </div>

                <!-- BUSINESS INTELLIGENCE Section -->
                <div v-else-if="currentPage === 'Reports &amp; Analytics'">
                    <h2>Reports &amp; Analytics</h2>
                </div>

                <!-- MANAGEMENT Section -->
                <div v-else-if="currentPage === 'My Hardware'">
                    <h2>My Hardware</h2>
                </div>
                <div v-else-if="currentPage === 'My Inventory'">
                    <h2>My Inventory</h2>
                </div>
                <div v-else-if="currentPage === 'My Suppliers'">
                    <h2>My Suppliers</h2>
                </div>
                <div v-else-if="currentPage === 'My Employees'">
                    <h2>My Employees</h2>
                </div>
                <div v-else-if="currentPage === 'My Customers'">
                    <h2>My Customers</h2>
                </div>

                <!-- Bottom Button(s)-->
                <div v-else-if="currentPage === 'Settings'">
                    <h2>Settings</h2>
                </div>
            </main>
        </div>
    </div>
    </body>

</html>
