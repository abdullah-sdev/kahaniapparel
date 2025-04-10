@extends('layouts.kahani')

@section('title', 'Kahani Apparel | Products')

@section('content')
    <main>
        <section class="products">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Products</h2>

                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">

                    {{-- @for ($i = 0; $i <div 8; $i++)
                        <a href="#" class="product-card | ">
                            <div class="image">
                                <img src="{{ asset('kahani-apparel/assets/products/dropshoulder/itachi.png') }}" alt="">
                            </div>
                            <div class="description flex flex-wrap flex-col items-start">
                                <h3 class="font-bold pb-1 inline border-b border-gray-400">Itachi</h3>
                                <p class="text-white/60 mt-2 inline-block text-[12px] sm:text-[16px]">From Rs. 1,200.00 PKR</p>
                            </div>
                        </a>
                        <div class="product-card">
                            <div class="image">
                                <img src="{{ asset('kahani-apparel/assets/products/Tshirt/flower.png') }}" alt="">
                            </div>
                            <div class="description flex flex-wrap flex-col items-start">
                                <h3 class="font-bold pb-1  inline border-b border-gray-400 ">Flower</h3>
                                <p class="text-white/60 mt-2 inline-block text-[12px] sm:text-[16px]">From Rs. 1,200.00 PKR</p>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="image">
                                <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}" alt="">
                            </div>
                            <div class="description flex flex-wrap flex-col items-start">
                                <h3 class="font-bold pb-1  inline border-b border-gray-400 ">Hoodie</h3>
                                <p class="text-white/60 mt-2 inline-block text-[12px] sm:text-[16px]">From Rs. 1,200.00 PKR</p>
                            </div>
                        </div>
                    @endfor --}}

                    @forelse ($products as $product)
                    <a href="{{ route('kahani.product', $product->slug) }}" class="product-card | ">
                        <div class="image">
                            <img src="{{ $product->thumbnail_image }}" alt="" class="w-full">
                        </div>
                        <div class="description flex flex-wrap flex-col items-start">
                            <h3 class="font-bold pb-1 inline border-b border-gray-400">{{ $product->name }}</h3>
                            <p class="text-white/60 mt-2 inline-block text-[12px] sm:text-[16px]">From Rs. {{ number_format($product->actual_price) }} PKR</p>
                        </div>
                    </a>
                    @empty

                    @endforelse

                </div>
                <div class="py-3">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
