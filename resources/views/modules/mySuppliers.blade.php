<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <button><i class="fa-solid fa-caret-down"></i></button>
        </div>
        <span class="text-[10px] text-gray-600 sm:text-[10px] md:text-[10px] lg:text-xs">Main Branch • Mabini, Davao de Oro</span> <!-- edit later and branch name sa name gyud sa hardware -->
    </div>
    
    <div class="flex space-x-3">
        <!-- Export -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'export-options')" class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-download"></i>
                <span class="hidden ml-2 lg:inline">Export</span>
            </button>
        </div>

        <!-- Add Supplier -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'add-supplier')"  class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-person-circle-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Supplier</span>
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

<!-- Add Supplier Modal -->
<x-modal name="add-supplier" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Title -->
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-truck-field"></i>
            <h2 class="text-xl font-semibold">Add New Supplier</h2>
        </div>

        <!-- Supplier Image (Circle Placeholder) -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative">
                <img src="assets/images/logo/logo-removebg-preview.png" 
                    class="object-cover w-24 h-24 border rounded-full shadow" 
                    alt="Employee photo">

                <!-- Edit image button -->
                <button 
                    class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-blue-700">
                    <i class="text-xs fa-solid fa-pen"></i>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Add profile photo</p>
        </div>

        <!-- Form -->
        <form class="space-y-4 text-sm">
            <!-- Supplier Info -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Supplier Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Supplier Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Supplier Name</label>
                        <input type="text" placeholder="KitaKeeps Warehouse" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Contact Number -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input type="text" placeholder="+63 912 345 6789" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input type="text" placeholder="123 Supplier St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-supplier')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button type="submit" 
                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">Save</button>
            </div>
        </form>

    </div>
</x-modal>










<!-- All Branches -->





<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Suppliers</h3>

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
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Supplier Name</th>
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

                    <!-- Branch Name -->
                    <td class="px-3 py-2 border ellipsis whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <span class="overflow-hidden whitespace-nowrap text-ellipsis">BB Hardware</span>
                        </div>
                    </td>

                    <!-- Main Branch -->
                    <td class="px-3 py-2 border ellipsis whitespace-nowrap">0929 281 1168</td>

                    <!-- Location -->
                    <td class="px-3 py-2 border ellipsis whitespace-nowrap">
                        123 Street, Tagum, Davao del yeh
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'view-supplier')" class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'edit-supplier')" class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-user-pen"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'delete-supplier')" class="px-2 py-1 text-white bg-red-500 rounded">
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

<!-- View Supplier Details Modal -->
<x-modal name="view-supplier" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4">
            <!-- Supplier Icon -->
            <div class="flex items-center justify-center w-20 h-20 text-3xl text-white bg-blue-500 rounded-full">
                <i class="fa-solid fa-truck-field"></i>
            </div>

            <!-- Supplier Name -->
            <div>
                <p class="text-lg font-semibold text-gray-800">BB Hardware</p>
                <p class="text-sm text-gray-500">Supplier since 8-15-2014</p>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t"></div>

        <!-- Supplier Details -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-medium">Contact Number:</span> +63 912 345 6789</p>
            <p><span class="font-medium">Email:</span> supplier@email.com</p>
            <p><span class="font-medium">Address:</span> 123 Supplier St, City</p>
        </div>

        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'view-supplier')"
                class="px-4 py-2 text-white transition bg-gray-500 rounded hover:bg-gray-600"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>

<!-- Edit Supplier Modal -->
<x-modal name="edit-supplier" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-truck-pen"></i>
            <h2 class="text-xl font-semibold">Edit Supplier Details</h2>
        </div>

        <!-- Profile Image -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative">
                <img src="assets/images/logo/logo-removebg-preview.png" 
                     class="object-cover w-24 h-24 border rounded-full shadow" 
                     alt="Supplier photo">

                <!-- Edit image button -->
                <button 
                    class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-green-700">
                    <i class="text-xs fa-solid fa-pen"></i>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Change supplier photo</p>
        </div>

        <!-- Form -->
        <form class="space-y-4 text-sm">
            <!-- Supplier Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Supplier Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Supplier Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Supplier Name</label>
                        <input type="text" value="ABC Supplies" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input type="text" value="+63 987 654 3210" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block mb-1 text-gray-800">Email</label>
                        <input type="email" value="supplier@email.com" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input type="text" value="456 Supplier St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'edit-supplier')"
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

<!-- Delete Supplier -->
<x-modal name="delete-supplier" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <!-- Red warning icon -->
        <i class="mx-auto text-4xl text-red-500 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Delete Supplier?</h2>
        <p class="text-sm text-gray-500">
            This action will permanently remove the supplier from the system. This cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'delete-supplier')"
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