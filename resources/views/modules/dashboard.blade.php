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










<!-- Customer Summary -->





<div class="overflow-x-auto table-pretty-scrollbar">
    <div class="flex gap-6 p-6 mt-1 min-w-max">
        <!-- Total Inventory Value -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Total Inventory Value</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-blue-500">₱64,222.00</h2>
        <p class="mt-1 text-sm text-red-500">▼ 2.4% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Customers with Credit -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Low Stock</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-red-500">47</h2>
        <p class="mt-1 text-sm text-green-500">▲ 6.3% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Due This Week -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Incoming Deliveries</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-purple-700">39</h2>
        <p class="mt-1 text-sm text-gray-400">Today</p>
        </div>

        <!-- Total Receivables -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Active Employees</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-green-500">12</h2>
        <p class="mt-1 text-sm text-gray-400">Present Today</p>
        </div>
    </div>
</div>









<div class="flex justify-center mb-20 space-x-5 overflow-x-auto table-pretty-scrollbar">
    <!-- Pie Chart -->
    <div class="w-64 p-4 p-5 bg-white shadow-md rounded-2xl">
        <h3 class="mb-3 text-sm font-semibold text-gray-700">Inventory Values</h3>

        <div class="flex items-center justify-center">
            <!-- Pie Chart -->
            <div class="relative w-24 h-24 rounded-full"
                style="background: conic-gradient(#1e3a8a 0% 68%, #cbd5e1 68% 100%);">
                <!-- Percent Labels -->
                <span class="absolute text-xs font-semibold text-white bottom-[25%] right-[30%]">68%</span>
                <span class="absolute text-xs font-semibold text-gray-800 top-[25%] left-[20%]">32%</span>
            </div>

            <!-- Legend -->
            <div class="ml-6 space-y-2 text-sm">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 rounded bg-slate-300"></div>
                    <span class="text-gray-600">Sold units</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-blue-900 rounded"></div>
                    <span class="text-gray-600">Total units</span>
                </div>
            </div>
        </div>

        <p class="mt-5 text-sm text-gray-500">This shows that 32% of the total units have been sold, leaving 68% of the units still available.</p>
    </div>

    <!-- Graph -->
    <div class="p-4 w-[500px] bg-white shadow-md rounded-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700">Sale VS Profit</h3>
            <span class="text-xs text-gray-500">Last 6 months</span>
        </div>

        <!-- Chart -->
        <div class="relative w-full h-48">
            <svg viewBox="0 0 500 200" class="w-full h-full">
                <!-- Grid Lines -->
                <g stroke="#e5e7eb" stroke-width="1">
                    <line x1="0" y1="40" x2="500" y2="40" />
                    <line x1="0" y1="80" x2="500" y2="80" />
                    <line x1="0" y1="120" x2="500" y2="120" />
                    <line x1="0" y1="160" x2="500" y2="160" />
                </g>

                <!-- Profit Line (blue) -->
                <path d="M 0 130 Q 80 100, 160 120 T 320 90 T 500 70" 
                    fill="none" stroke="#1e40af" stroke-width="2"/>
                <circle cx="500" cy="70" r="4" fill="#1e40af"/>
                
                <!-- Expense Line (red/orange) -->
                <path d="M 0 120 Q 80 140, 160 110 T 320 100 T 500 120" 
                    fill="none" stroke="#f97316" stroke-width="2"/>
                <circle cx="320" cy="100" r="4" fill="#f97316"/>

                <!-- Labels -->
                <text x="330" y="95" font-size="10" fill="#f97316" class="font-semibold">Highest Sale</text>
                <text x="430" y="90" font-size="10" fill="#1e40af" class="font-semibold">Highest Profit</text>
            </svg>

            <!-- Y-axis labels -->
            <div class="absolute top-0 left-0 flex flex-col justify-between h-full text-xs text-gray-500">
                <span>40k</span>
                <span>30k</span>
                <span>20k</span>
                <span>10k</span>
            </div>

            <!-- X-axis labels -->
            <div class="absolute bottom-0 flex justify-between text-xs text-gray-500 left-10 right-10">
                <span>Dec</span>
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>May</span>
                <span>Jun</span>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="p-3 bg-white rounded-lg shadow-md">
        <div class="flex flex-col space-y-5">
            <button class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-box"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                <i class="fa-solid fa-truck"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-purple-600 rounded-md hover:bg-purple-700">
                <i class="fa-solid fa-receipt"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-orange-600 rounded-md hover:bg-orange-700">
                <i class="fa-solid fa-user-plus"></i>
            </button>
        </div>
    </div>


</div>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
    © 2025 CKC Systems. All rights reserved.
</footer>