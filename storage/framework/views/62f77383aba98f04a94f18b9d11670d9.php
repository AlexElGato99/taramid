<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false, 'size']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false, 'size']); ?>
<?php foreach (array_filter((['disabled' => false, 'size']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $size = [
        'xs' => 'px-2.5 py-2 text-xs',
        'sm' => 'px-3 py-2.5 text-sm leading-4',
        'md' => 'px-4 py-3 text-sm',
        'lg' => 'px-4 py-3.5 text-base',
        'xl' => 'px-6 py-4 text-base'
    ][$size ?? 'md']
?>

<textarea <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm '.$size.' focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 placeholder-gray-400 shadow-sm dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors']); ?>><?php echo e($slot); ?></textarea>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/components/form/textarea.blade.php ENDPATH**/ ?>