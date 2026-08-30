@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.hero-slides.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{__('Back to Hero Slides')}}
            </a>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\HeroSlide)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                {{ isset($listing) ? __('Edit Slide') : __('Add Slide') }}
            </h2>

            <form method="POST"
                  action="{{ isset($listing) ? route('admin.hero-slides.update', $listing->id) : route('admin.hero-slides.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing))
                    @method('PUT')
                @endif

                <div class="space-y-6">
                    <div>
                        <x-form.label for="badge_text" :value="__('Badge Text')"/>
                        <x-form.input id="badge_text" name="badge_text" type="text" class="mt-1 block w-full"
                                      :value="old('badge_text', model_value($listing ?? null, 'badge_text', ''))" placeholder="{{ model_placeholder($listing ?? null, 'badge_text', __('e.g. 100% Organic')) }}"/>
                        <x-form.error class="mt-2" :messages="$errors->get('badge_text')"/>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <x-form.label for="heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="heading_line1" name="heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('heading_line1', model_value($listing ?? null, 'heading_line1', ''))" :required="admin_locale() === base_locale()" placeholder="{{ model_placeholder($listing ?? null, 'heading_line1', __('e.g. The Pure Essence')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('heading_line1')"/>
                        </div>
                        <div>
                            <x-form.label for="heading_line2" :value="__('Heading Line 2 (Highlighted)')"/>
                            <x-form.input id="heading_line2" name="heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('heading_line2', model_value($listing ?? null, 'heading_line2', ''))" :required="admin_locale() === base_locale()" placeholder="{{ model_placeholder($listing ?? null, 'heading_line2', __('e.g. of Morocco')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('heading_line2')"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="description" :value="__('Description')"/>
                        <x-form.textarea id="description" name="description" class="mt-1 block w-full" required
                                         placeholder="{{ model_placeholder($listing ?? null, 'description', __('Short description text for the hero section')) }}">{{ old('description', model_value($listing ?? null, 'description', '')) }}</x-form.textarea>
                        <x-form.error class="mt-2" :messages="$errors->get('description')"/>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <x-form.label for="button1_text" :value="__('Button 1 Text')"/>
                            <x-form.input id="button1_text" name="button1_text" type="text" class="mt-1 block w-full"
                                          :value="old('button1_text', model_value($listing ?? null, 'button1_text', ''))" placeholder="{{ model_placeholder($listing ?? null, 'button1_text', __('e.g. Our Products')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('button1_text')"/>
                        </div>
                        <div>
                            <x-form.label for="button1_link" :value="__('Button 1 Link')"/>
                            <x-form.input id="button1_link" name="button1_link" type="text" class="mt-1 block w-full"
                                          :value="old('button1_link', $listing->button1_link ?? '')" placeholder="{{__('e.g. #products')}}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('button1_link')"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <x-form.label for="button2_text" :value="__('Button 2 Text')"/>
                            <x-form.input id="button2_text" name="button2_text" type="text" class="mt-1 block w-full"
                                          :value="old('button2_text', model_value($listing ?? null, 'button2_text', ''))" placeholder="{{ model_placeholder($listing ?? null, 'button2_text', __('e.g. Our Story')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('button2_text')"/>
                        </div>
                        <div>
                            <x-form.label for="button2_link" :value="__('Button 2 Link')"/>
                            <x-form.input id="button2_link" name="button2_link" type="text" class="mt-1 block w-full"
                                          :value="old('button2_link', $listing->button2_link ?? '')" placeholder="{{__('e.g. #about')}}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('button2_link')"/>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                        <div class="flex items-center pt-7">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                       @if(old('is_active', $listing->is_active ?? true)) checked @endif>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:after:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Active')}}</span>
                            </label>
                        </div>
                    </div>

                    <x-form.primary class="w-full mt-5">{{__('Save changes')}}</x-form.primary>
                </div>
            </form>
        </div>
    </div>
@endsection
