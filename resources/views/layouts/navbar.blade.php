<nav class="flex items-center justify-between px-6 py-4 bg-white shadow">
    <!-- Module Title -->
    <div class="flex items-center space-x-4">
        <!-- Hamburger button (hidden on desktop, shown on mobile/tablet) -->
        <button 
            id="sidebarToggle" 
            class="text-gray-600 focus:outline-none md:hidden"
        >
            <!-- Hamburger icon -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h1 class="text-xl text-gray-800">
            {{ $pageTitle ?? 'Dashboard' }}
        </h1>
    </div>

    <!-- User Dropdown / Icon -->
    <div class="flex items-center space-x-4">
        <span class="text-gray-600">User Name</span>
    </div>
</nav>
