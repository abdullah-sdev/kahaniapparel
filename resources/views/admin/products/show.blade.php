<x-app-layout>
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
</x-app-layout>
