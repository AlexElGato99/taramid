<?php
    $processSteps = isset($processSteps) ? $processSteps : \App\Models\ProcessStep::active()->withTranslations()->ordered()->get();
    $defaultIcons = [
        1 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>',
        2 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m1.854-.732 2.077 1.199m0 0 7.794-4.5-.803-.215a4.5 4.5 0 0 0-2.48.043l-5.326 1.629a4.324 4.324 0 0 0-2.068 1.379M14.538 12.61l-2.077 1.199"/>',
        3 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19 14.5M14.25 3.104c.251.023.501.05.75.082M19 14.5l-1.5 4.5H6.5L5 14.5m14 0H5"/>',
        4 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>',
    ];
?>
<section id="process" class="py-24 lg:py-32 bg-white">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16 reveal">
            <div class="badge mx-auto mb-6"><?php echo e(setting('process_badge', __('Our Process'))); ?></div>
            <h2 class="font-display text-heading text-ink leading-tight">
                <?php echo e(setting('process_heading_line1', __('From plant to bottle,'))); ?><br><?php echo e(setting('process_heading_line2', __('a unique expertise'))); ?>

            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php $__currentLoopData = $processSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-surface rounded-2xl p-7 hover:shadow-card transition-all duration-300 group reveal <?php echo e($index > 0 ? 'reveal-delay-' . $index : ''); ?>">
                <div class="text-4xl font-display font-bold text-border mb-5 group-hover:text-primary/15 transition-colors"><?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                <div class="w-10 h-10 rounded-xl bg-primary/8 flex items-center justify-center mb-5 group-hover:bg-primary/12 transition-colors">
                    <?php if($step->icon): ?>
                        <div class="w-8 h-8" style="background-color: #2B5F3F; -webkit-mask-image: url('<?php echo e(asset('storage/' . $step->icon)); ?>'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-image: url('<?php echo e(asset('storage/' . $step->icon)); ?>'); mask-size: contain; mask-repeat: no-repeat; mask-position: center;"></div>
                    <?php else: ?>
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?php echo $defaultIcons[$index + 1] ?? $defaultIcons[1]; ?></svg>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-lg text-ink font-medium mb-2"><?php echo e($step->t('title')); ?></h4>
                <p class="text-sm text-ash leading-relaxed"><?php echo e($step->t('description')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/process.blade.php ENDPATH**/ ?>