<div class="p-6 space-y-6">

    <!-- Title -->
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Settings</h2>
        <p class="text-sm text-gray-500">Manage your preferences and system options below.</p>
    </div>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <!-- Dark Mode -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-blue-600 fa-solid fa-moon"></i>
                <div>
                    <p class="font-medium text-gray-800">Dark Mode</p>
                    <p class="text-sm text-gray-500">Switch between light and dark theme.</p>
                </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div class="h-6 bg-gray-200 rounded-full w-11 peer peer-checked:bg-blue-600"></div>
                <div class="absolute w-5 h-5 bg-white rounded-full left-1 top-0.5 peer-checked:translate-x-full transition"></div>
            </label>
        </div>

        <!-- Font Size -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-green-600 fa-solid fa-text-height"></i>
                <div>
                    <p class="font-medium text-gray-800">Font Size</p>
                    <p class="text-sm text-gray-500">Adjust the interface text size.</p>
                </div>
            </div>
            <select class="px-2 py-1 text-sm border rounded">
                <option>Small</option>
                <option selected>Medium</option>
                <option>Large</option>
            </select>
        </div>

        <!-- Check for Updates -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-yellow-600 fa-solid fa-rotate"></i>
                <div>
                    <p class="font-medium text-gray-800">Check for Updates</p>
                    <p class="text-sm text-gray-500">Ensure you’re running the latest version.</p>
                </div>
            </div>
            <button class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                Check
            </button>
        </div>

        <!-- Read Terms and Services -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-purple-600 fa-solid fa-file-contract"></i>
                <div>
                    <p class="font-medium text-gray-800">Terms & Services</p>
                    <p class="text-sm text-gray-500">Read our terms and conditions.</p>
                </div>
            </div>
            <button 
                x-data 
                x-on:click="$dispatch('open-modal', 'terms-and-services')" 
                class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                View
            </button>
        </div>

        <!-- Audit Log -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-red-600 fa-solid fa-clipboard-list"></i>
                <div>
                    <p class="font-medium text-gray-800">Audit Log</p>
                    <p class="text-sm text-gray-500">View system activities and records.</p>
                </div>
            </div>
            <button 
                x-data 
                x-on:click="$dispatch('open-modal', 'audit-log')" 
                class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                Open
            </button>
        </div>

        <!-- Help -->
        <div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-indigo-600 fa-solid fa-circle-question"></i>
                <div>
                    <p class="font-medium text-gray-800">Help</p>
                    <p class="text-sm text-gray-500">Get assistance or support.</p>
                </div>
            </div>
            <button 
                x-data 
                x-on:click="$dispatch('open-modal', 'help')" 
                class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                Open
            </button>
        </div>

        <!-- Sync to Cloud -->
        <div class="flex items-center justify-between p-4 transition bg-white border rounded-lg shadow hover:shadow-md sm:col-span-2 lg:col-span-3">
            <div class="flex items-center space-x-3">
                <i class="text-xl text-blue-600 fa-solid fa-cloud-arrow-up"></i> 
                <div>
                    <h2 class="font-semibold text-gray-800">Sync to Cloud</h2>
                    <p class="text-sm text-gray-500">Backup your data and access it anywhere.</p>
                </div>
            </div>
            <button class="px-3 py-1 text-sm text-white bg-purple-600 rounded hover:bg-purple-700 ellipses whitespace-nowrap">
                Sync Now
            </button>
        </div>
    </div>

    <!-- Footer Branding -->
    <footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
        © 2025 CKC Systems. All rights reserved.
    </footer>
</div>
