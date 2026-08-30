<?php
    $faqs = \App\Models\Faq::active()->withTranslations()->ordered()->get();
?>

<?php if($faqs->count()): ?>
<section id="faq" class="py-24 lg:py-32 bg-white">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <div class="badge mx-auto mb-6"><?php echo e(setting('faq_badge', __('FAQ'))); ?></div>
            <h2 class="font-display text-heading text-ink leading-tight mb-5">
                <?php echo e(setting('faq_heading', __('Frequently asked questions'))); ?>

            </h2>
            <?php if(setting('faq_description')): ?>
                <p class="text-base text-ash leading-relaxed"><?php echo e(setting('faq_description')); ?></p>
            <?php endif; ?>
        </div>

        <div class="space-y-3" x-data="{ active: null }">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card overflow-hidden reveal <?php echo e($index > 0 ? 'reveal-delay-' . min($index, 4) : ''); ?>">
                <button @click="active === <?php echo e($faq->id); ?> ? active = null : active = <?php echo e($faq->id); ?>"
                        class="w-full flex items-center justify-between gap-4 px-6 py-5 text-start">
                    <span class="text-sm font-medium text-ink"><?php echo e($faq->t('question')); ?></span>
                    <svg class="w-4 h-4 text-ash flex-shrink-0 transition-transform duration-300"
                         :class="active === <?php echo e($faq->id); ?> ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="active === <?php echo e($faq->id); ?>"
                     x-collapse
                     x-cloak>
                    <div class="px-6 pb-5 text-sm text-ash leading-relaxed border-t border-border pt-4">
                        <?php echo nl2br(e($faq->t('answer'))); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/faq.blade.php ENDPATH**/ ?>