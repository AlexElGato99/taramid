<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false, 'size', 'type' => 'text']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false, 'size', 'type' => 'text']); ?>
<?php foreach (array_filter((['disabled' => false, 'size', 'type' => 'text']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-6 py-4 text-base'
    ][$size ?? 'md'];
    
    // For file inputs, use specific styling
    $defaultClasses = $type === 'file' 
        ? 'block w-full text-sm text-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-800 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-primary-500 file:text-white hover:file:bg-primary-600 file:cursor-pointer transition-colors' 
        : 'block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm '.$size.' focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 placeholder-gray-400 shadow-sm dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors';
?>

<input type="<?php echo e($type); ?>" <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => $defaultClasses]); ?>>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/components/form/input.blade.php ENDPATH**/ ?>