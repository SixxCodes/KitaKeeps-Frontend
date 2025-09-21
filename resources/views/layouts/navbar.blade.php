<nav class="flex items-center justify-between px-6 py-3 bg-white shadow">
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

        <h1 class="text-xl text-gray-900">
            <!-- Page Icon -->
            <span class="text-blue-800" v-html="pageIcons[currentPage]"></span>

            <!-- Page Title -->
            <span class="text-[14px] sm:text-base md:text-lg lg:text-xl" v-if="currentPage">@{{ currentPage }}</span>
        </h1>
    </div>

    <div class="flex items-center mr-4 space-x-1">
        <!-- Bell Icon (always visible) -->
        <i class="mr-5 text-blue-800 fa-solid fa-bell"></i>

        <!-- User Icon (always visible) -->
        <button class="flex items-center justify-center w-8 h-8 text-white bg-blue-200 rounded-full">
            <i class="fa-solid fa-user"></i>
        </button>

        <!-- Username and Role (hidden on mobile) -->
        <div class="flex-col hidden sm:flex">
            <span class="text-sm text-black">{{ Auth::user()->username }}</span>
            <span class="text-xs text-gray-600">{{ Auth::user()->role }} at Branch Name</span>
        </div>

        <!-- Dropdown arrow (hidden on mobile) -->
        <i class="hidden text-gray-400 sm:inline fa-solid fa-angle-down"></i>
    </div>
</nav>
