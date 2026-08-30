<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" dir="{{ text_direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_name', config('app.name')) }}</title>

    @php $favV = setting('favicon_version', '1'); $favType = setting('favicon_type', 'png'); @endphp
    @if($favType === 'svg' && file_exists(public_path('favicon/favicon.svg')))
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon/favicon.svg')}}?v={{ $favV }}">
    @else
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}?v={{ $favV }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}?v={{ $favV }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}?v={{ $favV }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])

    @php
        $btnColor = setting('button_color', '#2B5F3F');
        if ($btnColor && $btnColor !== '#2B5F3F') {
            $r = hexdec(substr($btnColor, 1, 2));
            $g = hexdec(substr($btnColor, 3, 2));
            $b = hexdec(substr($btnColor, 5, 2));
        }
    @endphp
    @if(isset($r))
    <style>
        :root {
            --btn-color: {{ $btnColor }};
        }
    </style>
    @endif
    @if(setting('custom_code'))
    {!! setting('custom_code') !!}
    @endif
</head>
<body class="min-h-screen bg-[#fafaf8] font-body text-ink antialiased flex flex-col">
    <div class="flex-1 flex items-center justify-center px-4 py-12">
        @yield('content')
    </div>
</body>
</html>
