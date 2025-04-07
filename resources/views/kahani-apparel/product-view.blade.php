

@extends('layouts.kahani')

@section('title', 'Kahani Apparel | Caffeine and Chaos')

@section('content')
    <main>
        <section class=" | mx-auto max-w-[1200px] p-5 md:p-10 ">
            <div class="flex flex-row flex-wrap gap-4">
                <div class="w-fit">
                    <div class="main-img | overflow-hidden max-h-[400px] aspect-square rounded-3xl">
                        <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}" alt="">
                    </div>
                    <div class="prod-img-slider-mini | p-2 flex justify-center gap-2">
                        <div class="main-img | overflow-hidden max-h-[100px] aspect-square rounded">
                            <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}" alt="">
                        </div>
                        <div class="main-img | overflow-hidden max-h-[100px] aspect-square rounded">
                            <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}" alt="">
                        </div>
                        <div class="main-img | overflow-hidden max-h-[100px] aspect-square rounded">
                            <img src="{{ asset('kahani-apparel/assets/products/Hoodie/glass.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="text-3xl font-bold mb-8 mt-2 ">Caffeine and Chaos</h2>
                    <div class="rating | flex items-center text-[16px]">
                        <div class="stars | flex items-center text-yellow-400">
                              @for ($i = 0; $i < 5; $i++)
                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="none" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                              </svg>
                              @endfor
                        </div>
                        (1)
                    </div>
                    <p class="text-white/60 mb-4">Rs. 1,200.00 PKR</p>
                    <div>
                        <div x-data="{ selectedSize: '' }" class="rounded-lg shadow-lg">
                            <h2 class="text-lg font-bold mb-1">Select Size</h2>
                            <div class="flex flex-wrap flex-row gap-4 text-[16px] font-thin text-white/80">
                                <template x-for="size in ['Small', 'Medium', 'Large', 'XL', 'XXL']" :key="size">
                                    <div>
                                        <input type="radio" :id="size" :value="size" x-model="selectedSize" class="hidden">
                                        <label :for="size" :class="{ 'bg-blue-500 text-white ': selectedSize === size }" class="block text-center px-2 py-1 border border-bblue rounded-lg cursor-pointer hover:bg-bblue hover:text-white transition-colors">
                                            <span x-text="size"></span>
                                        </label>
                                    </div>
                                </template>
                            </div>
                            {{-- <div class="mt-4">
                                <p class="">Selected Size: <span x-text="selectedSize" class="font-semibold"></span></p>
                            </div> --}}
                        </div>
                        <div x-data="{ selectedColor: '' }" class="rounded-lg shadow-lg mt-4">
                            <h2 class="text-lg font-semibold mb-1">Select Color</h2>
                            <div class="flex flex-wrap flex-row gap-4 text-[16px] font-thin text-white/80">
                                <template x-for="color in ['Red', 'Green', 'Blue']" :key="color">
                                    <div>
                                        <input type="radio" :id="color" :value="color" x-model="selectedColor" class="hidden">
                                        <label :for="color" :class="{ 'bg-blue-500 text-white ': selectedColor === color }" class="block text-center px-2 py-1 border border-bblue rounded-lg cursor-pointer hover:bg-bblue hover:text-white transition-colors">
                                            <span x-text="color"></span>
                                        </label>
                                    </div>
                                </template>
                            </div>
                            {{-- <div class="mt-4">
                                <p class="">Selected Color: <span x-text="selectedColor" class="font-semibold"></span></p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-justify text-white/60">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi commodi necessitatibus, quaerat distinctio
                nisi aut voluptate perspiciatis earum mollitia minus! Asperiores, ipsum quisquam expedita ea sunt vel, culpa
                voluptas sequi consectetur iusto, accusantium neque necessitatibus? Doloremque aliquid autem dolorem a
                voluptatem corrupti culpa! Rem, neque? Delectus eos placeat accusantium nobis!
                </p>
            </div>
        </section>
    </main>
@endsection
