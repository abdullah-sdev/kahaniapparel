<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link rel="shortcut icon" href="{{ asset('kahani-apparel/assets/Logos/logo_white.png') }}" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <link rel="stylesheet" href="assets/css/main.css"> --}}
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="main bg-black font-body text-white relative min-h-screen" id="main">
        <header class="">
            <div class="container mx-auto max-w-[1200px]" x-data="{ open: false }">
                <div class="flex justify-between items-center border-b border-gray-200 p-4">
                    <div class="font-bold hidden sm:block gap-2">
                        {{-- @hasrole(\App\Enums\RoleEnum::ADMIN)
                            <div class="font-semibold text-white">{{ Auth::user()->name }}</div>
                        @endhasrole --}}
                        @role(\App\Enums\RoleEnum::ADMIN->value)
                            <div class="font-roxborough font-thin text-white text-[17px] relative" x-data="{ open: false }" x-cloak>
                                <button @click="open = !open" class="text-bblue hover:underline inline-flex align-middle">
                                    <div><span class="material-icons text-[22px] text-white">person</span></div>
                                    <div class="ml-2">{{ Auth::user()->fullname() }}</div>
                                </button>

                                <ul x-show="open" @click.outside="open = false"
                                    class="absolute right-0 mt-2 max-w-48 bg-white rounded-md shadow-lg py-1">

                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('Super Admin') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('kahani.panel') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        @endrole

                        @role(\App\Enums\RoleEnum::CUSTOMER->value)
                            <div class="font-roxborough font-thin text-white text-[17px] relative" x-data="{ open: false }" x-cloak>
                                <button @click="open = !open" class="text-bblue hover:underline inline-flex align-middle">
                                    <div><span class="material-icons text-[22px] text-white">person</span></div>
                                    <div class="ml-2">{{ Auth::user()->fullname() }}</div>
                                </button>
                                <ul x-show="open" @click.outside="open = false"
                                    class="absolute right-0 mt-2 max-w-48 bg-white rounded-md shadow-lg py-1">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        @endrole
                        @guest
                            <div class="flex gap-2 flex-wrap">
                                <a href="{{ route('login') }}"
                                    class="inline-block button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">
                                    Login
                                </a>
                                <a href="{{ route('register') }}"
                                    class="inline-block button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">
                                    Register
                                </a>
                            </div>

                        @endguest


                    </div>
                    <div>
                        <a href="{{ route('kahani.home') }}">
                            <img src="{{ asset('kahani-apparel/assets/Logos/logo_white.png') }}" class="h-[70px]"
                                alt="">
                        </a>
                    </div>
                    <div class="flex justify-between items-center gap-2 ">
                        <div class="cart-utility">
                            <a href="{{ route('kahani.cart') }}">
                                <div
                                    class="px-2 py-2 flex items-center rounded-full bg-white hover:bg-gray-300 transition-all duration-100">

                                    <img src="{{ asset('kahani-apparel/assets/icons/Cart.png') }}" class="w-[20px]"
                                        alt="">

                                </div>
                            </a>
                        </div>
                        <div class="search-utility hidden sm:inline-block">
                            <input type="search" placeholder="Search here..."
                                class="text-black p-2 w-[200px] rounded-full">
                        </div>
                        <button class="sm:hidden material-icons text-white cursor-pointer" x-on:click="open = ! open">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" x-show="!open"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" x-show="open"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>

                        </button>
                    </div>

                </div>
                <!-- Screen Navigation -->
                <div class="nav-head hidden sm:block">
                    <ul
                        class="flex flex-col sm:flex-row items-center sm:justify-between max-w-[1000px] mx-auto px-4 min-h-screen sm:min-h-fit absolute bg-black sm:static w-full gap-6 py-6 sm:py-0">
                        <li><a href="{{ route('kahani.home') }}"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">Home</a>
                        </li>
                        <li><a href="{{ route('kahani.products') }}"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">Shop</a>
                        </li>
                        <li><a href="#"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">About
                                Us</a></li>
                        <li><a href="#"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">Contact
                                Us</a></li>
                        <li class="sm:hidden">
                            <div class="font-bold p-2">
                                <button
                                    class="button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">Login</button>
                                <button
                                    class="button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">Register</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Mobile Navigation -->
                <div class="nav-head sm:hidden" x-show="open" x-transition.duration.500ms x-cloak
                    x-trap.inert.noscroll="open" x-on:keydown.esc.window="open = false">
                    <ul
                        class="flex flex-col sm:flex-row items-center sm:justify-between max-w-[1000px] mx-auto px-4 min-h-screen sm:min-h-fit absolute bg-black sm:static w-full gap-6 py-6 sm:py-0">
                        <li><a href="{{ route('kahani.home') }}"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">
                                Home
                            </a>
                        </li>
                        <li><a href="{{ route('kahani.products') }}"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">
                                Shop
                            </a>
                        </li>
                        <li><a href="#"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">
                                About
                                Us
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="font-roxborough font-black p-2 text-gray-200 hover:text-bblue inline-block transition-all duration-100">
                                Contact
                                Us
                            </a>
                        </li>
                        <li class="sm:hidden">
                            <div class="font-bold p-2">
                                <button
                                    class="button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">Login</button>
                                <button
                                    class="button border-gray-400 hover:gray-100 hover:text-gray-100 hover:border-0 hover:bg-bblue text-gray-300 border px-2 transition-all duration-100 rounded text-[20px] font-normal">Register</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <div class=""
            style="background: url('{{ asset('kahani-apparel/assets/backgrounds/bg-2.svg') }}'); background-size: 768px; background-repeat: repeat;">
            @yield('content')
        </div>

        <footer>
            <div>
                <div class="| p-2 bg-bblue relative">
                    <div class="">
                        <div class="mx-auto max-w-[1100px] border-b border-white/50 p-2">
                            <ul class="flex justify-center gap-4 text-[18px] flex-col md:flex-row items-center">
                                <li><a class="text-white/70 hover:text-white"
                                        href="{{ route('kahani.home') }}">Home</a></li>
                                <li><a class="text-white/70 hover:text-white" href="#">FAQ</a></li>
                                <li><a class="text-white/70 hover:text-white" href="#">Privacy Policy</a></li>
                                <li><a class="text-white/70 hover:text-white" href="#">Delivery Policy</a></li>
                                <li><a class="text-white/70 hover:text-white" href="#">Return Policy</a></li>
                            </ul>
                        </div>
                        <div
                            class="flex justify-between gap-4 text-[18px] align-middle text-black max-w-[1100px] mx-auto items-center flex-col md:flex-row">
                            <div class="pt-3 px-3 ">
                                <img src="{{ asset('kahani-apparel/assets/Logos/logo_black.png') }}"
                                    alt="kahani apparel" class="h-[60px] inline-block">
                            </div>

                            <div class="flex justify-center align-middle mt-3 items-center gap-3">
                                <a href="#" class="facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="22"
                                        height="22" viewBox="0 0 50 50">
                                        <path
                                            d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"
                                            stroke="black" stroke-width="0"></path>
                                    </svg>
                                </a>
                                <a href="#" class="instagram align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="21"
                                        height="21" viewBox="0 0 50 50">
                                        <path
                                            d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z"
                                            stroke="black" stroke-width="3"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="font-black font-roxborough">
                                &copy; 2025 Kahani Apparel
                            </div>
                        </div>

                    </div>

                    <div class="absolute bottom-0 left-0">
                        <svg width="25px" height="25px" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0L25 25H0L0 0Z" fill="#000" />
                        </svg>
                    </div>
                    <div class="absolute top-0 left-0">
                        <svg width="25px" height="25px" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <polygon points="0,0 0,25 25,0" style="fill: #000" />
                        </svg>
                    </div>
                    <div class="absolute top-0 right-0">
                        <svg width="25px" height="25px" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <polygon points="0,0 25,0 25,25" style="fill: #000" />
                        </svg>
                    </div>
                    <div class="absolute bottom-0 right-0">
                        <svg width="25px" height="25px" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <polygon points="25,0 25,25 0,25" style="fill: #000" />
                        </svg>
                    </div>
                </div>
            </div>
        </footer>
        {{-- <div x-data="{modalIsOpen: true}">
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                <!-- Modal Dialog -->
                <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                    <!-- Dialog Header -->
                    <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">Special Offer</h3>
                        <button x-on:click="modalIsOpen = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Dialog Body -->
                    <div class="px-4 py-8">
                        <p>As a token of appreciation, we have an exclusive offer just for you. Upgrade your account now to unlock premium features and enjoy a seamless experience.</p>
                    </div>
                    <!-- Dialog Footer -->
                    <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                        <button x-on:click="modalIsOpen = false" type="button" class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Remind me later</button>
                        <button x-on:click="modalIsOpen = false" type="button" class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Upgrade Now</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


    {{-- <script src="assets/script.js"></script> --}}

    <!-- Toast Notification Container -->
    <div x-data="toastNotifications()" @notify.window="show($event.detail)"
        class="fixed inset-0 flex flex-col items-end justify-start px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50 space-y-4">
        <template x-for="(toast, index) in toasts" :key="index">
            <div x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto overflow-hidden"
                :class="{
                    'ring-2 ring-green-500': toast.type === 'success',
                    'ring-2 ring-red-500': toast.type === 'error',
                    'ring-2 ring-blue-500': toast.type === 'info',
                    'ring-2 ring-yellow-500': toast.type === 'warning'
                }">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <template x-if="toast.type === 'success'">
                                <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </template>
                            <template x-if="toast.type === 'error'">
                                <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </template>
                            <template x-if="toast.type === 'info'">
                                <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </template>
                            <template x-if="toast.type === 'warning'">
                                <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </template>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="toast.title" class="text-sm font-medium text-gray-900"></p>
                            <p x-text="toast.message" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(toast.id)"
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex items-center justify-between">
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-green-600 h-1.5 rounded-full"
                            :class="{
                                'bg-green-600': toast.type === 'success',
                                'bg-red-600': toast.type === 'error',
                                'bg-blue-600': toast.type === 'info',
                                'bg-yellow-600': toast.type === 'warning'
                            }"
                            x-bind:style="`width: ${toast.progress}%`"></div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function toastNotifications() {
            // console.log('toastNotifications called');
            return {
                toasts: [],
                init() {
                    // console.log('toasts array:', this.toasts);
                    // Check for Laravel session messages
                    @if (session()->has('success'))
                        this.show({
                            type: 'success',
                            title: 'Success',
                            message: '{{ session('success') }}'
                        });
                    @endif

                    @if (session()->has('error'))
                        this.show({
                            type: 'error',
                            title: 'Error',
                            message: '{{ session('error') }}'
                        });
                    @endif

                    @if (session()->has('warning'))
                        this.show({
                            type: 'warning',
                            title: 'Warning',
                            message: '{{ session('warning') }}'
                        });
                    @endif

                    @if (session()->has('info'))
                        this.show({
                            type: 'info',
                            title: 'Info',
                            message: '{{ session('info') }}'
                        });
                    @endif

                    // Check for validation errors
                    @if ($errors->any())
                        // this.show({
                        //     type: 'error',
                        //     title: 'Validation Error',
                        //     message: 'Please check the form for errors'
                        // });
                        @forelse ($errors->all() as $errorsingle)
                            this.show({
                                type: 'error',
                                title: 'Error',
                                message: '{{ $errorsingle }}'
                            })
                        @empty

                        @endforelse
                    @endif
                },
                show(toast) {
                    const id = Date.now();
                    // const existingToast = this.toasts.find(t => t.id === id);
                    // if (existingToast) {
                    //     return; // toast already exists, do not add again
                    // }
                    const newToast = {
                        id,
                        type: toast.type || 'info',
                        title: toast.title || this.getDefaultTitle(toast.type),
                        message: toast.message || '',
                        progress: 100,
                        timeout: null
                    };
                    // console.log('show(toast) called');
                    // Start progress bar countdown
                    newToast.timeout = setInterval(() => {
                        newToast.progress -= 1;

                        if (newToast.progress <= 0) {
                            this.remove(id);
                        }
                    }, 50);

                    this.toasts.push(newToast);

                    // Auto-remove after 5 seconds
                    setTimeout(() => {
                        this.remove(id);
                    }, 5000);
                },
                remove(id) {
                    const toastIndex = this.toasts.findIndex(t => t.id === id);
                    if (toastIndex >= 0) {
                        clearInterval(this.toasts[toastIndex].timeout);
                        this.toasts.splice(toastIndex, 1);
                    }
                },
                getDefaultTitle(type) {
                    switch (type) {
                        case 'success':
                            return 'Success';
                        case 'error':
                            return 'Error';
                        case 'warning':
                            return 'Warning';
                        default:
                            return 'Info';
                    }
                }
            }
        }

        // Helper function to dispatch notifications from anywhere
        window.notify = function(type, title, message) {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    type,
                    title,
                    message
                }
            }));
            // console.log('notify called');
        };
    </script>
</body>

</html>
