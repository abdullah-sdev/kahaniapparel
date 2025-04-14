@extends('layouts.kahani')

@section('title', 'Kahani Apparel')

@section('content')

    <main>
        <section class=""
            style="background-image: url('{{ asset('kahani-apparel/assets/bg-sky.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="container | mx-auto flex justify-center items-center p-10">
                <h1 class="text-3xl font-bold text-center font-roxborough">About Us</h1>
            </div>
        </section>


        <section class="about_us">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">About <span class="text-bblue">Kahani
                            Apparel</span> </h2>
                    <p class="text-white/70 text-center">
                        At <span class="text-bblue">Kahani Apparel</span>, fashion meets storytelling. Our designs go beyond
                        prints—they are expressions of
                        individuality, culture, humor, and poetry. Whether it’s deep Urdu verses, witty pop culture
                        references, or artistic illustrations, our apparel speaks for you.
                        We believe that every piece of clothing tells a story, and through our designs, we bring those
                        stories to life.
                    </p>
                </div>
            </div>
        </section>


        <section class="about_us">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Our Journey </h2>
                    <p class="text-white/70 text-center">
                        <span class="text-bblue">Kahani Apparel</span> began as a small custom print-on-demand store with a vision to bring meaningful
                        designs to life. What started as a passion for poetry and creative expression soon evolved into a
                        brand that blends fashion with emotions, humor, and art. Today, we offer a diverse collection of
                        apparel that allows you to express yourself in the most stylish way possible.
                    </p>
                </div>
            </div>
        </section>


        <section class="about_us">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Our Collections </h2>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Kahani Collection</b> – Featuring poetry and written expressions on T-shirts, hoodies,
                        drop-shoulder
                        apparel, and more.

                    </p>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Statement Tees</b> – Bold, witty, and relatable phrases that make a statement.

                    </p>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Art-Inspired Apparel</b> – Unique graphics, including pop culture mashups and creative illustrations.

                    </p>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Minimalist & Aesthetic Designs</b> – Clean, simple, and modern styles for a sleek look.

                    </p>
                </div>
            </div>
        </section>
        <section class="about_us">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Why Choose Us? </h2>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">High-Quality Fabrics</b>  – Ensuring comfort, durability, and a premium feel.

                    </p>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Custom Prints</b> – A variety of humorous, artistic, and poetic designs.

                    </p>
                    <p class="text-white/70 text-center">

                        <b class="text-white/80">Wearable Stories</b> – Every piece tells a story, emotion, or thought.

                    </p>
                    {{-- <p class="text-white/70 text-center">

                        Join us and wear your Kahani with confidence!

                    </p> --}}
                </div>
            </div>
        </section>


    </main>

@endsection
