
@extends('layouts.kahani')

@section('title', 'Kahani Apparel | Contact')

@section('content')

    <main>
        <section class=""
            style="background-image: url('{{ asset('kahani-apparel/assets/bg-sky.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="container | mx-auto flex justify-center items-center p-10">
                <h1 class="text-3xl font-bold text-center font-roxborough">Customer Support</h1>
            </div>
        </section>



        <section>
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                {{-- <h2 class="text-3xl font-bold mb-8 text-center font-roxborough">Customer Support</h2> --}}
                <div class="flex justify-center mx-auto max-w-[700px] flex-col-reverse md:flex-row gap-10 md:gap-0">
                    <div
                        class="bg-bblue p-10 md:rounded-none md:rounded-l-3xl md:w-1/2 rounded-3xl md:border-black md:border-2">
                        <h3 class="text-2xl font-black mb-8 text-center font-roxborough text-black">Send Us A
                            Message</h3>
                        <form action="#" method="get">
                            <div class="flex flex-col gap-3">
                                <input type="text" name="name" id="name" placeholder="Name"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <input type="email" name="email" id="email" placeholder="Email"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <input type="text" name="subject" id="subject" placeholder="Subject"
                                    class="bg-transparent border-0 border-b-2 border-white placeholder:text-white">
                                <textarea name="message" id="message" placeholder="Your Message Here"
                                    class="bg-transparent border border-b-2 border-white placeholder:text-white   focus-within:border-b-2 focus-within:ring-0"></textarea>
                                <button type="submit"
                                    class="bg-white rounded text-black font-black hover:bg-black hover:text-white transition-all duration-100">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div
                        class="bg-white p-10 text-black md:rounded-none md:rounded-r-3xl rounded-3xl flex flex-col justify-center align-middle items-center md:w-1/2 md:border-black md:border-2">

                        <h3 class="text-xl font-black mb-2 text-center font-roxborough">For inquiries contact us
                            at:</h3>
                        <p class="mb-2 text-center font-roxborough">kahaniapparel@gmail.com</p>

                    </div>
                </div>
            </div>
        </section>



    </main>

@endsection
