@props([
    'section' => null,   // key into config/translatable.php, for section pages
    'fields'  => null,   // explicit translatable field list, for model forms
    'form'    => null,   // id of the form to lock; defaults to the nearest one
    'note'    => null,
])

@php
    $languages = site_languages();
    $locale    = admin_locale();
    $isBase    = $locale === base_locale();
    $current   = $languages->get($locale) ?? $languages->first();

    $translatable = $fields ?? ($section ? config('translatable.sections.' . $section, []) : []);
@endphp

@if($languages->count() > 1)
    <div class="mb-6 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 p-4"
         data-lang-panel
         data-is-base="{{ $isBase ? '1' : '0' }}"
         data-form="{{ $form }}"
         data-translatable="{{ json_encode(array_values($translatable)) }}">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3 7.5 7.03 7.5 12s2.015 9 4.5 9ZM3.6 9h16.8M3.6 15h16.8"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Content language') }}</div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                        @if($isBase)
                            {{ $note ?? __('You are editing the default language. Pick another language to translate this content.') }}
                        @else
                            {{ __('Editing the :language version. Fields left empty fall back to the default language on the website.', ['language' => $current->name]) }}
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex-shrink-0 w-full sm:w-56">
                <label for="admin_content_language" class="sr-only">{{ __('Content language') }}</label>
                <select id="admin_content_language"
                        onchange="window.location.href = this.value;"
                        class="block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm px-3 py-2.5 focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 shadow-sm transition-colors">
                    @foreach($languages as $language)
                        <option value="{{ admin_lang_url($language->code) }}" {{ $language->code === $locale ? 'selected' : '' }}>
                            {{ $language->name }}{{ $language->code === base_locale() ? ' — ' . __('Default') : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @unless($isBase)
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-3 pt-3 border-t border-gray-200 dark:border-gray-800">
                {{ __('Only translatable text is editable here. Images, links and other shared settings are managed from the default language.') }}
            </p>
        @endunless
    </div>

    @once
        @push('javascript')
            <script>
                (function () {
                    var RTL_LOCALES = @json(config('languages.rtl', []));

                    // While translating, lock every field that is not
                    // language-specific so it is visibly read-only and is not
                    // submitted -- the server ignores it either way.
                    function lockSharedFields() {
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

                                // Structured fields arrive as name="field[0][part]".
                                // The parts that must stay locked are disabled in
                                // the form itself, so leave the rest editable.
                                var root = name.indexOf('[') === -1 ? name : name.slice(0, name.indexOf('['));
                                if (translatable.indexOf(root) !== -1) return;

                                field.disabled = true;
                                field.classList.add('opacity-50', 'cursor-not-allowed');
                                field.title = @json(__('Managed in the default language'));
                            });
                        });
                    }

                    // Typing Arabic into a left-to-right box is painful, so when
                    // the content language reads right-to-left the editable text
                    // controls flip with it. The admin interface itself stays in
                    // its own language and direction.
                    //
                    // Every content form carries a hidden "lang" input, which is
                    // what identifies the form and the language being edited --
                    // so this works per form, including the gallery page where
                    // each caption is its own form.
                    function applyContentDirection() {
                        document.querySelectorAll('form input[type="hidden"][name="lang"]').forEach(function (marker) {
                            if (RTL_LOCALES.indexOf(marker.value) === -1) return;

                            var form = marker.form || marker.closest('form');
                            if (!form) return;

                            form.setAttribute('data-content-rtl', '');

                            form.querySelectorAll('input[type="text"], input:not([type]), textarea')
                                .forEach(function (field) {
                                    // Locked fields belong to the default language,
                                    // and URLs read wrong reversed.
                                    if (field.disabled || field.readOnly) return;
                                    field.setAttribute('dir', 'rtl');
                                    field.classList.add('text-right');
                                });
                        });
                    }

                    function run() {
                        lockSharedFields();
                        applyContentDirection();
                    }

                    // The stack renders at the end of <body>, so the form is
                    // already parsed and this avoids a flash of the wrong side.
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', run);
                    } else {
                        run();
                    }
                })();
            </script>
        @endpush
    @endonce
@endif
