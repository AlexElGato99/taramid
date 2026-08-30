
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(__('Gallery')); ?></h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e(__('Manage images for the gallery slider on the homepage')); ?></p>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginal926beb366dfc19dfa24e4ebe11864896 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal926beb366dfc19dfa24e4ebe11864896 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.lang-select','data' => ['fields' => ['caption']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin.lang-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['caption'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal926beb366dfc19dfa24e4ebe11864896)): ?>
<?php $attributes = $__attributesOriginal926beb366dfc19dfa24e4ebe11864896; ?>
<?php unset($__attributesOriginal926beb366dfc19dfa24e4ebe11864896); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal926beb366dfc19dfa24e4ebe11864896)): ?>
<?php $component = $__componentOriginal926beb366dfc19dfa24e4ebe11864896; ?>
<?php unset($__componentOriginal926beb366dfc19dfa24e4ebe11864896); ?>
<?php endif; ?>

        <?php $translatingGallery = admin_locale() !== base_locale(); ?>

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8 mb-8 <?php echo e($translatingGallery ? 'hidden' : ''); ?>">
            <h2 class="text-base font-medium text-gray-900 dark:text-white mb-4"><?php echo e(__('Upload Images')); ?></h2>
            <form method="POST" action="<?php echo e(route('admin.gallery.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <div class="flex-1 w-full">
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5"><?php echo e(__('Select multiple images at once. Max 5MB each.')); ?></p>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                        <?php echo e(__('Upload')); ?>

                    </button>
                </div>
            </form>
        </div>

        <?php if($images->count()): ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
                    <div class="aspect-square">
                        <img src="<?php echo e(asset('storage/' . $image->image)); ?>" alt="<?php echo e($image->t('caption')); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <form method="POST" action="<?php echo e(route('admin.gallery.update', $image->id)); ?>" class="space-y-2">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="lang" value="<?php echo e(admin_locale()); ?>">
                            <input type="text" name="caption" value="<?php echo e(model_value($image, 'caption', '')); ?>"
                                   placeholder="<?php echo e(model_placeholder($image, 'caption', __('Caption (optional)'))); ?>"
                                   class="block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md py-1.5 px-2">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <input type="number" name="sort_order" value="<?php echo e($image->sort_order); ?>" <?php echo e($translatingGallery ? 'disabled' : ''); ?> class="w-14 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md py-1 px-2" title="<?php echo e(__('Sort Order')); ?>">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" class="sr-only peer" value="1" <?php echo e($translatingGallery ? 'disabled' : ''); ?> <?php echo e($image->is_active ? 'checked' : ''); ?>>
                                        <div class="w-8 h-4.5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-700 font-medium"><?php echo e(__('Save')); ?></button>
                            </div>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.gallery.destroy', $image->id)); ?>" onsubmit="return confirm('<?php echo e(__('Are you sure?')); ?>')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="absolute top-2 right-2 w-7 h-7 bg-black/50 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-colors opacity-0 group-hover:opacity-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($images->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($images->links()); ?>

            </div>
        <?php endif; ?>
        <?php else: ?>
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3 3h18M3 3v18m0-18h.008v.008H3V3Z"/></svg>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('No gallery images yet. Upload some to get started.')); ?></p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>