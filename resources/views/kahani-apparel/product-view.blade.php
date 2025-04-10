@extends('layouts.kahani')

@section('title', 'Kahani Apparel | ' . $product->name)

@section('content')
    <main>
        <section class=" | mx-auto max-w-[1200px] p-5 md:p-10 ">
            <div class="flex flex-row flex-wrap gap-10">

                <div class="grid grid-cols-1 relative w-[415px]" x-data="{ currentIndex: 0 }">
                    <!-- Main Image -->
                    <div class="prod-img | aspect-square w-full rounded-3xl bg-slate-300 relative overflow-hidden">
                        @foreach ($product->gallery as $index => $image)
                            <img x-show="currentIndex === {{ $index }}" src="{{ $image->image_path }}"
                                alt="{{ $product->name }}"
                                class="absolute w-full h-full object-cover object-top rounded-lg transition-opacity duration-300">
                        @endforeach
                    </div>
                    <!-- Navigation Buttons -->
                    <div class="flex justify-between absolute top-1/2 left-0 right-0 -translate-y-1/2 px-2">
                        <button
                            @click="currentIndex = (currentIndex + {{ count($product->gallery) }} - 1) % {{ count($product->gallery) }}"
                            class="w-8 h-8 rounded-full bg-white/80 shadow-md flex items-center justify-center hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button @click="currentIndex = (currentIndex + 1) % {{ count($product->gallery) }}"
                            class="w-8 h-8 rounded-full bg-white/80 shadow-md flex items-center justify-center hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>

                    <!-- Optional: Indicator dots (visible on hover) -->
                    <div class="flex justify-center gap-1 mt-2 opacity-0 hover:opacity-100 transition-opacity">
                        @foreach ($product->gallery as $index => $image)
                            <button @click="currentIndex = {{ $index }}" class="w-2 h-2 rounded-full"
                                :class="currentIndex === {{ $index }} ? 'bg-gray-700' : 'bg-gray-300'"></button>
                        @endforeach
                    </div>
                </div>

                <div class="grow">


                    <h2 class="text-3xl font-bold mb-8 mt-2 pb-1 items-start w-fit relative">
                        {{ $product->name }}
                        <span
                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                    </h2>

                    <div class="rating | flex items-center text-[16px]">
                        <div class="stars | flex items-center text-yellow-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="none" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                            @endfor
                        </div>
                        (1)
                    </div>
                    <p class="text-white/60 mb-4">Rs. {{ number_format($product->actual_price, 2) }} PKR</p>
                    <form action="{{ route('store_to_cart') }}" method="POST">
                        @csrf
                        <div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">


                            <!-- Size -->
                            <div x-data="{ selectedSize: '' }" class="rounded-lg shadow-lg">
                                <h2 class="text-lg font-bold mb-1">Select Size</h2>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-[16px] font-thin text-white/80">
                                    <template x-for="size in @js($product->sizes)" :key="size.id">
                                        <div>
                                            <input type="radio" :id="`size-${size.id}`" :value="size.id"
                                                x-model.number="selectedSize" class="hidden">
                                            <label :for="`size-${size.id}`"
                                                :class="{ 'bg-blue-500 text-white': selectedSize === size.id }"
                                                class="block text-center px-2 py-1 border border-bblue rounded-lg cursor-pointer hover:bg-bblue hover:text-white transition-colors">
                                                <span x-text="size.name"></span>
                                            </label>
                                        </div>
                                    </template>
                                </div>

                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="selectedSize" :value="selectedSize">
                            </div>




                            <!-- Color -->
                            <div x-data="{ selectedColor: '' }" class="rounded-lg shadow-lg mt-4">
                                <h2 class="text-lg font-semibold mb-1">Select Color</h2>
                                <div class="grid grid-cols-3 md:grid-cols-5 gap-4 text-[16px] font-thin text-white/80">
                                    <template x-for="color in @js($product->colors)" :key="color.id">
                                        <div>
                                            <input type="radio" :id="`color-${color.id}`" :value="color.id"
                                                x-model.number="selectedColor" class="hidden">
                                            <label :for="`color-${color.id}`"
                                                :class="{ 'bg-blue-500 text-white': selectedColor === color.id }"
                                                class="block text-center px-2 py-1 border border-bblue rounded-lg cursor-pointer hover:bg-bblue hover:text-white transition-colors">
                                                <span x-text="color.name"></span>
                                            </label>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="mt-4" x-data="{ quantity: 1 }">
                                <div class="grid max-w-[100px]">
                                    <h2 class="text-lg font-semibold mb-1">Quantity</h2>
                                    <div class="grid grid-cols-3 border border-white py-1">
                                        <!-- Decrease Button -->
                                        <button type="button" @click="quantity > 1 ? quantity-- : quantity = 1"
                                            class="flex items-center justify-center hover:text-white">
                                            -
                                        </button>

                                        <!-- Hidden Input for Form Submission -->
                                        <input type="hidden" name="quantity" :value="quantity">

                                        <!-- Display Quantity -->
                                        <div class="flex items-center justify-center text-2xl font-bold" x-text="quantity"></div>

                                        <!-- Increase Button -->
                                        <button type="button" @click="quantity < 10 ? quantity++ : quantity = 10"
                                            class="flex items-center justify-center hover:text-white">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mt-4" x-data="{ quantity: 1 }">
                                <div class="grid max-w-[100px]">
                                    <h2 class="text-lg font-semibold mb-1">Quantity</h2>
                                    <div class="grid grid-cols-3 border border-white py-1">
                                        <button type="button" @click="quantity > 1 ? quantity-- : quantity = 1"
                                            class="flex items-center justify-center hover:text-white">
                                            -
                                        </button>
                                        <input type="hidden" name="quantity" :value="quantity">
                                        <div class="flex items-center justify-center text-2xl font-bold" x-text="quantity">
                                        </div>
                                        <button type="button" @click="quantity <button 10 ? quantity++ : quantity = 10"
                                            class="flex items-center justify-center hover:text-white">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Buy Now -->
                            <div class="mt-4">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 font-roxborough">
                                    <button value="Buy Now" name="action"
                                        class="bg-white text-black rounded-lg py-2 flex align-middle justify-center gap-2 place-items-center">
                                        <div>Buy Now</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                            </svg>
                                        </div>

                                    </button>

                                    <button type="submit" name="action" value="Add to Cart"
                                        class="bg-black border border-white py-2 text-white rounded-lg flex align-middle justify-center gap-2 place-items-center">
                                        Add to Cart
                                        <svg xmlns="[http://www.w3.org/2000/svg"](http://www.w3.org/2000/svg")
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 0 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </button>


                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="mt-4">
                <p class="text-justify text-white/60 font-roxborough">
                    {{ $product->description }}
                </p>
            </div>
        </section>
        <section class=" | mx-auto max-w-[1200px] p-5 md:p-10 ">
            <div class="flex flex-row flex-wrap gap-4">

                <div class="mx-auto">


                    <h2 class="text-3xl font-bold mb-8 mt-2 pb-1 items-start w-fit relative">
                        You May Also Like
                        {{-- <span
                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span> --}}
                    </h2>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="prod-card | mx-auto">
                        <a href="{{ route('kahani.products') }}?" class="grid grid-cols-1 gap-4">
                            <div class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                <img src="https://placehold.co/500/black/white?font=playfair-display&text=Goku-2"
                                    alt="">
                            </div>
                            <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                <p class=" items-center  w-fit relative">
                                    Goku 2
                                    <span
                                        class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                </p>
                                <p class="text-white/60 text-base text-left mt-2">
                                    Rs. 1,200.00/- PKR
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="prod-card | mx-auto">
                        <a href="{{ route('kahani.products') }}?" class="grid grid-cols-1 gap-4">
                            <div class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                <img src="https://placehold.co/500/black/white?font=playfair-display&text=Goku-2"
                                    alt="">
                            </div>
                            <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                <p class=" items-center  w-fit relative">
                                    Goku 2
                                    <span
                                        class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                </p>
                                <p class="text-white/60 text-base text-left mt-2">
                                    Rs. 1,200.00/- PKR
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="prod-card | mx-auto">
                        <a href="{{ route('kahani.products') }}?" class="grid grid-cols-1 gap-4">
                            <div class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                <img src="https://placehold.co/500/black/white?font=playfair-display&text=Goku-2"
                                    alt="">
                            </div>
                            <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                <p class=" items-center  w-fit relative">
                                    Goku 2
                                    <span
                                        class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                </p>
                                <p class="text-white/60 text-base text-left mt-2">
                                    Rs. 1,200.00/- PKR
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="prod-card | mx-auto">
                        <a href="{{ route('kahani.products') }}?" class="grid grid-cols-1 gap-4">
                            <div class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                <img src="https://placehold.co/500/black/white?font=playfair-display&text=Goku-2"
                                    alt="">
                            </div>
                            <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                <p class=" items-center  w-fit relative">
                                    Goku 2
                                    <span
                                        class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                </p>
                                <p class="text-white/60 text-base text-left mt-2">
                                    Rs. 1,200.00/- PKR
                                </p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
