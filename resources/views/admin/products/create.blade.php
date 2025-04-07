<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-m-1 5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 p-3 rounded-lg mb-5">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <form method="POST" action="{{ route('products.store') }}" class="p-5"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="max-w-sm pt-4">
                                        <label for="name" class="block text-sm font-medium mb-2 dark:text-white">
                                            Name</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Name">
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="actual_price"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Actual Price</label>
                                        <input type="text" id="actual_price" name="actual_price"
                                            value="{{ old('actual_price') }}"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Actual Price">
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="discounted_price"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Discounted Price</label>
                                        <input type="text" id="discounted_price" name="discounted_price"
                                            value="{{ old('discounted_price') }}"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Discounted Price   ">
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="thumbnail_image"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Thumbnail Image</label>
                                        <div x-data="{ image1: '' }"
                                            class="border-2 rounded-lg border-gray-800 border-dashed p-6">
                                            <img :src="image1" alt="" class="h-32 aspect-square">
                                            <label for="thumbnail_image">
                                                <span
                                                    class="inline-block mt-3 bg-blue-500 text-white px-2 py-1 rounded">Change</span>

                                                <input type="file" name="thumbnail_image" class="hidden"
                                                    id="thumbnail_image" accept="image/*"
                                                    @change="image1 = URL.createObjectURL($event.target.files[0])">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="max-w-sm pt-4">
                                        <label for="thumbnail_image1"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Thumbnail Image 2</label>
                                        <div x-data="{ image2: '' }"
                                            class="border-2 rounded-lg border-gray-800 border-dashed p-6">
                                            <img :src="image2" alt="" class="h-32 aspect-square">
                                            <label for="thumbnail_image1">
                                                <span
                                                    class="inline-block mt-3 bg-blue-500 text-white px-2 py-1 rounded">Change</span>
                                                <input type="file" name="thumbnail_image1" class="hidden"
                                                    id="thumbnail_image1" accept="image/*"
                                                    @change="image2 = URL.createObjectURL($event.target.files[0])">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="color_id" class="block text-sm font-medium mb-2 dark:text-white">
                                            Color</label>
                                        <select id="color_id" name="color_id[]" multiple
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}"
                                                    {{ in_array($color->id, old('color_id', [])) ? 'selected' : '' }}>
                                                    {{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="size_id" class="block text-sm font-medium mb-2 dark:text-white">
                                            Size</label>
                                        <select id="size_id" name="size_id[]" multiple
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}"
                                                    {{ in_array($size->id, old('size_id', [])) ? 'selected' : '' }}>
                                                    {{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="category_id" class="block text-sm font-medium mb-2 dark:text-white">
                                            Category</label>
                                        <select id="category_id" name="category_id[]" multiple
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('category_id', [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="max-w-sm pt-4">
                                        <label for="description" class="block text-sm font-medium mb-2 dark:text-white">
                                            Description</label>
                                        <textarea id="description" name="description"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Description">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
