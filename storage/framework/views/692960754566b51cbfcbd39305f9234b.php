<?php
    $galleryImages = \App\Models\GalleryImage::active()->withTranslations()->ordered()->get();
?>

<?php if($galleryImages->count()): ?>
<section id="gallery" class="py-24 lg:py-32 bg-surface overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <div class="badge mx-auto mb-6"><?php echo e(setting('gallery_badge', __('Gallery'))); ?></div>
            <h2 class="font-display text-heading text-ink leading-tight mb-5">
                <?php echo e(setting('gallery_heading', __('Behind the scenes of our work'))); ?>

            </h2>
            <?php if(setting('gallery_description')): ?>
                <p class="text-base text-ash leading-relaxed"><?php echo e(setting('gallery_description')); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reveal reveal-delay-2">
        <div class="gallery-marquee">
            <div class="gallery-marquee__track">
                <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="gallery-marquee__slide">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $image->image)); ?>"
                             alt="<?php echo e($image->t('caption') ?: ''); ?>"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    <?php if($image->t('caption')): ?>
                        <p class="text-sm text-ash mt-3 text-center"><?php echo e($image->t('caption')); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="gallery-marquee__slide">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $image->image)); ?>"
                             alt="<?php echo e($image->t('caption') ?: ''); ?>"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    <?php if($image->t('caption')): ?>
                        <p class="text-sm text-ash mt-3 text-center"><?php echo e($image->t('caption')); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/gallery.blade.php ENDPATH**/ ?>