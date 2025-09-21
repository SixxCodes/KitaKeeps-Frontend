<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <button><i class="fa-solid fa-caret-down"></i></button>
        </div>
        <span class="text-xs text-gray-600">Main Branch • Mabini, Davao de Oro</span> <!-- edit later and branch name sa name gyud sa hardware -->
    </div>
    
    <div class="flex space-x-3">
        <!-- Export -->
        <div class="flex items-center space-x-4">
            <button class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-download"></i>
                <span class="hidden ml-2 lg:inline">Export</span>
            </button>
        </div>

        <!-- Add Customer -->
        <div class="flex items-center space-x-4">
            <button class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-user-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Customer</span>
            </button>
        </div>
    </div>
</div>










<!-- Customer Summary -->





<div class="overflow-x-auto table-pretty-scrollbar">
    <div class="flex gap-6 p-6 mt-1 min-w-max">
        <!-- Customers with Credit -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Customers with Credit</span>
            <span class="text-gray-400 cursor-pointer">↗</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">47</h2>
        <p class="mt-1 text-sm text-green-500">▲ 6.3% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Due This Week -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Due This Week</span>
            <span class="text-gray-400 cursor-pointer">↗</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">39</h2>
        <p class="mt-1 text-sm text-green-500">▲ 12% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Total Receivables -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Total Receivables</span>
            <span class="text-gray-400 cursor-pointer">↗</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">₱64,222.00</h2>
        <p class="mt-1 text-sm text-red-500">▼ 2.4% <span class="text-gray-500">this week</span></p>
        </div>
    </div>
</div>










<!-- ALL CUSTOMERS w/ CREDIT -->





<h3 class="mt-2 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">Customer Credits</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow">
    <!-- Search + Entries -->
    <div class="flex items-center justify-between mb-4 whitespace-nowrap">
        <div>
            <label class="mr-2 text-sm text-ellipsis sm:text-base">Show</label>
            <select class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">
                <option>5</option>
            </select>
            <span class="ml-2 text-sm text-ellipsis sm:text-base">entries</span>
        </div>

        <!-- Search Bar --> 
        <div class="flex items-center space-x-2">
            <i class="text-blue-800 fa-solid fa-filter"></i>
            <div class="flex items-center px-2 py-1 border rounded w-25 sm:px-5 sm:py-1 md:px-3 md:py-2 sm:w-50 md:w-52">
                <i class="mr-2 text-blue-400 fa-solid fa-magnifying-glass"></i>
                <input
                    type="text" 
                    placeholder="Search..." 
                    class="w-full py-0 text-sm bg-transparent border-none outline-none sm:py-0 md:py-1"
                />
            </div>
        </div>
    </div>

    <div class="overflow-x-auto table-pretty-scrollbar">
        <!-- Table -->
        <table class="min-w-full text-sm border">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-3 py-2 text-left border">ID</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Customer Name</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Total Amount</th>
                    <th class="px-3 py-2 text-left border">Due Date</th>
                    <th class="px-3 py-2 text-left border">Sale Date</th>
                    <th class="px-3 py-2 text-left border">Status</th>
                    <th class="px-3 py-2 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee Rows -->
                <tr class="hover:bg-gray-50">
                    <!-- Customer ID -->
                    <td class="px-3 py-2 border">1</td>

                    <!-- Customer Profile and Name -->
                    <td class="px-3 py-2 border">
                        <div class="flex items-center gap-2">
                            <!-- Circle placeholder icon -->
                            <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-200 rounded-full">
                            <i class="fa-solid fa-user"></i>
                            </div>
                            <!-- Name -->
                            <span class="overflow-hidden whitespace-nowrap text-ellipsis">Zyrile Crisaucetomo</span>
                        </div>
                    </td>

                    <!-- Total Amount -->
                    <td class="px-3 py-2 border">P2005</td>

                    <!-- Due Date -->
                    <td class="px-3 py-2 border">
                        10-10-25
                    </td>

                    <!-- Sale Date -->
                    <td class="px-3 py-2 border">
                        9-29-25
                    </td>

                    <!-- Status -->
                    <td class="px-3 py-2 border">
                        <span class="inline-block px-3 py-1 text-xs text-white bg-yellow-500 rounded-full">
                            Pending
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-user-pen"></i>
                        </button>
                        <button class="px-2 py-1 text-white bg-red-500 rounded">
                            <i class="fa-solid fa-user-minus"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-4">
        <p class="text-sm text-ellipsis sm:text-base">Showing 1 to 5 of 100 entries</p>
        <div class="flex gap-2">
        <button class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">Previous</button>
        <button class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">Next</button>
        </div>
    </div>
    
</div>









<!-- ALL CUSTOMERS -->





<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Customers</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow">
    <!-- Search + Entries -->
    <div class="flex items-center justify-between mb-4 whitespace-nowrap">
        <div>
            <label class="mr-2 text-sm text-ellipsis sm:text-base">Show</label>
            <select class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">
                <option>5</option>
            </select>
            <span class="ml-2 text-sm text-ellipsis sm:text-base">entries</span>
        </div>

        <!-- Search Bar --> 
        <div class="flex items-center space-x-2">
            <i class="text-blue-800 fa-solid fa-filter"></i>
            <div class="flex items-center px-2 py-1 border rounded w-25 sm:px-5 sm:py-1 md:px-3 md:py-2 sm:w-50 md:w-52">
                <i class="mr-2 text-blue-400 fa-solid fa-magnifying-glass"></i>
                <input
                    type="text" 
                    placeholder="Search..." 
                    class="w-full py-0 text-sm bg-transparent border-none outline-none sm:py-0 md:py-1"
                />
            </div>
        </div>
    </div>

    <div class="overflow-x-auto table-pretty-scrollbar">
        <!-- Table -->
        <table class="min-w-full text-sm border">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-3 py-2 text-left border">ID</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Customer Name</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Contact Number</th>
                    <th class="px-3 py-2 text-left border">Address</th>
                    <th class="px-3 py-2 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee Rows -->
                <tr class="hover:bg-gray-50">
                    <!-- Customer ID -->
                    <td class="px-3 py-2 border">1</td>

                    <!-- Customer Profile and Name -->
                    <td class="px-3 py-2 border">
                        <div class="flex items-center gap-2">
                            <!-- Circle placeholder icon -->
                            <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-200 rounded-full">
                            <i class="fa-solid fa-user"></i>
                            </div>
                            <!-- Name -->
                            <span class="overflow-hidden whitespace-nowrap text-ellipsis">Zyrile Crisaucetomo</span>
                        </div>
                    </td>

                    <!-- Contact Number -->
                    <td class="px-3 py-2 border">0926 281 1138</td>

                    <!-- Customer Address -->
                    <td class="px-3 py-2 border">
                        Prk.Makugihon, Brgy. Cuambog, Mabini, Davao de Oro
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-user-pen"></i>
                        </button>
                        <button class="px-2 py-1 text-white bg-red-500 rounded">
                            <i class="fa-solid fa-user-minus"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-4">
        <p class="text-sm text-ellipsis sm:text-base">Showing 1 to 5 of 100 entries</p>
        <div class="flex gap-2">
        <button class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">Previous</button>
        <button class="px-3 py-1 text-sm border rounded text-ellipsis sm:text-base">Next</button>
        </div>
    </div>
    
</div>