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

    <!-- Top: Clock + Date -->
    <div class="flex items-end justify-end">
        <div class="flex flex-col items-end">
            <span id="clock" class="text-xl font-semibold text-blue-600"></span>
            <span id="date" class="text-sm text-gray-500"></span>
        </div>
    </div>
</div>

<!-- Clock Script -->
<script>
    function updateClockAndDate() {
        const now = new Date();

        // Format time as 12-hour HH:MM:SS AM/PM
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // convert 0 to 12
        const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;

        // Format date as Month Day, Year
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const dateString = now.toLocaleDateString(undefined, options);

        document.getElementById('clock').textContent = timeString;
        document.getElementById('date').textContent = dateString;
    }

    // Initial call
    updateClockAndDate();

    // Update every second
    setInterval(updateClockAndDate, 1000);
</script>





<div class="flex mb-10 space-x-5">
    <div class="flex-1 p-6 mt-10 bg-white rounded-lg shadow min-w-[350px]">
        <h2 class="mb-6 text-xl font-semibold text-gray-700">Top 5 Products by Sales</h2>

        <!-- Chart Container -->
        <div class="space-y-6">

            <!-- Product 1 -->
            <div class="flex items-center space-x-4">
                <span class="w-24 text-gray-600">Product A</span>
                <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                    <div class="h-6 bg-blue-600 rounded-full" style="width: 90%;"></div>
                </div>
                <span class="w-12 text-right text-gray-700">90</span>
            </div>

            <!-- Product 2 -->
            <div class="flex items-center space-x-4">
                <span class="w-24 text-gray-600">Product B</span>
                <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                    <div class="h-6 bg-blue-600 rounded-full" style="width: 75%;"></div>
                </div>
                <span class="w-12 text-right text-gray-700">75</span>
            </div>

            <!-- Product 3 -->
            <div class="flex items-center space-x-4">
                <span class="w-24 text-gray-600">Product C</span>
                <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                    <div class="h-6 bg-blue-600 rounded-full" style="width: 60%;"></div>
                </div>
                <span class="w-12 text-right text-gray-700">60</span>
            </div>

            <!-- Product 4 -->
            <div class="flex items-center space-x-4">
                <span class="w-24 text-gray-600">Product D</span>
                <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                    <div class="h-6 bg-blue-600 rounded-full" style="width: 45%;"></div>
                </div>
                <span class="w-12 text-right text-gray-700">45</span>
            </div>

            <!-- Product 5 -->
            <div class="flex items-center space-x-4">
                <span class="w-24 text-gray-600">Product E</span>
                <div class="relative flex-1 h-6 bg-blue-200 rounded-full">
                    <div class="h-6 bg-blue-600 rounded-full" style="width: 30%;"></div>
                </div>
                <span class="w-12 text-right text-gray-700">30</span>
            </div>
            <p class="mt-5 text-sm text-gray-500">
                <i class="fa-solid fa-robot"></i>
                Mampising Branch is currently the highest-performing branch in terms of sales, followed closely by The Cymanti Branch. Bardur Branch has the lowest sales among the top 5, highlighting areas for potential growth.
            </p>
        </div>
    </div>



    <div class="flex-1 p-6 mt-10 bg-white rounded-lg shadow min-w-[350px]">
        <h2 class="mb-6 text-xl font-semibold text-gray-700">Top 5 Stores by Sales</h2>
        
        {{-- Store Item --}}
        <div class="space-y-3">
            {{-- Gateway str --}}
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Mampising Branch</span>
                    <span class="text-sm font-medium text-gray-700">87k</span>
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full">
                    <div class="h-4 bg-blue-500 rounded-full" style="width: 100%;"></div>
                </div>
            </div>

            {{-- The Rustic Fox --}}
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Cymanti Branch</span>
                    <span class="text-sm font-medium text-gray-700">72k</span>
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full">
                    <div class="h-4 bg-blue-500 rounded-full" style="width: 82.8%;"></div>
                </div>
            </div>

            {{-- Velvet Vine --}}
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Elyrion Branch</span>
                    <span class="text-sm font-medium text-gray-700">59k</span>
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full">
                    <div class="h-4 bg-blue-500 rounded-full" style="width: 67.8%;"></div>
                </div>
            </div>

            {{-- Blue Harbor --}}
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Polaris Branch</span>
                    <span class="text-sm font-medium text-gray-700">50k</span>
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full">
                    <div class="h-4 bg-blue-500 rounded-full" style="width: 57.5%;"></div>
                </div>
            </div>

            {{-- Blue Harbor --}}
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Bardur Branch</span>
                    <span class="text-sm font-medium text-gray-700">50k</span>
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full">
                    <div class="h-4 bg-blue-500 rounded-full" style="width: 57.5%;"></div>
                </div>
            </div>

            <p class="mt-5 text-sm text-gray-500">
                <i class="fa-solid fa-robot"></i>
                Mampising Branch is currently the highest-performing branch in terms of sales, followed closely by The Cymanti Branch. Bardur Branch has the lowest sales among the top 5, highlighting areas for potential growth.
            </p>
            
        </div>
    </div>
</div>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
    © 2025 CKC Systems. All rights reserved.
</footer>