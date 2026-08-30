@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.slider-items.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{__('Back to Slider')}}
            </a>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\SliderItem)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                {{ isset($listing) ? __('Edit Slider Item') : __('Add Slider Item') }}
            </h2>

            <form method="POST"
                  action="{{ isset($listing) ? route('admin.slider-items.update', $listing->id) : route('admin.slider-items.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing))
                    @method('PUT')
                @endif

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-8">
                            <x-form.label for="text" :value="__('Text')"/>
                            <x-form.input id="text" name="text" type="text" class="mt-1 block w-full"
                                          :value="old('text', model_value($listing ?? null, 'text', ''))" :required="admin_locale() === base_locale()" placeholder="{{ model_placeholder($listing ?? null, 'text', __('e.g. Certified Organic Morocco')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('text')"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div>
                        <x-form.label for="logo" :value="__('Logo')"/>
                        @if(isset($listing) && $listing->logo)
                            <div class="mt-2 mb-3">
                                <img src="{{ asset('storage/' . $listing->logo) }}" alt="" class="h-12 rounded-lg object-contain bg-gray-50 dark:bg-gray-800 p-1">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">{{__('PNG, JPG, SVG, WebP or GIF. Max 2MB.')}}</p>
                        <x-form.error class="mt-2" :messages="$errors->get('logo')"/>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                   @if(old('is_active', $listing->is_active ?? true)) checked @endif>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:after:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Active')}}</span>
                        </label>
                    </div>

                    <x-form.primary class="max-w-xs w-full">
                        {{__('Save changes')}}
                    </x-form.primary>
                </div>
            </form>
        </div>
    </div>
@endsection
