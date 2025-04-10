@extends('layouts.kahani')

@section('title', 'Kahani Apparel | Caffeine and Chaos')

@section('content')
    <main>
        <section class=" | mx-auto max-w-[1200px] p-5 md:p-10 ">
            <div class=" mb-8 mt-2 pb-1 place-items-center w-full relative text-center">
                <h2 class="text-3xl font-bold">Wishlist</h2>
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 rounded-lg border border-bblue">
                    <div class="grid">
                        <div class="p-4">
                            <div class="text-[16px]">
                                <img src="https://placehold.co/500/grey/white?font=playfair-display&text=OZ" alt=""
                                    class="inline-block w-12 h-12 rounded-full">
                                Hello, <span class="text-bblue">{{ auth()->user()->fullname() }}</span>
                            </div>
                        </div>
                        <div class="border-y border-bblue px-4 py-1">My Account</div>
                        <div class="font-roxborough p-4 grid gap-2">
                            <div>My Profile</div>
                            <div>Address</div>
                            <div>Orders</div>
                            <div>Returns</div>
                            <div>Cancellations</div>
                            <div>Reviews</div>
                            <div>Recently Viewed</div>
                        </div>
                        <div class="border-y border-bblue py-1 px-4">
                            <form method="POST" action="{{ route('logout') }}" class="w-full place-items-center">
                                @csrf
                                <button
                                    class="flex gap-2 items-center align-middle justify-center text-white hover:text-bblue">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>
                                    </div>
                                    <div class="flex items-center">Logout</div>
                                </button>
                            </form>
                        </div>
                        <div class="p-4 place-items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-white"></x-application-logo>
                        </div>
                    </div>
                </div>
                <div class="col-span-9 rounded-lg p-2 border border-bblue"></div>
            </div>
        </section>
    </main>
@endsection
