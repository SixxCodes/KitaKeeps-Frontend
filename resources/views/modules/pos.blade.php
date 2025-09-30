@php
    use App\Models\Product;

    $owner = auth()->user();

    // Get current branch from session (or fallback to first branch)
    $userBranches  = $owner->branches;
    $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
                    ?? $userBranches->sortBy('branch_id')->first();

    // Selected category from query string (?category=...)
    $selectedCategory = request('category');

    // Distinct categories for this branch
    $categories = Product::whereHas('branch_products', function($q) use ($currentBranch) {
            $q->where('branch_id', $currentBranch->branch_id);
        })
        ->whereNotNull('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    // Products for POS, filtered by branch + optional category
    $posProducts = Product::with([
            'product_supplier.supplier',
            'branch_products' => function($q) use ($currentBranch) {
                $q->where('branch_id', $currentBranch->branch_id);
            }
        ])
        ->whereHas('branch_products', function($q) use ($currentBranch) {
            $q->where('branch_id', $currentBranch->branch_id);
        })
        ->when($selectedCategory, function($q) use ($selectedCategory) {
            $q->where('category', $selectedCategory);
        })
        ->when(request('pos_search'), function ($q, $posSearch) {
            $q->where('prod_name', 'like', "%{$posSearch}%")
            ->orWhere('category', 'like', "%{$posSearch}%");
        })
        ->orderBy('product_id', 'asc')
        ->get();
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

    <!-- Search Bar --> 
    <form method="GET" action="{{ url()->current() }}" class="flex items-center space-x-2">
        <i class="text-blue-800 fa-solid fa-filter"></i>
        <div class="flex items-center px-2 py-1 bg-white rounded shadow w-25 sm:px-5 sm:py-1 md:px-3 md:py-2 sm:w-50 md:w-52">
            <i class="mr-2 text-blue-400 fa-solid fa-magnifying-glass"></i>
            <input
                type="text" 
                name="pos_search"
                value="{{ request('pos_search') }}"
                placeholder="Search..." 
                class="w-full py-0 text-sm bg-white border-none outline-none sm:py-0 md:py-1"
            />
        </div>
    </form>
</div>








<!-- POS (Point of Sale) -->
<div class="flex flex-col mt-8 space-y-6 lg:flex-row lg:space-x-2 lg:space-y-0">
    <!-- Left: Product Listing -->
    <div class="w-full lg:w-2/3">
        
        <!-- Categories -->
        <div class="flex pb-2 space-x-2 overflow-x-auto whitespace-nowrap">
            <a href="{{ url()->current() }}" 
            class="whitespace-nowrap px-4 py-1 text-sm rounded-full {{ request('category') ? 'bg-white' : 'bg-blue-500 text-white' }}">
                All
            </a>

            @foreach($categories as $category)
                <a href="{{ url()->current() }}?category={{ urlencode($category) }}" 
                class="whitespace-nowrap px-4 py-1 text-sm rounded-full {{ request('category') == $category ? 'bg-blue-500 text-white' : 'bg-white' }}">
                    {{ $category }}
                </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 gap-4 mt-4 overflow-y-auto sm:grid-cols-3 md:grid-cols-4" style="max-height: 75vh;">
            @forelse($posProducts as $product)
            <!-- Card -->
            <div class="p-4 bg-white bg-gray-100 rounded shadow cursor-pointer hover:shadow-lg hover:bg-gray-100">
                <div class="flex items-center justify-center w-full h-24 bg-blue-300 rounded">
                    @if($product->prod_image_path)
                        <img src="{{ asset('storage/'.$product->prod_image_path) }}" 
                                alt="{{ $product->product_name }}" 
                                class="object-cover w-full h-full rounded">
                    @else
                        <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-200 rounded-full">
                            <i class="fa-solid fa-box fa-2x"></i>
                        </div>
                    @endif
                </div>
                <div class="mt-2 text-sm font-bold">{{ $product->prod_name }}</div>
                <div class="text-xs text-gray-500">{{ $product->product_supplier->first()?->supplier?->supp_name ?? 'N/A' }}</div>
                <div class="text-xs text-gray-500">Stocks: {{ $product->branch_products->first()?->stock_qty ?? 0 }}</div>
                <div class="mt-1 font-semibold">₱{{ number_format($product->selling_price, 2) }}</div>
            </div>
            @empty
            <div class="col-span-4 px-3 py-2 text-center">
                <span class="text-gray-500">Nothing to see here yet.</span>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Right: Order Details -->
    <div class="w-full p-4 bg-white rounded shadow lg:w-1/3">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Order Details</h2>
            <!-- Dropdown Cash -->
            <select class="px-2 py-1 text-sm border rounded">
                <option>Cash</option>
                <option>Credit</option>
            </select>
        </div>

        <div class="flex flex-col">
            <!-- Order Items (scrollable if many) -->
            <div class="pr-1 space-y-2 overflow-y-auto max-h-48">

                <div class="flex items-center justify-between p-2 bg-white rounded shadow">
                    <div>
                        <div class="text-sm font-semibold">Product Name</div>
                        <div class="text-xs text-gray-500">Supplier Name</div>
                        <div class="text-xs text-gray-500">3x</div>
                    </div>
                    <div class="font-semibold">₱35</div>
                </div>
                
                <div class="flex items-center justify-between p-2 bg-white rounded shadow">
                    <div>
                        <div class="text-sm font-semibold">Product Name</div>
                        <div class="text-xs text-gray-500">Supplier Name</div>
                        <div class="text-xs text-gray-500">3x</div>
                    </div>
                    <div class="font-semibold">₱35</div>
                </div>
            </div>

            <!-- Shipping Fee -->
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm">Shipping Fee</span>
                    <select class="px-2 py-1 text-sm border rounded">
                        <option>₱50</option>
                        <option>₱100</option>
                    </select>
                </div>

                <!-- Total -->
                <div class="flex items-center justify-between mt-2 font-bold">
                <span>Total</span>~
                <span>₱155</span>
            </div>
        </div>

        <!-- Button -->
        <button class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md shadow hover:bg-blue-800">
        Proceed
        </button>
    </div>
</div>
