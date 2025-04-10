<!DOCTYPE html>
<html lang="en" x-data="productView()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page - {{ $product->name }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <!-- Product Images -->
            <div class="mb-8 lg:mb-0">
                <div class="bg-white rounded-lg overflow-hidden shadow mb-4">
                    <img x-bind:src="selectedImage" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                </div>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->gallery as $image)
                        <button @click="selectedImage = '{{ $image->image_path }}'" class="border rounded overflow-hidden hover:border-blue-500 transition" :class="{ 'border-blue-500': selectedImage === '{{ asset('storage/'.$image) }}' }">
                            <img src="{{ $image->image_path }}'" alt="" class="w-full h-20 object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center mb-4">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $product->rating)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-gray-600 ml-2">{{ $product->review_count }} reviews</span>
                    </div>
                </div>

                <p class="text-2xl text-gray-900 mb-6">${{ number_format($product->price, 2) }}</p>

                <div class="mb-6">
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>

                <!-- Color Selection -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Color</h3>
                    <div class="flex space-x-2">
                        @foreach($product->colors as $color)
                            <button
                                @click="selectedColor = '{{ $color->id }}'"
                                class="w-8 h-8 rounded-full border-2 flex items-center justify-center"
                                :class="{
                                    'border-blue-500': selectedColor === '{{ $color->id }}',
                                    'border-transparent': selectedColor !== '{{ $color->id }}'
                                }"
                                style="background-color: {{ $color->hex }}"
                                title="{{ $color->name }}"
                            ></button>
                        @endforeach
                    </div>
                    <p x-show="selectedColor" class="mt-1 text-sm text-gray-500">Selected: <span x-text="selectedColor"></span></p>
                </div>

                <!-- Size Selection -->
                <div class="mb-6" x-show="availableSizes.length > 0">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-sm font-medium text-gray-900">Size</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Size guide</a>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->sizes as $size)
                            <button
                                @click="selectedSize = '{{ $size }}'"
                                :disabled="!availableSizes.includes('{{ $size }}')"
                                class="py-2 px-3 border rounded-md text-center text-sm font-medium"
                                :class="{
                                    'bg-blue-600 text-white border-blue-600': selectedSize === '{{ $size }}',
                                    'border-gray-300 text-gray-900 hover:bg-gray-50': selectedSize !== '{{ $size }}' && availableSizes.includes('{{ $size }}'),
                                    'border-gray-200 text-gray-400 cursor-not-allowed': !availableSizes.includes('{{ $size }}')
                                }"
                            >
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                    <p x-show="selectedSize" class="mt-1 text-sm text-gray-500">Selected: <span x-text="selectedSize"></span></p>
                </div>

                <!-- Quantity Selection -->
                <div class="mb-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Quantity</h3>
                    <div class="flex items-center">
                        <button
                            @click="if(quantity > 1) quantity--"
                            class="bg-gray-200 px-3 py-1 rounded-l-md hover:bg-gray-300"
                        >
                            -
                        </button>
                        <input
                            type="number"
                            x-model="quantity"
                            min="1"
                            max="10"
                            class="w-16 text-center border-t border-b border-gray-300 py-1"
                        >
                        <button
                            @click="if(quantity < 10) quantity++"
                            class="bg-gray-200 px-3 py-1 rounded-r-md hover:bg-gray-300"
                        >
                            +
                        </button>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4">
                    <button
                        @click="addToCart()"
                        class="flex-1 bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Add to cart
                    </button>
                    <button
                        @click="checkout()"
                        class="flex-1 bg-white border border-gray-300 rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Checkout
                    </button>
                </div>

                <!-- Success Message -->
                <div
                    x-show="showSuccess"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="mt-4 p-3 bg-green-100 text-green-700 rounded-md"
                    x-text="successMessage"
                ></div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="mt-16">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Product Details</h2>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Product Information</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Material</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $product->material }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Dimensions</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $product->dimensions }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Weight</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $product->weight }} kg</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">SKU</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $product->sku }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <script>
        function productView() {
            return {
                selectedImage: '{{ $product->gallery[0] ?? '' }}',
                selectedColor: '{{ $product->colors[0] ?? '' }}',
                selectedSize: '{{ $product->sizes[0] ?? '' }}',
                quantity: 1,
                availableSizes: JSON.parse('@json($product->available_sizes)'),
                showSuccess: false,
                successMessage: '',

                addToCart() {
                    // Validate selection
                    if (!this.validateSelection()) return;

                    // Simulate API call
                    fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id }},
                            color: this.selectedColor,
                            size: this.selectedSize,
                            quantity: this.quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.showSuccessMessage('Item added to cart successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error adding the item to your cart.');
                    });
                },

                checkout() {
                    // Validate selection
                    if (!this.validateSelection()) return;

                    // Redirect to checkout with product details
                    const params = new URLSearchParams();
                    params.append('product_id', {{ $product->id }});
                    params.append('color', this.selectedColor);
                    params.append('size', this.selectedSize);
                    params.append('quantity', this.quantity);

                    window.location.href = '{{ route("checkout") }}?' + params.toString();
                },

                validateSelection() {
                    if (!this.selectedColor) {
                        alert('Please select a color');
                        return false;
                    }

                    if (this.availableSizes.length > 0 && !this.selectedSize) {
                        alert('Please select a size');
                        return false;
                    }

                    return true;
                },

                showSuccessMessage(message) {
                    this.successMessage = message;
                    this.showSuccess = true;

                    // Hide after 3 seconds
                    setTimeout(() => {
                        this.showSuccess = false;
                    }, 3000);
                }
            }
        }
    </script>
</body>
</html>
