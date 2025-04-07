<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Addresses') }}
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
                                <form method="POST" action="{{ route('addresses.store') }}" class="p-5">
                                    @csrf

                                    <div class="max-w-sm">

                                        <input type="hidden" id="user_id" name="user_id" value="4"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="User">
                                    </div>
                                    <div class="max-w-sm pt-4">
                                        <label for="name"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Name</label>
                                        <input type="text" id="name" name="name"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Name">
                                    </div>
                                    <div class="max-w-sm pt-4">
                                        <label for="address1"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Address 1</label>
                                        <input type="text" id="address1" name="address1"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Address 1">
                                    </div>
                                    <div class="max-w-sm mt-4">
                                        <label for="address2"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Address 2</label>
                                        <input type="text" id="address2" name="address2"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Address 2">
                                    </div>
                                    <div class="max-w-sm mt-4">
                                        <label for="country"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Country</label>
                                        <input type="text" id="country" name="country"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Country">
                                    </div>
                                    <div class="max-w-sm mt-4">
                                        <label for="city"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            City</label>
                                        <input type="text" id="city" name="city"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="City">
                                    </div>
                                    <div class="max-w-sm mt-4">
                                        <label for="state"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            State</label>
                                        <input type="text" id="state" name="state"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="State">
                                    </div>
                                    <div class="max-w-sm mt-4">
                                        <label for="postalCode"
                                            class="block text-sm font-medium mb-2 dark:text-white">
                                            Postal Code</label>
                                        <input type="text" id="postalCode" name="postalCode"
                                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Postal Code">
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
