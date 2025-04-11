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
                                Select All
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
                            <div class="flex flex-col gap-2">
                                @forelse ($order->orderItems as $item)
                                    {{-- {{ $item }} --}}
                                    <div class="bg-white text-black p-2 flex align-middle gap-3 font-body rounded-lg">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="order[{{ $order->id }}][{{ $item->id }}]" id="" class="mr-2" checked>
                                        </div>
                                        <div class="w-[70px] aspect-square"><img src="{{ $item->product->thumbnail_image }}"
                                                alt="" class="w-full h-full object-cover"></div>
                                        <div class="flex flex-col justify-between grow">
                                            <div class="">
                                                {{ $item->product->name ?? '' }} ( {{ $item->quantity }} )
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                <div>Item Description .....</div>
                                                <div class="">
                                                    @forelse ($item->product_attributes as $key => $attributes)
                                                        <div>{{ $key }} : {{ $attributes }}</div>
                                                    @empty
                                                        no Attributes
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-between grow">
                                            <div class="text-gray-600 text-lg font-normal">
                                                <div class="text-gray-600 text-lg font-normal">Rs. {{ $item->total() }}/-</div>
                                                <div class="text-gray-600 text-sm font-normal">Rs. {{ $item->price }}/-</div>
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
                                {{-- <div class="bg-white text-black p-2 flex align-middle gap-3 font-body rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="" id="" class="mr-2">
                                    </div>
                                    <div class="w-[70px] aspect-square"><img src="" alt=""
                                            class="w-full h-full object-cover"></div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="">Chillout Drop Shuldr Tee</div>
                                        <div class="text-sm text-gray-400">
                                            <div>Item Description .....</div>
                                            <div>Item Color</div>
                                            <div>Item Size</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="text-gray-600 text-lg font-normal">Rs. 1200/-</div>
                                        <div class="text-[12px] flex gap-2 text-gray-400">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>

                                            </div>
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white text-black p-2 flex align-middle gap-3 font-body rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="" id="" class="mr-2">
                                    </div>
                                    <div class="w-[70px] aspect-square"><img src="" alt=""
                                            class="w-full h-full object-cover"></div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="">Chillout Drop Shuldr Tee</div>
                                        <div class="text-sm text-gray-400">
                                            <div>Item Description .....</div>
                                            <div>Item Color</div>
                                            <div>Item Size</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="text-gray-600 text-lg font-normal">Rs. 1200/-</div>
                                        <div class="text-[12px] flex gap-2 text-gray-400">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>

                                            </div>
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white text-black p-2 flex align-middle gap-3 font-body rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="" id="" class="mr-2">
                                    </div>
                                    <div class="w-[70px] aspect-square"><img src="" alt=""
                                            class="w-full h-full object-cover"></div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="">Chillout Drop Shuldr Tee</div>
                                        <div class="text-sm text-gray-400">
                                            <div>Item Description .....</div>
                                            <div>Item Color</div>
                                            <div>Item Size</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between grow">
                                        <div class="text-gray-600 text-lg font-normal">Rs. 1200/-</div>
                                        <div class="text-[12px] flex gap-2 text-gray-400">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>

                                            </div>
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <div class="p-4 bg-white rounded-xl text-black">

                                <div>
                                    <div class="mt-2">Order Summary</div>
                                    <div class="p-2 text-[14px]">
                                        <div class="flex justify-between">
                                            <div>Sub Total (0 items)</div>
                                            <div>Rs. {{ $order->calculateSubTotal() }}</div>

                                        </div>
                                        <div class="flex justify-between">
                                            <div>Shipping Fee</div>
                                            <div>Rs. {{ $order->delivery_cost ?? '0' }}</div>
                                        </div>
                                        <div class="">
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
                                        </div>
                                        <div class="flex justify-between">
                                            <div>Total</div>
                                            <div>Rs. {{ $order->total() }}</div>
                                        </div>

                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-bblue text-base font-normal text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Proceed To Checkout
                                        </button>

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
