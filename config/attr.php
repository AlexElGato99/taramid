<?php

return [
    'page_limit' => '12',
    'update' => 'update/',
    'favicon' => [
        'path' => 'favicon/',
        'sizes' => [
            '192' => 'android-chrome-192x192',
            '512' => 'android-chrome-512x512',
            '180' => 'apple-touch-icon',
            '16' => 'favicon-16x16',
            '32' => 'favicon-32x32',
            '150' => 'mstile-150x150'
        ],
    ],
    'manifest' => [
        'name' => '',
        'short_name' => [
            [
                "src" => "/android-chrome-192x192.png",
                "sizes" => "192x192",
                "type" => "image/png"
            ],
            [
                "src" => "/android-chrome-512x512.png",
                "sizes" => "512x512",
                "type" => "image/png"
            ]
        ],
        "theme_color" => "#ffffff",
        "background_color" => "#ffffff",
        "display" => "standalone"
    ],
    'avatar' => [
        'path' => 'uploads/user/',
        'cover_x' => '1536',
        'cover_y' => '256',
        'thumb' => '120',
    ],
    'tinymce' => [
        'path' => 'uploads/tinymce/',
        'large_x' => '860',
    ],
    'payments' => [
        'paypal' => [
            'name' => 'PayPal',
            'type' => 'PayPal account'
        ],
        'stripe' => [
            'name' => 'Stripe',
            'type' => 'Credit card'
        ],
        'coinbase' => [
            'name' => 'Coinbase',
            'type' => 'Cryptocurrency'
        ],
        'bank' => [
            'name' => 'Bank',
            'type' => 'Bank transfer'
        ]
    ],
    'admin' => [
        'admin.index' => [
            'icon' => 'dashboard',
            'nav' => 'dashboard',
            'title' => 'Dashboard',
        ],
        'management' => [
            'header' => 'true',
            'title' => 'Management',
            'class' => 'mt-3',
        ],
        'admin.user.index' => [
            'icon' => 'mic',
            'nav' => 'user',
            'title' => 'Users'
        ],
        'admin.notifications.page' => [
            'icon' => 'bell',
            'nav' => 'notifications',
            'title' => 'Notifications'
        ],
        'website' => [
            'header' => 'true',
            'title' => 'Website',
            'class' => 'mt-8',
        ],
        'admin.hero-slides.index' => [
            'icon' => 'image-add',
            'nav' => 'hero-slides',
            'title' => 'Hero Slides'
        ],
        'admin.quick-stats.index' => [
            'icon' => 'dashboard',
            'nav' => 'quick-stats',
            'title' => 'Quick Statistics'
        ],
        'admin.slider-items.index' => [
            'icon' => 'mic',
            'nav' => 'slider-items',
            'title' => 'Slider'
        ],
        'admin.our-story.index' => [
            'icon' => 'browse',
            'nav' => 'our-story',
            'title' => 'Our Story'
        ],
        'admin.process-section.index' => [
            'icon' => 'settings',
            'nav' => 'process-section',
            'title' => 'Process Section'
        ],
        'admin.process-steps.index' => [
            'icon' => 'collection',
            'nav' => 'process-steps',
            'title' => 'Process Steps'
        ],
        'admin.products-section.index' => [
            'icon' => 'edit',
            'nav' => 'products-section',
            'title' => 'Products Section'
        ],
        'admin.products.index' => [
            'icon' => 'gem',
            'nav' => 'products',
            'title' => 'Our Products'
        ],
        'admin.categories.index' => [
            'icon' => 'browse',
            'nav' => 'categories',
            'title' => 'Categories'
        ],
        'admin.cert-section.index' => [
            'icon' => 'flag',
            'nav' => 'cert-section',
            'title' => 'Certificates Section'
        ],
        'admin.certificates.index' => [
            'icon' => 'medal',
            'nav' => 'certificates',
            'title' => 'Certificates'
        ],
        'admin.faqs.index' => [
            'icon' => 'chat',
            'nav' => 'faqs',
            'title' => 'FAQs'
        ],
        'admin.faq-section.index' => [
            'icon' => 'flag',
            'nav' => 'faq-section',
            'title' => 'FAQ Section'
        ],
        'admin.gallery.index' => [
            'icon' => 'image-add',
            'nav' => 'gallery',
            'title' => 'Gallery'
        ],
        'admin.gallery-section.index' => [
            'icon' => 'flag',
            'nav' => 'gallery-section',
            'title' => 'Gallery Section'
        ],
        'admin.contact-section.index' => [
            'icon' => 'chat',
            'nav' => 'contact-section',
            'title' => 'Contact Section'
        ],
        'admin.footer-section.index' => [
            'icon' => 'link',
            'nav' => 'footer-section',
            'title' => 'Footer'
        ],
        'system' => [
            'header' => 'true',
            'title' => 'System',
            'class' => 'mt-8',
        ],
        'admin.settings.index' => [
            'icon' => 'settings',
            'nav' => 'settings',
            'title' => 'Settings',
            'menu' => [
                'admin.settings.index' => [
                    'title' => 'General',
                ],
                'admin.customize.index' => [
                    'title' => 'Customize',
                ],
            ],
        ],
    ],
    'colors' => [
        'zinc' => [
            50 => '#fafafa',
            100 => '#f4f4f5',
            200 => '#e4e4e7',
            300 => '#d4d4d8',
            400 => '#a1a1aa',
            500 => '#71717a',
            600 => '#52525b',
            700 => '#3f3f46',
            800 => '#27272a',
            900 => '#18181b',
            950 => '#09090b',
        ],
        'slate' => [
            50 => '#f8fafc',
            100 => '#f1f5f9',
            200 => '#e2e8f0',
            300 => '#cbd5e1',
            400 => '#94a3b8',
            500 => '#64748b',
            600 => '#475569',
            700 => '#334155',
            800 => '#1e293b',
            900 => '#0f172a',
            950 => '#020617',
        ],
        'gray' => [
            50 => '#f9fafb',
            100 => '#f3f4f6',
            200 => '#e5e7eb',
            300 => '#d1d5db',
            400 => '#9ca3af',
            500 => '#6b7280',
            600 => '#4b5563',
            700 => '#374151',
            800 => '#1f2937',
            900 => '#111827',
            950 => '#030712',
        ],
        'neutral' => [
            50 => '#fafafa',
            100 => '#f5f5f5',
            200 => '#e5e5e5',
            300 => '#d4d4d4',
            400 => '#a3a3a3',
            500 => '#737373',
            600 => '#525252',
            700 => '#404040',
            800 => '#262626',
            900 => '#171717',
            950 => '#0a0a0a',
        ],
        'stone' => [
            50 => '#fafaf9',
            100 => '#f5f5f4',
            200 => '#e7e5e4',
            300 => '#d6d3d1',
            400 => '#a8a29e',
            500 => '#78716c',
            600 => '#57534e',
            700 => '#44403c',
            800 => '#292524',
            900 => '#1c1917',
            950 => '#0c0a09',
        ],
    ]
];
