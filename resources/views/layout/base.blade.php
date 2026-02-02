<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | {{ config('app.name', 'My Company') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>



    @stack('styles')

    @yield('heads')
</head>
{{-- use darkmode in body --}}

<body class="bg-gray-50">
    @yield('layout')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>


    <!-- JavaScript for Interactions -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
    @yield('scripts')

    {{-- Session Messages --}}
    @if(!session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('success') ?? 'Good job!' }}
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 focus:ring-brand-medium hover:bg-brand-soft inline-flex items-center justify-center h-8 w-8 shrink-0 shrink-0"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('error') }}
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 focus:ring-brand-medium hover:bg-brand-soft inline-flex items-center justify-center h-8 w-8 shrink-0 shrink-0"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>
    @endif
</body>

</html>