@extends('layouts.kahani')

@section('title', 'Kahani Apparel | Products')

@section('content')
    <main>
        <section class="">
            <div class="container | mx-auto max-w-[1200px]">
                <div class="mt-7">
                    <div class="flex justify-between align-middle bg-black gap-3 ">
                        <div class="bg-white  w-[20px]"> </div>

                        <div class=" bg-white grow px-3">
                            <h2 class="text-3xl font-bold py-1 font-roxborough text-black">
                                Check-Out
                            </h2>
                        </div>

                        <div class="bg-white  w-[20px]"> </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="checkout">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class=" mb-8">
                    <form action="{{ route('proceedToCheckout', $order) }}" method="post">
                        @csrf

                        <div class="font-normal grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 ">
                                    <div class="flex flex-col gap-2">
                                        <label for="fname" class="">
                                            First Name
                                        </label>
                                        <input type="text" name="fname" id="fname"
                                            class="border border-white bg-black py-2 px-3 text-white"
                                            placeholder="Enter Your First Name">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="lname" class="">
                                            Last Name
                                        </label>
                                        <input type="text" name="lname" id="lname"
                                            class="border border-white bg-black py-2 px-3 text-white"
                                            placeholder="Enter Your Last Name">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="email" class="">
                                            Email Address
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="border border-white bg-black py-2 px-3 text-white"
                                            placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="phone" class="">
                                            Phone Number
                                        </label>
                                        <input type="tel" name="phone" id="phone"
                                            class="border border-white bg-black py-2 px-3 text-white"
                                            placeholder="Enter Your Phone Number">
                                    </div>
                                </div>
                                @role([\App\Enums\RoleEnum::ADMIN->value, \App\Enums\RoleEnum::CUSTOMER->value])
                                    <!-- Address Selection -->
                                    <div class=" rounded-lg shadow">
                                        {{-- <h2 class="text-lg font-semibold mb-4 text-blue-700 border-b pb-2">Shipping Address</h2> --}}

                                        <div class="space-y-4">
                                            <h3 class="font-medium text-white">Select Address</h3>

                                            <!-- Validation Error for Address Selection -->
                                            {{-- @error('address_id', 'new_address')
                                                <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                                            @enderror --}}

                                            {{-- <div class="space-y-3">
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                                    @foreach ($addresses as $address)
                                                        <label
                                                            class="flex items-start p-4 border rounded-lg hover:border-blue-400 cursor-pointer @error('address_id') border-red-500 @enderror">
                                                            <input type="radio" name="address_id" value="{{ $address->id }}"
                                                                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                                {{ $address->is_default ? 'checked' : '' }}>
                                                            <div class="ml-3">
                                                                <div class="flex items-center">
                                                                    <span
                                                                        class="block font-medium text-white">{{ $address->name }}</span>
                                                                    @if ($address->is_default)
                                                                        <span
                                                                            class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                            Default
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="text-sm text-white mt-1">
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
                                            </div> --}}
                                            <div class="swiper addressSwiper">
                                                <div class="swiper-wrapper">
                                                    @foreach ($addresses as $address)
                                                        <div class="swiper-slide">
                                                            <label
                                                                class="flex flex-col h-full p-4 border rounded-lg hover:border-blue-400 cursor-pointer space-y-2 @error('address_id') border-red-500 @enderror">
                                                                <div class="flex items-start">
                                                                    <input type="radio" name="address_id"
                                                                        value="{{ $address->id }}"
                                                                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                                        {{ $address->is_default ? 'checked' : '' }}>
                                                                    <div class="ml-3">
                                                                        <div class="flex items-center">
                                                                            <span
                                                                                class="block font-medium text-white">{{ $address->name }}</span>
                                                                            @if ($address->is_default)
                                                                                <span
                                                                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                                    Default
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="text-sm text-white mt-1">
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
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Swiper navigation -->
                                                <div class="flex justify-between mt-4 text-white">
                                                    <div class="swiper-button-prev"></div>
                                                    <div class="swiper-button-next"></div>
                                                </div>
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
                                                    class="mt-4 p-4 border border-gray-200 rounded-lg ">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <!-- Full Name -->
                                                        <div>
                                                            <label for="full_name"
                                                                class="block text-sm font-medium text-white mb-1">Full
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
                                                                class="block text-sm font-medium text-white mb-1">Phone
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
                                                                class="block text-sm font-medium text-white mb-1">Address
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
                                                                class="block text-sm font-medium text-white mb-1">Address
                                                                Line 2 (Optional)</label>
                                                            <input type="text" id="address_line_2"
                                                                name="new_address[address_line_2]"
                                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                                value="{{ old('new_address.address_line_2') }}">
                                                        </div>

                                                        <!-- City -->
                                                        <div>
                                                            <label for="city"
                                                                class="block text-sm font-medium text-white mb-1">City</label>
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
                                                                class="block text-sm font-medium text-white mb-1">State/Province</label>
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
                                                                class="block text-sm font-medium text-white mb-1">Postal
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
                                                                class="block text-sm font-medium text-white mb-1">Country</label>
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
                                                            <label for="is_default" class="ml-2 block text-sm text-white">Set
                                                                as
                                                                default
                                                                address</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endrole
                                @guest
                                    <div class="grid grid-cols-1 gap-4 mb-4 ">
                                        <div class="flex flex-col gap-2">
                                            <label for="address1" class="">
                                                Address 1
                                            </label>
                                            <input type="text" name="address1" id="address1"
                                                class="border border-white bg-black py-2 px-3 text-white"
                                                placeholder="Enter Your Address 1">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="address2" class="">
                                                Address 2
                                            </label>
                                            <input type="text" name="address2" id="address2"
                                                class="border border-white bg-black py-2 px-3 text-white"
                                                placeholder="Enter Your Address 2">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 ">
                                        <div class="flex flex-col gap-2">
                                            <label for="city" class="">
                                                City
                                            </label>
                                            <input type="text" name="city" id="city"
                                                class="border border-white bg-black py-2 px-3 text-white"
                                                placeholder="Enter Your City">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="province" class="">
                                                Province
                                            </label>
                                            <input type="text" name="province" id="province"
                                                class="border border-white bg-black py-2 px-3 text-white"
                                                placeholder="Enter Your Province">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="postalCode" class="">
                                                Postal Code
                                            </label>
                                            <input type="text" name="postalCode" id="postalCode"
                                                class="border border-white bg-black py-2 px-3 text-white"
                                                placeholder="Enter Your Postal Code">
                                        </div>

                                    </div>
                                @endguest
                                <div class="mt-4">
                                    <h2 class="text-3xl font-semibold my-4 inline-block pb-2">Payment Method</h2>
                                    <div class="border  border-white rounded-lg ">
                                        <div class="border-b p-2 border-white mb-2">Cash On Delivery (COD)</div>
                                        <div class="p-2">
                                            After Placing the order you will recieve order confirmation in under 24 hrs on
                                            your
                                            given phone number and email.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <div class="p-4 bg-white rounded-xl text-black">
                                    <div class="text-3xl font-semibold my-4 inline-block pb-2 ">
                                        Review Your Cart
                                    </div>
                                    <div>
                                        <div class="overflow-y-scroll h-60  flex flex-col gap-2">
                                            @forelse ($order->orderItems as $item)
                                                <div class="flex flex-row gap-2 text-[12px] bg-gray-300 rounded-lg p-2">
                                                    <div class="w-[70px] aspect-square">
                                                        <img src="{{ $item->product->thumbnail_image }}"
                                                            alt="Placeholder Image">
                                                    </div>
                                                    <div class="flex flex-col justify-between">
                                                        <div class="flex flex-col">
                                                            <div>
                                                                {{ $item->product->name }}
                                                            </div>
                                                            <div>
                                                                {{ $item->quantity }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            Rs. {{ $item->total() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                            {{-- <div class="flex flex-row gap-2 text-[12px] bg-gray-300 rounded-lg p-2">
                                                <div class="w-[70px] aspect-square">
                                                    <img src="https://placehold.co/150/black/white?font=playfair-display&text=eius-et-tempore-magni1"
                                                        alt="Placeholder Image">
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <div class="flex flex-col">
                                                        <div>
                                                            Not Your Business - Drp Shldr Tees
                                                        </div>
                                                        <div>
                                                            1x
                                                        </div>
                                                    </div>
                                                    <div>
                                                        1200 PKR
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-row gap-2 text-[12px] bg-gray-300 rounded-lg p-2">
                                                <div class="w-[70px] aspect-square">
                                                    <img src="https://placehold.co/150/black/white?font=playfair-display&text=eius-et-tempore-magni1"
                                                        alt="Placeholder Image">
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <div class="flex flex-col">
                                                        <div>
                                                            Not Your Business - Drp Shldr Tees
                                                        </div>
                                                        <div>
                                                            1x
                                                        </div>
                                                    </div>
                                                    <div>
                                                        1200 PKR
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-row gap-2 text-[12px] bg-gray-300 rounded-lg p-2">
                                                <div class="w-[70px] aspect-square">
                                                    <img src="https://placehold.co/150/black/white?font=playfair-display&text=eius-et-tempore-magni1"
                                                        alt="Placeholder Image">
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <div class="flex flex-col">
                                                        <div>
                                                            Not Your Business - Drp Shldr Tees
                                                        </div>
                                                        <div>
                                                            1x
                                                        </div>
                                                    </div>
                                                    <div>
                                                        1200 PKR
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-2">Order Summary</div>
                                        <div class="p-2 text-[14px]">
                                            <div class="flex justify-between">
                                                <div>Sub Total ({{ $order->orderItems()->count() }} items)</div>
                                                <div>Rs. {{ $order->calculateSubTotal() }}</div>

                                            </div>
                                            <div class="flex justify-between">
                                                <div>Shipping Fee</div>
                                                <div>Rs. {{ $order->delivery_cost ?? '0' }}</div>
                                            </div>
                                            <div class="mt-4">

                                                @if ($order->discount_id == null)


                                                        <div class="grid grid-cols-12 gap-2 py-2">
                                                            <div class="col-span-8">
                                                                <input type="text" name="coupon" id="coupon" form="apply-discount"
                                                                    class="w-full rounded-md border border-black bg-white py-1 px-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                                    placeholder="Enter Voucher Code">
                                                            </div>
                                                            <div class="col-span-4">
                                                                <button type="submit"
                                                                form="apply-discount"
                                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-bblue text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                    Apply
                                                                </button>
                                                            </div>
                                                        </div>

                                                @else
                                                    <div class="flex justify-between px-2">
                                                        <div>Discount Code</div>
                                                        <div>{{ $order->discount->code }}</div>
                                                    </div>
                                                    <div class="flex justify-between px-2">
                                                        <div>Discounted For</div>
                                                        @if ($order->discount->type == 'percentage')
                                                            {{ $order->discount->value }}%
                                                        @else
                                                            Rs. {{ $order->discount->value }}
                                                        @endif
                                                    </div>
                                                    <div class="flex mt-2">

                                                        <button type="submit" form="remove-discount"
                                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-2 rounded-lg shadow-md transition duration-200 ease-in-out flex items-center gap-2">
                                                            Remove Code
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>

                                                        </button>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="flex justify-between mt-4">
                                                <div>Total</div>
                                                <div>Rs. {{ $order->total() }}</div>
                                            </div>

                                        </div>
                                        <div>
                                            <form action="{{ route('proceedToCheckout', $order) }}" method="post"
                                                id="checkout-form">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-bblue text-base font-normal text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Proceed To Checkout
                                                </button>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                    @if ($order->discount_id == null)
                        <form action="{{ route('coupon.apply') }}" method="post" id="apply-discount">
                            @csrf
                        </form>
                    @else
                        <form action="{{ route('coupon.remove') }}" method="post" id="remove-discount">
                            @csrf
                        </form>
                    @endif



                </div>

            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.addressSwiper', {
                    slidesPerView: 1.2,
                    spaceBetween: 15,
                    breakpoints: {
                        640: {
                            slidesPerView: 1.2,
                        },
                        768: {
                            slidesPerView: 1.5,
                        },
                        1024: {
                            slidesPerView: 2.5,
                        },
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    grabCursor: true
                });
            });
        </script>

    </main>
@endsection
