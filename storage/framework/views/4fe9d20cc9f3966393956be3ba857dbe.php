<nav class="site-nav fixed top-0 left-0 right-0 z-50" x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 h-[72px] flex items-center justify-between">
        <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2.5 group">
            <?php if(setting('logo')): ?>
                <img src="<?php echo e(asset('static/img/' . setting('logo'))); ?>" alt="<?php echo e(setting('name', 'Taramide')); ?>" class="object-contain" style="height: <?php echo e(setting('logo_height', '28')); ?>px;">
            <?php endif; ?>
        </a>

        <ul class="hidden lg:flex items-center gap-8">
            <li><a href="<?php echo e(url('/')); ?>" class="text-sm text-ash hover:text-ink transition-colors duration-200"><?php echo e(__('Home')); ?></a></li>
            <li><a href="<?php echo e(url('/#about')); ?>" class="text-sm text-ash hover:text-ink transition-colors duration-200"><?php echo e(__('Our Story')); ?></a></li>
            <li><a href="<?php echo e(route('products.index')); ?>" class="text-sm text-ash hover:text-ink transition-colors duration-200"><?php echo e(__('Products')); ?></a></li>
            <li><a href="<?php echo e(url('/#process')); ?>" class="text-sm text-ash hover:text-ink transition-colors duration-200"><?php echo e(__('Process')); ?></a></li>
            <li><a href="<?php echo e(url('/#certs')); ?>" class="text-sm text-ash hover:text-ink transition-colors duration-200"><?php echo e(__('Certifications')); ?></a></li>
        </ul>

        <div class="flex items-center gap-1 sm:gap-3">
            <?php if (isset($component)) { $__componentOriginal8d3bff7d7383a45350f7495fc470d934 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8d3bff7d7383a45350f7495fc470d934 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.language-switcher','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('language-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $attributes = $__attributesOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $component = $__componentOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__componentOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>
            <a href="<?php echo e(route('contact')); ?>" class="hidden md:inline-flex btn-ghost py-2 px-5 text-[13px]"><?php echo e(__('Contact')); ?></a>
            <a href="<?php echo e(route('products.index')); ?>" class="hidden sm:inline-flex btn-fill py-2 px-5 text-[13px]">
                <?php echo e(__('Order Now')); ?>

                <svg class="w-3.5 h-3.5 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <button @click="open = !open" class="lg:hidden w-10 h-10 flex items-center justify-center text-ink" aria-label="Menu">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="lg:hidden absolute left-0 right-0 top-[72px] bg-white border-t border-border px-6 flex flex-col items-center justify-center"
         style="height: calc(100vh - 72px);">
        <div class="space-y-2 text-center">
            <a @click="open = false" href="<?php echo e(url('/')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Home')); ?></a>
            <a @click="open = false" href="<?php echo e(url('/#about')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Our Story')); ?></a>
            <a @click="open = false" href="<?php echo e(route('products.index')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Products')); ?></a>
            <a @click="open = false" href="<?php echo e(url('/#process')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Process')); ?></a>
            <a @click="open = false" href="<?php echo e(url('/#certs')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Certifications')); ?></a>
            <a @click="open = false" href="<?php echo e(route('contact')); ?>" class="block py-3 text-base text-ash hover:text-ink transition-colors"><?php echo e(__('Contact')); ?></a>
        </div>
        <div class="mt-8 pt-6 border-t border-border w-full max-w-xs">
            <?php if (isset($component)) { $__componentOriginal8d3bff7d7383a45350f7495fc470d934 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8d3bff7d7383a45350f7495fc470d934 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.language-switcher','data' => ['mobile' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('language-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['mobile' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $attributes = $__attributesOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $component = $__componentOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__componentOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>
            <div class="h-4"></div>
            <a href="<?php echo e(route('products.index')); ?>" @click="open = false" class="btn-fill w-full justify-center text-[13px] py-3"><?php echo e(__('Order Now')); ?></a>
        </div>
    </div>
</nav>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/sections/nav.blade.php ENDPATH**/ ?>