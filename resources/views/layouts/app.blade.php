<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Toast Notification Container -->
    <div x-data="toastNotifications()" x-init="init()" @notify.window="show($event.detail)"
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
                                <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
            return {
                toasts: [],
                init() {
                    // Check for Laravel session messages
                    @if(session()->has('success'))
                        this.show({
                            type: 'success',
                            title: 'Success',
                            message: '{{ session('success') }}'
                        });
                    @endif

                    @if(session()->has('error'))
                        this.show({
                            type: 'error',
                            title: 'Error',
                            message: '{{ session('error') }}'
                        });
                    @endif

                    @if(session()->has('warning'))
                        this.show({
                            type: 'warning',
                            title: 'Warning',
                            message: '{{ session('warning') }}'
                        });
                    @endif

                    @if(session()->has('info'))
                        this.show({
                            type: 'info',
                            title: 'Info',
                            message: '{{ session('info') }}'
                        });
                    @endif

                    // Check for validation errors
                    @if($errors->any())
                        this.show({
                            type: 'error',
                            title: 'Validation Error',
                            message: 'Please check the form for errors'
                        });
                    @endif
                },
                show(toast) {
                    const id = Date.now();
                    const newToast = {
                        id,
                        type: toast.type || 'info',
                        title: toast.title || this.getDefaultTitle(toast.type),
                        message: toast.message || '',
                        progress: 100,
                        timeout: null
                    };

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
                    switch(type) {
                        case 'success': return 'Success';
                        case 'error': return 'Error';
                        case 'warning': return 'Warning';
                        default: return 'Info';
                    }
                }
            }
        }

        // Helper function to dispatch notifications from anywhere
        window.notify = function(type, title, message) {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { type, title, message }
            }));
        };
    </script>
</body>

</html>
