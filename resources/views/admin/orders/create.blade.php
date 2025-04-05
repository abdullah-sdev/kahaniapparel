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

                            {{-- <!-- Address Selection -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Shipping Address</h2>

                                <div class="space-y-4">
                                    <h3 class="font-medium text-gray-700">Select Address</h3>

                                    <div class="space-y-3">
                                        @foreach ($addresses as $address)
                                            <label
                                                class="flex items-start p-4 border rounded-lg hover:border-blue-400 cursor-pointer">
                                                <input type="radio" name="address_id" value="{{ $address->id }}"
                                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                    {{ $address->is_default ? 'checked' : '' }} required>
                                                <div class="ml-3">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="block font-medium text-gray-900">{{ $address->name }}</span>
                                                        @if ($address->is_default)
                                                            <span
                                                                class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Default</span>
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
                                                <div>
                                                    <label for="full_name"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Full
                                                        Name</label>
                                                    <input type="text" id="full_name" name="new_address[full_name]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label for="phone"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Phone
                                                        Number</label>
                                                    <input type="tel" id="phone" name="new_address[phone]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div class="md:col-span-2">
                                                    <label for="address_line_1"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Address
                                                        Line 1</label>
                                                    <input type="text" id="address_line_1"
                                                        name="new_address[address_line_1]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div class="md:col-span-2">
                                                    <label for="address_line_2"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Address
                                                        Line 2 (Optional)</label>
                                                    <input type="text" id="address_line_2"
                                                        name="new_address[address_line_2]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label for="city"
                                                        class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                    <input type="text" id="city" name="new_address[city]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label for="state"
                                                        class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                                    <input type="text" id="state" name="new_address[state]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label for="postal_code"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Postal
                                                        Code</label>
                                                    <input type="text" id="postal_code"
                                                        name="new_address[postal_code]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label for="country"
                                                        class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                                    <input type="text" id="country" name="new_address[country]"
                                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" id="is_default"
                                                        name="new_address[is_default]" value="1"
                                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                    <label for="is_default"
                                                        class="ml-2 block text-sm text-gray-700">Set as default
                                                        address</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
                <label class="flex items-start p-4 border rounded-lg hover:border-blue-400 cursor-pointer
                    @error('address_id') border-red-500 @enderror">
                    <input type="radio" name="address_id" value="{{ $address->id }}"
                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                        {{ $address->is_default ? 'checked' : '' }}>
                    <div class="ml-3">
                        <div class="flex items-center">
                            <span class="block font-medium text-gray-900">{{ $address->name }}</span>
                            @if ($address->is_default)
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Default
                                </span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            <div>{{ $address->address1 }}</div>
                            @if ($address->address2)
                                <div>{{ $address->address2 }}</div>
                            @endif
                            <div>{{ $address->city }}, {{ $address->state }} {{ $address->postalCode }}</div>
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
                <svg x-show="!open" class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <svg x-show="open" class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                Add New Address
            </button>

            <!-- New Address Form -->
            <div x-show="open" x-transition class="mt-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="full_name" name="new_address[full_name]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.full_name') border-red-500 @enderror"
                            value="{{ old('new_address.full_name') }}">
                        @error('new_address.full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="new_address[phone]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.phone') border-red-500 @enderror"
                            value="{{ old('new_address.phone') }}">
                        @error('new_address.phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Line 1 -->
                    <div class="md:col-span-2">
                        <label for="address_line_1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                        <input type="text" id="address_line_1" name="new_address[address_line_1]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.address_line_1') border-red-500 @enderror"
                            value="{{ old('new_address.address_line_1') }}">
                        @error('new_address.address_line_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Line 2 -->
                    <div class="md:col-span-2">
                        <label for="address_line_2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                        <input type="text" id="address_line_2" name="new_address[address_line_2]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('new_address.address_line_2') }}">
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" id="city" name="new_address[city]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.city') border-red-500 @enderror"
                            value="{{ old('new_address.city') }}">
                        @error('new_address.city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State -->
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                        <input type="text" id="state" name="new_address[state]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.state') border-red-500 @enderror"
                            value="{{ old('new_address.state') }}">
                        @error('new_address.state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                        <input type="text" id="postal_code" name="new_address[postal_code]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.postal_code') border-red-500 @enderror"
                            value="{{ old('new_address.postal_code') }}">
                        @error('new_address.postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" id="country" name="new_address[country]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('new_address.country') border-red-500 @enderror"
                            value="{{ old('new_address.country') }}">
                        @error('new_address.country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Default Address Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_default" name="new_address[is_default]" value="1"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('new_address.is_default') ? 'checked' : '' }}>
                        <label for="is_default" class="ml-2 block text-sm text-gray-700">Set as default address</label>
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
                                    <!-- Initial Item -->
                                    <div class="order-item p-4 border rounded-lg">
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                            <div class="md:col-span-5">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                                <select
                                                    class="product-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    name="items[0][product_id]" required>
                                                    <option value="">Select Product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            data-price="{{ $product->discounted_price }}">
                                                            {{ $product->name }} -
                                                            ${{ number_format($product->discounted_price, 2) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                                <input type="number"
                                                    class="quantity w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    name="items[0][quantity]" min="1" value="1" required>
                                            </div>

                                            <div class="md:col-span-3">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                                <input type="text"
                                                    class="price w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100"
                                                    name="items[0][price]" readonly>
                                            </div>

                                            <div class="md:col-span-2">
                                                <button type="button"
                                                    class="remove-item w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="addItem"
                                    class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
                                        {{-- <div>
                                            <label for="discount_id" class="block text-sm font-medium text-gray-700 mb-1">Discount Code (Optional)</label>
                                            <select id="discount_id" name="discount_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">No Discount</option>
                                                @foreach ($discounts as $discount)
                                                    <option value="{{ $discount->id }}" {{ old('discount_id', '') == $discount->id ? 'selected' : '' }}>
                                                        {{ $discount->code }} ({{ $discount->type == 'fixed' ? '$'.$discount->amount : $discount->amount.'%' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
                    {{-- <div class="container py-4 px-2">
                        <h1 class="mb-4 text-3xl font-bold">Create New Order</h1>

                        <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 gap-4">
                                <!-- Customer Information Section -->
                                <div class="bg-white rounded-lg shadow p-4">
                                    <div class="font-bold text-lg mb-2">Customer Information</div>
                                    <div class="mb-3">
                                        <label for="user_id" class="block text-sm font-medium mb-2">Customer</label>
                                        <select
                                            class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                            id="user_id" name="user_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->fullname() }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address_id" class="block text-sm font-medium mb-2">Shipping
                                            Address</label>
                                        <select
                                            class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                            id="address_id" name="address_id" required>
                                            <option value="">Select Address</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}"
                                                    {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                                    {{ $address->address1 }}, {{ $address->city }},
                                                    {{ $address->state }}
                                                    {{ $address->postal_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Order Items Section -->
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <div class="font-bold text-lg mb-2">Order Items</div>
                                    <div id="orderItems">
                                        <!-- Items will be added here dynamically -->
                                        <div class="order-item mb-3 p-3 border rounded">
                                            <div class="grid grid-cols-12 gap-3">
                                                <div class="col-span-5">
                                                    <label class="block text-sm font-medium mb-2">Product</label>
                                                    <select
                                                        class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 product-select"
                                                        name="items[0][product_id]" required>
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->discounted_price }}">
                                                                {{ $product->name }} -
                                                                ${{ number_format($product->discounted_price, 2) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block text-sm font-medium mb-2">Quantity</label>
                                                    <input type="number"
                                                        class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 quantity"
                                                        name="items[0][quantity]" min="1" value="1"
                                                        required>
                                                </div>
                                                <div class="col-span-3">
                                                    <label class="block text-sm font-medium mb-2">Price</label>
                                                    <input type="text"
                                                        class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 price"
                                                        name="items[0][price]" readonly>
                                                </div>
                                                <div class="col-span-2 flex items-end">
                                                    <button type="button"
                                                        class="remove-item inline-flex items-center px-2 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" id="addItem"
                                        class="mt-3 px-2 py-1 rounded text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-indigo-500">Add
                                        Item</button>
                                </div>

                                <!-- Order Summary Section -->
                                <div class="bg-white rounded-lg shadow p-4">
                                    <div class="font-bold text-lg mb-2">Order Summary</div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="payment_type" class="block text-sm font-medium mb-2">Payment
                                                Type</label>
                                            <select
                                                class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                                id="payment_type" name="payment_type" required>
                                                <option value="cash"
                                                    {{ old('payment_type') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="credit_card"
                                                    {{ old('payment_type') == 'credit_card' ? 'selected' : '' }}>Credit
                                                    Card</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cargo_company_id"
                                                class="block text-sm font-medium mb-2">Shipping
                                                Company</label>
                                            <select
                                                class="block w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                                id="cargo_company_id" name="cargo_company_id" required>
                                                <option value="">Select Shipping Company</option>
                                                @foreach ($cargoCompanies as $company)
                                                    <option value="{{ $company->id }}"
                                                        data-price="{{ $company->base_price }}"
                                                        {{ old('cargo_company_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                        (${{ number_format($company->base_price, 2) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="discount_id" class="block text-sm font-medium mb-2">Discount
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

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td id="subtotal">$0.00</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td id="shipping">$0.00</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td id="discount">-$0.00</td>
                                            </tr>
                                            <tr class="h4">
                                                <th>Total:</th>
                                                <td id="total">$0.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="flex gap-3 justify-end">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Create Order
                                    </button>
                                    <a href="{{ route('orders.index') }}"
                                        class="inline-flex justify-center py-2 px-4 border-black shadow-sm text-sm font-medium rounded-md text-white bg-slate-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Cancel
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div> --}}


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let itemCount = 1;

                            // Add new item
                            document.getElementById('addItem').addEventListener('click', function() {
                                const newItem = document.querySelector('.order-item').cloneNode(true);
                                newItem.innerHTML = newItem.innerHTML.replace(/items\[0\]/g, `items[${itemCount}]`);
                                newItem.querySelector('.product-select').value = '';
                                newItem.querySelector('.quantity').value = 1;
                                newItem.querySelector('.price').value = '';
                                document.getElementById('orderItems').appendChild(newItem);
                                itemCount++;
                            });

                            // Remove item
                            document.addEventListener('click', function(e) {
                                if (e.target.classList.contains('remove-item')) {
                                    if (document.querySelectorAll('.order-item').length > 1) {
                                        e.target.closest('.order-item').remove();
                                        calculateTotals();
                                    } else {
                                        alert('You must have at least one item in your order.');
                                    }
                                }
                            });

                            // Product selection change
                            document.addEventListener('change', function(e) {
                                if (e.target.classList.contains('product-select')) {
                                    const selectedOption = e.target.options[e.target.selectedIndex];
                                    const price = selectedOption.getAttribute('data-price');
                                    if (price) {
                                        e.target.closest('.order-item').querySelector('.price').value = price;
                                        calculateTotals();
                                    }
                                }
                            });

                            // Quantity change
                            document.addEventListener('input', function(e) {
                                if (e.target.classList.contains('quantity')) {
                                    calculateTotals();
                                }
                            });

                            // Shipping company change
                            document.getElementById('cargo_company_id').addEventListener('change', function() {
                                calculateTotals();
                            });

                            // Discount change
                            document.getElementById('discount_id').addEventListener('change', function() {
                                calculateTotals();
                            });

                            // Calculate all totals
                            function calculateTotals() {
                                let subtotal = 0;

                                // Calculate items subtotal
                                document.querySelectorAll('.order-item').forEach(item => {
                                    const price = parseFloat(item.querySelector('.price').value) || 0;
                                    const quantity = parseInt(item.querySelector('.quantity').value) || 0;
                                    subtotal += price * quantity;
                                });

                                // Get shipping cost
                                const shippingSelect = document.getElementById('cargo_company_id');
                                const shippingOption = shippingSelect.options[shippingSelect.selectedIndex];
                                const shippingCost = shippingOption ? parseFloat(shippingOption.getAttribute('data-price')) || 0 :
                                0;

                                // Get discount
                                const discountSelect = document.getElementById('discount_id');
                                const discountId = discountSelect.value;
                                let discountAmount = 0;

                                if (discountId) {
                                    // In a real app, you would fetch discount details via AJAX or have them in JS
                                    // For this example, we'll assume it's a fixed $10 discount
                                    const discountOption = document.querySelector(`#discount_id option[value="${discountId}"]`);
                                    const discountType = discountOption ? discountOption.getAttribute('data-type') : null;
                                    const discountValue = discountOption ? discountOption.getAttribute('data-value') : null;
                                    if (discountType === 'percentage') {
                                        discountAmount = subtotal * (parseFloat(discountValue) / 100);
                                    } else if (discountType === 'amount') {
                                        discountAmount = parseFloat(discountValue) || 0;
                                    }
                                }

                                // Calculate total
                                const total = subtotal + shippingCost - discountAmount;

                                // Update display
                                document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
                                document.getElementById('shipping').textContent = '$' + shippingCost.toFixed(2);
                                document.getElementById('discount').textContent = '-$' + discountAmount.toFixed(2);
                                document.getElementById('total').textContent = '$' + total.toFixed(2);
                            }

                            // Initial calculation
                            calculateTotals();
                        });
                    </script>
                    {{-- <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let itemCount = 1;

                            // Add new item
                            document.getElementById('addItem').addEventListener('click', function() {
                                const newItem = document.querySelector('.order-item').cloneNode(true);
                                newItem.innerHTML = newItem.innerHTML.replace(/items\[0\]/g, `items[${itemCount}]`);
                                newItem.querySelector('.product-select').value = '';
                                newItem.querySelector('.quantity').value = 1;
                                newItem.querySelector('.price').value = '';
                                document.getElementById('orderItems').appendChild(newItem);
                                itemCount++;
                            });

                            // Remove item
                            document.addEventListener('click', function(e) {
                                if (e.target.classList.contains('remove-item')) {
                                    if (document.querySelectorAll('.order-item').length > 1) {
                                        e.target.closest('.order-item').remove();
                                        calculateTotals();
                                    } else {
                                        alert('You must have at least one item in your order.');
                                    }
                                }
                            });

                            // Product selection change
                            document.addEventListener('change', function(e) {
                                if (e.target.classList.contains('product-select')) {
                                    const selectedOption = e.target.options[e.target.selectedIndex];
                                    const price = selectedOption.getAttribute('data-price');
                                    if (price) {
                                        e.target.closest('.order-item').querySelector('.price').value = price;
                                        calculateTotals();
                                    }
                                }
                            });

                            // Quantity change
                            document.addEventListener('input', function(e) {
                                if (e.target.classList.contains('quantity')) {
                                    calculateTotals();
                                }
                            });

                            // Shipping company change
                            document.getElementById('cargo_company_id').addEventListener('change', function() {
                                calculateTotals();
                            });

                            // Discount change
                            document.getElementById('discount_id').addEventListener('change', function() {
                                calculateTotals();
                            });

                            // Calculate all totals
                            function calculateTotals() {
                                let subtotal = 0;

                                // Calculate items subtotal
                                document.querySelectorAll('.order-item').forEach(item => {
                                    const price = parseFloat(item.querySelector('.price').value) || 0;
                                    const quantity = parseInt(item.querySelector('.quantity').value) || 0;
                                    subtotal += price * quantity;
                                });

                                // Get shipping cost
                                const shippingSelect = document.getElementById('cargo_company_id');
                                const shippingOption = shippingSelect.options[shippingSelect.selectedIndex];
                                const shippingCost = shippingOption ? parseFloat(shippingOption.getAttribute('data-price')) || 0 :
                                    0;

                                // Get discount
                                const discountSelect = document.getElementById('discount_id');
                                const discountId = discountSelect.value;
                                let discountAmount = 0;

                                if (discountId) {
                                    // In a real app, you would fetch discount details via AJAX or have them in JS
                                    // For this example, we'll assume it's a fixed $10 discount
                                    const discountOption = document.querySelector(`#discount_id option[value="${discountId}"]`);
                                    const discountType = discountOption ? discountOption.getAttribute('data-type') : null;
                                    const discountValue = discountOption ? discountOption.getAttribute('data-value') : null;
                                    if (discountType === 'percentage') {
                                        discountAmount = subtotal * (parseFloat(discountValue) / 100);
                                    } else if (discountType === 'amount') {
                                        discountAmount = parseFloat(discountValue) || 0;
                                    }
                                }

                                // Calculate total
                                const total = subtotal + shippingCost - discountAmount;

                                // Update display
                                document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
                                document.getElementById('shipping').textContent = '$' + shippingCost.toFixed(2);
                                document.getElementById('discount').textContent = '-$' + discountAmount.toFixed(2);
                                document.getElementById('total').textContent = '$' + total.toFixed(2);
                            }

                            // Initial calculation
                            calculateTotals();
                        });
                    </script> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
