<!-- Module Header -->
<div class="flex items-center justify-between">
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <!-- <button><i class="fa-solid fa-caret-down"></i></button> -->
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

        <!-- Low Stock -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Low Stock</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-yellow-500">47</h2>
        <p class="mt-1 text-sm text-black">6.3% <span class="text-gray-500">of inventory</span></p>
        </div>

        <!-- Due This Week -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Sold Out</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-red-500">39</h2>
        <p class="mt-1 text-sm text-black">6.3% <span class="text-gray-500">of inventory</span></p>
        </div>

        <!-- Total Receivables -->
        <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Active Employees</span>
            <!-- <span class="text-gray-400 cursor-pointer">↗</span> -->
        </div>
        <h2 class="text-2xl font-bold text-green-500">12</h2>
        <p class="mt-1 text-sm text-black">6.3 <span class="text-gray-500">this week</span></p>
        </div>
    </div>
</div>









<div class="flex flex-col mt-5 mb-20 space-x-0 space-y-5 lg:justify-center lg:flex-row lg:space-x-5 lg:space-y-0">
    <!-- Pie Chart -->
    <div class="order-2 lg:w-[250px] p-5 bg-white shadow-md rounded-2xl lg:order-1">
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
    <div class="p-4 bg-white shadow-md rounded-2xl w-full lg:w-[500px] order-3 lg:order-2">
        <!-- Header -->
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700">Sale VS Profit</h3>
            <span class="text-xs text-gray-500">Last 7 days</span>
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
                <span>0</span>
            </div>

            <!-- X-axis labels -->
            <div class="absolute bottom-0 flex justify-between text-xs text-gray-500 left-10 right-10">
                <span>Oct 1</span>
                <span>Oct 2</span>
                <span>Oct 3</span>
                <span>Oct 4</span>
                <span>Oct 5</span>
                <span>Oct 6</span>
                <span>Oct 7</span>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="order-1 p-3 bg-white rounded-lg shadow-md lg:order-3">
        <div class="flex flex-row space-x-5 lg:flex-col lg:space-x-0 lg:space-y-5">

            <button x-on:click="$dispatch('open-modal', 'add-product')" class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-clipboard-list"></i>
            </button>
            <button x-on:click="$dispatch('open-modal', 'add-supplier')" class="w-full px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                <i class="fa-solid fa-truck"></i>
            </button>
            <button x-on:click="$dispatch('open-modal', 'add-employee')" class="w-full px-4 py-2 text-white bg-purple-600 rounded-md hover:bg-purple-700">
                <i class="fa-solid fa-users"></i>
            </button>
            <button x-on:click="$dispatch('open-modal', 'add-customer')" class="w-full px-4 py-2 text-white bg-orange-600 rounded-md hover:bg-orange-700">
                <i class="fa-solid fa-users-line"></i>
            </button>
        </div>
    </div>
</div>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
    © 2025 KitaKeeps. All rights reserved.
</footer>










<!-- Modals -->
<!-- Add Product Modal -->
<x-modal name="add-product" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Modal Header -->
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-box"></i>
                <h2 class="text-xl font-semibold">Add New Product</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'add-product')" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>

        <!-- Form -->
        <form class="space-y-4 text-sm">

            <!-- Product Image (Circle Placeholder) -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img id="preview-employee" src="assets/images/logo/logo-removebg-preview.png" 
                        class="object-cover w-24 h-24 border rounded-full shadow" 
                        alt="Employee photo">

                    <!-- Upload button -->
                    <label for="employee_image" 
                        class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full cursor-pointer hover:bg-blue-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="employee_image" name="employee_image_path" class="hidden" accept="image/*"
                        onchange="document.getElementById('preview-employee').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <p class="mt-2 text-sm text-gray-500">Add profile photo</p>
            </div>

            <!-- Basic Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Product Information</legend>
                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Product Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">Product Name</label>
                        <input required name="prod_name" type="text" placeholder="Paint" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500"/>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block mb-1 text-gray-800">Category</label>
                        <select required name="category" id="category" 
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500">
                            <option value="">Select category</option>
                            <option value="Building Materials">Building Materials</option>
                            <option value="Construction Materials">Construction Materials</option>
                            <option value="Decor">Decor</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Garden & Landscaping">Garden & Landscaping</option>
                            <option value="Paints & Finishes">Paints & Finishes</option>
                            <option value="Plumbing & Sanitary">Plumbing & Sanitary</option>
                            <option value="Security & Safety">Security & Safety</option>
                            <option value="Tools">Tools</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Description</label>
                        <textarea name="prod_description" rows="3" placeholder="Write product details..." class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500"></textarea>
                    </div>

                    <!-- Product Supplier -->
                    <div>
                        <label for="supplier" class="block mb-1 text-gray-800">Product Supplier</label>
                        <select required name="supplier" id="supplier" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500">
                            <option value="">Select a supplier</option>
                            @foreach($userSuppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->supp_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Quantity -->
                    <div>
                        <label class="block mb-1 text-gray-800">Stock Quantity</label>
                        <input required type="number" name="quantity" placeholder="143" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500"/>
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
                        <input required type="number" name="unit_cost" placeholder="100" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500"/>
                    </div>

                    <!-- Selling Price -->
                    <div>
                        <label class="block mb-1 text-gray-800">Selling Price</label>
                        <input required type="number" name="selling_price" placeholder="150" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500"/>
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
        </form>
    </div>
</x-modal>

<!-- Add Supplier Modal -->
<x-modal name="add-supplier" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Title -->
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center">
                <i class="mr-2 fa-solid fa-truck-field"></i>
                <h2 class="text-xl font-semibold">Add New Supplier</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'add-supplier')" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>  

        <!-- Form -->
        <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data" class="space-y-4 text-sm">
            @csrf
            
            <!-- Supplier Image -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img id="preview-supp" src="assets/images/logo/logo-removebg-preview.png" 
                        class="object-cover w-24 h-24 border rounded-full shadow" 
                        alt="Supplier photo">

                    <!-- Upload button -->
                    <label for="supp_image" 
                        class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full cursor-pointer hover:bg-blue-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="supp_image" name="supp_image" class="hidden" accept="image/*"
                        onchange="document.getElementById('preview-supp').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <p class="mt-2 text-sm text-gray-500">Add profile photo</p>
            </div>

            <!-- Supplier Info -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Supplier Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Supplier Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Supplier Name</label>
                        <input required type="text" name="supp_name" placeholder="KitaKeeps Warehouse" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Contact Number -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input required type="text" name="supp_contact" placeholder="+63 912 345 6789" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input required type="text" name="supp_address" placeholder="123 Supplier St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-supplier')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">Save</button>
            </div>
        </form>

    </div>
</x-modal>

<!-- Hire Employee Modal -->
<x-modal name="add-employee" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center">
                <i class="mr-2 fa-solid fa-user-plus"></i>
                <h2 class="text-xl font-semibold">Hire Employee</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'add-employee')" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>  

        @if ($errors->any())
            <div class="p-2 mb-2 text-red-700 bg-red-100 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Form -->
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="space-y-4 text-sm"
            x-data="{ position: '' }">
            @csrf <!-- Laravel CSRF -->
            
            <!-- Profile Image -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img id="preview-employee" src="assets/images/logo/logo-removebg-preview.png" 
                        class="object-cover w-24 h-24 border rounded-full shadow" 
                        alt="Employee photo">

                    <!-- Upload button -->
                    <label for="employee_image" 
                        class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full cursor-pointer hover:bg-blue-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="employee_image" name="employee_image_path" class="hidden" accept="image/*"
                        onchange="document.getElementById('preview-employee').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <p class="mt-2 text-sm text-gray-500">Add profile photo</p>
            </div>

            <!-- Personal Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Personal Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                <!-- First Name -->
                <div>
                    <label class="block mb-1 text-gray-800">First Name</label>
                    <input required type="text" name="firstname" placeholder="Kita" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block mb-1 text-gray-800">Last Name</label>
                    <input required type="text" name="lastname" placeholder="Keeper" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block mb-1 text-gray-800">Gender</label>
                    <select required name="gender" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Contact Number -->
                <div>
                    <label class="block mb-1 text-gray-800">Contact Number</label>
                    <input required name="contact_number" type="text" placeholder="+63 912 345 6789" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                </div>

                <!-- Email -->
                <div class="sm:col-span-2">
                    <label class="block mb-1 text-gray-800">Email</label>
                    <input required type="email" name="email" placeholder="example@email.com" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                </div>

                <!-- Address -->
                <div class="sm:col-span-2">
                    <label class="block mb-1 text-gray-800">Address</label>
                    <input required type="text" name="address" placeholder="123 Main St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                </div>

                </div>
            </fieldset>

            <!-- Job Information -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Job Information</legend>
                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">
                    <!-- Position -->
                    <div>
                        <label class="block mb-1 text-gray-800">Position</label>
                        <input required type="text" name="position" placeholder="Cashier"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"
                            x-model="position">
                    </div>

                    <!-- Daily Salary -->
                    <div>
                        <label class="block mb-1 text-gray-800">Daily Salary</label>
                        <input required type="number" name="daily_rate" placeholder="500" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>
                </div>
                
                <div x-show="position.toLowerCase() === 'cashier' || position.toLowerCase() === 'admin'" class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">
                    <!-- Username -->
                    <div>
                        <label class="block mb-1 text-gray-800">Username</label>
                        <input type="text" name="username" placeholder="e.g., john.doe"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block mb-1 text-gray-800">Password</label>
                        <input type="password" name="password" placeholder="Enter password"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500"/>
                    </div>
                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-employee')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button x-on:click="$dispatch('open-modal', 'success-modal')"
                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">Save</button>
            </div>
        </form>

    </div>
</x-modal>

<!-- Add Customer -->
<x-modal name="add-customer" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        
        <!-- Title -->
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-user-plus"></i>
                <h2 class="text-xl font-semibold">Add New Customer</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'add-customer')" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>

        <!-- Form -->
        <form action="{{ route('customers.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4 text-sm">
            @csrf

            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img id="customerImagePreview"
                        src="assets/images/logo/logo-removebg-preview.png"
                        class="object-cover w-24 h-24 border rounded-full shadow"
                        alt="Customer photo">

                    <!-- Hidden File Input -->
                    <input type="file" name="cust_image_path" id="cust_image_path"
                        class="hidden" accept="image/*"
                        onchange="previewCustomerImage(event)">

                    <!-- Edit image button -->
                    <button type="button"
                        onclick="document.getElementById('cust_image_path').click();"
                        class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-green-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500">Add customer photo</p>
            </div>

            <!-- Customer Info -->
            <fieldset class="p-4 border border-gray-200 rounded-lg">
                <legend class="font-semibold text-gray-700">Customer Information</legend>

                <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2">

                    <!-- Customer Name -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Customer Name</label>
                        <input required type="text" name="cust_name" placeholder="Juan Dela Cruz"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500" required />
                    </div>

                    <!-- Contact Number -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input required type="text" name="cust_contact" placeholder="+63 912 345 6789"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500" />
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input required type="text" name="cust_address" placeholder="123 Main St, City"
                            class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-green-500 focus:border-green-500" />
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

                <button x-on:click="$dispatch('open-modal', 'error-modal')"
                class="px-3 py-1 text-white transition bg-green-600 rounded hover:bg-green-700">
                    Save
                </button>
            </div>
        </form>
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