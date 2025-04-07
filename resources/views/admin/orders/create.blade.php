<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">

                    <div class="container mx-auto px-4 py-8">
                        <h1 class="text-2xl font-bold mb-6">Create New Order</h1>

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 p-3 rounded-lg mb-5">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div x-data="orderForm" x-init="init()">
                            <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="space-y-6">
                                @csrf

                                <!-- Customer Information -->
                                <div class="bg-white rounded-lg shadow p-6">
                                    <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Customer Information
                                    </h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="user_id"
                                                class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                                            <select id="user_id" name="user_id"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                                <option value="">Select Customer</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->fullname() }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- Address Selection -->
                                <div class="bg-white rounded-lg shadow p-6">
                                    <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Shipping Address</h2>

                                    <div class="space-y-4">
                                        <h3 class="font-medium text-gray-700">Select Address</h3>

                                        <!-- Validation Error for Address Selection -->
                                        @error('address_id', 'new_address')
                                            <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                                        @enderror

                                        <div class="space-y-3">
                                            @foreach ($addresses as $address)
                                                <label
                                                    class="flex items-start p-4 border rounded-lg hover:border-blue-400 cursor-pointer @error('address_id') border-red-500 @enderror">
                                                    <input type="radio" name="address_id" value="{{ $address->id }}"
                                                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                        {{ $address->is_default ? 'checked' : '' }}>
                                                    <div class="ml-3">
                                                        <div class="flex items-center">
                                                            <span
                                                                class="block font-medium text-gray-900">{{ $address->name }}</span>
                                                            @if ($address->is_default)
                                                                <span
                                                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                    Default
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="text-sm text-gray-500 mt-1">
                                                            <div>{{ $address->address1 }}</div>
                                                            @if ($address->address2)
                                                                <div>{{ $address->address2 }}</div>
                                                            @endif
                                                            <div>{{ $address->city }}, {{ $address->state }}
                                                                {{ $address->postalCode }}</div>
                                                            <div>{{ $address->country }}</div>
                                                            <div>Phone: {{ $user->phone }}</div>
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Add New Address Toggle -->
                                        <div x-data="{ open: false }" class="pt-2">
                                            <button @click="open = !open" type="button"
                                                class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                                <svg x-show="!open" class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <svg x-show="open" class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Add New Address
                                            </button>

                                            <!-- New Address Form -->
                                            <div x-show="open" x-transition
                                                class="mt-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <!-- Full Name -->
                                                    <div>
                                                        <label for="full_name"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Full
                                                            Name</label>
                                                        <input type="text" id="full_name" name="new_address[full_name]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                            value="{{ old('new_address.full_name') }}">
                                                        @error('new_address.full_name')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Phone -->
                                                    <div>
                                                        <label for="phone"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Phone
                                                            Number</label>
                                                        <input type="tel" id="phone" name="new_address[phone]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                                            value="{{ old('new_address.phone') }}">
                                                        @error('new_address.phone')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Address Line 1 -->
                                                    <div class="md:col-span-2">
                                                        <label for="address_line_1"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Address
                                                            Line 1</label>
                                                        <input type="text" id="address_line_1"
                                                            name="new_address[address_line_1]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                                            value="{{ old('new_address.address_line_1') }}">
                                                        @error('new_address.address_line_1')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Address Line 2 -->
                                                    <div class="md:col-span-2">
                                                        <label for="address_line_2"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Address
                                                            Line 2 (Optional)</label>
                                                        <input type="text" id="address_line_2"
                                                            name="new_address[address_line_2]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                            value="{{ old('new_address.address_line_2') }}">
                                                    </div>

                                                    <!-- City -->
                                                    <div>
                                                        <label for="city"
                                                            class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                        <input type="text" id="city" name="new_address[city]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                                            value="{{ old('new_address.city') }}">
                                                        @error('new_address.city')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- State -->
                                                    <div>
                                                        <label for="state"
                                                            class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                                        <input type="text" id="state" name="new_address[state]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                                            value="{{ old('new_address.state') }}">
                                                        @error('new_address.state')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Postal Code -->
                                                    <div>
                                                        <label for="postal_code"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Postal
                                                            Code</label>
                                                        <input type="text" id="postal_code"
                                                            name="new_address[postal_code]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                            value="{{ old('new_address.postal_code') }}">
                                                        @error('new_address.postal_code')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Country -->
                                                    <div>
                                                        <label for="country"
                                                            class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                                        <input type="text" id="country" name="new_address[country]"
                                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                                            value="{{ old('new_address.country') }}">
                                                        @error('new_address.country')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Default Address Checkbox -->
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="is_default"
                                                            name="new_address[is_default]" value="1"
                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                            {{ old('new_address.is_default') ? 'checked' : '' }}>
                                                        <label for="is_default"
                                                            class="ml-2 block text-sm text-gray-700">Set as default
                                                            address</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Order Items -->
                                <div class="bg-white rounded-lg shadow p-6">
                                    <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Order Items</h2>

                                    <div id="orderItems" class="space-y-4">
                                        <!-- Initial Item (Sample Structure) -->
                                        <div class="order-item p-4 border rounded-lg" data-index="0">
                                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                                <!-- Product Selection -->
                                                <div class="md:col-span-4">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                                    <select
                                                        class="product-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                        name="items[0][product_id]" required
                                                        @change="updateVariants($el)">
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->discounted_price }}"
                                                                data-colors="{{ $product->colors->toJson() }}"
                                                                data-sizes="{{ $product->sizes->toJson() }}">
                                                                {{ $product->name }} -
                                                                ${{ number_format($product->discounted_price, 2) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('items.0.product_id')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Quantity -->
                                                <div class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                                    <input type="number"
                                                        class="quantity w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                        name="items[0][quantity]" min="1" value="1" required
                                                        @input="calculateLineTotal($el)">
                                                    @error('items.0.quantity')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Color Selection (Dynamic) -->
                                                <div class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                                                    <select
                                                        class="color-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                        name="items[0][color_id]" required>
                                                        <option value="">Select Color</option>
                                                        <!-- Options will be populated via JavaScript -->
                                                    </select>
                                                    @error('items.0.color_id')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Size Selection (Dynamic) -->
                                                <div class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                                                    <select
                                                        class="size-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                        name="items[0][size_id]" required>
                                                        <option value="">Select Size</option>
                                                        <!-- Options will be populated via JavaScript -->
                                                    </select>
                                                    @error('items.0.size_id')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Price Display -->
                                                <div class="md:col-span-1">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                                    <input type="text"
                                                        class="price w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100"
                                                        name="items[0][price]" readonly>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="md:col-span-1">
                                                    <button type="button"
                                                        class="remove-item w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                        @click="removeItem($el)">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add Item Button -->
                                    <button type="button" id="addItem"
                                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        @click="addNewItem()">
                                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Add Item
                                    </button>
                                </div>

                                <!-- Order Summary -->
                                <div class="bg-white rounded-lg shadow p-6">
                                    <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Order Summary</h2>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <div class="mb-4">
                                                <label for="payment_type"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Payment
                                                    Type</label>
                                                <select id="payment_type" name="payment_type"
                                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    required>
                                                    <option value="cash"
                                                        {{ old('payment_type') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="credit_card"
                                                        {{ old('payment_type') == 'credit_card' ? 'selected' : '' }}>Credit
                                                        Card</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label for="cargo_company_id"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Shipping
                                                    Company</label>
                                                <select id="cargo_company_id" name="cargo_company_id"
                                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    required>
                                                    <option value="">Select Shipping Company</option>
                                                    @foreach ($cargoCompanies as $company)
                                                        <option value="{{ $company->id }}"
                                                            data-price="{{ $company->base_price ?? 0 }}"
                                                            {{ old('cargo_company_id') == $company->id ? 'selected' : '' }}>
                                                            {{ $company->name }}
                                                            (${{ number_format($company->base_price ?? 0, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="discount_id"
                                                        class="block text-sm font-medium mb-2">Discount
                                                        Code
                                                        (Optional)</label>
                                                    <select
                                                        class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                                        id="discount_id" name="discount_id">
                                                        <option value="">No Discount</option>
                                                        @foreach ($discounts as $discount)
                                                            <option value="{{ $discount->id }}"
                                                                data-value="{{ $discount->value }}"
                                                                data-type="{{ $discount->type }}"
                                                                {{ old('discount_id') == $discount->id ? 'selected' : '' }}>
                                                                {{ $discount->code }}
                                                                ({{ $discount->type == 'amount' ? '$' . number_format($discount->value, 2) : $discount->value . '%' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div>
                                            <div class="border rounded-lg p-4">
                                                <div class="space-y-2">
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Subtotal:</span>
                                                        <span id="subtotal" class="font-medium">$0.00</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Shipping:</span>
                                                        <span id="shipping" class="font-medium">$0.00</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Discount:</span>
                                                        <span id="discount"
                                                            class="font-medium text-red-600">-$0.00</span>
                                                    </div>
                                                    <div class="border-t border-gray-200 my-2"></div>
                                                    <div class="flex justify-between text-lg font-bold">
                                                        <span>Total:</span>
                                                        <span id="total" class="text-blue-600">$0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex justify-end space-x-4">
                                    <a href="{{ route('orders.index') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Create Order
                                    </button>
                                </div>
                            </form>

                        </div>


                    </div>

                    <!-- Alpine.js Script -->
                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('orderForm', () => ({
                                itemCount: 1,
                                subtotal: 0,
                                shippingCost: 0,
                                discountAmount: 0,
                                total: 0,


                                init() {
                                    this.calculateTotals();
                                    // console.log('Alpine.js initialized for order form');

                                    // Initialize first product's variants if preselected
                                    const initialProduct = document.querySelector('.product-select');
                                    if (initialProduct.value) {
                                        this.updateVariants(initialProduct);
                                    }
                                },

                                addNewItem() {
                                    const newItem = document.querySelector('.order-item').cloneNode(true);
                                    const newIndex = this.itemCount++;

                                    // Update all attributes and names
                                    newItem.innerHTML = newItem.innerHTML
                                        .replace(/items\[0\]/g, `items[${newIndex}]`)
                                        .replace(/items\.0\./g, `items.${newIndex}.`);

                                    newItem.setAttribute('data-index', newIndex);
                                    document.getElementById('orderItems').appendChild(newItem);

                                    // Reset the new item
                                    newItem.querySelector('.product-select').value = '';
                                    newItem.querySelector('.quantity').value = 1;
                                    newItem.querySelector('.price').value = '';
                                    newItem.querySelector('.color-select').innerHTML =
                                        '<option value="">Select Color</option>';
                                    newItem.querySelector('.size-select').innerHTML =
                                        '<option value="">Select Size</option>';
                                },

                                removeItem(button) {
                                    const items = document.querySelectorAll('.order-item');
                                    if (items.length > 1) {
                                        button.closest('.order-item').remove();
                                        this.calculateTotals();
                                    } else {
                                        alert('You must have at least one item in your order.');
                                    }
                                },

                                updateVariants(select) {
                                    const item = select.closest('.order-item');
                                    const selectedOption = select.options[select.selectedIndex];
                                    const colors = JSON.parse(selectedOption.getAttribute('data-colors') || '[]');
                                    const sizes = JSON.parse(selectedOption.getAttribute('data-sizes') || '[]');

                                    // Update color options
                                    const colorSelect = item.querySelector('.color-select');
                                    colorSelect.innerHTML = '<option value="">Select Color</option>' +
                                        colors.map(color => `<option value="${color.id}">${color.name}</option>`).join(
                                            '');

                                    // Update size options
                                    const sizeSelect = item.querySelector('.size-select');
                                    sizeSelect.innerHTML = '<option value="">Select Size</option>' +
                                        sizes.map(size => `<option value="${size.id}">${size.name}</option>`).join('');

                                    // Update price
                                    const priceInput = item.querySelector('.price');
                                    priceInput.value = parseFloat(selectedOption.getAttribute('data-price') || 0)
                                        .toFixed(2);

                                    this.calculateTotals();
                                },

                                calculateLineTotal(input) {
                                    const item = input.closest('.order-item');
                                    const price = parseFloat(item.querySelector('.price').value) || 0;
                                    const quantity = parseInt(input.value) || 0;

                                    return price * quantity;
                                },

                                calculateTotals() {
                                    // Calculate items subtotal
                                    this.subtotal = Array.from(document.querySelectorAll('.order-item'))
                                        .reduce((sum, item) => {
                                            const price = parseFloat(item.querySelector('.price').value) || 0;
                                            const quantity = parseInt(item.querySelector('.quantity').value) || 0;
                                            return sum + (price * quantity);
                                        }, 0);

                                    // Get shipping cost
                                    const shippingSelect = document.getElementById('cargo_company_id');
                                    const shippingOption = shippingSelect?.options[shippingSelect.selectedIndex];
                                    this.shippingCost = shippingOption ? parseFloat(shippingOption.getAttribute(
                                        'data-price')) || 0 : 0;

                                    // Get discount
                                    const discountSelect = document.getElementById('discount_id');
                                    const discountId = discountSelect?.value;
                                    this.discountAmount = 0;

                                    if (discountId) {
                                        const discountOption = document.querySelector(
                                            `#discount_id option[value="${discountId}"]`);
                                        const discountType = discountOption?.getAttribute('data-type');
                                        const discountValue = parseFloat(discountOption?.getAttribute('data-value')) ||
                                            0;

                                        if (discountType === 'percentage') {
                                            this.discountAmount = this.subtotal * (discountValue / 100);
                                        } else if (discountType === 'fixed') {
                                            this.discountAmount = discountValue;
                                        }
                                    }

                                    // Calculate total
                                    this.total = this.subtotal + this.shippingCost - this.discountAmount;

                                    // Update display
                                    document.getElementById('subtotal').textContent = '$' + this.subtotal.toFixed(2);
                                    document.getElementById('shipping').textContent = '$' + this.shippingCost.toFixed(
                                        2);
                                    document.getElementById('discount').textContent = '-$' + this.discountAmount
                                        .toFixed(2);
                                    document.getElementById('total').textContent = '$' + this.total.toFixed(2);
                                }
                            }));
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
