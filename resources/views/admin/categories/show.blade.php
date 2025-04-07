<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category:') }}
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
                                <div class="">{{ $category->name }}</div>
                            </div>
                        </div>
                        <div class="border rounded">
                            <div class="py-2 px-4">
                                <div class="font-bold">Products</div>
                                <div class="">
                                    @forelse ($category->products as $product)
                                        <div><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></div>
                                    @empty
                                        No Products
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="text-blue-600 hover:text-blue-700">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
