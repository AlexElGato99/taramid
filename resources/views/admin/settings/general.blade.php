<div class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
        <div class="lg:col-span-4">
            <x-form.label for="logo" :value="__('Logo')"/>
            <x-form.file id="logo" name="logo" type="file" class="mt-1 block w-full" placeholder="{{__('logo')}}"/>
            @if(config('settings.logo'))
                <div class="mt-2 flex items-center gap-2 p-2 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <img src="{{asset('static/img/'.config('settings.logo'))}}" alt="Logo" class="h-8 object-contain">
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{__('Current')}}</span>
                </div>
            @endif
        </div>
        <div class="lg:col-span-4">
            <x-form.label for="favicon" :value="__('Favicon')"/>
            <x-form.file id="favicon" name="favicon" type="file" class="mt-1 block w-full" placeholder="{{__('Favicon')}}" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml,image/x-icon,image/bmp"/>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">PNG, JPG, GIF, WebP, SVG, ICO, BMP</p>
        </div>
        <div class="lg:col-span-4">
            <x-form.label for="logo_height" :value="__('Logo Size')"/>
            <div class="mt-1 flex items-center gap-3">
                <input type="range" id="logo_height" name="logo_height" min="16" max="80" step="2"
                       value="{{ old('logo_height', config('settings.logo_height', '28')) }}"
                       class="settings-slider flex-1 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                       oninput="document.getElementById('logo-size-val').textContent = this.value + 'px'; var p = document.getElementById('logo-preview'); if(p) p.style.height = this.value + 'px';">
                <span id="logo-size-val" class="text-xs font-mono text-gray-600 dark:text-gray-300 w-10 text-right">{{ old('logo_height', config('settings.logo_height', '28')) }}px</span>
            </div>
            @if(config('settings.logo'))
            <div class="mt-2 flex items-center justify-center p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                <img id="logo-preview" src="{{asset('static/img/'.config('settings.logo'))}}" alt="Preview"
                     style="height: {{ old('logo_height', config('settings.logo_height', '28')) }}px;"
                     class="object-contain transition-all duration-200">
            </div>
            @endif
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Header logo height (16-80px)')}}</p>
        </div>
    </div>

    <hr class="border-gray-100 dark:border-gray-800">

    <div>
        <x-form.label for="custom_code" :value="__('Custom code')"/>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{__('Add custom scripts to the <head> section of your site (e.g. Google Tag Manager, analytics, meta tags)')}}</p>
        <x-form.textarea name="custom_code"
                         placeholder="<!-- Google tag (gtag.js) -->&#10;<script async src=&quot;https://www.googletagmanager.com/gtag/js?id=G-XXXXXXX&quot;></script>">{{old('custom_code', config('settings.custom_code'))}}</x-form.textarea>
    </div>
</div>

<style>
    .settings-slider { -webkit-appearance: none; appearance: none; background: transparent; }
    .settings-slider::-webkit-slider-runnable-track { height: 6px; border-radius: 3px; background: #e5e7eb; }
    .dark .settings-slider::-webkit-slider-runnable-track { background: #374151; }
    .settings-slider::-webkit-slider-thumb { -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%; background: #2563eb; border: 2px solid #fff; cursor: pointer; margin-top: -6px; box-shadow: 0 1px 4px rgba(37,99,235,0.3); }
    .dark .settings-slider::-webkit-slider-thumb { border-color: #1f2937; }
    .settings-slider::-moz-range-track { height: 6px; border-radius: 3px; background: #e5e7eb; border: none; }
    .dark .settings-slider::-moz-range-track { background: #374151; }
    .settings-slider::-moz-range-thumb { width: 18px; height: 18px; border-radius: 50%; background: #2563eb; border: 2px solid #fff; cursor: pointer; box-shadow: 0 1px 4px rgba(37,99,235,0.3); }
    .dark .settings-slider::-moz-range-thumb { border-color: #1f2937; }
    .settings-slider::-moz-range-progress { height: 6px; border-radius: 3px; background: #2563eb; }
    .settings-slider:focus { outline: none; }
</style>
