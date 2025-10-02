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
            $q->where('prod_name', 'like', "%{$posSearch}%");
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

                @php
                    $branchProduct = $product->branch_products->first();
                @endphp

                <!-- Card -->
                <div class="p-4 bg-white rounded shadow cursor-pointer hover:shadow-lg hover:bg-gray-100"
                    onclick="addToCart(
                    {{ $product->product_id }},
                    '{{ $product->prod_name }}',
                    {{ $branchProduct->stock_qty ?? 0 }},
                    {{ $product->selling_price }},
                    '{{ $product->prod_image_path ? asset('storage/'.$product->prod_image_path) : '' }}',
                    '{{ $product->product_supplier->first()?->supplier?->supp_name ?? 'N/A' }}'
                    )">
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
    <div class="flex flex-col justify-between w-full p-4 bg-white rounded shadow lg:w-1/3">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Order Details</h2>
            </div>

            <div class="flex flex-col">
                <!-- Order Items -->
                <div id="order-items" class="pr-1 space-y-2 overflow-y-auto max-h-80"></div>
            </div>
        </div>

        <div>
            <!-- Payment Method -->
            <div class="flex items-center justify-between mt-2">
                <span class="text-sm">Payment Method</span>
                <select class="py-1 text-sm border rounded" id="payment-method" onchange="handlePaymentChange(this)">
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Shipping Fee -->
            <div class="flex items-center justify-between mt-2">
                <span class="text-sm">Shipping Fee</span>
                <select class="py-1 text-sm border rounded" id="shipping" onchange="renderCart()">
                    <option value="0">No Delivery</option>
                    <option value="50">₱50</option>
                    <option value="70">₱70</option>
                    <option value="100">₱100</option>
                </select>
            </div>

            <!-- Total -->
            <div class="flex items-center justify-between mt-2 font-bold">
                <span>Total</span>
                <span id="order-total">₱0.00</span>
            </div>
            
            <!-- Button -->
            <button class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md shadow hover:bg-blue-800">
                Proceed
            </button>
        </div>
    </div>
</div>

<!-- No Stock Modal -->
<x-modal name="no-stock" :show="false" maxWidth="sm">
    <div class="p-6 text-center">
        <h2 class="mb-4 text-lg font-bold text-red-600">No more stock available!</h2>
        <button 
            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
            x-on:click="$dispatch('close-modal', 'no-stock')">
            OK
        </button>
    </div>
</x-modal>

<script>
    let cart = JSON.parse(localStorage.getItem("cart")) || {};

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function addToCart(id, name, stock, price, image) {
        if (!cart[id]) {
            cart[id] = { id, name, qty: 1, stock, price, image };
        } else {
            if (cart[id].qty < stock) {
                cart[id].qty++;
            } else {
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'no-stock' }));
                return;
            }
        }
        saveCart();
        renderCart();
    }

    function renderCart() {
        const container = document.querySelector("#order-items");
        container.innerHTML = "";

        // ✅ Clean out zero-qty items (just in case)
        for (const id in cart) {
            if (cart[id].qty <= 0) {
                delete cart[id];
            }
        }

        Object.values(cart).forEach(item => {
            let div = document.createElement("div");
            div.className = "flex items-center justify-between p-2 bg-white rounded shadow";

            div.innerHTML = `
                <div class="flex items-center gap-3">
                    <!-- Image -->
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded">
                        <img src="${item.image ?? '/placeholder.png'}" 
                            alt="${item.name}" 
                            class="object-cover w-full h-full rounded">
                    </div>

                    <!-- Product Info -->
                    <div>
                        <div class="text-sm font-semibold">${item.name}</div>
                        <div class="text-xs text-gray-500">Unit Price: ₱${item.price}</div>
                        <div class="text-xs text-gray-500">Stock left: ${item.stock - item.qty}x</div>
                    </div>
                </div>

                <!-- Subtotal + Qty controls -->
                <div class="flex flex-col items-end">
                    <div class="font-semibold">₱${(item.price * item.qty).toFixed(2)}</div>
                    <div class="flex items-center gap-2 mt-1">
                        <button class="px-2 py-1 text-sm bg-gray-200 rounded qty-decrease" data-id="${item.id}">-</button>
                        <span class="text-sm font-medium">${item.qty}</span>
                        <button class="px-2 py-1 text-sm bg-gray-200 rounded qty-increase" data-id="${item.id}">+</button>
                    </div>
                </div>
            `;

            saveCart();
            container.appendChild(div);
        });

        document.querySelectorAll(".qty-decrease").forEach(btn => {
            btn.addEventListener("click", () => {
                let id = btn.dataset.id;
                if (cart[id].qty > 1) {
                    cart[id].qty--;
                } else {
                    delete cart[id]; // remove if qty goes to 0
                }
                saveCart();   // ✅ save the cleaned cart
                renderCart(); // re-render cart
            });
        });

        document.querySelectorAll(".qty-increase").forEach(btn => {
            btn.addEventListener("click", () => {
                let id = btn.dataset.id;
                if (cart[id].qty < cart[id].stock) {
                    cart[id].qty++;
                    saveCart();  // save after increasing
                } else {
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: 'no-stock' }));
                    return;
                }
                renderCart(); // re-render cart
            });
        });

        // ✅ Calculate total with shipping
        const subtotal = Object.values(cart).reduce((sum, item) => sum + (item.qty * item.price), 0);
        const shippingFee = parseFloat(document.querySelector("#shipping")?.value || 0);
        const total = subtotal + shippingFee;

        document.querySelector("#order-total").textContent = "₱" + total.toFixed(2);
    }

    document.addEventListener("DOMContentLoaded", function() {
        cart = JSON.parse(localStorage.getItem("cart")) || {};
        renderCart(); // 👈 redraw cart on page load
    });
</script>

<!-- Credit Modal -->
<x-modal name="credit-modal" :show="false" maxWidth="sm">
    <div class="p-6 overflow-y-auto" style="max-height: 80vh;">
        <h2 class="text-lg font-bold text-blue-600">Add Customer</h2>
        <p class="mb-4 text-gray-700">Add a customer to confirm credited order:</p>

        <!-- Search bar -->
        <div class="relative">
            <input
                placeholder="Search for customers..."
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
            >
            <span class="absolute right-3 top-2.5 text-gray-400">
                <i class="mr-2 text-blue-400 fa-solid fa-magnifying-glass"></i>
            </span>
        </div>

        <!-- Button -->
        <button class="w-full py-2 mt-2 mb-4 text-white bg-blue-600 rounded-md shadow hover:bg-blue-800">
            Add new customer
        </button>

        <div class="flex items-center p-2 mb-4 space-x-3 rounded shadow cursor-pointer hover:bg-gray-300">
            <div class="flex items-center justify-center w-10 h-10 text-white bg-gray-400 rounded-full">
                👤
            </div>
            <div>
                <div class="font-medium text-gray-800">Customer Name</div>
                <div class="text-xs text-gray-500">Customer Address, Philippines</div>
                <div class="text-xs text-gray-500">Total Credits: 3</div>
            </div>
        </div>

        <div class="flex items-center p-2 mb-4 space-x-3 rounded shadow cursor-pointer hover:bg-gray-300">
            <div class="flex items-center justify-center w-10 h-10 text-white bg-gray-400 rounded-full">
                👤
            </div>
            <div>
                <div class="font-medium text-gray-800">Customer Name</div>
                <div class="text-xs text-gray-500">Customer Address, Philippines</div>
                <div class="text-xs text-gray-500">Total Credits: 3</div>
            </div>
        </div>

        <div class="flex items-center p-2 mb-4 space-x-3 rounded shadow cursor-pointer hover:bg-gray-300">
            <div class="flex items-center justify-center w-10 h-10 text-white bg-gray-400 rounded-full">
                👤
            </div>
            <div>
                <div class="font-medium text-gray-800">Customer Name</div>
                <div class="text-xs text-gray-500">Customer Address, Philippines</div>
                <div class="text-xs text-gray-500">Total Credits: 3</div>
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <!-- Close button -->
            <button 
                class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300"
                x-on:click="$dispatch('close-modal', 'credit-modal')">
                Close
            </button>

            <div class="flex justify-end">
                <button 
                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
                    x-on:click="$dispatch('close-modal', 'credit-modal')">
                    Save
                </button>
            </div>
        </div>
    </div>
</x-modal>

<script>
    function handlePaymentChange(select) {
        const value = select.value;

        if (value === "Credit") {
            // open the credit modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'credit-modal' }));
        }
    }
</script>