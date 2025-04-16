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
                                Cart
                            </h2>
                        </div>

                        <div class="bg-white  w-[20px]"> </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="checkout">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20 font-normal">
                <div class=" mb-8">


                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 md:col-span-8">
                            <div class="flex flex-col gap-2 font-body">
                                @forelse ($order->orderItems as $item)
                                    <div
                                        class="bg-white text-black p-2 grid grid-cols-4 gap-3 font-body rounded-lg items-center">

                                        <div class=" aspect-square flex col-span-1 w-full justify-items-center items-center">
                                            <img src="{{ $item->product->thumbnail_image }}" alt=""
                                                class="h-full aspect-square align-middle justify-between">
                                        </div>
                                        <div class="flex flex-col justify-between grow overflow-hidden col-span-2">
                                            <div class="text-nowrap text-clip overflow-hidden">
                                                {{ $item->product->name ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                <div class="">
                                                    @forelse ($item->product_attributes as $key => $attributes)
                                                        <div>{{ $key }} : {{ $attributes }}</div>
                                                    @empty
                                                        no Attributes
                                                    @endforelse
                                                </div>
                                                <div class="">
                                                    Quantity : {{ $item->quantity }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-between">
                                            <div class="text-gray-600 text-lg font-normal mr-5">
                                                <div class="text-gray-600 text-lg font-normal">Rs.
                                                    {{ $item->total() }}/-
                                                </div>
                                            </div>

                                            <div class="text-xs flex gap-2 text-gray-400">
                                                <div class="wishlist | hover:text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>

                                                </div>
                                                <div class="trash | ">
                                                    <form action="{{ route('remove_from_cart', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="hover:text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </button>

                                                    </form>
                                                    <div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                            {{-- <div class="flex flex-col gap-2 font-body">
                                @forelse ($order->orderItems as $item)
                                    <div
                                        class="bg-white text-black p-2 flex flex-row align-middle gap-3 font-body rounded-lg">

                                        <div class="w-[100px] aspect-square flex flex-col">
                                            <img src="{{ $item->product->thumbnail_image }}" alt=""
                                                class="h-full aspect-square w-[100px]">
                                        </div>
                                        <div class="flex flex-col justify-between grow overflow-hidden">
                                            <div class="text-nowrap text-clip">
                                                {{ $item->product->name ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                <div class="">
                                                    @forelse ($item->product_attributes as $key => $attributes)
                                                        <div>{{ $key }} : {{ $attributes }}</div>
                                                    @empty
                                                        no Attributes
                                                    @endforelse
                                                </div>
                                                <div class="">
                                                    Quantity : {{ $item->quantity }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-between">
                                            <div class="text-gray-600 text-lg font-normal mr-5">
                                                <div class="text-gray-600 text-lg font-normal">Rs.
                                                    {{ $item->total() }}/-
                                                </div>
                                            </div>

                                            <div class="text-[12px] flex gap-2 text-gray-400">
                                                <div class="wishlist | hover:text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                    </svg>

                                                </div>
                                                <div class="trash | ">
                                                    <form action="{{ route('remove_from_cart', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="hover:text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </button>

                                                    </form>
                                                    <div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div> --}}
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <div class="p-4 bg-white rounded-xl text-black">

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

                                                <form action="{{ route('coupon.apply', $order) }}" method="post">
                                                    @csrf
                                                    <div class="grid grid-cols-12 gap-2 py-2">
                                                        <div class="col-span-8">
                                                            <input type="text" name="coupon" id="coupon"
                                                                class="w-full rounded-md border border-black bg-white py-1 px-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                                placeholder="Enter Voucher Code">
                                                        </div>
                                                        <div class="col-span-4">
                                                            <button type="submit"
                                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-bblue text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Apply
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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
                                                    <form action="{{ route('coupon.remove', $order) }}" method="post">
                                                        @csrf
                                                        {{-- <button type="submit" class="bg-red-400 text-white rounded inline-block px-2 py-1 font-bold self-end ">Remove
                                                            Code</button> --}}
                                                        <button type="submit"
                                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-2 rounded-lg shadow-md transition duration-200 ease-in-out flex items-center gap-2">
                                                            Remove Code
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>

                                                        </button>

                                                    </form>
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
                </div>

            </div>
        </section>
    </main>
@endsection
