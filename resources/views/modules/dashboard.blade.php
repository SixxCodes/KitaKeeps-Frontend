@php
    use Carbon\Carbon;
    use App\Models\BranchProduct;
    use App\Models\Product;
    use App\Models\User;
    use App\Models\Sale;
    use App\Models\Employee;
    use App\Models\Attendance;

    // --- Branch-awareness ---
    $owner = auth()->user();
    $userBranches = $owner ? $owner->branches : collect();
    $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
                ?? $userBranches->sortBy('branch_id')->first();
    $branchId = $currentBranch ? $currentBranch->branch_id : null;

    // --- Date ranges ---
    $now = Carbon::now();
    $startOfWeek = $now->copy()->startOfWeek();
    $startOfLastWeek = $startOfWeek->copy()->subWeek();
    $endOfLastWeek = $startOfWeek->copy()->subDay();

    // --- Helper for percentage change ---
    function percentChange($current, $previous) {
        if ($previous == 0) return $current > 0 ? 100 : 0;
        return round((($current - $previous) / $previous) * 100, 1);
    }

    // --- Metrics ---

    // Total inventory value (from BranchProduct × Product)
    $totalInventoryValue = BranchProduct::where('branch_id', $branchId)
        ->join('product', 'branch_product.product_id', '=', 'product.product_id')
        ->sum(\DB::raw('branch_product.stock_qty * product.selling_price'));

    // Low stock count (1–19)
    $lowStockCount = BranchProduct::where('branch_id', $branchId)
        ->whereBetween('stock_qty', [1, 19])
        ->count();

    // Sold out count
    $soldOutCount = BranchProduct::where('branch_id', $branchId)
        ->where('stock_qty', 0)
        ->count();

    // --- Weekly percentage changes (simulated or derived) ---
    $currentWeekSales = Sale::where('branch_id', $branchId)
        ->whereBetween('sale_date', [$startOfWeek, $now])
        ->sum('total_amount');

    $lastWeekSales = Sale::where('branch_id', $branchId)
        ->whereBetween('sale_date', [$startOfLastWeek, $endOfLastWeek])
        ->sum('total_amount');

    $inventoryChange = percentChange($currentWeekSales, $lastWeekSales);
    $lowStockChange = percentChange($lowStockCount, $lowStockCount - 2);
    $soldOutChange = percentChange($soldOutCount, $soldOutCount - 1);

    // --- Today's date ---
    $today = Carbon::today()->toDateString();

    // --- Active employees today ---
    $activeEmployeesToday = Employee::where('branch_id', $branchId)
        ->whereHas('attendance', function ($query) use ($today) {
            $query->whereDate('att_date', $today)
                ->where('status', 'present');
        })
        ->count();

    // --- Active employees this week ---
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $activeEmployeesThisWeek = Employee::where('branch_id', $branchId)
        ->whereHas('attendance', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('att_date', [$startOfWeek, $endOfWeek])
                ->where('status', 'present');
        })
        ->distinct('employee_id')
        ->count();
@endphp

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










<!-- Summary -->
<div class="overflow-x-auto table-pretty-scrollbar">
  <div class="flex gap-6 p-6 mt-1 min-w-max">

    <!-- Total Inventory Value -->
    <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Total Inventory Value</span>
      </div>
      <h2 class="text-2xl font-bold text-blue-500">₱{{ number_format($totalInventoryValue, 2) }}</h2>
      <p class="mt-1 text-sm {{ $inventoryChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
        {{ $inventoryChange >= 0 ? '▲' : '▼' }} {{ abs($inventoryChange) }}%
        <span class="text-gray-500">this week</span>
      </p>
    </div>

    <!-- Low Stock -->
    <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Low Stock</span>
      </div>
      <h2 class="text-2xl font-bold text-yellow-500">{{ $lowStockCount }}</h2>
      <p class="mt-1 text-sm {{ $lowStockChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
        {{ $lowStockChange >= 0 ? '▲' : '▼' }} {{ abs($lowStockChange) }}%
        <span class="text-gray-500">this week</span>
      </p>
    </div>

    <!-- Sold Out -->
    <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Sold Out</span>
      </div>
      <h2 class="text-2xl font-bold text-red-500">{{ $soldOutCount }}</h2>
      <p class="mt-1 text-sm {{ $soldOutChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
        {{ $soldOutChange >= 0 ? '▲' : '▼' }} {{ abs($soldOutChange) }}%
        <span class="text-gray-500">this week</span>
      </p>
    </div>

    <!-- Active Employees -->
    <div class="flex flex-col p-5 bg-white shadow-md rounded-2xl min-w-[200px]">
    <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Active Employees</span>
    </div>
    <h2 class="text-2xl font-bold text-green-500">{{ $activeEmployeesToday }}</h2>
    <p class="mt-1 text-sm">
        {{ $activeEmployeesThisWeek }}
        <span class="text-gray-500">this week</span>
    </p>
    </div>
  </div>
</div>








<!-- Charts & Graphs -->
<div class="flex justify-center mb-20 space-x-5 overflow-x-auto table-pretty-scrollbar">
    <!-- Pie Chart -->
    <div class="w-64 p-4 p-5 bg-white shadow-md rounded-2xl">
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
    <div class="p-4 w-[500px] bg-white shadow-md rounded-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700">Sale VS Profit</h3>
            <span class="text-xs text-gray-500">Last 6 months</span>
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
                <span>10k</span>
            </div>

            <!-- X-axis labels -->
            <div class="absolute bottom-0 flex justify-between text-xs text-gray-500 left-10 right-10">
                <span>Dec</span>
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>May</span>
                <span>Jun</span>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="p-3 bg-white rounded-lg shadow-md">
        <div class="flex flex-col space-y-5">
            <button class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-box"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                <i class="fa-solid fa-truck"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-purple-600 rounded-md hover:bg-purple-700">
                <i class="fa-solid fa-receipt"></i>
            </button>
            <button class="w-full px-4 py-2 text-white bg-orange-600 rounded-md hover:bg-orange-700">
                <i class="fa-solid fa-user-plus"></i>
            </button>
        </div>
    </div>


</div>

<!-- Footer Branding -->
<footer class="py-4 text-sm text-center text-gray-400 border-t mt-15">
    © 2025 CKC Systems. All rights reserved.
</footer>