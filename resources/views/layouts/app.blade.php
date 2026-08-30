<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ text_direction() }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = setting('site_name', config('app.name'));
        $seoTitle = setting('seo_title', $siteName);
        $seoDesc = setting('seo_description', '');
        $seoKeywords = setting('seo_keywords', '');
        $ogTitle = setting('og_title', '') ?: $seoTitle;
        $ogDesc = setting('og_description', '') ?: $seoDesc;
        $ogImage = setting('og_image') ? asset('storage/' . setting('og_image')) : '';
        $canonicalUrl = url()->current();
        $favV = setting('favicon_version', '1');
        $favType = setting('favicon_type', 'png');
    @endphp

    <title>{{ $seoTitle }}</title>

    @if($seoDesc)
    <meta name="description" content="{{ $seoDesc }}">
    @endif
    @if($seoKeywords)
    <meta name="keywords" content="{{ $seoKeywords }}">
    @endif
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    @if($ogDesc)
    <meta property="og:description" content="{{ $ogDesc }}">
    @endif
    @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    @endif
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    @if($ogDesc)
    <meta name="twitter:description" content="{{ $ogDesc }}">
    @endif
    @if($ogImage)
    <meta name="twitter:image" content="{{ $ogImage }}">
    @endif

    @if(setting('google_verification'))
    <meta name="google-site-verification" content="{{ setting('google_verification') }}">
    @endif

    @if($favType === 'svg' && file_exists(public_path('favicon/favicon.svg')))
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon/favicon.svg')}}?v={{ $favV }}">
    @else
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}?v={{ $favV }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}?v={{ $favV }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}?v={{ $favV }}">
    @endif
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    @if(is_rtl())
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
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
<body class="bg-white text-ink antialiased overflow-x-hidden font-body">
    @php
        $schemaName = setting('schema_business_name', setting('site_name', config('app.name')));
        $schemaType = setting('schema_business_type', 'Organization');
    @endphp
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "{{ $schemaType }}",
        "name": "{{ e($schemaName) }}",
        "url": "{{ url('/') }}"
        @if(setting('logo'))
        ,"logo": "{{ asset('static/img/' . setting('logo')) }}"
        @endif
        @if(setting('seo_description'))
        ,"description": "{{ e(setting('seo_description')) }}"
        @endif
        @if(setting('schema_email'))
        ,"email": "{{ e(setting('schema_email')) }}"
        @endif
        @if(setting('schema_phone'))
        ,"telephone": "{{ e(setting('schema_phone')) }}"
        @endif
        @if(setting('schema_address'))
        ,"address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ e(setting('schema_address')) }}"
        }
        @endif
        @if(setting('schema_founding_date'))
        ,"foundingDate": "{{ e(setting('schema_founding_date')) }}"
        @endif
        @if(setting('schema_price_range'))
        ,"priceRange": "{{ e(setting('schema_price_range')) }}"
        @endif
        @php
            $socials = array_filter([
                setting('facebook'),
                setting('twitter'),
                setting('instagram'),
                setting('youtube'),
            ]);
        @endphp
        @if(count($socials))
        ,"sameAs": {!! json_encode(array_values($socials)) !!}
        @endif
    }
    </script>

    @if(setting('google_analytics'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ setting('google_analytics') }}');
    </script>
    @endif
    @yield('content')
    @stack('scripts')
</body>
</html>
