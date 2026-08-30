<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="{{ text_direction() }}">
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
    @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
    @php
        $btnColor = setting('button_color', '#2B5F3F');
        if ($btnColor && $btnColor !== '#2B5F3F') {
            $r = hexdec(substr($btnColor, 1, 2));
            $g = hexdec(substr($btnColor, 3, 2));
            $b = hexdec(substr($btnColor, 5, 2));
            $hoverR = min(255, $r + 30);
            $hoverG = min(255, $g + 30);
            $hoverB = min(255, $b + 30);
        }
    @endphp
    @if(isset($r))
    <style>
        :root {
            --btn-color: {{ $btnColor }};
            --btn-hover: rgb({{ $hoverR }}, {{ $hoverG }}, {{ $hoverB }});
            --btn-shadow: rgba({{ $r }}, {{ $g }}, {{ $b }}, 0.35);
            --btn-bg-subtle: rgba({{ $r }}, {{ $g }}, {{ $b }}, 0.04);
            --btn-bg-badge: rgba({{ $r }}, {{ $g }}, {{ $b }}, 0.08);
            --btn-focus-ring: rgba({{ $r }}, {{ $g }}, {{ $b }}, 0.1);
        }
    </style>
    @endif
    @if(setting('custom_code'))
    {!! setting('custom_code') !!}
    @endif
</head>
<body class="min-h-screen bg-white dark:bg-gray-950 text-gray-900 dark:text-white flex flex-col">
<div class="flex-1">
    @yield('content')
</div>
</body>
</html>
