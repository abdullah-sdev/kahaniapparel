<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-m-1 5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 p-3 rounded-lg mb-5">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <p class="px-5 pt-5 text-2xl font-bold mb-5 dark:text-white">Change Order Status</p>
                                <p class="px-5">Order ID: {{ $order->id }}</p>
                                <form method="POST" action="{{ route('orders.update', $order) }}" class="p-5">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-2 gap-6">

                                        <div class="max-w-sm pt-4">
                                            <label for="name" class="block text-sm font-medium mb-2 dark:text-white">
                                                Payment Status</label>
                                            <select id="payment_status" name="payment_status"
                                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                x-data="{ paymentStatus: '{{ $order->payment_status }}' }"
                                                :style="{
                                                    'background-color': {
                                                        'paid': '#2e865f', // green
                                                        'pending': '#ff9800', // orange
                                                        'failed': '#d32f2f' // red
                                                    } [paymentStatus]
                                                }"
                                                @change="paymentStatus = $event.target.value">
                                                <option value="paid"
                                                    {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="pending"
                                                    {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="failed"
                                                    {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed
                                                </option>
                                            </select>
                                        </div>

                                        <div class="max-w-sm pt-4">
                                            <label for="order_status"
                                                class="block text-sm font-medium mb-2 dark:text-white">
                                                Order Status</label>
                                            <select id="order_status" name="order_status"
                                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                x-data="{ statusColor: '{{ $order->order_status }}' }"
                                                :style="{
                                                    'background-color': {
                                                        'unshipped': '#ff9800', // orange
                                                        'shipped': '#ffc107', // yellow
                                                        'delivered': '#2e865f', // green
                                                        'cancelled': '#d32f2f' // red
                                                    } [statusColor]
                                                }"
                                                @change="statusColor = $event.target.value">
                                                <option value="unshipped"
                                                    {{ $order->order_status == 'unshipped' ? 'selected' : '' }}>
                                                    Unshipped
                                                </option>
                                                <option value="shipped"
                                                    {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                                    Shipped
                                                </option>
                                                <option value="delivered"
                                                    {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                                    Delivered
                                                </option>
                                                <option value="cancelled"
                                                    {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mt-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden  sm:rounded-lg mt-4 p-6">
                <div class=" text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order Items</h2>
                </div>
                <div class=" bg-white sm:rounded-lg"></div>
                <div class="max-w-xl px-6">


                    <div class="grid grid-cols-1 gap-2 mt-4 sm:grid-cols-2">


                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Product
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Quantity
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white dark:bg-neutral-900 divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($order->orderItems as $orderItem)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $orderItem->product->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $orderItem->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                            <form {{-- action="{{ route('order-items.destroy', $orderItem) }}" --}} class="inline-block"
                                                onsubmit="return confirm('Are you sure?')" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"
                                            class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white text-center">
                                            No order items
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
            <div class="bg-white overflow-hidden  sm:rounded-lg mt-4 p-6">
                <div class=" text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cargo Ship</h2>
                </div>
                <div class=" bg-white sm:rounded-lg"></div>
                <div class="max-w-xl px-6 py-3">

                    <form action="" method="post">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="cargo_company_id" class="block text-sm font-medium text-gray-700">Cargo
                                    Company</label>
                                <select id="cargo_company_id" name="cargo_company_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($cargoCompanies as $cargoCompany)
                                        <option value="{{ $cargoCompany->id }}"
                                            {{ $order->cargo_company_id == $cargoCompany->id ? 'selected' : '' }}>
                                            {{ $cargoCompany->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="cargo_company_id" class="block text-sm font-medium text-gray-700">
                                    Tracking Number
                                </label>
                                <input type="text" id="tracking_number" name="tracking_number"
                                    value="{{ $order->tracking_number }}"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            </div>
                        </div>
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="bg-white overflow-hidden  sm:rounded-lg mt-4 p-6">
                <div class=" text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Address</h2>
                </div>
                <div class=" bg-white sm:rounded-lg"></div>
                <div class="max-w-xl px-6 py-3">

                    <div>
                        <label for="address" class="block text-sm font-medium mb-2 dark:text-white">Address:</label>
                        <select name="address" id="address">
                            @forelse ( $order->user->addresses as $address)
                                <option value="{{ $address->id }}" {{ $address->id == $order->address_id ? 'selected' : '' }}>{{ $address->address1 }}</option>
                            @empty
                                No Address
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
