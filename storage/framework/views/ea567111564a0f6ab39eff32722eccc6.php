<?php
    $sliderItems = isset($sliderItems) ? $sliderItems : \App\Models\SliderItem::active()->withTranslations()->ordered()->get();
?>
<?php if($sliderItems->count()): ?>
<div class="bg-surface py-3.5 overflow-hidden relative border-y border-border">
    <div class="absolute left-0 inset-y-0 w-24 bg-gradient-to-r from-surface to-transparent pointer-events-none z-10"></div>
    <div class="absolute right-0 inset-y-0 w-24 bg-gradient-to-l from-surface to-transparent pointer-events-none z-10"></div>
    <div class="marquee-track flex gap-10 whitespace-nowrap w-max">
        <?php for($i = 0; $i < 3; $i++): ?>
            <?php $__currentLoopData = $sliderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col items-center gap-1.5 px-2">
                    <?php if($item->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $item->logo)); ?>" alt="<?php echo e($item->t('text')); ?>" class="object-contain" style="height: 60px; width: auto;">
                    <?php endif; ?>
                    <span class="text-xs tracking-wider text-ash/60 font-medium"><?php echo e($item->t('text')); ?></span>
                </div>
                <?php if(!$loop->last): ?>
                    <span class="text-primary/20 text-[10px] self-center">&bull;</span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($i < 2): ?>
                <span class="text-primary/20 text-[10px] self-center">&bull;</span>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/marquee.blade.php ENDPATH**/ ?>