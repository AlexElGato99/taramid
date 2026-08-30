@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto w-full">
        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10">
                <div class="lg:col-span-6">
                    <div class="mb-5">
                        <x-form.label for="button_color" :value="__('Button / Accent color')"/>
                        <div class="flex gap-3 items-center mt-1">
                            <input type="color" 
                                   id="button_color_picker" 
                                   value="{{ old('button_color', config('settings.button_color', '#2B5F3F')) }}"
                                   class="h-12 w-20 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600 bg-transparent"
                                   onchange="document.getElementById('button_color').value = this.value">
                            <input type="text" 
                                   id="button_color" 
                                   name="button_color" 
                                   value="{{ old('button_color', config('settings.button_color', '#2B5F3F')) }}"
                                   class="flex-1 h-12 px-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono uppercase focus:ring-2 focus:ring-blue-500"
                                   placeholder="#2B5F3F"
                                   maxlength="7"
                                   oninput="this.value = this.value.toUpperCase(); if(/^#[0-9A-F]{6}$/i.test(this.value)) document.getElementById('button_color_picker').value = this.value">
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Used for buttons, badges, links and focus states')}}</p>
                    </div>
                </div>
                <div class="lg:col-span-12">
                    <hr class="my-6 border-gray-100 dark:border-gray-800">
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Hero Floating Icons')}}</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">{{__('Upload icons that float across the hero section background. Use small PNG or SVG images for best results.')}}</p>

                @php
                    $heroIcons = json_decode(config('settings.hero_floating_icons', '[]'), true) ?: [];
                @endphp

                @if(count($heroIcons))
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-3 mb-4">
                        @foreach($heroIcons as $i => $icon)
                            <div class="relative group" x-data="{ marked: false }">
                                <label class="block cursor-pointer">
                                    <input type="checkbox" name="remove_icons[]" value="{{ $i }}" class="sr-only peer" x-model="marked">
                                    <div class="w-full aspect-square rounded-lg border-2 flex items-center justify-center p-2 transition-all"
                                         :class="marked ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:border-gray-300 dark:hover:border-gray-600'">
                                        <img src="{{ asset('storage/' . $icon) }}" alt="" class="max-w-full max-h-full object-contain" :class="marked ? 'opacity-30' : ''">
                                    </div>
                                    <div class="absolute top-1 right-1 w-5 h-5 rounded-full flex items-center justify-center text-white text-xs transition-all"
                                         :class="marked ? 'bg-red-500' : 'bg-gray-400 opacity-0 group-hover:opacity-100'">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-4">{{__('Click an icon to mark it for removal')}}</p>
                @endif

                <input type="file" name="hero_icons[]" accept="image/*" multiple
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Select multiple files to upload at once')}}</p>
            </div>

            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Favicon')}}</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">{{__('Upload a favicon image (SVG, PNG, JPG). It will be resized automatically for all required sizes.')}}</p>

                @php
                    $favType = config('settings.favicon_type', 'png');
                    $favVersion = config('settings.favicon_version', '1');
                @endphp

                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 rounded-lg border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 flex items-center justify-center p-2">
                        @if($favType === 'svg' && file_exists(public_path('favicon/favicon.svg')))
                            <img src="{{ asset('favicon/favicon.svg') }}?v={{ $favVersion }}" alt="Current favicon" class="max-w-full max-h-full object-contain">
                        @elseif(file_exists(public_path('favicon/favicon-32x32.png')))
                            <img src="{{ asset('favicon/favicon-32x32.png') }}?v={{ $favVersion }}" alt="Current favicon" class="max-w-full max-h-full object-contain">
                        @else
                            <span class="text-xs text-gray-400">{{__('None')}}</span>
                        @endif
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        {{__('Current favicon')}} ({{ strtoupper($favType) }})
                    </div>
                </div>

                <input type="file" name="favicon" accept="image/svg+xml,image/png,image/jpeg,image/webp,image/gif"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Recommended: SVG for best quality, or at least 512x512px PNG')}}</p>
            </div>

            <div class="space-y-3 sortable-module">
                @foreach($modules as $module)
                    <div class="rounded-lg border shadow-sm border-gray-200 dark:bg-gray-900 dark:border-gray-800 px-5 divide-y divide-gray-100 card">
                        <div class="" x-data="{ expanded: false }">

                            <div class="py-4 font-medium text-gray-500 dark:text-gray-300 flex items-center space-x-4 js-handle">
                                <x-ui.icon name="swap" class="w-5 h-5 cursor-pointer" stroke="currentColor"/>
                                <span class="flex-1">{{$module->title}}</span>
                                <x-ui.icon name="settings" class="w-5 h-5 cursor-pointer" stroke="currentColor"
                                           @click="expanded = ! expanded"/>
                            </div>
                            <input type="hidden" name="module[{{$module->id}}][sortable]" value="{{$module->sortable}}"
                                   class="sortable-input">
                            <input type="hidden" name="module[{{$module->id}}][id]" value="{{$module->id}}">
                            <div x-show="expanded" x-collapse>
                                <div class="px-2 py-5 border-t border-gray-100 dark:border-gray-800">
                                    @include('admin.customize.partials.'.$module->slug)
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <x-form.primary class="w-full mt-5" size="lg">{{__('Save change')}}</x-form.primary>
        </form>
    </div>

    @push('javascript')
        <script src="{{asset('static/js/jquery.js')}}"></script>
        <script src="{{asset('static/js/sortable.js')}}"></script>
        <script>
            sortable('.sortable-module', {
                forcePlaceholderSize: true,
                handle: '.js-handle'
            });
            sortable('.sortable-module')[0].addEventListener('sortupdate', function (e) {
                $('.sortable-module .card').each(function (i, el) {
                    $(el).find('.sortable-input').val(i);
                });
            });

            function imageViewer(src = '') {
                return {
                    imageUrl: src,

                    fileChosen(event) {
                        this.fileToDataUrl(event, src => this.imageUrl = src)
                    },

                    fileToDataUrl(event, callback) {
                        if (!event.target.files.length) return

                        let file = event.target.files[0],
                            reader = new FileReader()

                        reader.readAsDataURL(file)
                        reader.onload = e => callback(e.target.result)
                    },
                }
            }
        </script>
    @endpush
@endsection
