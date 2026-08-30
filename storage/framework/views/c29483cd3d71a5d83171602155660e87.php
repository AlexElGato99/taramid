<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name','class']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name','class']); ?>
<?php foreach (array_filter((['name','class']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<svg
    xmlns="http://www.w3.org/2000/svg"
    stroke-linecap="round"
    stroke-width="1.75"
    stroke-linejoin="round"
    <?php echo e($attributes->merge(['class' => "$class"])); ?>>
    <use xlink:href="<?php echo e(asset('static/sprite/sprite.svg')); ?>#<?php echo e($name); ?>"></use>
</svg>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/components/ui/icon.blade.php ENDPATH**/ ?>