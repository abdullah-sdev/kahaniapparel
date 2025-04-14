@extends('layouts.kahani')

@section('title', 'Kahani Apparel')

@section('content')

    <main>
        <section class=""
            style="background-image: url('{{ asset('kahani-apparel/assets/bg-sky.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="container | mx-auto flex justify-center items-center p-10">
                <h1 class="text-3xl font-bold text-center font-roxborough">Privacy Policy</h1>
            </div>
        </section>


        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        1. Introduction
                    </h2>
                    <p class="text-white/70 text-left">
                        Welcome to Kahani Apparel (“we,” “our,” or “us”). Your privacy is important to us, and we are
                        committed to protecting your personal information. This Privacy Policy explains how we collect, use,
                        share, and safeguard your data when you visit our website or use our services. By accessing our
                        platform, you agree to the terms outlined in this policy.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        2. Information We Collect
                    </h2>
                    <p class="text-white/70 text-left">
                        To provide a seamless shopping experience, we may collect the following details:
                    </p>

                    <ul class="list-disc pl-6 text-white/70 text-left">
                        <li>
                            <strong>Personal Details</strong> – Your name, contact number, email address, and delivery address.
                        </li>
                        <li>
                            <strong>Payment Information</strong> – When you make a purchase, your payment is processed securely
                            through our third-party payment partner.
                        </li>
                        <li>
                            <strong>Device & Usage Data</strong> – Information about how you navigate our website and the device
                            you use.
                        </li>
                    </ul>



                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        3. How We Use Your Information
                    </h2>
                    <p class="text-white/70 text-left">
                        We use your data for the following purposes:
                    </p>
                    <ul class="list-disc pl-6 text-white/70 text-left">
                        <li>Processing and shipping your orders.</li>
                        <li>Providing customer support and responding to inquiries.</li>
                        <li>Sending order confirmations and other important notifications.</li>
                        <li>Improving our website and enhancing your shopping experience.</li>
                        <li>Sharing promotions and updates (only with your consent).</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        4. Data Protection
                    </h2>
                    <p class="text-white/70 text-left">
                        We take appropriate measures to keep your personal information secure and prevent unauthorized
                        access, loss, or misuse.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        5. Cookies & Tracking
                    </h2>
                    <p class="text-white/70 text-left">
                        Our website may use cookies and similar tracking technologies to improve functionality and
                        understand user behavior. You can adjust your cookie preferences through your browser settings.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        6. Sharing of Information
                    </h2>
                    <p class="text-white/70 text-left">
                        We only share your information with third-party service providers, such as payment processors and
                        delivery partners, to fulfill your orders and enhance our services. We do not sell or trade your
                        personal data.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        7. Your Rights
                    </h2>
                    <p class="text-white/70 text-left">
                        You have the right to request access, modifications, or deletion of your personal information. To
                        make a request or ask any privacy-related questions, please contact us at
                        {{ env('MAIL_FROM_ADDRESS') }}.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        8. Policy Updates
                    </h2>
                    <p class="text-white/70 text-left">
                        This Privacy Policy may be updated from time to time. We recommend checking this page periodically
                        for any changes.
                    </p>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-start sm:gap-x-0 gap-x-10">
                    <h2 class="text-3xl font-bold mb-8  font-roxborough">
                        9. Contact Us
                    </h2>
                    <p class="text-white/70 text-left">
                        If you have any questions about this policy or your personal data, feel free to reach out:
                        Kahani Apparel
                        [Your Business Address]
                        Email: [your email]
                    </p>
                </div>
            </div>
        </section>




    </main>

@endsection
