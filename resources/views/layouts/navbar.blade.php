<nav class="flex items-center justify-between px-6 py-4 bg-white shadow">
    <div class="flex items-center space-x-4">
        <!-- Hamburger (only visible on mobile/tablet) -->
        <button 
            @click="toggleSidebar"
            class="text-gray-600 focus:outline-none md:hidden"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h1 class="text-xl text-gray-800">
            {{ $pageTitle ?? 'Dashboard' }}
        </h1>
    </div>

    <div class="flex items-center space-x-4">
        <span class="text-gray-600">User Name</span>
    </div>
</nav>
