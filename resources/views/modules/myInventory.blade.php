<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <!-- <button><i class="fa-solid fa-caret-down"></i></button> -->
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

        <!-- Add Customer -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'add-product')"  class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Add Product</span>
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
            <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="flex flex-col items-center w-24 px-4 py-3 transition bg-green-100 rounded-lg hover:bg-green-200"
                x-on:click="exportData('excel')"
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

<!-- Add Product -->
<x-modal name="add-product" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-box"></i>
            <h2 class="text-xl font-semibold">Add New Product</h2>
        </div>

        <!-- Product Image (Circle Placeholder) -->
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
        <div class="space-y-4 text-sm">

            <!-- Basic Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Product Information</legend>
                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Product Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">Product Name</label>
                        <input type="text" placeholder="T-shirt" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"/>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block mb-1 text-gray-800">Category</label>
                        <select class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500">
                            <option value="">Select Category</option>
                            <option value="clothing">Clothing</option>
                            <option value="footwear">Footwear</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Description</label>
                        <textarea rows="3" placeholder="Write product details..." class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>

                </div>
            </fieldset>

            <!-- Pricing -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Pricing</legend>
                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Unit Cost -->
                    <div>
                        <label class="block mb-1 text-gray-800">Unit Cost</label>
                        <input type="number" placeholder="100" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"/>
                    </div>

                    <!-- Selling Price -->
                    <div>
                        <label class="block mb-1 text-gray-800">Selling Price</label>
                        <input type="number" placeholder="150" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-product')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button x-on:click="$dispatch('open-modal', 'success-modal')" 
                class="px-3 py-1 text-white transition bg-blue-600 rounded hover:bg-blue-700">Save</button>
            </div>
        </div>
    </div>
</x-modal>











<!-- ALL PRODUCTS -->
<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Products</h3>

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
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Product Name</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Product Supplier</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Category</th>
                    <th class="px-3 py-2 text-left border">Qty.</th>
                    <th class="px-3 py-2 text-left border whitespace-nowrap">Selling Price</th>
                    <th class="px-3 py-2 text-left border">Status</th>
                    <th class="px-3 py-2 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Product Rows -->
                <tr class="hover:bg-gray-50">
                    <!-- Customer ID -->
                    <td class="px-3 py-2 border">1</td>

                    <!-- Product Image and Name -->
                    <td class="px-3 py-2 border">
                        <div class="flex items-center gap-2">
                            <!-- Circle placeholder icon -->
                            <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-200 rounded-full">
                            <i class="fa-solid fa-user"></i>
                            </div>
                            <!-- Product Name -->
                            <span class="overflow-hidden whitespace-nowrap text-ellipsis">Sherlux Spray Paint Red</span>
                        </div>
                    </td>

                    <!-- Product Supplier -->
                    <td class="px-3 py-2 border">KP Hardware</td>

                    <!-- Category -->
                    <td class="px-3 py-2 border whitespace-nowrap">
                        Spray Paint
                    </td>

                    <!-- Quantity -->
                    <td class="px-3 py-2 border">
                        50
                    </td>

                    <!-- Selling Price -->
                    <td class="px-3 py-2 border">
                        P130.00
                    </td>

                    <!-- Status -->
                    <td class="px-3 py-2 border">
                        <span class="inline-block px-3 py-1 text-xs text-white bg-green-500 rounded-full whitespace-nowrap">
                            In Stock
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'view-product')"  class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'edit-product')" class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'delete-product')" class="px-2 py-1 text-white bg-red-500 rounded">
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

<!-- View Product Details Modal -->
<x-modal name="view-product" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Product Section -->
        <div class="flex items-center space-x-4">
            <!-- Product Image -->
            <div class="flex items-center justify-center w-20 h-20 overflow-hidden text-3xl text-white bg-blue-400 rounded-full">
                <i class="fa-solid fa-box"></i>
            </div>

            <!-- Product Name & Category -->
            <div>
                <p class="text-lg font-semibold text-gray-800">Product Name</p>
                <p class="text-sm text-gray-500">Product Category</p>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t"></div>

        <!-- Product Details -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-medium">Description:</span> This is product.</p>
            <p><span class="font-medium">Unit Cost:</span> ₱200.00</p>
            <p><span class="font-medium">Selling Price:</span> ₱300.00</p>
            <p><span class="font-medium">Stock Quantity:</span> 50</p>
       
            <p>
                <span class="text-green-500">In Stock</span>
            </p>

            <p><span class="font-medium">Supplier:</span> KP Hardware</p>
        </div>

        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'view-product')"
                class="px-4 py-2 text-white transition bg-gray-500 rounded hover:bg-gray-600"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>

<!-- Edit Product Details Modal -->
<x-modal name="edit-product" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Modal Header -->
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-box"></i>
            <h2 class="text-xl font-semibold">Edit Product Details</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'edit-product" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>

        <!-- Form -->
        <div class="space-y-4 text-sm">

            <!-- Product Image -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative w-24 h-24">
                    <img 
                        src="assets/images/logo/logo-removebg-preview.png" 
                        class="object-cover w-full h-full border rounded-full shadow" 
                        alt="product">

                    <!-- Edit image button -->
                    <label
                        class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full cursor-pointer hover:bg-green-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-500">Change product image</p>
            </div>

            <!-- Product Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Product Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Product Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">Product Name</label>
                        <input type="text" name="prod_name" value="Sherlux Spray Paint Red"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block mb-1 text-gray-800">Category</label>
                        <select name="category" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500">
                            <option value="" disabled selected>Select category</option>
                            <option value="">Paint</option>
                            <option value="">Cement</option>
                            <option value="">Flooring</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Description</label>
                        <textarea name="prod_description" rows="3" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">This is product.</textarea>
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label class="block mb-1 text-gray-800">Product Supplier</label>
                        <select name="supplier" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select supplier</option>
                            <option value="">KP Hardware</option>
                            <option value="">BB Hardware</option>
                            <option value="">Hardware</option>
                        </select>
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label class="block mb-1 text-gray-800">Stock Quantity</label>
                        <input type="number" name="stock_qty" value="50" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>
                </div>
            </fieldset>
            <!-- Pricing -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Pricing</legend>
                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">
                    <!-- Unit Cost -->
                    <div>
                        <label class="block mb-1 text-gray-800">Unit Cost</label>
                        <input type="number" name="unit_cost" value="100" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Selling Price -->
                    <div>
                        <label class="block mb-1 text-gray-800">Selling Price</label>
                        <input type="number" name="selling_price" value="100" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'edit-product')"
                    class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit" x-on:click="$dispatch('open-modal', 'success-modal')"
                    class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                    Update
                </button>
            </div>
        </div>
    </div>
</x-modal>

<!-- Delete Product -->
<x-modal name="delete-product" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <!-- Red warning icon -->
        <i class="mx-auto text-4xl text-red-500 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Delete Product?</h2>
        <p class="text-sm text-gray-500">
            This action will permanently remove the product from the system. This cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'delete-product')"
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