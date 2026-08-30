<!DOCTYPE html>
<html class="dark" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(text_direction()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta itemprop="name"
          content="<?php if(isset($config['title'])): ?><?php echo e($config['title']); ?><?php else: ?><?php echo e(setting('title')); ?><?php endif; ?>">
    <meta itemprop="description"
          content="<?php if(isset($config['description'])): ?><?php echo e($config['description']); ?><?php else: ?><?php echo e(setting('description')); ?><?php endif; ?>">
    <?php if(!empty($config['image'])): ?>
        <meta itemprop="image" content="<?php echo e($config['image']); ?>">
    <?php endif; ?>

    <meta property="og:type" content="website">
    <meta property="og:title"
          content="<?php if(isset($config['title'])): ?><?php echo e($config['title']); ?><?php else: ?><?php echo e(setting('title')); ?><?php endif; ?>">
    <meta property="og:description"
          content="<?php if(isset($config['description'])): ?><?php echo e($config['description']); ?><?php else: ?><?php echo e(setting('description')); ?><?php endif; ?>">
    <?php if(!empty($config['image'])): ?>
        <meta property="og:image" content="<?php echo e($config['image']); ?>"/>
        <meta property="og:image:type" content="<?php echo e(pathinfo($config['image'])['extension']); ?>"/>
    <?php endif; ?>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">

    <meta name="twitter:card" content="summary_large_image">

    <link rel="canonical" href="<?php echo e(url()->current()); ?>"/>
</head>
<body
    class="min-h-screen bg-gray-50 text-gray-900 flex flex-col relative">

<div
    class="relative before:absolute before:top-0 before:inset-x-0 before:bg-[url('../img/shape.svg')] before:bg-no-repeat before:bg-top before:w-full before:h-full before:-z-[1] flex items-center flex-1 dark:before:opacity-10">
    <div class="max-w-2xl text-center mx-auto">
        <h1 class="block font-bold text-9xl text-gray-900"><?php echo $__env->yieldContent('code'); ?></h1>
        <p class="mt-5 text-3xl font-semibold tracking-tight text-gray-500 dark:text-white/60"><?php echo $__env->yieldContent('message'); ?></p>
        <?php if (isset($component)) { $__componentOriginald9b334c307e2ff55247e0436e6ae07f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9b334c307e2ff55247e0436e6ae07f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.primary','data' => ['href' => ''.e(route('index')).'','class' => '!px-8 !rounded-full mt-7 gap-x-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('index')).'','class' => '!px-8 !rounded-full mt-7 gap-x-3']); ?>
            <span><?php echo e(__('Back to Homepage')); ?></span>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald9b334c307e2ff55247e0436e6ae07f6)): ?>
<?php $attributes = $__attributesOriginald9b334c307e2ff55247e0436e6ae07f6; ?>
<?php unset($__attributesOriginald9b334c307e2ff55247e0436e6ae07f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9b334c307e2ff55247e0436e6ae07f6)): ?>
<?php $component = $__componentOriginald9b334c307e2ff55247e0436e6ae07f6; ?>
<?php unset($__componentOriginald9b334c307e2ff55247e0436e6ae07f6); ?>
<?php endif; ?>
    </div>
</div>
</body>
</html>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/layouts/error.blade.php ENDPATH**/ ?>