<!-- Module Header -->
<div class="flex items-center justify-between" x-data>
    <div class="flex flex-col mr-5">
        <div class="flex items-center space-x-2">
            <h2 class="text-black sm:text-sm md:text-sm lg:text-lg">Zyrile Hardware</h2>
            <button><i class="fa-solid fa-caret-down"></i></button>
        </div>
        <span class="text-[8px] text-gray-600 sm:text-[10px] md:text-[10px] lg:text-xs">Main Branch • Mabini, Davao de Oro</span> <!-- edit later and branch name sa name gyud sa hardware -->
    </div>
    
    <div class="flex space-x-3">
        <!-- Take Attendance -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'take-attendance')" class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-file-pen"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Take Attendance (SUN)</span> 
            </button>
        </div>

        <!-- Export -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'export-options')" class="flex items-center px-5 py-2 text-xs text-black transition-colors bg-white rounded-md shadow hover:bg-blue-300 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-download"></i>
                <span class="hidden ml-2 lg:inline">Export</span>
            </button>
        </div>

        <!-- Add Employee -->
        <div class="flex items-center space-x-4">
            <button x-on:click="$dispatch('open-modal', 'add-employee')" class="flex items-center px-5 py-2 text-xs text-white transition-colors bg-blue-600 rounded-md shadow hover:bg-blue-800 sm:text-xs md:text-xs lg:text-sm">
                <i class="fa-solid fa-user-plus"></i>
                <span class="hidden ml-2 lg:inline whitespace-nowrap">Hire Employee</span>
            </button>
        </div>
    </div>
</div>

<!-- Hire Employee Modal -->
<x-modal name="add-employee" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex justify-between mb-4 space-x-1 text-blue-900">
            <div class="flex items-center">
                <i class="fa-solid fa-user-plus"></i>
                <h2 class="text-xl font-semibold">Hire Employee</h2>
            </div>
            <span x-on:click="$dispatch('close-modal', 'add-employee')" class="cursor-pointer">
                <i class="text-lg fa-solid fa-xmark"></i>
            </span>
        </div>  

        <!-- Form -->
        <form method="POST" action="/employees" enctype="multipart/form-data" class="space-y-4 text-sm">
            @csrf <!-- Laravel CSRF -->
            
            <!-- Profile Image -->
            <!-- Add file and see preview -->
            <div x-data="{ photoUrl: 'assets/images/logo/logo-removebg-preview.png' }" class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img :src="photoUrl"
                        class="object-cover w-24 h-24 border rounded-full shadow" 
                        alt="Add employee photo">

                    <!-- Add image button -->
                    <input type="file" accept="image/*" class="hidden" x-ref="photoInput" 
                            x-on:change="
                            const file = $refs.photoInput.files[0];
                            if(file){ 
                                const reader = new FileReader();
                                reader.onload = e => photoUrl = e.target.result;
                                reader.readAsDataURL(file);
                    }">
                    
                    <button 
                        x-on:click="$refs.photoInput.click()" class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-blue-700">
                        <i class="text-xs fa-solid fa-pen"></i>
                    </button>
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
                    <input type="text" placeholder="John" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block mb-1 text-gray-800">Last Name</label>
                    <input type="text" placeholder="Doe" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block mb-1 text-gray-800">Gender</label>
                    <select class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    </select>
                </div>

                <!-- Contact Number -->
                <div>
                    <label class="block mb-1 text-gray-800">Contact Number</label>
                    <input type="text" placeholder="+63 912 345 6789" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                <!-- Email -->
                <div class="sm:col-span-2">
                    <label class="block mb-1 text-gray-800">Email</label>
                    <input type="email" placeholder="example@email.com" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                <!-- Address -->
                <div class="sm:col-span-2">
                    <label class="block mb-1 text-gray-800">Address</label>
                    <input type="text" placeholder="123 Main St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
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
                    <input type="text" placeholder="Cashier" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                <!-- Daily Salary -->
                <div>
                    <label class="block mb-1 text-gray-800">Daily Salary</label>
                    <input type="number" placeholder="500" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <!-- Submitted with the form but not seen by the user -->
            <!-- <input type="hidden" name="employee_image_path" :value="photoUrl"> -->

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                x-on:click="$dispatch('close-modal', 'add-employee')"
                class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

                <button type="submit" 
                class="px-3 py-1 text-white transition bg-blue-600 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>

    </div>
</x-modal>

<!-- Export Modal -->
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

<!-- Attendance Modal -->
<x-modal name="take-attendance" :show="false" maxWidth="lg">
    <div class="p-6 max-h-[80vh] overflow-y-auto">

        <h2 class="text-xl font-semibold text-center text-gray-800">Attendance for Today</h2>
        <p class="mb-5 text-sm text-center text-gray-500">
            Take attendance for <span class="font-medium">September 21, 2025 (Sunday)</span>.
        </p>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-3 py-2 text-left border ellipses whitespace-nowrap">ID</th>
                        <th class="px-3 py-2 text-left border ellipses whitespace-nowrap">Employee Name</th>
                        <th class="px-3 py-2 text-left border ellipses whitespace-nowrap">Role</th>
                        <th class="px-3 py-2 text-left border ellipses whitespace-nowrap">Attendance</th>
                    </tr>
                </thead>
                <tbody class="divide-x divide-y divide-blue-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-100">
                        <!-- ID -->
                        <td class="px-3 py-2 border">1</td>

                        <!-- Employee Name -->
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

                        <!-- Role -->
                        <td class="px-3 py-2 border">
                            <span class="inline-block px-3 py-1 text-xs text-white bg-orange-400 rounded-full">
                                Cashier
                            </span>
                        </td>
                        
                        <!-- Attendance Buttons -->
                        <td class="px-4 py-3 text-center">
                            <button class="inline-flex items-center justify-center w-5 h-5 text-white transition bg-red-500 rounded hover:bg-red-600">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Save / Cancel -->
        <div class="flex justify-end mt-4 space-x-2">
            <button 
                x-on:click="$dispatch('close-modal', 'take-attendance')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">Cancel</button>

            <button 
                class="px-4 py-2 text-white transition bg-green-600 rounded hover:bg-green-700">Save</button>
        </div>

    </div>
</x-modal>








<!-- ==================== ATTENDANCE ==================== -->





<h3 class="mt-8 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">Attendance</h3>

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
                        <button x-on:click="$dispatch('open-modal', 'pay-salary-confirm')" class="px-2 py-1 text-white bg-green-500 rounded">
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

<!-- Pay Salary Confirmation Modal -->
<x-modal name="pay-salary-confirm" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <i class="mx-auto text-4xl text-yellow-400 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Are you sure?</h2>
        <p class="text-sm text-gray-500">
            This will process the salary for the selected employee(s). This action cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'pay-salary-confirm')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300"
            >
                Cancel
            </button>

            <button
                class="px-4 py-2 text-white transition bg-green-600 rounded hover:bg-green-700"
            >
                Yes, Pay
            </button>
        </div>

    </div>
</x-modal>










<!-- ==================== All Employees ==================== -->





<h3 class="mt-5 text-blue-600 sm:text-sm md:text-sm lg:text-lg text-shadow-lg">All Employees</h3>

<div class="p-4 mt-3 bg-white rounded-lg shadow pb-50">
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

                    <!-- Actions -->
                    <td class="flex justify-center gap-2 px-3 py-3 border">
                        <button x-on:click="$dispatch('open-modal', 'view-employee')" class="px-2 py-1 text-white bg-blue-500 rounded">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'edit-employee')"  class="px-2 py-1 text-white bg-green-500 rounded">
                            <i class="fa-solid fa-user-pen"></i>
                        </button>
                        <button x-on:click="$dispatch('open-modal', 'delete-employee')" class="px-2 py-1 text-white bg-red-500 rounded">
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

<!-- View Employee Details Modal -->
<x-modal name="view-employee" :show="false" maxWidth="sm">
    <div class="p-6">
        <!-- Profile Section -->
        <div class="flex items-center space-x-4">
            <!-- User Icon -->
            <div class="flex items-center justify-center w-20 h-20 text-3xl text-white bg-blue-400 rounded-full">
                <i class="fa-solid fa-user"></i>
            </div>

            <!-- Name + Role -->
            <div>
                <p class="text-lg font-semibold text-gray-800">John Doe</p>
                <p class="text-sm text-gray-500">Cashier</p>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t"></div>

        <!-- Contact Details -->
        <div class="space-y-2 text-sm text-gray-700">
            <p><span class="font-medium">Gender:</span> Male</p>
            <p><span class="font-medium">Contact Number:</span> +63 912 345 6789</p>
            <p><span class="font-medium">Email:</span> john@example.com</p>
            <p><span class="font-medium">Address:</span> 123 Main St, City</p>
            <p><span class="font-medium">Daily Salary:</span> ₱500</p>
        </div>

        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button 
                x-on:click="$dispatch('close-modal', 'view-employee')"
                class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700"
            >
                Close
            </button>
        </div>
    </div>
</x-modal>

<!-- Edit Employee Details Modal -->
<x-modal name="edit-employee" :show="false" maxWidth="lg">
    <div class="p-6 overflow-y-auto max-h-[80vh] table-pretty-scrollbar">
        <div class="flex items-center mb-4 space-x-1 text-blue-900">
            <i class="fa-solid fa-user-pen"></i>
            <h2 class="text-xl font-semibold">Edit Employee Details</h2>
        </div>

        <!-- Profile Image -->
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
                        <input type="text" value="John" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block mb-1 text-gray-800">Last Name</label>
                        <input type="text" value="Doe" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block mb-1 text-gray-800">Gender</label>
                        <select class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Gender</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block mb-1 text-gray-800">Contact Number</label>
                        <input type="text" value="+63 912 345 6789" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Email</label>
                        <input type="email" value="john@example.com" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block mb-1 text-gray-800">Address</label>
                        <input type="text" value="123 Main St, City" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
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
                        <input type="text" value="Cashier" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                    <!-- Daily Salary -->
                    <div>
                        <label class="block mb-1 text-gray-800">Daily Salary</label>
                        <input type="number" value="500" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"/>
                    </div>

                </div>
            </fieldset>

            <!-- Buttons -->
            <div class="flex justify-end mt-2 space-x-2">
                <button type="button" 
                    x-on:click="$dispatch('close-modal', 'edit-employee')"
                    class="px-3 py-1 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit" 
                    class="px-3 py-1 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Delete/Fire Employee Modal-->
<x-modal name="delete-employee" :show="false" maxWidth="sm">
    <div class="p-6 space-y-4 text-center">

        <!-- Red warning icon -->
        <i class="mx-auto text-4xl text-red-500 fa-solid fa-triangle-exclamation"></i>

        <h2 class="text-lg font-semibold text-gray-800">Fire Employee?</h2>
        <p class="text-sm text-gray-500">
            This action will permanently remove the employee from the system. This cannot be undone.
        </p>

        <div class="flex justify-center mt-4 space-x-3">
            <button
                x-on:click="$dispatch('close-modal', 'delete-employee')"
                class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded hover:bg-gray-300"
            >
                Cancel
            </button>

            <button
                class="px-4 py-2 text-white transition bg-red-600 rounded hover:bg-red-700"
            >
                Yes, Fire
            </button>
        </div>

    </div>
</x-modal>




