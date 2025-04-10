<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">

                    <div class="py-12">
                        <div class="container mx-auto px-4 ">
                            <div class="flex justify-center">
                                <div class="w-full md:w-2/3">
                                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                        <div class="bg-gray-100 px-6 py-4">
                                            <h2 class="text-xl font-semibold">Order #{{ $order->id }}</h2>
                                            <p class="mb-0 text-gray-600">Placed on
                                                {{ $order->created_at->format('F j, Y \a\t g:i a') }}</p>
                                        </div>

                                        <div class="p-6">
                                            <h4 class="text-lg font-semibold mb-4">Order Items</h4>

                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="bg-gray-200">
                                                            <th class="px-4 py-2">id</th>
                                                            <th class="px-4 py-2">Product</th>
                                                            <th class="px-4 py-2">Price</th>
                                                            <th class="px-4 py-2">Qty</th>
                                                            <th class="px-4 py-2">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderitems as $item)
                                                            <tr class="border-b">
                                                                <td class="px-4 py-2">
                                                                    {{ $item->id }}
                                                                </td>
                                                                <td class="px-4 py-2">
                                                                    <strong>{{ $item->product->name }}</strong>
                                                                    @if ($item->product_attributes)
                                                                        <div class="text-sm text-gray-500">
                                                                            <div>Item Color:
                                                                                {{ $item->product_attributes['color'] ?? 'N/A' }}
                                                                            </div>
                                                                            <div>Item Size:
                                                                                {{ $item->product_attributes['size'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="px-4 py-2">
                                                                    ${{ number_format($item->price, 2) }}
                                                                </td>
                                                                <td class="px-4 py-2">{{ $item->quantity }}</td>
                                                                <td class="px-4 py-2">
                                                                    ${{ number_format($item->total(), 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                                <div>
                                                    <h4 class="text-lg font-semibold mb-2">Shipping Address</h4>
                                                    <address class="text-gray-600">
                                                        <strong>{{ $order->address->name }}</strong><br>
                                                        {{ $order->address->address1 }}<br>
                                                        @if ($order->address->address2)
                                                            {{ $order->address->address2 }}<br>
                                                        @endif
                                                        {{ $order->address->city }}, {{ $order->address->state }}
                                                        {{ $order->address->postalCode }}<br>
                                                        {{ $order->address->country }}<br>
                                                        Phone: {{ $order->user->phone }}
                                                    </address>
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-semibold mb-2">Order Summary</h4>
                                                    <table class="w-full">
                                                        <tr>
                                                            <td class="py-1">Subtotal:</td>
                                                            <td class="py-1 text-right">
                                                                ${{ number_format($order->subtotal, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-1">Shipping:</td>
                                                            <td class="py-1 text-right">
                                                                ${{ number_format($order->delivery_cost, 2) }}</td>
                                                        </tr>
                                                        @if ($order->discount)
                                                            <tr>
                                                                <td class="py-1">Discount:</td>
                                                                <td class="py-1 text-right">
                                                                    -${{ number_format($order->discount->amount, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr class="font-semibold">
                                                            <td class="py-1">Total:</td>
                                                            <td class="py-1 text-right">
                                                                ${{ number_format($order->total(), 2) }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gray-100 px-6 py-4">
                                            @if ($order->tracking_number)
                                                <p class="mb-2 text-gray-600">
                                                    <strong>Tracking Number:</strong> {{ $order->tracking_number }}<br>
                                                    <strong>Shipping Company:</strong>
                                                    {{ $order->cargoCompany->name ?? 'N/A' }}
                                                </p>
                                            @endif

                                            <div class="flex justify-between">
                                                <a href="{{ route('admin.orders.index') }}"
                                                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back
                                                    to Orders</a>

                                                @if ($order->payment_status === 'pending' && $order->payment_type === 'credit_card')
                                                    <a href="#"
                                                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Complete
                                                        Payment</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-4 p-4 grid gap-4">
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Name</div>
                                <div class="">{{ $order->user->first_name }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Payment Status</div>
                                <div class="">{{ $order->payment_status }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Delivery Cost</div>
                                <div class="">{{ $order->delivery_cost }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Order Status</div>
                                <div class="">{{ $order->order_status }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Order Items</div>

                                <div class="">
                                    @foreach ($order->orderItems as $orderItem)
                                        <div class="border rounded p-4">
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">ID </div>
                                                <div class="w-2/3">{{ $orderItem->product->id }}</div>


                                            </div>
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">Product </div>
                                                <div class="w-2/3">{{ $orderItem->product->name }}</div>


                                            </div>
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">Quantity:</div>
                                                <div class="w-2/3">{{ $orderItem->quantity }}</div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">Price:</div>
                                                <div class="w-2/3">PKR
                                                    {{ number_format($orderItem->product->discounted_price, 2) }}</div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">product_attributes:</div>
                                                <div class="w-2/3">

                                                    @forelse ($orderItem->product_attributes as $key => $attributes)
                                                        <div>{{ $key }} : {{ $attributes }}</div>
                                                    @empty
                                                        no Attributes
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="w-2/3">
                                                    @forelse ($orderItem->reviews as $review)
                                                        <div class="border rounded p-4">
                                                            @if ($review->rating)
                                                                <div>Rating: {{ $review->rating }}</div>
                                                            @endif
                                                            @if ($review->review)
                                                                <div>Review: {{ $review->review }}</div>
                                                            @endif
                                                        </div>
                                                    @empty
                                                        No Reviews
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        <div>
                            <a href="{{ route('admin.orders.edit', $order->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
