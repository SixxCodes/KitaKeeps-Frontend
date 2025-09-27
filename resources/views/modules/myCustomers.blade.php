<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">
                {{ $currentBranch->branch_name ?? 'No Branch' }}
            </h2>
            
            <!-- Caret Button to Open Modal -->
            <!-- <button x-on:click="$dispatch('open-modal', 'switch-branch')" 
                class="text-gray-600 hover:text-black">
                <i class="fa-solid fa-caret-down"></i>
            </button> -->
        </div>

        <span class="text-[10px] text-gray-600 sm:text-[10px] md:text-[10px] lg:text-xs">
            {{ $currentBranch->branch_id == $mainBranch->branch_id ? 'Main Branch' : 'Branch' }} • 
            {{ $currentBranch->location ?? '' }}
        </span>
    </div>
    
    <div class="flex space-x-3">
        <!-- Export -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'export-options')"  class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-download"></i>
                <span class="hidden ml-2 lg:inline">Export</span>
            </button>
        </div>

        <!-- Add Customer -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'add-customer')"  class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-user-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Customer</span>
            </button>
        </div>
    </div>
</div>

<!-- Export -->
 <x-modal name="export-options" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4">

        <h2 class="text-lg font-semibold text-center text-gray-800">Export As</h2>

        <div class="flex justify-center mt-4 space-x-4">

            <!-- Excel -->
            <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-green-100 rounded-lg hover:bg-green-200"
                x-on:click="exportData('excel')"
            >
                <i class="mb-1 text-2xl text-green-600 fa-solid fa-file-excel"></i>
                <span class="text-sm text-gray-700">Excel</span>
            </button>

            <!-- DOCX -->
            <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                x-on:click="exportData('docx')"
            >
                <i class="mb-1 text-2xl text-blue-600 fa-solid fa-file-word"></i>
                <span class="text-sm text-gray-700">DOCX</span>
            </button>

            <!-- PDF -->
            <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-red-100 rounded-lg hover:bg-red-200"
                x-on:click="exportData('pdf')"
            >
                <i class="mb-1 text-2xl text-red-600 fa-solid fa-file-pdf"></i>
                <span class="text-sm text-gray-700">PDF</span>
            </button>

        </div>

        <!-- Cancel -->
        <div class="flex justify-center mt-6">
            <button 
                x-on:click="$dispatch('close-modal', 'export-options')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300"
            >Cancel</button>
        </div>
    </div>
</x-modal>

<!-- Add Customer -->
 <x-modal name="add-customer" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Title -->
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-user-plus"></i>
            <h2 class="text-xl font-semibold">Add New Customer</h2>
        </div>

        <!-- Customer Image (Circle Placeholder) -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative">
                <img src="assets/images/logo/logo-removebg-preview.png" 
                    class="object-cover w-24 h-24 border rounded-full shadow" 
                    alt="Customer photo">

                <!-- Edit image button -->
                <button 
                    class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-blue-700">
                    <i class="text-xs fa-solid fa-pen"></i>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Add customer photo</p>
        </div>

        <!-- Form -->
        <form class="space-y-4 text-sm">
            <!-- Customer Info -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Customer Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Customer Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Customer Name</label>
                        <input type="text" placeholder="Juan Dela Cruz" 
                               class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Contact Number -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input type="text" placeholder="+63 912 345 6789" 
                               class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input type="text" placeholder="123 Main St, City" 
                               class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-customer')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit" 
                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-modal>











<!-- Customer Summary -->
<div class="overflow-x-auto table-pretty-scrollbar">
    <div class="flex gap-6 p-6 mt-1 min-w-max">
        <!-- Customers with Credit -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Customers with Credit</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-gray-900">47</h2>
        <p class="mt-1 text-sm text-green-500">▲ 6.3% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Due This Week -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Due This Week</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-gray-900">39</h2>
        <p class="mt-1 text-sm text-green-500">▲ 12% <span class="text-gray-500">this week</span></p>
        </div>

        <!-- Total Receivables -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[270px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Total Receivables</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
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
                    <th class="px-3 py-2 text-left border ellipses whitespace-nowrap">Incoming Due Date</th>
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
                    <td class="px-3 py-2 border ellipses whitespace-nowrap">P2005</td>

                    <!-- Due Date -->
                    <td class="px-3 py-2 border ellipses whitespace-nowrap">
                        10-10-25
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'customer-credits')" class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
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

<!-- View Customer Credit Modal -->
<x-modal name="customer-credits" :show="false" maxWidth="2xl">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <!-- Title -->
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-credit-card"></i>
            <h2 class="text-xl font-semibold">Customer Credits</h2>
        </div>

        <!-- Credits Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-3 py-2 text-left border">Credit ID</th>
                        <th class="px-3 py-2 text-left border whitespace-nowrap">Due Date</th>
                        <th class="px-3 py-2 text-left border whitespace-nowrap">Sale Date</th>
                        <th class="px-3 py-2 text-left border whitespace-nowrap">Amount</th>
                        <th class="px-3 py-2 text-center border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row Example -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border">CRED-001</td>
                        <td class="px-3 py-2 border">2025-10-15</td>
                        <td class="px-3 py-2 border">2025-09-20</td>
                        <td class="px-3 py-2 border whitespace-nowrap">₱1,200</td>
                        <td class="flex justify-center gap-2 px-3 py-2 border">
                            <button class="px-2 py-1 text-white bg-green-500 rounded hover:bg-green-600">
                                <i class="fa-solid fa-peso-sign"></i> Pay
                            </button>
                            <button class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border">CRED-002</td>
                        <td class="px-3 py-2 border">2025-11-01</td>
                        <td class="px-3 py-2 border">2025-09-22</td>
                        <td class="px-3 py-2 border whitespace-nowrap">₱805</td>
                        <td class="flex justify-center gap-2 px-3 py-2 border">
                            <button class="px-2 py-1 text-white bg-green-500 rounded hover:bg-green-600">
                                <i class="fa-solid fa-peso-sign"></i> Pay
                            </button>
                            <button class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Total Row -->
                    <tr class="font-semibold bg-gray-100">
                        <td colspan="3" class="px-3 py-2 text-right border">Total Amount:</td>
                        <td class="px-3 py-2 border">₱2,005</td>
                        <td class="flex justify-center gap-2 px-3 py-2 border">
                            <button class="px-2 py-1 text-white bg-green-600 rounded hover:bg-green-700">
                                <i class="fa-solid fa-money-bill-wave"></i> Pay All
                            </button>
                            <button class="px-2 py-1 text-white bg-red-600 rounded hover:bg-red-700">
                                <i class="fa-solid fa-trash"></i> Delete All
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer Button -->
        <div class="flex justify-end mt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'customer-credits')"
                class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>










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
                    <td class="px-3 py-2 border ellipses whitespace-nowrap">0926 281 1138</td>

                    <!-- Customer Address -->
                    <td class="px-3 py-2 border ellipses whitespace-nowrap">
                        Prk.Makugihon, Brgy. Cuambog, Mabini, Davao de Oro
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'view-customer')"  class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'edit-customer')"  class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-user-pen"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'delete-customer')"  class="px-2 py-1 text-white bg-red-500 rounded">
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

<!-- View Customer Details Modal -->
<x-modal name="view-customer" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4">
            <!-- User Icon -->
            <div class="flex items-center justify-center w-20 h-20 text-2xl text-white bg-green-400 rounded-full">
                <i class="fa-solid fa-user"></i>
            </div>

            <!-- Name + Customer Type -->
            <div>
                <p class="text-lg font-semibold text-gray-800">Jane Smith</p>
                <p class="text-sm text-gray-500">Regular Customer</p>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t"></div>

        <!-- Customer Details -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-medium">Gender:</span> Female</p>
            <p><span class="font-medium">Contact Number:</span> +63 987 654 3210</p>
            <p><span class="font-medium">Email:</span> jane@example.com</p>
            <p><span class="font-medium">Address:</span> 456 Market Road, City</p>
            <p><span class="font-medium">Credit Balance:</span> ₱2,500</p>
        </div>

        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'view-customer')"
                class="px-4 py-2 text-white transition bg-green-600 rounded hover:bg-green-700"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>

<!-- Edit Customer Details Modal -->
<x-modal name="edit-customer" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex items-center mb-4 space-x-1 text-green-900">
            <i class="fa-solid fa-user-pen"></i>
            <h2 class="text-xl font-semibold">Edit Customer Details</h2>
        </div>

        <!-- Profile Image -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative">
                <img src="assets/images/logo/logo-removebg-preview.png" 
                     class="object-cover w-24 h-24 border rounded-full shadow" 
                     alt="Customer photo">

                <!-- Edit image button -->
                <button 
                    class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-green-600 rounded-full hover:bg-green-700">
                    <i class="text-xs fa-solid fa-pen"></i>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Change profile photo</p>
        </div>

        <!-- Form -->
        <form class="space-y-4 text-sm">
            <!-- Personal Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Personal Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- First Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">First Name</label>
                        <input type="text" value="Jane" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">Last Name</label>
                        <input type="text" value="Smith" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block mb-1 text-gray-800">Gender</label>
                        <select class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input type="text" value="+63 987 654 3210" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Email</label>
                        <input type="email" value="jane@example.com" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input type="text" value="456 Customer Ave, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'edit-customer')"
                    class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit" 
                    class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Delete Customer -->
<x-modal name="delete-customer" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <!-- Red warning icon -->
        <i class="mx-auto text-4xl text-red-500 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Fire Customer?</h2>
        <p class="text-sm text-gray-500">
            This action will permanently remove the customer from the system. This cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'delete-customer')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300"
            >
                Cancel
            </button>

            <button
                class="px-4 py-2 text-white transition bg-red-600 rounded hover:bg-red-700"
            >
                Yes, Delete
            </button>
        </div>

    </div>
</x-modal>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t">
    © 2025 KitaKeeps. All rights reserved.
</footer>