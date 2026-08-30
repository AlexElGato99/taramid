
<?php $__env->startSection('content'); ?>
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(__('Footer Section')); ?></h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e(__('Manage the footer content, branding, and contact details')); ?></p>
        </div>

        <?php if (isset($component)) { $__componentOriginal926beb366dfc19dfa24e4ebe11864896 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal926beb366dfc19dfa24e4ebe11864896 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.lang-select','data' => ['section' => 'footer-section']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin.lang-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['section' => 'footer-section']); ?>
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


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="<?php echo e(route('admin.footer-section.update')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="lang" value="<?php echo e(admin_locale()); ?>">

                <div class="space-y-6">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider"><?php echo e(__('Branding')); ?></h3>

                    <div>
                        <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'footer_logo','value' => __('Footer Logo')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'footer_logo','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Footer Logo'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                        <?php if(config('settings.footer_logo')): ?>
                            <div class="mt-2 mb-3">
                                <img src="<?php echo e(asset('storage/' . config('settings.footer_logo'))); ?>" alt="Footer Logo" class="object-contain rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-2" style="height: <?php echo e(config('settings.logo_height', '28')); ?>px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="footer_logo" accept="image/*"
                               class="block w-full max-w-md text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?php echo e(__('Uses the same size as the navigation logo. Adjust logo size in General Settings.')); ?></p>
                    </div>

                    <div>
                        <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'footer_description','value' => __('Description')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'footer_description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Description'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                        <textarea id="footer_description" name="footer_description" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="<?php echo e(admin_placeholder('footer_description', __('Short brand description'))); ?>"><?php echo e(old('footer_description', admin_value('footer_description', 'Natural extracts from aromatic and medicinal plants of the Moroccan Middle Atlas.'))); ?></textarea>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider"><?php echo e(__('Footer Columns')); ?></h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 -mt-3"><?php echo e(__('Configure the 3 footer columns (after the branding column). Each line can be plain text or a link.')); ?></p>

                    <?php
                        $defaultColumns = [
                            ['title' => 'Navigation', 'lines' => [
                                ['text' => 'Our Story', 'url' => '/#about'],
                                ['text' => 'Products', 'url' => '/products'],
                                ['text' => 'Process', 'url' => '/#process'],
                                ['text' => 'Certifications', 'url' => '/#certs'],
                            ]],
                            ['title' => 'Contact', 'lines' => [
                                ['text' => '+212 661 436 621', 'url' => 'tel:+212661436621'],
                                ['text' => 'ste.taramide@gmail.com', 'url' => 'mailto:ste.taramide@gmail.com'],
                                ['text' => 'Er-rich, Midelt, Maroc', 'url' => ''],
                            ]],
                            ['title' => 'Legal', 'lines' => [
                                ['text' => 'Ste. Taramide SARL AU', 'url' => ''],
                                ['text' => 'en cours', 'url' => ''],
                                ['text' => 'Bio Maroc MA-BIO-102', 'url' => ''],
                            ]],
                        ];
                        // While translating, seed the editor from the default-language
                        // columns so the admin translates the labels in place.
                        $footerColumns = json_decode((string) admin_value('footer_columns', ''), true)
                            ?: (json_decode((string) setting_raw('footer_columns', base_locale(), ''), true) ?: $defaultColumns);
                        $columnsReadonly = admin_locale() !== base_locale();
                    ?>

                    <div x-data='{
                        columns: <?php echo json_encode($footerColumns, 15, 512) ?>,
                        addLine(colIdx) {
                            if (this.columns[colIdx].lines.length < 10) {
                                this.columns[colIdx].lines.push({ text: "", url: "" });
                            }
                        },
                        removeLine(colIdx, lineIdx) {
                            this.columns[colIdx].lines.splice(lineIdx, 1);
                        }
                    }'>
                        <input type="hidden" name="footer_columns" :value="JSON.stringify(columns)">

                        <div class="space-y-6">
                            <template x-for="(col, colIdx) in columns" :key="colIdx">
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400" x-text="'Column ' + (colIdx + 2)"></span>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"><?php echo e(__('Column Title')); ?></label>
                                        <input type="text" x-model="col.title"
                                               class="block w-full max-w-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                               placeholder="Column title">
                                    </div>

                                    <div class="space-y-2">
                                        <template x-for="(line, lineIdx) in col.lines" :key="lineIdx">
                                            <div class="flex items-start gap-2">
                                                <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-2">
                                                    <input type="text" x-model="line.text"
                                                           class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                                           placeholder="Display text">
                                                    <input type="text" x-model="line.url"
                                                           <?php echo e($columnsReadonly ? 'readonly' : ''); ?>

                                                           class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm <?php echo e($columnsReadonly ? 'opacity-60 cursor-not-allowed' : ''); ?>"
                                                           placeholder="<?php echo e($columnsReadonly ? __('Managed in the default language') : __('URL (leave empty for plain text)')); ?>">
                                                </div>
                                                <button type="button" @click="removeLine(colIdx, lineIdx)"
                                                        class="mt-1 p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                    <button type="button" @click="addLine(colIdx)"
                                            x-show="col.lines.length < 10"
                                            class="mt-3 inline-flex items-center gap-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <?php echo e(__('Add line')); ?>

                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider"><?php echo e(__('Bottom Bar & WhatsApp')); ?></h3>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-6">
                            <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'footer_copyright','value' => __('Copyright Text')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'footer_copyright','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Copyright Text'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'footer_copyright','name' => 'footer_copyright','type' => 'text','class' => 'mt-1 block w-full','value' => old('footer_copyright', admin_value('footer_copyright', 'Taramide Cosmetics')),'placeholder' => ''.e(admin_placeholder('footer_copyright', 'Taramide Cosmetics')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'footer_copyright','name' => 'footer_copyright','type' => 'text','class' => 'mt-1 block w-full','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('footer_copyright', admin_value('footer_copyright', 'Taramide Cosmetics'))),'placeholder' => ''.e(admin_placeholder('footer_copyright', 'Taramide Cosmetics')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?php echo e(__('Year is added automatically')); ?></p>
                        </div>
                        <div class="lg:col-span-6">
                            <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'footer_whatsapp','value' => __('WhatsApp Number')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'footer_whatsapp','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('WhatsApp Number'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'footer_whatsapp','name' => 'footer_whatsapp','type' => 'text','class' => 'mt-1 block w-full','value' => old('footer_whatsapp', config('settings.footer_whatsapp', '212661436621')),'placeholder' => '212661436621']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'footer_whatsapp','name' => 'footer_whatsapp','type' => 'text','class' => 'mt-1 block w-full','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('footer_whatsapp', config('settings.footer_whatsapp', '212661436621'))),'placeholder' => '212661436621']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?php echo e(__('Without + or spaces (e.g. 212661436621)')); ?></p>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <?php if (isset($component)) { $__componentOriginald9b334c307e2ff55247e0436e6ae07f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9b334c307e2ff55247e0436e6ae07f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.primary','data' => ['class' => 'max-w-xs w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-w-xs w-full']); ?>
                        <?php echo e(__('Save changes')); ?>

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
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/admin/footer-section/index.blade.php ENDPATH**/ ?>