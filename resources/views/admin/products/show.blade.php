{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product:') }}
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
                                <div class="">{{ $product->name }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Discounted Price</div>
                                <div class="">{{ $product->discounted_price }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Actual Price</div>
                                <div class="">{{ $product->actual_price }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Description</div>
                                <div class="">{{ $product->description }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Thumbnails</div>
                                <div class="flex gap-4">
                                    <div class="">
                                        <img src="{{ asset('images/products/' . $product->thumbnail_image) }}"
                                            alt="" class="aspect-square size-[150px]">
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <img src="{{ asset('images/products/' . ($product->thumbnail_image1 ?? 'product.png')) }}"
                                                alt="" class="aspect-square size-[150px]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Gallery</div>
                                <div class="flex gap-4">
                                    @foreach ($product->gallery as $image)

                                    <div class="">
                                        <img src="{{ asset('images/products/' . $image->image) }}"
                                            alt="" class="aspect-square size-[150px]">
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Colors</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($product->colors as $color)
                                        <div
                                            class="text-gray-600 bg-gray-100 rounded-full px-2 py-1 flex items-center gap-2">
                                            <div class="w-4 h-4 rounded-full"
                                                style="background-color: {{ $color->hex }}"></div>
                                            <div> {{ $color->name }}</div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Sizes</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($product->sizes as $size)
                                        <div class="text-gray-600 bg-gray-100 rounded-full px-2 py-1 font-black">
                                            {{ $size->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Categories</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($product->categories as $category)
                                        <div class="text-gray-600 bg-gray-100 rounded-full px-2 py-1">
                                            {{ $category->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Reviews</div>
                                <div class=" flex flex-wrap gap-2">
                                <table class="w-full">
                                    <thead class="bg-gray-100 border-b">
                                        <tr>
                                            <th class="px-4 py-2 font-bold">ID</th>
                                            <th class="px-4 py-2 font-bold">User</th>
                                            <th class="px-4 py-2 font-bold">Rating</th>
                                            <th class="px-4 py-2 font-bold">Comment</th>
                                            <th class="px-4 py-2 font-bold">Disabled</th>
                                            <th class="px-4 py-2 font-bold">Gallery</th>
                                            <th class="px-4 py-2 font-bold">Order</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    @forelse ($product->reviews as $review)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-4 py-2 font-bold">{{ $review->id }}</td>
                                            <td class="px-4 py-2 font-bold">{{ $review->user->first_name }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $review->rating }} / 5</td>
                                            <td class="px-4 py-2 text-sm text-gray-600 max-w-[20ch] overflow-hidden whitespace-nowrap text-ellipsis" >{{ $review->comment }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $review->disabled }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $review->gallery->count() }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600 max-w-[15ch]">
                                                @forelse ($review->order->orderItems as $item)
                                                    <div>{{ $item->product->name }} {{ $item->quantity }}</div>
                                                @empty

                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-2 text-center text-gray-600">No Review</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:items-start md:space-x-6">
                        <div class="mb-4 md:mb-0 md:w-1/2">
                            {{-- Product Image Gallery --}}
                            <div class="relative">
                                {{-- @if ($product->galleries->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->galleries->first()->image_path) }}" alt="{{ $product->name }}" class="w-full rounded-md shadow-lg">

                                    @if ($product->galleries->count() > 1)
                                        <div class="mt-4 grid grid-cols-3 gap-2">
                                            @foreach ($product->galleries->skip(1) as $galleryImage)
                                                <img src="{{ asset('storage/' . $galleryImage->image_path) }}" alt="{{ $product->name }} - Additional Image" class="w-full h-24 object-cover rounded-md cursor-pointer shadow-sm hover:opacity-75 transition duration-300">
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <img src="{{ asset('storage/' . $product->thumbnail_image) }}" alt="{{ $product->name }}" class="w-full rounded-md shadow-lg">
                                @endif --}}
                            </div>
                        </div>

                        <div class="md:w-1/2">
                            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>

                            @if ($product->discounted_price)
                                <div class="flex items-center mb-2">
                                    <span class="text-gray-500 line-through">${{ number_format($product->actual_price, 2) }}</span>
                                    <span class="ml-2 text-xl font-semibold text-green-500">${{ number_format($product->discounted_price, 2) }}</span>
                                </div>
                            @else
                                <p class="text-xl font-semibold text-gray-800 mb-2">${{ number_format($product->actual_price, 2) }}</p>
                            @endif

                            <p class="text-gray-700 mb-4">{{ $product->description }}</p>

                            <div class="mb-4">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    Stock: {{ $product->is_in_stock ? 'In Stock' : 'Out of Stock' }}
                                </span>
                                @if ($product->is_enable)
                                    <span class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-green-700 mr-2">
                                        Enabled
                                    </span>
                                @else
                                    <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-700 mr-2">
                                        Disabled
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center space-x-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Add to Cart
                                </button>
                                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Add to Wishlist
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
