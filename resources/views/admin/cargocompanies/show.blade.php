<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargo Company') }}
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
                                <div class="">{{ $cargoCompany->name }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Code</div>
                                <div class="">{{ $cargoCompany->code }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Tax Number</div>
                                <div class="">{{ $cargoCompany->tax_number }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Orders</div>
                                <div class="">

                                    <ul>
                                        @forelse ($cargoCompany->orders as $order)
                                            <li>{{ $order->tracking_number }}</li>
                                        @empty
                                            <li>No orders found</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('cargo-companies.edit', $cargoCompany->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
