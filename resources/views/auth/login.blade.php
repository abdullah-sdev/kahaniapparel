{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.kahani')

@section('title', 'Kahani Apparel')

@section('content')

    <main>



        {{-- <section class="login">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">



                </div>
            </div>
        </section> --}}
        <section>
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20 text-black">

                <div class="flex justify-center mx-auto max-w-[700px] flex-col-reverse md:flex-row gap-10 md:gap-0">
                    <div class="bg-white  md:rounded-none md:rounded-l-3xl md:w-2/3 rounded-3xl md:border-black md:border-2">

                        <div class="p-10"
                            style="background: url('{{ asset('kahani-apparel/assets/backgrounds/bg-blackbg.svg') }}'); background-size: 768px; background-repeat: repeat;">

                            <h2 class="text-xl font-bold mb-8 text-center font-roxborough">Login to Your Account</h2>
                            <h3 class="text-2xl font-black mb-8 text-center font-roxborough text-black">
                                User Login
                            </h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="flex flex-col gap-3">
                                    <div class="inputgrp | flex flex-col ">
                                        <label for="email" class="text-sm">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            required autofocus autocomplete="username"
                                            class="bg-white border rounded-md border-black placeholder:text-black p-2 h-8">
                                    </div>

                                    <div class="inputgrp | flex flex-col ">
                                        <label for="password" class="text-sm">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="bg-white border rounded-md border-black placeholder:text-black  p-2 h-8">
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded border-gray-300 text-bblue shadow-sm focus:ring-bblue"
                                                name="remember">
                                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    <button type="submit"
                                        class="inline-block bg-bblue/80 rounded text-black font-black hover:bg-bblue hover:text-black transition-all duration-100 py-2">Login</button>
                                </div>
                            </form>
                        </div>



                    </div>

                    <div
                        class="bg-bblue text-black md:rounded-none md:rounded-r-3xl rounded-3xl flex flex-col justify-center align-middle items-center md:w-1/2 md:border-black md:border-2">

                        <div class="p-10 h-full flex flex-col justify-center align-middle items-center"
                            style="background: url('{{ asset('kahani-apparel/assets/backgrounds/bg-blackbg.svg') }}'); background-size: 768px; background-repeat: repeat;">


                            <h3 class="text-xl font-black mb-2 text-center font-roxborough">For inquiries contact us
                                at:</h3>
                            <p class="mb-2 text-center font-roxborough">kahaniapparel@gmail.com</p>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    </main>

@endsection
