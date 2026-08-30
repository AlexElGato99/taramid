<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'section' => null,   // key into config/translatable.php, for section pages
    'fields'  => null,   // explicit translatable field list, for model forms
    'form'    => null,   // id of the form to lock; defaults to the nearest one
    'note'    => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'section' => null,   // key into config/translatable.php, for section pages
    'fields'  => null,   // explicit translatable field list, for model forms
    'form'    => null,   // id of the form to lock; defaults to the nearest one
    'note'    => null,
]); ?>
<?php foreach (array_filter(([
    'section' => null,   // key into config/translatable.php, for section pages
    'fields'  => null,   // explicit translatable field list, for model forms
    'form'    => null,   // id of the form to lock; defaults to the nearest one
    'note'    => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $languages = site_languages();
    $locale    = admin_locale();
    $isBase    = $locale === base_locale();
    $current   = $languages->get($locale) ?? $languages->first();

    $translatable = $fields ?? ($section ? config('translatable.sections.' . $section, []) : []);
?>

<?php if($languages->count() > 1): ?>
    <div class="mb-6 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 p-4"
         data-lang-panel
         data-is-base="<?php echo e($isBase ? '1' : '0'); ?>"
         data-form="<?php echo e($form); ?>"
         data-translatable="<?php echo e(json_encode(array_values($translatable))); ?>">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3 7.5 7.03 7.5 12s2.015 9 4.5 9ZM3.6 9h16.8M3.6 15h16.8"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e(__('Content language')); ?></div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                        <?php if($isBase): ?>
                            <?php echo e($note ?? __('You are editing the default language. Pick another language to translate this content.')); ?>

                        <?php else: ?>
                            <?php echo e(__('Editing the :language version. Fields left empty fall back to the default language on the website.', ['language' => $current->name])); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="flex-shrink-0 w-full sm:w-56">
                <label for="admin_content_language" class="sr-only"><?php echo e(__('Content language')); ?></label>
                <select id="admin_content_language"
                        onchange="window.location.href = this.value;"
                        class="block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm px-3 py-2.5 focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 shadow-sm transition-colors">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(admin_lang_url($language->code)); ?>" <?php echo e($language->code === $locale ? 'selected' : ''); ?>>
                            <?php echo e($language->name); ?><?php echo e($language->code === base_locale() ? ' — ' . __('Default') : ''); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <?php if (! ($isBase)): ?>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-3 pt-3 border-t border-gray-200 dark:border-gray-800">
                <?php echo e(__('Only translatable text is editable here. Images, links and other shared settings are managed from the default language.')); ?>

            </p>
        <?php endif; ?>
    </div>

    <?php if (! ($isBase)): ?>
        <?php if (! $__env->hasRenderedOnce('48c4026c-0701-4993-9754-f71b7ae03cc2')): $__env->markAsRenderedOnce('48c4026c-0701-4993-9754-f71b7ae03cc2'); ?>
            <?php $__env->startPush('javascript'); ?>
                <script>
                    // During a translation pass, lock every field that is not
                    // language-specific so it is visibly read-only and is not
                    // submitted -- the server ignores it either way.
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('[data-lang-panel][data-is-base="0"]').forEach(function (panel) {
                            var translatable = JSON.parse(panel.dataset.translatable || '[]');
                            if (!translatable.length) return;

                            var formId = panel.dataset.form;
                            var form = formId ? document.getElementById(formId)
                                              : panel.parentElement.querySelector('form');
                            if (!form) return;

                            var always = ['_token', '_method', 'lang'];

                            form.querySelectorAll('input, select, textarea').forEach(function (field) {
                                var name = (field.name || '').replace(/\[\]$/, '');
                                if (!name || always.indexOf(name) !== -1) return;
                                if (translatable.indexOf(name) !== -1) return;

                                field.disabled = true;
                                field.classList.add('opacity-50', 'cursor-not-allowed');
                                field.title = <?php echo json_encode(__('Managed in the default language'), 15, 512) ?>;
                            });
                        });
                    });
                </script>
            <?php $__env->stopPush(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\Dev_Projects\Laravel_Projects\taramid\projectfiles\allfilesbackupstaramid\resources\views/components/admin/lang-select.blade.php ENDPATH**/ ?>