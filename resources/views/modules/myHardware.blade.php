<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>

            <!-- Caret Button to Open Modal -->
            <button x-on:click="$dispatch('open-modal', 'switch-branch')" 
                    class="px-1 text-xs text-gray-600 border border-gray-300 rounded hover:text-black hover:border hover:shadow-sm sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-caret-down"></i> Switch Branch
            </button>
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

        <!-- Add Employee -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'add-branch')"  class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-warehouse"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Branch</span>
            </button>
        </div>
    </div>
</div>

<!-- Switch Branch Modal -->
<x-modal name="switch-branch" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Header -->
        <h2 class="mb-4 text-lg font-semibold text-center text-gray-800">
            Switch Branch
        </h2>

        <!-- Branch List -->
        <div class="space-y-2">
            <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="flex items-center justify-between w-full px-4 py-2 text-sm text-left transition border rounded-lg hover:bg-blue-100">
                <div>
                    <span class="font-semibold">Zyrile Hardware Maco</span>
                    <span class="text-xs text-gray-500"> Main Branch • Maco</span>
                </div>
                <i class="text-green-600 fa-solid fa-check"></i>
            </button>

            <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="flex items-center justify-between w-full px-4 py-2 text-sm text-left transition border rounded-lg hover:bg-blue-100">
                <div>
                    <span class="font-semibold">Panabo Branch Hardware</span>
                    <span class="text-xs text-gray-500"> Branch • Panabo</span>
                </div>
            </button>
        </div>

        <!-- Cancel -->
        <div class="flex justify-end mt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'switch-branch')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                Cancel
            </button>
        </div>
    </div>
</x-modal>

<!-- Export -->
<x-modal name="export-options" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4">

        <h2 class="text-lg font-semibold text-center text-gray-800">Export As</h2>

        <div class="flex justify-center mt-4 space-x-4">

            <!-- Excel -->
            <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-green-100 rounded-lg hover:bg-green-200"
                x-on:click="$dispatch('open-modal', 'success-modal')"
            >
                <i class="mb-1 text-2xl text-green-600 fa-solid fa-file-excel"></i>
                <span class="text-sm text-gray-700">Excel</span>
            </button>

            <!-- DOCX -->
            <!-- <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                x-on:click="exportData('docx')"
            >
                <i class="mb-1 text-2xl text-blue-600 fa-solid fa-file-word"></i>
                <span class="text-sm text-gray-700">DOCX</span>
            </button> -->

            <!-- PDF -->
            <!-- <button 
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-red-100 rounded-lg hover:bg-red-200"
                x-on:click="exportData('pdf')"
            >
                <i class="mb-1 text-2xl text-red-600 fa-solid fa-file-pdf"></i>
                <span class="text-sm text-gray-700">PDF</span>
            </button> -->

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

<!-- Add Branch -->
<x-modal name="add-branch" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Title -->
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-code-branch"></i>
            <h2 class="text-xl font-semibold">Add New Branch</h2>
        </div>

        <!-- Form -->
        <div class="space-y-4 text-sm">
            <!-- Branch Info -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Branch Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Branch Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Branch Name</label>
                        <input type="text" placeholder="Davao City Branch" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Location -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Location</label>
                        <input type="text" placeholder="123 Main St, Davao City" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'add-branch')"
                    class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button x-on:click="$dispatch('open-modal', 'success-modal')"
                    class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">Save</button>
            </div>
        </div>
    </div>
</x-modal>










<!-- All Branches -->
<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Branches</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow">
    <!-- Search + Entries -->
    <div class="flex items-center justify-between mb-4 whitespace-nowrap">
        <div>
            <label class="mr-2 text-sm text-ellipsis sm:text-base">Show</label>
            <select class="py-1 text-sm border rounded text-ellipsis sm:text-base">
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
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Branch Name</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Main Branch</th>
                    <th class="px-3 py-2 text-left border">Location</th>
                    <th class="px-3 py-2 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee Rows -->
                <tr class="hover:bg-gray-50">
                    <!-- Customer ID -->
                    <td class="px-3 py-2 border">1</td>

                    <!-- Branch Name -->
                    <td class="px-3 py-2 border">
                        <div class="flex items-center gap-2">
                            <span class="overflow-hidden whitespace-nowrap text-ellipsis">Kenny Hardware</span>
                        </div>
                    </td>

                    <!-- Main Branch -->
                    <td class="px-3 py-2 border ellipsis whitespace-nowrap">Zyrile Hardware</td>

                    <!-- Location -->
                    <td class="px-3 py-2 border ellipsis whitespace-nowrap">
                        Mampising, Mabini, Davao de Oro
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'view-branch')"  class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'edit-branch')"  class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'delete-branch')"  class="px-2 py-1 text-white bg-red-500 rounded">
                            <i class="fa-solid fa-trash"></i>
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

<!-- View Branch Details Modal -->
<x-modal name="view-branch" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4">
            <!-- Branch Icon -->
            <div class="flex items-center justify-center w-20 h-20 text-3xl text-white bg-blue-600 rounded-full">
                <i class="fa-solid fa-code-branch"></i>
            </div>

            <!-- Branch Name -->
            <div>
                <p class="text-lg font-semibold text-gray-800">Downtown Branch</p>
                <p class="text-sm text-gray-500">Active since 3-12-2019</p>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t"></div>

        <!-- Branch Details -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-medium">Location:</span> 45 Main Street, Tagum City</p>
        </div>

        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'view-branch')"
                class="px-4 py-2 text-white transition bg-gray-500 rounded hover:bg-gray-600"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>

<!-- Edit Branch Details Modal -->
<x-modal name="edit-branch" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <!-- Title -->
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-code-branch"></i>
            <h2 class="text-xl font-semibold">Edit Branch Details</h2>
        </div>

        <!-- Profile Image -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative">
                <img src="assets/images/logo/logo-removebg-preview.png" 
                     class="object-cover w-24 h-24 border rounded-full shadow" 
                     alt="Branch photo">

                <!-- Edit image button -->
                <button 
                    class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-green-600 rounded-full hover:bg-green-700">
                    <i class="text-xs fa-solid fa-pen"></i>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Change branch photo</p>
        </div>

        <!-- Form -->
        <div class="space-y-4 text-sm">
            <!-- Branch Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Branch Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Branch Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Branch Name</label>
                        <input type="text" value="Main Branch" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Location -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Location</label>
                        <input type="text" value="123 City Road, Davao" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'edit-branch')"
                    class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <button x-on:click="$dispatch('open-modal', 'success-modal')"
                    class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                    Update
                </button>
            </div>
        </div>
    </div>
</x-modal>

<!-- Delete Branch -->
<x-modal name="delete-branch" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <!-- Red warning icon -->
        <i class="mx-auto text-4xl text-red-500 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Delete Branch?</h2>
        <p class="text-sm text-gray-500">
            This action will permanently remove the branch from the system. This cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'delete-branch')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300"
            >
                Cancel
            </button>

            <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="px-4 py-2 text-white transition bg-red-600 rounded hover:bg-red-700"
            >
                Yes, Delete
            </button>
        </div>

    </div>
</x-modal>

<!-- Feedback Modals -->
<!-- Success Modal -->
<x-modal name="success-modal" :show="false" maxWidth="sm">
    <div class="p-6 text-center">
        <i class="text-green-600 fa-solid fa-circle-check fa-2x"></i>
        <h2 class="mt-3 text-lg font-semibold text-gray-800">Success!</h2>
        <p class="mt-1 text-gray-600">Operation completed successfully.</p>
        <button type="button"
            class="px-4 py-2 mt-4 text-white bg-green-600 rounded hover:bg-green-700"
            x-on:click="$dispatch('close-modal', 'success-modal')">
            Yay!
        </button>
    </div>
</x-modal>

<!-- Error Modal -->
<x-modal name="error-modal" :show="false" maxWidth="sm">
    <div class="p-6 text-center">
        <i class="text-red-600 fa-solid fa-circle-xmark fa-2x"></i>
        <h2 class="mt-3 text-lg font-semibold text-gray-800">Error!</h2>
        <p class="mt-1 text-gray-600">Something went wrong. Please try again.</p>
        <button type="button"
            class="px-4 py-2 mt-4 text-white bg-red-600 rounded hover:bg-red-700"
            x-on:click="$dispatch('close-modal', 'error-modal')">
            Try Again
        </button>
    </div>
</x-modal>