{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Emplyzer Selection - SAW Method System">
    <meta name="author" content="Emplyzzer">

    <title>{{ $title ?? 'Emplyzer Dashboard' }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Extra Styles --}}
    @stack('styles')
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed": "#dae2fd",
                        "primary": "#000000",
                        "tertiary-container": "#271901",
                        "secondary-fixed": "#d8e2ff",
                        "on-primary-fixed": "#131b2e",
                        "on-primary-container": "#7c839b",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#e4e2e4",
                        "on-secondary-fixed-variant": "#004395",
                        "background": "#fcf8fa",
                        "outline-variant": "#c6c6cd",
                        "primary-fixed-dim": "#bec6e0",
                        "tertiary": "#000000",
                        "tertiary-fixed": "#fcdeb5",
                        "error-container": "#ffdad6",
                        "on-tertiary-container": "#98805d",
                        "on-tertiary-fixed-variant": "#574425",
                        "secondary-container": "#2170e4",
                        "secondary-fixed-dim": "#adc6ff",
                        "surface": "#fcf8fa",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#f0edef",
                        "surface-container-low": "#f6f3f5",
                        "on-secondary": "#ffffff",
                        "outline": "#76777d",
                        "surface-dim": "#dcd9db",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#001a42",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#3f465c",
                        "on-secondary-container": "#fefcff",
                        "surface-bright": "#fcf8fa",
                        "surface-variant": "#e4e2e4",
                        "secondary": "#0058be",
                        "inverse-primary": "#bec6e0",
                        "on-surface": "#1b1b1d",
                        "inverse-surface": "#303032",
                        "on-background": "#1b1b1d",
                        "primary-container": "#131b2e",
                        "surface-tint": "#565e74",
                        "tertiary-fixed-dim": "#dec29a",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#eae7e9",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed": "#271901",
                        "on-surface-variant": "#45464d",
                        "inverse-on-surface": "#f3f0f2"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "32px",
                        "lg": "24px",
                        "md": "16px",
                        "sm": "8px",
                        "container-margin": "24px",
                        "gutter": "20px",
                        "base": "4px",
                        "xs": "4px"
                    },
                    "fontFamily": {
                        "headline-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "display-xl": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "data-tabular": ["Inter"]
                    },
                    "fontSize": {
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "500"
                        }],
                        "display-xl": ["36px", {
                            "lineHeight": "44px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["24px", {
                            "lineHeight": "32px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "data-tabular": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "500"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #F4F7FE;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .ambient-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }

        .active-nav-border {
            border-right-width: 4px;
        }
    </style>
</head>

<body class="font-body-md text-on-surface antialiased">

    @include('layouts.partials.sidebar')

    <main class="ml-[260px] min-h-screen">

        @include('layouts.partials.navbar')
        <section class="flex-1 p-8">
            @yield('content')
        </section>

    </main>
    @include('layouts.partials.footer')

    {{-- Floating Action Button --}}
    @include('layouts.partials.fab')

    @if (session('success'))
        <div class="fixed top-5 right-5 z-[999] bg-emerald-500 text-white px-5 py-3 rounded-xl shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-5 right-5 z-[999] bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    @stack('scripts')
</body>

</html>
