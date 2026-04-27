<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Emplyzer' }}</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Vite --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Extra Styles --}}
    @stack('styles')
</head>

<body class="font-[Inter] bg-[#F4F7FE] text-slate-900 antialiased">

    {{-- Page Content --}}
    @yield('content')
    @include('layouts.partials.flash')

    {{-- Extra Scripts --}}
    @stack('scripts')


    @if (session('modal_success'))
        <x-alert type="success" title="Success!" :message="session('modal_success')" button="Go Back to Dashboard" />
    @endif
</body>

</html>
