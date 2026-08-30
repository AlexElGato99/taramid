@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{__('Back to Categories')}}
            </a>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\Category)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                {{ isset($listing) ? __('Edit Category') : __('Add Category') }}
            </h2>

            <form method="POST"
                  action="{{ isset($listing) ? route('admin.categories.update', $listing->id) : route('admin.categories.store') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing))
                    @method('PUT')
                @endif

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-8">
                            <x-form.label for="name" :value="__('Name')"/>
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', model_value($listing ?? null, 'name', ''))" {{ admin_locale() === base_locale() ? 'required' : '' }} placeholder="{{ model_placeholder($listing ?? null, 'name', __('e.g. Essential Oils')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('name')"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                    </div>

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
