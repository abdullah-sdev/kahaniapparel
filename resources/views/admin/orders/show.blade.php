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

                    <div class="mt-4 p-4 grid gap-4">
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
                                                <div class="w-2/3">PKR {{ number_format($orderItem->product->discounted_price, 2) }}</div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="font-bold w-1/3">product_attributes:</div>
                                                <div class="w-2/3">{{ $orderItem->product_attributes}}</div>
                                            </div>
                                            {{-- Reviews --}}
                                            {{-- <div class="flex items-center">
                                                <div class="w-2/3">
                                                    @forelse ($orderItem->reviews as $review)
                                                        <div class="border rounded p-4">
                                                            {{ $review }}
                                                        </div>
                                                    @empty
                                                        No Reviews
                                                    @endforelse
                                                </div>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        <div>
                            <a href="{{ route('orders.edit', $order->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
