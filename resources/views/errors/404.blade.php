@extends('layouts.kahani')

@section('title', 'Kahani Apparel | 404 Error')

@section('content')

    <main>
        <section>
            <div class="container | mx-auto max-w-[1200px] p-5 md:p-10 ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mx-auto">
                    <div class="w-full">
                        <div class="mx-auto">
                            <h2 class="text-3xl font-bold mt-2 mb-4 text-center font-roxborough">404 Error</h2>
                            <p class="text-2xl text-center italic text-white/60">
                                Kahani ka yeh safha kho gaya, <br>
                                Magar kahani abhi baaqi hai.
                            </p>
                        </div>
                        <div class="mt-8 text-white/80">
                            <p>
                                It looks like this page dissappeared into the unknown, <br>
                                but your style isnt over, <br>
                                Let's get you back on track!
                            </p>
                        </div>

                    </div>
                    <div class="w-1/2 mx-auto">
                        <div class="main-img | overflow-hidden max-h-[700px] aspect-square mx-auto">
                            <img src="{{ asset('kahani-apparel/assets/404.png') }}" alt="" class="" >
                        </div>
                    </div>
                </div>
                <div class="text-center mt-10">
                    <a href="{{ route('kahani.home') }}" class="text-white inline-block bg-bblue px-5 py-2 rounded-full">
                        Back to
                        <img src="{{ asset('kahani-apparel/assets/Logos/logo_white.png') }}" class="inline-block ml-2 h-[40px]" alt="">
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection
