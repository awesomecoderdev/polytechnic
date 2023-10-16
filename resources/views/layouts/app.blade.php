<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- start::head --}} @yield('head') {{-- end::head --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.0.0/turbolinks.min.js"
        integrity="sha512-ifx27fvbS52NmHNCt7sffYPtKIvIzYo38dILIVHQ9am5XGDQ2QjSXGfUZ54Bs3AXdVi7HaItdhAtdhKz8fOFrA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" min-h-screen bg-primary/15 font-sans antialiased ">
    {{-- start::header --}} @yield('header') {{-- end::header --}}

    <main id="main" class="relative">
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
    {{-- start::content --}} @yield('content') {{-- end::content --}}
    {{-- start::script --}} @yield('script') {{-- end::script --}}
</body>

</html>
