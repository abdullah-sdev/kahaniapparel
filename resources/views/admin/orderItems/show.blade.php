<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Item:') }}
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
                                <div class="">{{ $orderItem->product->name }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Price</div>
                                <div class="">{{ $orderItem->price }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Quantity</div>
                                <div class="">{{ $orderItem->quantity }}</div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('admin.order-items.edit', $orderItem->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
