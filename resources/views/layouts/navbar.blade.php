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
        <!-- <i class="mr-5 text-blue-800 fa-solid fa-bell"></i> -->

        <!-- User Icon (always visible) -->
        <button 
            x-data 
            x-on:click="$dispatch('open-modal', 'user-profile')" 
            class="flex items-center justify-center w-8 h-8 overflow-hidden border border-gray-200 rounded-full"
        >
            @if(Auth::user()->user_image_path)
                <img 
                    src="{{ asset('storage/' . Auth::user()->user_image_path) }}" 
                    alt="User photo" 
                    class="object-cover w-full h-full"
                >
            @else
                <!-- Fallback icon if no image -->
                <i class="flex items-center justify-center w-full h-full text-white bg-blue-200 fa-solid fa-user"></i>
            @endif
        </button>

        <!-- Username and Role (hidden on mobile) -->
        <div class="flex-col hidden sm:flex">
            <span class="text-sm text-black">{{ Auth::user()->username }}</span>
            <span class="text-xs text-gray-600">
                {{ Auth::user()->role }} at {{ Auth::user()->branches->first()->branch_name ?? 'No Branch' }}
            </span>
        </div>

        <!-- Dropdown arrow (hidden on mobile) -->
        <button x-data x-on:click="$dispatch('open-modal', 'user-profile')">
            <i class="hidden text-gray-400 sm:inline fa-solid fa-angle-down"></i>
        </button>
    </div>
</nav>

<!-- User Profile Modal -->
<x-modal name="user-profile" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-blue-900 dark:text-gray-100">Your Profile</h2>
            <button 
                type="button" 
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                x-on:click="$dispatch('close-modal', 'user-profile')"
            >
                <i class="text-lg fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Profile Image -->
        <div class="flex flex-col items-center mb-6">
            @if(Auth::user()->user_image_path)
                <img 
                    src="{{ asset(Auth::user()->user_image_path) }}" 
                    alt="User photo" 
                    class="object-cover w-24 h-24 border rounded-full shadow"
                >
            @else
                <!-- Fallback icon if no image -->
                <i class="flex items-center justify-center w-24 h-24 text-3xl text-white bg-blue-200 rounded-full fa-solid fa-user"></i>
            @endif
        </div>

        <!-- Username -->
        <div class="mb-4 text-center">
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Username</label>
            <p class="font-medium text-gray-800 dark:text-gray-100">{{ Auth::user()->username }}</p>
        </div>

        <!-- Role and Branch -->
        <div class="mb-4 text-center">
            <p class="text-gray-600 dark:text-gray-400">{{ ucfirst(Auth::user()->role) }}</p>
            <p class="text-gray-600 dark:text-gray-400">
                {{ Auth::user()->branches->pluck('branch_name')->join(', ') ?: 'No Branch' }}
            </p>
        </div>
    </div>
</x-modal>