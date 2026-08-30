<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false, 'size','href'=>false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false, 'size','href'=>false]); ?>
<?php foreach (array_filter((['disabled' => false, 'size','href'=>false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $size = [
        'xs' => 'px-3 py-2 text-xs',
        'sm' => 'px-4 py-2.5 text-sm leading-4',
        'md' => 'px-6 py-3.5 text-sm',
        'lg' => 'px-6 py-4 !text-base',
        'icon' => 'p-0 flex items-center justify-center w-12 h-12'
    ][$size ?? 'md']
?>
<?php if($href): ?>
    <a <?php echo $attributes->merge(['href'=> $href,'class' => "inline-flex whitespace-nowrap gap-x-3 items-center justify-center $size rounded-base font-[450] disabled:opacity-50 disabled:pointer-events-none transition"]); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo e($attributes->merge(['class' => "inline-flex whitespace-nowrap gap-x-3 items-center justify-center $size rounded-base font-[450] disabled:opacity-50 disabled:pointer-events-none transition"])); ?>>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/components/form/button.blade.php ENDPATH**/ ?>