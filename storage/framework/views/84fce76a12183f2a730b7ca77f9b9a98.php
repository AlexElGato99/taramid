<?php
    $slide = isset($heroSlides) && $heroSlides->count() > 0 ? $heroSlides->first() : null;
    $badge = optional($slide)->t('badge_text') ?? '100% Organic';
    $line1 = optional($slide)->t('heading_line1') ?? 'The Pure Essence';
    $line2 = optional($slide)->t('heading_line2') ?? 'of Morocco';
    $desc = optional($slide)->t('description') ?? 'Natural extracts from aromatic and medicinal plants, grown in the valleys of the Middle Atlas. From seed to bottle.';
    $btn1Text = optional($slide)->t('button1_text') ?? 'Our Products';
    $btn1Link = $slide->button1_link ?? '#products';
    $btn2Text = optional($slide)->t('button2_text') ?? 'Our Story';
    $btn2Link = $slide->button2_link ?? '#about';
    $heroImage = $slide && $slide->image ? asset('storage/' . $slide->image) : null;
    $stats = [];
    foreach ([1,2,3,4] as $i) {
        $num = setting('stat'.$i.'_number', '0');
        $suffix = setting('stat'.$i.'_suffix', '');
        $pos = setting('stat'.$i.'_suffix_pos', 'right');
        $label = setting('stat'.$i.'_label', '');
        if ($num || $suffix) {
            $stats[] = compact('num', 'suffix', 'pos', 'label');
        }
    }
?>
<section class="relative min-h-screen bg-white overflow-hidden">
    <?php if($heroImage): ?>
        <div class="absolute inset-0 z-0">
            <img src="<?php echo e($heroImage); ?>" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white/80"></div>
        </div>
    <?php endif; ?>

    <?php
        $heroFloatingIcons = json_decode(setting('hero_floating_icons', '[]'), true) ?: [];
    ?>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 min-h-screen flex items-center justify-center relative z-10 pt-20 lg:pt-[72px]">
        <div class="w-full pb-20 lg:py-0 text-center">

            <div>
                <div class="badge mt-4 lg:mt-6 mb-3 lg:mb-3 reveal mx-auto">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.403 12.998a3 3 0 0 0-2.053-.9 3 3 0 0 0-.87.14 3 3 0 0 1-1.48.09 3 3 0 0 1-1.15-.54 3 3 0 0 0-1.7-.63 3 3 0 0 0-1.7.63 3 3 0 0 1-1.15.54 3 3 0 0 1-1.48-.09 3 3 0 0 0-.87-.14 3 3 0 0 0-2.053.9A9.96 9.96 0 0 1 2 10C2 5.589 5.589 2 10 2s8 3.589 8 8a9.96 9.96 0 0 1-1.597 2.998Z" clip-rule="evenodd"/></svg>
                    <?php echo e($badge); ?>

                </div>

                <div class="relative">
                    <?php if(count($heroFloatingIcons) >= 1): ?>
                    <img src="<?php echo e(asset('storage/' . $heroFloatingIcons[0])); ?>" alt=""
                         class="hero-heading-icon hero-heading-icon--left" aria-hidden="true">
                    <?php endif; ?>
                    <?php if(count($heroFloatingIcons) >= 2): ?>
                    <img src="<?php echo e(asset('storage/' . $heroFloatingIcons[1])); ?>" alt=""
                         class="hero-heading-icon hero-heading-icon--right" aria-hidden="true">
                    <?php endif; ?>
                    <h1 class="font-display text-hero text-ink mb-4 lg:mb-6 reveal reveal-delay-1">
                        <?php echo e($line1); ?><br>
                        <span class="text-primary"><?php echo e($line2); ?></span>
                    </h1>
                </div>

                <p class="text-sm sm:text-base lg:text-lg text-ash leading-relaxed max-w-md mx-auto mb-6 lg:mb-10 reveal reveal-delay-2">
                    <?php echo e($desc); ?>

                </p>

                <div class="flex flex-col sm:flex-row flex-wrap justify-center items-center gap-2.5 sm:gap-3 reveal reveal-delay-3">
                    <?php if($btn1Text): ?>
                    <a href="<?php echo e($btn1Link); ?>" class="btn-fill group">
                        <?php echo e($btn1Text); ?>

                        <svg class="w-4 h-4 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if($btn2Text): ?>
                    <a href="<?php echo e($btn2Link); ?>" class="btn-ghost"><?php echo e($btn2Text); ?></a>
                    <?php endif; ?>
                </div>

                <?php if(count($stats)): ?>
                <div class="flex justify-center gap-8 sm:gap-12 mt-10 pt-8 pb-16 lg:pb-24 border-t border-border reveal reveal-delay-4 max-w-lg mx-auto">
                    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center">
                        <div class="text-2xl font-display font-semibold text-ink">
                            <span data-count="<?php echo e($stat['num']); ?>" data-suffix="<?php echo e($stat['suffix']); ?>" data-suffix-pos="<?php echo e($stat['pos']); ?>"><?php echo e($stat['pos'] === 'left' ? $stat['suffix'] : ''); ?>0<?php echo e($stat['pos'] === 'right' ? $stat['suffix'] : ''); ?></span>
                        </div>
                        <div class="text-xs text-ash mt-1"><?php echo e($stat['label']); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/hero.blade.php ENDPATH**/ ?>