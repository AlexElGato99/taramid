
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('sections.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="pt-[72px]">
        <section class="py-20 lg:py-28 bg-surface">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-xl mx-auto mb-16">
                    <div class="badge mx-auto mb-6 reveal"><?php echo e(setting('products_badge', 'Our Range')); ?></div>
                    <h1 class="font-display text-4xl lg:text-5xl text-ink leading-tight reveal reveal-delay-1">
                        <?php echo e(setting('products_heading_line1', 'Our Products')); ?>

                    </h1>
                    <p class="text-base text-ash leading-relaxed mt-4 reveal reveal-delay-2">
                        <?php echo e(setting('products_description', 'All our products are sourced from plants harvested within 100 km of Midelt.')); ?>

                    </p>
                </div>

                <div class="flex flex-col lg:flex-row gap-10">

                    <aside class="w-full lg:w-64 shrink-0 reveal">
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24">
                            <h3 class="font-display text-lg text-ink mb-4"><?php echo e(__('Categories')); ?></h3>
                            <ul class="space-y-1">
                                <li>
                                    <a href="<?php echo e(route('products.index')); ?>"
                                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-colors <?php echo e(!$activeCategory ? 'bg-primary/10 text-primary font-medium' : 'text-ash hover:text-ink hover:bg-gray-50'); ?>">
                                        <span><?php echo e(__('All Products')); ?></span>
                                        <span class="text-xs <?php echo e(!$activeCategory ? 'text-primary' : 'text-ash/60'); ?>"><?php echo e($totalProducts); ?></span>
                                    </a>
                                </li>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products.index', ['category' => $category->slug])); ?>"
                                           class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-colors <?php echo e($activeCategory === $category->slug ? 'bg-primary/10 text-primary font-medium' : 'text-ash hover:text-ink hover:bg-gray-50'); ?>">
                                            <span><?php echo e($category->t('name')); ?></span>
                                            <?php if($category->products_count > 0): ?>
                                                <span class="text-xs <?php echo e($activeCategory === $category->slug ? 'text-primary' : 'text-ash/60'); ?>"><?php echo e($category->products_count); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </aside>

                    <div class="flex-1 min-w-0">
                        <?php if($products->isNotEmpty()): ?>
                            <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="group reveal <?php echo e($index > 0 ? 'reveal-delay-' . min($index, 4) : ''); ?>">
                                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden transition-shadow duration-300 group-hover:shadow-md h-full flex flex-col">
                                            <div class="aspect-square bg-surface relative overflow-hidden">
                                                <?php if($product->image): ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->t('title')); ?>"
                                                         class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-16 h-16 text-ash/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($product->t('badge')): ?>
                                                    <span class="absolute top-3 start-3 text-xs font-medium bg-white/90 backdrop-blur-sm text-ink px-3 py-1 rounded-full"><?php echo e($product->t('badge')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="p-5 flex flex-col flex-1">
                                                <h3 class="font-display text-lg text-ink mb-1 group-hover:text-primary transition-colors"><?php echo e($product->t('title')); ?></h3>
                                                <div class="mt-auto">
                                                    <div class="flex flex-wrap gap-1.5 mt-3 min-h-[28px]">
                                                        <?php if($product->t('tag1')): ?>
                                                            <span class="text-[11px] font-medium text-primary bg-primary/5 px-2.5 py-1 rounded-full"><?php echo e($product->t('tag1')); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($product->t('tag2')): ?>
                                                            <span class="text-[11px] font-medium text-primary bg-primary/5 px-2.5 py-1 rounded-full"><?php echo e($product->t('tag2')); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if($products->hasPages()): ?>
                                <div class="mt-12 flex justify-center">
                                    <?php echo e($products->links()); ?>

                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-center py-16">
                                <svg class="w-16 h-16 text-ash/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                                <p class="text-ash text-lg"><?php echo e(__('No products found in this category.')); ?></p>
                                <?php if($activeCategory): ?>
                                    <a href="<?php echo e(route('products.index')); ?>" class="inline-block mt-4 text-primary hover:underline text-sm font-medium"><?php echo e(__('View all products')); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </section>
    </main>

    <?php echo $__env->make('sections.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/products/index.blade.php ENDPATH**/ ?>