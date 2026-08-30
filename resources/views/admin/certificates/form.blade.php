@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mb-3">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{__('Back to Certificates')}}
            </a>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $config['title'] }}</h1>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\Certificate)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST"
                  action="{{ isset($listing) ? route('admin.certificates.update', $listing->id) : route('admin.certificates.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing)) @method('PUT') @endif

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-8">
                            <x-form.label for="title" :value="__('Title')"/>
                            <x-form.input id="title" name="title" type="text" class="mt-1 block w-full" :required="admin_locale() === base_locale()"
                                          :value="old('title', model_value($listing ?? null, 'title', ''))" placeholder="{{ model_placeholder($listing ?? null, 'title', __('e.g. Bio Maroc')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'description', __('Certificate description')) }}">{{ old('description', model_value($listing ?? null, 'description', '')) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="status_label" :value="__('Status Label')"/>
                            <x-form.input id="status_label" name="status_label" type="text" class="mt-1 block w-full"
                                          :value="old('status_label', model_value($listing ?? null, 'status_label', 'Active'))" placeholder="{{ model_placeholder($listing ?? null, 'status_label', __('e.g. Active')) }}"/>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Badge text shown on the card (e.g. Active, Verified)')}}</p>
                        </div>
                        <div class="lg:col-span-8">
                            <x-form.label for="detail_line" :value="__('Detail Line')"/>
                            <x-form.input id="detail_line" name="detail_line" type="text" class="mt-1 block w-full"
                                          :value="old('detail_line', model_value($listing ?? null, 'detail_line', ''))" placeholder="{{ model_placeholder($listing ?? null, 'detail_line', __('e.g. Certificate No. 2026-0001415')) }}"/>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Extra info shown below the description')}}</p>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div>
                        <x-form.label for="icon" :value="__('Icon (SVG)')"/>
                        <input type="file" name="icon" id="icon" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Upload an icon image for this certificate')}}</p>

                        @if(isset($listing) && $listing->icon)
                            <div class="mt-3 flex items-center gap-3">
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{__('Current icon:')}}</span>
                                <img src="{{ asset('storage/' . $listing->icon) }}" alt="" class="h-8 w-8 object-contain bg-gray-100 dark:bg-gray-800 rounded p-1">
                            </div>
                        @endif
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex items-center gap-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" class="sr-only peer" value="1"
                                   {{ old('is_active', isset($listing) ? $listing->is_active : true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:after:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Active')}}</span>
                        </label>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <x-form.primary class="max-w-xs w-full">
                        {{__('Save changes')}}
                    </x-form.primary>
                </div>
            </form>
        </div>
    </div>
@endsection
