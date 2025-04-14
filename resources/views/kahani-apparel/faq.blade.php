@extends('layouts.kahani')

@section('title', 'Kahani Apparel')

@section('content')

    <main>
        <section class=""
            style="background-image: url('{{ asset('kahani-apparel/assets/bg-sky.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; ">
            <div class="container | mx-auto flex justify-center items-center p-10">
                <h1 class="text-3xl font-bold text-center font-roxborough">FAQs</h1>
            </div>
        </section>


        <section class="">
            <div class="container | mx-auto max-w-[1200px] p-10 md:p-20">
                <div class="flex flex-wrap flex-col justify-around items-center sm:gap-x-0 gap-x-10">
                    <div class="w-full divide-y divide-neutral-300 overflow-hidden rounded-sm border border-neutral-300  dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-300">
                        <div x-data="{ isExpanded: false }">
                            <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-4  p-4 text-left underline-offset-2 hover:/75 focus-visible:/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75 font-roxborough text-base" aria-controls="accordionItemOne" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-normal'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
                                What browsers are supported?
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                            <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne" x-collapse>
                                <div class="p-4 text-sm sm:text-base font-roxborough">
                                    Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-white">documentation</a> for additional information.
                                </div>
                            </div>
                        </div>
                        <div x-data="{ isExpanded: false }">
                            <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-4  p-4 text-left underline-offset-2 hover:/75 focus-visible:/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75 font-roxborough text-base" aria-controls="accordionItemTwo" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-normal'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
                                How can I contact customer support?
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                            <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo" x-collapse>
                                <div class="p-4 text-sm sm:text-base font-roxborough">
                                    Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-white">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
                                </div>
                            </div>
                        </div>
                        <div x-data="{ isExpanded: false }">
                            <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-4  p-4 text-left underline-offset-2 hover:/75 focus-visible:/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75 font-roxborough text-base" aria-controls="accordionItemThree" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-normal'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
                                What is the refund policy?
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                            <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree" x-collapse>
                                <div class="p-4 text-sm sm:text-base font-roxborough">
                                    Please refer to our <a href="#" class="underline underline-offset-2 text-white">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>





    </main>

@endsection
