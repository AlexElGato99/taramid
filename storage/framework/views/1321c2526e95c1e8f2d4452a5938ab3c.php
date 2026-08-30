<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(text_direction()); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php
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
    ?>

    <title><?php echo e($seoTitle); ?></title>

    <?php if($seoDesc): ?>
    <meta name="description" content="<?php echo e($seoDesc); ?>">
    <?php endif; ?>
    <?php if($seoKeywords): ?>
    <meta name="keywords" content="<?php echo e($seoKeywords); ?>">
    <?php endif; ?>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
    <meta property="og:title" content="<?php echo e($ogTitle); ?>">
    <meta property="og:site_name" content="<?php echo e($siteName); ?>">
    <?php if($ogDesc): ?>
    <meta property="og:description" content="<?php echo e($ogDesc); ?>">
    <?php endif; ?>
    <?php if($ogImage): ?>
    <meta property="og:image" content="<?php echo e($ogImage); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <?php endif; ?>
    <meta property="og:locale" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <meta name="twitter:card" content="<?php echo e($ogImage ? 'summary_large_image' : 'summary'); ?>">
    <meta name="twitter:title" content="<?php echo e($ogTitle); ?>">
    <?php if($ogDesc): ?>
    <meta name="twitter:description" content="<?php echo e($ogDesc); ?>">
    <?php endif; ?>
    <?php if($ogImage): ?>
    <meta name="twitter:image" content="<?php echo e($ogImage); ?>">
    <?php endif; ?>

    <?php if(setting('google_verification')): ?>
    <meta name="google-site-verification" content="<?php echo e(setting('google_verification')); ?>">
    <?php endif; ?>

    <?php if($favType === 'svg' && file_exists(public_path('favicon/favicon.svg'))): ?>
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon/favicon.svg')); ?>?v=<?php echo e($favV); ?>">
    <?php else: ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-touch-icon.png')); ?>?v=<?php echo e($favV); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>?v=<?php echo e($favV); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?>?v=<?php echo e($favV); ?>">
    <?php endif; ?>
    <link rel="manifest" href="<?php echo e(asset('site.webmanifest')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <?php if(is_rtl()): ?>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <?php endif; ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/frontend.css', 'resources/js/frontend.js']); ?>
    <?php
        $btnColor = setting('button_color', '#2B5F3F');
        if ($btnColor && $btnColor !== '#2B5F3F') {
            $r = hexdec(substr($btnColor, 1, 2));
            $g = hexdec(substr($btnColor, 3, 2));
            $b = hexdec(substr($btnColor, 5, 2));
            $hoverR = min(255, $r + 30);
            $hoverG = min(255, $g + 30);
            $hoverB = min(255, $b + 30);
        }
    ?>
    <?php if(isset($r)): ?>
    <style>
        :root {
            --btn-color: <?php echo e($btnColor); ?>;
            --btn-hover: rgb(<?php echo e($hoverR); ?>, <?php echo e($hoverG); ?>, <?php echo e($hoverB); ?>);
            --btn-shadow: rgba(<?php echo e($r); ?>, <?php echo e($g); ?>, <?php echo e($b); ?>, 0.35);
            --btn-bg-subtle: rgba(<?php echo e($r); ?>, <?php echo e($g); ?>, <?php echo e($b); ?>, 0.04);
            --btn-bg-badge: rgba(<?php echo e($r); ?>, <?php echo e($g); ?>, <?php echo e($b); ?>, 0.08);
            --btn-focus-ring: rgba(<?php echo e($r); ?>, <?php echo e($g); ?>, <?php echo e($b); ?>, 0.1);
        }
    </style>
    <?php endif; ?>
    <?php if(setting('custom_code')): ?>
    <?php echo setting('custom_code'); ?>

    <?php endif; ?>
</head>
<body class="bg-white text-ink antialiased overflow-x-hidden font-body">
    <?php
        $schemaName = setting('schema_business_name', setting('site_name', config('app.name')));
        $schemaType = setting('schema_business_type', 'Organization');
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "<?php echo e($schemaType); ?>",
        "name": "<?php echo e(e($schemaName)); ?>",
        "url": "<?php echo e(url('/')); ?>"
        <?php if(setting('logo')): ?>
        ,"logo": "<?php echo e(asset('static/img/' . setting('logo'))); ?>"
        <?php endif; ?>
        <?php if(setting('seo_description')): ?>
        ,"description": "<?php echo e(e(setting('seo_description'))); ?>"
        <?php endif; ?>
        <?php if(setting('schema_email')): ?>
        ,"email": "<?php echo e(e(setting('schema_email'))); ?>"
        <?php endif; ?>
        <?php if(setting('schema_phone')): ?>
        ,"telephone": "<?php echo e(e(setting('schema_phone'))); ?>"
        <?php endif; ?>
        <?php if(setting('schema_address')): ?>
        ,"address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo e(e(setting('schema_address'))); ?>"
        }
        <?php endif; ?>
        <?php if(setting('schema_founding_date')): ?>
        ,"foundingDate": "<?php echo e(e(setting('schema_founding_date'))); ?>"
        <?php endif; ?>
        <?php if(setting('schema_price_range')): ?>
        ,"priceRange": "<?php echo e(e(setting('schema_price_range'))); ?>"
        <?php endif; ?>
        <?php
            $socials = array_filter([
                setting('facebook'),
                setting('twitter'),
                setting('instagram'),
                setting('youtube'),
            ]);
        ?>
        <?php if(count($socials)): ?>
        ,"sameAs": <?php echo json_encode(array_values($socials)); ?>

        <?php endif; ?>
    }
    </script>

    <?php if(setting('google_analytics')): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(setting('google_analytics')); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo e(setting('google_analytics')); ?>');
    </script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/layouts/app.blade.php ENDPATH**/ ?>