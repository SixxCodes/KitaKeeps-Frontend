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
        <!-- Take Attendance -->
        <div class="flex items-center space-x-4">
            <button class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-file-pen"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Take Attendance (SUN)</span>
            </button>
        </div>

        <!-- Export -->
        <div class="flex items-center space-x-4">
            <button class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-download"></i>
                <span class="hidden ml-2 lg:inline">Export</span>
            </button>
        </div>

        <!-- Add Employee -->
        <div class="flex items-center space-x-4">
            <button class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-user-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Employee</span>
            </button>
        </div>
    </div>
</div>










<!-- ==================== ATTENDANCE ==================== -->





<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">Attendance</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow">
    <!-- Search + Entries -->
    <div class="flex items-center justify-between mb-4 whitespace-nowrap">
        <div>
            <label class="mr-2 text-sm text-ellipsis sm:text-base">Show</label>
            <select class="px-2 py-1 text-sm border rounded text-ellipsis sm:text-base">
                <option v-for="num in [5, 10, 25, 50]">1</option>
            </select>
            <span class="mr-5 text-sm text-ellipsis sm:text-base">entries</span>
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
                    <th class="px-3 py-2 text-left border">Employee Name</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Daily Rate</th>
                    <th class="px-3 py-2 text-left border">Mon</th>
                    <th class="px-3 py-2 text-left border">Tue</th>
                    <th class="px-3 py-2 text-left border">Wed</th>
                    <th class="px-3 py-2 text-left border">Thu</th>
                    <th class="px-3 py-2 text-left border">Sat</th>
                    <th class="px-3 py-2 text-left border">Sun</th>
                    <th class="px-3 py-2 text-left border">Total Salary</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee Rows -->
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2 border">1</td>

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

                    <td class="px-3 py-2 border">400</td>

                    <td class="px-3 py-2 text-center border">
                        <i class="text-green-500 fa-solid fa-circle-check"></i>
                    </td>

                    <td class="px-3 py-2 text-center border">
                        <i class="text-red-500 fa-solid fa-circle-xmark"></i>
                    </td>

                    <td class="px-3 py-2 text-center border">
                        <i class="text-green-500 fa-solid fa-circle-check"></i>
                    </td>
                    
                    <td class="px-3 py-2 text-center border">
                        <i class="text-green-500 fa-solid fa-circle-check"></i>
                    </td>

                    <td class="px-3 py-2 text-center border">
                        <i class="text-red-500 fa-solid fa-circle-xmark"></i>
                    </td>

                    <td class="px-3 py-2 text-center border">
                        <i class="text-gray-400 fa-solid fa-minus"></i>
                    </td>

                    <td class="px-3 py-2 text-right border whitespace-nowrap">
                        P1200
                        <button class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-money-bill"></i>
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










<!-- ==================== All Employees ==================== -->





<h3 class="mt-5 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Employees</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow pb-50">
    <!-- Search + Entries -->
    <div class="flex items-center justify-between mb-4 whitespace-nowrap">
        <div>
            <label class="mr-2 text-sm text-ellipsis sm:text-base">Show</label>
            <select class="px-2 py-1 text-sm border rounded text-ellipsis sm:text-base">
                <option v-for="num in [5, 10, 25, 50]">1</option>
            </select>
            <span class="mr-5 text-sm text-ellipsis sm:text-base">entries</span>
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
                    <th class="px-3 py-2 text-left border">Employee Name</th>
                    <th class="px-3 py-2 text-left border">Email</th>
                    <th class="px-3 py-2 text-left border">Username</th>
                    <th class="px-3 py-2 text-left border">Role</th>
                    <th class="px-3 py-2 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee Rows -->
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2 border">1</td>

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

                    <td class="px-3 py-2 border">zk@gmail.com</td>

                    <td class="px-3 py-2 border">zkpantyers</td>

                    <td class="px-3 py-2 border">
                        <span class="inline-block px-3 py-1 text-xs text-white bg-orange-400 rounded-full">
                            Cashier
                        </span>
                    </td>

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







