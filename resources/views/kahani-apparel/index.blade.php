@extends('layouts.kahani')

@section('title', 'Kahani Apparel')

@section('content')

    <main>
        <section class=""
            style="background-image: url('{{ asset('kahani-apparel/assets/bg-sky.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="container | min-h-screen mx-auto flex justify-center items-center p-16">
                <img src="{{ asset('kahani-apparel/assets/Logos/logo_black.png') }}" class="max-h-[400px]" alt="">
            </div>
        </section>

        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-5 md:p-10 ">
                <div class="bg-slate-100/20 rounded-xl ">
                    <div class="p-5 md:p-10">
                        <h3 class="text-3xl font-bold mt-2 mb-8 text-center font-roxborough">Our Products</h3>
                        <div class="products | grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 grid-cols-2 gap-8 font-semibold">

                            @forelse ($categories as $category)
                            <div class="prod-card | mx-auto">
                                <a href="{{ route('kahani.products') }}?{{ $category->slug }}">
                                    <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ $category->image }}"
                                        alt="">
                                </div>
                                <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                    <p class="pb-1 items-center mx-auto w-fit relative">
                                        {{ $category->name }}
                                        <span
                                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                    </p>
                                </div>
                                </a>
                            </div>
                            @empty
                                None Found
                            @endforelse

                            {{-- <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Tshirt/flower.png') }}"
                                        alt="">
                                </div>
                                <div class="prod-name | text-center mt-4 text-white/80 font-roxborough ">
                                    <p class="pb-1 items-center mx-auto w-fit relative">
                                        T-Shirts
                                        <span
                                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/dropshoulder/itachi.png') }}"
                                        alt="">
                                </div>
                                <div class="prod-name | text-center mt-4 text-white/80 font-roxborough">
                                    <p class="pb-1 items-center mx-auto w-fit relative">
                                        Oversized / Drop Shldr
                                        <span
                                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}"
                                        alt="">

                                </div>

                                <div class="prod-name | text-center mt-4 text-white/80 font-roxborough">
                                    <p class="pb-1 items-center mx-auto w-fit relative">
                                        Hoodies
                                        <span
                                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Sweatshirt/venom.png') }}"
                                        alt="">

                                </div>
                                <div class="prod-name | text-center mt-4 text-white/80 font-roxborough">
                                    <p class="pb-1 items-center mx-auto w-fit relative">
                                        Sweatshirts
                                        <span
                                            class="absolute top-full left-1/2 transform -translate-x-1/2 w-3/4 border-b border-white/60"></span>
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <hr class="border-t-2 border-slate-200/25 w-[80%] mx-auto">
                    <div class="px-3 py-10 ">
                        <h3 class="text-3xl font-bold mb-8 text-center font-roxborough">Trending Products</h3>
                        <div class="products | mx-auto">

                            <!-- Slider main container -->
                            <div x-init="new Swiper($el, {
                                modules: [Navigation, Pagination, Autoplay],
                                loop: true,
                                slidesPerView: 2,
                                spaceBetween: 5,

                                breakpoints: {
                                    768: {
                                    slidesPerView: 4,
                                    },
                                },

                                autoplay: {
                                    delay: 1000,
                                },

                                pagination: {
                                    el: '.swiper-pagination',
                                },

                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },


                            });" class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    @forelse ($products as $product)
                                    <div class="swiper-slide">
                                        <div class="prod-card | place-items-center">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <a href="{{ route('kahani.product', $product->slug) }}">
                                                    <img src="{{ $product->thumbnail_image }}"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        no products
                                    @endforelse

                                    {{-- <div class="swiper-slide">
                                        <div class="prod-card | place-items-center">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <img src="{{ asset('kahani-apparel/assets/products/Sweatshirt/venom.png') }}"
                                                    alt="">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="prod-card | place-items-center">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <img src="{{ asset('kahani-apparel/assets/products/Sweatshirt/cig boy.png') }}"
                                                    alt="">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="prod-card | place-items-center">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <img src="{{ asset('kahani-apparel/assets/products/Tshirt/flower.png') }}"
                                                    alt="">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="prod-card | ">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}"
                                                    alt="">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="prod-card | ">
                                            <div
                                                class="prod-img |  aspect-square max-h-[248px] overflow-hidden rounded-t-xl bg-slate-300">
                                                <img src="{{ asset('kahani-apparel/assets/products/Hoodie/girl with cig.png') }}"
                                                    alt="">

                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev absolute top-1/2 -translate-y-1/2 left-2 z-10">
                                    <div class="bg-white/95 p-1 rounded-full text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.8" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>

                                    </div>

                                </div>
                                <div class="swiper-button-next absolute top-1/2 -translate-y-1/2 right-2 z-10">
                                    <div class="bg-white/95 p-1 rounded-full text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.8" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>


                                    </div>
                                </div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div> --}}
                            </div>

                        </div>
                        <div class="flex items-center justify-center">
                            <a class="inline-block mt-4 font-normal bg-slate-600 hover:bg-bblue border border-bblue px-2 py-1 rounded-xl transition-all duration-100"
                                href="#">View all</a>
                        </div>
                    </div>
                    <hr class="border-t-2 border-slate-200/25 w-[80%] mx-auto">
                    <div class="p-10">
                        <h3 class="text-3xl font-bold mb-8 text-center font-roxborough">Kahani Collection</h3>
                        <div class="products | grid sm:grid-cols-2 md:grid-cols-4 grid-cols-1 gap-4">
                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Tshirt/coming-soon.jpeg') }}"
                                        alt="">

                                </div>

                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Tshirt/coming-soon.jpeg') }}"
                                        alt="">

                                </div>

                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Tshirt/coming-soon.jpeg') }}"
                                        alt="">

                                </div>

                            </div>

                            <div class="prod-card | mx-auto">
                                <div
                                    class="prod-img | aspect-square max-h-[248px] overflow-hidden rounded-3xl bg-slate-300">
                                    <img src="{{ asset('kahani-apparel/assets/products/Tshirt/coming-soon.jpeg') }}"
                                        alt="">

                                </div>

                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <a class="inline-block mt-4 font-normal bg-slate-600 hover:bg-bblue border border-bblue px-2 py-1 rounded-xl transition-all duration-100"
                                href="#">View all</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="stats ">
            <div class=" | p-10 bg-bblue/50 mx-auto w-[100%]">
                <div class="flex flex-wrap justify-around items-center max-w-[1200px] mx-auto sm:gap-x-0 gap-x-10">
                    <div class="flex flex-col items-center sm:w-1/2 md:w-1/4 w-full p-8">
                        <img src="{{ asset('kahani-apparel/assets/icons/world_wide_shiping.png') }}" class="h-[100px]"
                            alt="">
                        <p class="font-bold text-center sm:text-2xl">Worldwide Shipping</p>
                    </div>
                    <div class="flex flex-col items-center sm:w-1/2 md:w-1/4 w-full p-8">
                        <img src="{{ asset('kahani-apparel/assets/icons/Best_quality.png') }}" class="h-[100px]"
                            alt="">
                        <p class="font-bold text-center sm:text-2xl">Best Quality</p>
                    </div>
                    <div class="flex flex-col items-center sm:w-1/2 md:w-1/4 w-full p-8">
                        <img src="{{ asset('kahani-apparel/assets/icons/Best_offer.png') }}" class="h-[100px]"
                            alt="">
                        <p class="font-bold text-center sm:text-2xl">Best Offers</p>
                    </div>
                    <div class="flex flex-col items-center sm:w-1/2 md:w-1/4 w-full p-8">
                        <img src="{{ asset('kahani-apparel/assets/icons/Secure_payment.png') }}" class="h-[100px]"
                            alt="">
                        <p class="font-bold text-center sm:text-2xl">Secure Payment</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_us">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">About Us</h2>
                    <p class="text-slate-300 text-center">
                        At <span class="font-bold text-bblue">Kahani Apparel</span>, we believe that every outfit
                        tells a story. Inspired by the power of
                        words, emotions, and self-expression, we bring you apparel that speaks louder than fashion.
                        Whether it's poetic verses, thought-provoking designs, or creative prints, our pieces are
                        designed to resonate with you.
                    </p>
                </div>
            </div>
        </section>
        <section class="vision">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Vision</h2>
                    <p class="text-slate-300 text-center">
                        We are more than just a clothing brand-we are a canvas for stories. Our goal is to create
                        designs that connect with people on a deeper level, whether through poetry-infused apparel
                        or bold, statement-making prints.
                    </p>
                </div>
            </div>
        </section>
        <section>
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Customer Support</h2>
                <div class="flex justify-center mx-auto max-w-[700px] flex-col-reverse md:flex-row gap-10 md:gap-0">
                    <div
                        class="bg-bblue p-10 md:rounded-none md:rounded-l-3xl md:w-1/2 rounded-3xl md:border-black md:border-2">
                        <h3 class="text-2xl font-black mb-8 text-center font-roxborough text-black">Send Us A
                            Message</h3>
                        <form action="#" method="get">
                            <div class="flex flex-col gap-3">
                                <input type="text" name="name" id="name" placeholder="Name"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <input type="email" name="email" id="email" placeholder="Email"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <input type="text" name="subject" id="subject" placeholder="Subject"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <textarea name="message" id="message" placeholder="Your Message Here"
                                    class="bg-transparent border border-b-2 border-white placeholder:text-white   focus-within:border-b-2 focus-within:ring-0"></textarea>
                                <button type="submit"
                                    class="bg-white rounded text-black font-black hover:bg-black hover:text-white transition-all duration-100">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div
                        class="bg-white p-10 text-black md:rounded-none md:rounded-r-3xl rounded-3xl flex flex-col justify-center align-middle items-center md:w-1/2 md:border-black md:border-2">

                        <h3 class="text-xl font-black mb-2 text-center font-roxborough">For inquiries contact us
                            at:</h3>
                        <p class="mb-2 text-center font-roxborough">kahaniapparel@gmail.com</p>

                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
