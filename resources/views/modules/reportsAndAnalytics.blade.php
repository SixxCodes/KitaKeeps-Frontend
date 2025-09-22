<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <button><i class="fa-solid fa-caret-down"></i></button>
        </div>
        <span class="text-[10px] text-gray-600 sm:text-[10px] md:text-[10px] lg:text-xs">Main Branch • Mabini, Davao de Oro</span> <!-- edit later and branch name sa name gyud sa hardware -->
    </div>

    <!-- Top: Clock + Date -->
    <div class="flex items-end justify-end">
        <div class="flex flex-col items-end">
            <span id="clock" class="text-xl font-semibold text-blue-600">12:45:32</span>
            <span id="date" class="text-sm text-gray-500">September 22, 2025</span>
        </div>
    </div>
</div>







<div class="max-w-lg p-6 mx-auto mt-10 bg-white rounded-lg shadow">
    <h2 class="mb-6 text-xl font-semibold text-gray-700">Top 5 Products by Sales</h2>

    <!-- Chart Container -->
    <div class="space-y-4">

        <!-- Product 1 -->
        <div class="flex items-center space-x-4">
            <span class="w-24 text-gray-600">Product A</span>
            <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                <div class="h-6 bg-blue-600 rounded-full" style="width: 90%;"></div>
            </div>
            <span class="w-12 text-right text-gray-700">90</span>
        </div>

        <!-- Product 2 -->
        <div class="flex items-center space-x-4">
            <span class="w-24 text-gray-600">Product B</span>
            <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                <div class="h-6 bg-blue-600 rounded-full" style="width: 75%;"></div>
            </div>
            <span class="w-12 text-right text-gray-700">75</span>
        </div>

        <!-- Product 3 -->
        <div class="flex items-center space-x-4">
            <span class="w-24 text-gray-600">Product C</span>
            <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                <div class="h-6 bg-blue-600 rounded-full" style="width: 60%;"></div>
            </div>
            <span class="w-12 text-right text-gray-700">60</span>
        </div>

        <!-- Product 4 -->
        <div class="flex items-center space-x-4">
            <span class="w-24 text-gray-600">Product D</span>
            <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                <div class="h-6 bg-blue-600 rounded-full" style="width: 45%;"></div>
            </div>
            <span class="w-12 text-right text-gray-700">45</span>
        </div>

        <!-- Product 5 -->
        <div class="flex items-center space-x-4">
            <span class="w-24 text-gray-600">Product E</span>
            <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                <div class="h-6 bg-blue-600 rounded-full" style="width: 30%;"></div>
            </div>
            <span class="w-12 text-right text-gray-700">30</span>
        </div>

    </div>
</div>



<div class="max-w-md p-4 mx-auto mt-10 mb-20 bg-white rounded-lg shadow">
    <h2 class="mb-4 text-lg font-semibold">Top 5 Stores by Sales</h2>
    
    {{-- Store Item --}}
    <div class="space-y-3">
        {{-- Gateway str --}}
        <div>
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-gray-700">Gateway str</span>
                <span class="text-sm font-medium text-gray-700">87k</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="h-4 bg-blue-500 rounded-full" style="width: 100%;"></div>
            </div>
        </div>

        {{-- The Rustic Fox --}}
        <div>
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-gray-700">The Rustic Fox</span>
                <span class="text-sm font-medium text-gray-700">72k</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="h-4 bg-blue-500 rounded-full" style="width: 82.8%;"></div>
            </div>
        </div>

        {{-- Velvet Vine --}}
        <div>
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-gray-700">Velvet Vine</span>
                <span class="text-sm font-medium text-gray-700">59k</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="h-4 bg-blue-500 rounded-full" style="width: 67.8%;"></div>
            </div>
        </div>

        {{-- Blue Harbor --}}
        <div>
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-gray-700">Blue Harbor</span>
                <span class="text-sm font-medium text-gray-700">50k</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="h-4 bg-blue-500 rounded-full" style="width: 57.5%;"></div>
            </div>
        </div>

        {{-- Nebula Novelties --}}
        <div>
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-gray-700">Nebula Novelties</span>
                <span class="text-sm font-medium text-gray-700">39k</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="h-4 bg-blue-500 rounded-full" style="width: 44.8%;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
    © 2025 CKC Systems. All rights reserved.
</footer>