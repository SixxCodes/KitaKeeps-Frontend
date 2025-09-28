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
    <div class="flex items-center space-x-2">
        <i class="text-blue-800 fa-solid fa-filter"></i>
        <div class="flex items-center px-2 py-1 bg-white rounded shadow w-25 sm:px-5 sm:py-1 md:px-3 md:py-2 sm:w-50 md:w-52">
            <i class="mr-2 text-blue-400 fa-solid fa-magnifying-glass"></i>
            <input
                type="text" 
                placeholder="Search..." 
                class="w-full py-0 text-sm bg-white border-none outline-none sm:py-0 md:py-1"
            />
        </div>
    </div>
</div>








<!-- POS (Point of Sale) -->
<div class="flex flex-col mt-8 space-y-6 lg:flex-row lg:space-x-2 lg:space-y-0">
    <!-- Left: Product Listing -->
    <div class="w-full lg:w-2/3">
        
        <!-- Categories -->
        <div class="flex pb-2 space-x-2 overflow-x-auto table-pretty-scrollbar">
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                All
            </button>
            <button class="px-4 py-1 text-sm text-white bg-blue-500 rounded-full shadow ellipses whitespace-nowrap">
                Paint
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Cement
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Plumbing
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Electrical
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Furniture
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Plywoods
            </button>
            <button class="px-4 py-1 text-sm bg-white rounded-full shadow ellipses whitespace-nowrap">
                Flooring
            </button>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 gap-4 mt-4 sm:grid-cols-3 md:grid-cols-4">
            @foreach($branch->branchproducts as $branchProduct)
                @php
                    $product  = $branchProduct->product;
                    $supplier = $product->product_supplier->first()?->supplier;
                @endphp

                <div class="p-4 bg-white rounded shadow cursor-pointer hover:bg-gray-100"
                    onclick="addToCart(
                        {{ $product->product_id }},
                        '{{ $product->prod_name }}',
                        {{ $branchProduct->stock_qty }},
                        {{ $product->selling_price }},
                        '{{ $product->prod_image_path ? asset('storage/'.$product->prod_image_path) : '' }}'
                    )">
                    <div class="flex items-center justify-center w-full h-24 bg-blue-200 rounded">
                        @if($product->prod_image_path)
                            <img src="{{ asset('storage/'.$product->prod_image_path) }}" class="object-cover w-full h-full rounded">
                        @else
                            <i class="text-white fa-solid fa-box fa-2x"></i>
                        @endif
                    </div>
                    <div class="mt-2 text-sm font-bold">{{ $product->prod_name }}</div>
                    <div class="text-xs text-gray-500">{{ $supplier->supp_name ?? 'No Supplier' }}</div>
                    <div class="text-xs text-gray-500">Stock: {{ $branchProduct->stock_qty }}</div>
                    <div class="mt-1 font-semibold">₱{{ number_format($product->selling_price, 2) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Right: Order Details -->
    <div class="w-full p-4 bg-white rounded shadow lg:w-1/3">
        <form onsubmit="checkout(); return false;">
            @csrf

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Order Details</h2>
                <!-- Payment -->
                <select id="payment" class="px-2 py-1 text-sm border rounded">
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                </select>
            </div>

            <!-- Cart Items -->
            <div id="cart-items" class="pr-1 space-y-2 overflow-y-auto max-h-48">
                <!-- JS will render cart here -->
            </div>

            <!-- Shipping Fee -->
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm">Shipping Fee</span>
                <select id="shipping_fee" class="px-2 py-1 text-sm border rounded">
                    <option value="50">₱50</option>
                    <option value="100">₱100</option>
                </select>
            </div>

            <!-- Total -->
            <div class="flex items-center justify-between mt-2 font-bold">
                <span>Total</span>
                <span id="cart-total">₱0</span>
            </div>

            <!-- Button -->
            <button type="submit" class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md shadow hover:bg-blue-800">
                Proceed
            </button>
        </form>
    </div>

</div>

<script>
    let cart = [];

    function addToCart(productId, name, stock, price, image) {
        let item = cart.find(i => i.product_id === productId);

        if(item) {
            if(item.quantity < stock) {
                item.quantity++;
            } else {
                showStockModal("⚠ Not enough stock available!");
            }
        } else {
            if(stock > 0) {
                cart.push({ product_id: productId, name, stock, quantity: 1, price, image });
            } else {
                showStockModal("⚠ This product is out of stock!");
            }
        }

        renderCart();
    }

    function showStockModal(message) {
        // put the message inside the modal body
        document.getElementById("stock-issue-message").textContent = message;

        // open modal using your reusable system
        window.dispatchEvent(new CustomEvent("open-modal", { detail: "stock-issue" }));
    }

    function renderCart() {
        let cartDiv = document.getElementById("cart-items");
        cartDiv.innerHTML = "";

        let total = 0;
        cart.forEach(item => {
            let subtotal = item.quantity * item.price;
            total += subtotal;

            cartDiv.innerHTML += `
                <div class="flex items-center justify-between p-2 bg-white rounded shadow">
                    <div class="flex items-center space-x-2">
                        ${item.image ? 
                            `<img src="${item.image}" class="object-cover w-10 h-10 rounded">` : 
                            `<div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded"><i class='text-gray-500 fa-solid fa-box'></i></div>`
                        }
                        <div>
                            <div class="text-sm font-semibold">${item.name}</div>
                            <div class="text-xs text-gray-500">Qty: ${item.quantity}x</div>
                            <div class="text-xs text-gray-500">Unit Price: ₱${item.price}</div>
                            <div class="text-xs text-gray-400">Stock left: ${item.stock - item.quantity}</div>
                        </div>
                    </div>
                    <div class="font-semibold">₱${subtotal}</div>
                </div>
            `;
        });

        document.getElementById("cart-total").innerText = "₱" + total;
    }

    function checkout() {
        fetch("{{ route('pos.checkout') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                items: cart,
                payment_method: document.getElementById("payment").value,
                shipping_fee: document.getElementById("shipping_fee").value
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.error){
                alert("❌ " + data.error);
            } else {
                alert("✅ " + data.message);
                cart = [];
                renderCart();
                location.reload(); // refresh stock display
            }
        });
    }
</script>

<!-- Stock Warning Modal -->
<x-modal name="stock-issue" :show="false" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-bold text-red-600">⚠ Stock Issue</h2>
        <p id="stock-issue-message" class="mt-2 text-sm text-gray-700"></p>
        <div class="mt-4 text-right">
            <button 
                type="button"
                x-on:click="$dispatch('close-modal', 'stock-issue')" 
                class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                Close
            </button>
        </div>
    </div>
</x-modal>
