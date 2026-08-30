@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mb-3">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{__('Back to FAQs')}}
            </a>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $config['title'] }}</h1>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\Faq)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST"
                  action="{{ isset($listing) ? route('admin.faqs.update', $listing->id) : route('admin.faqs.store') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing)) @method('PUT') @endif

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-8">
                            <x-form.label for="question" :value="__('Question')"/>
                            <x-form.input id="question" name="question" type="text" class="mt-1 block w-full" :required="admin_locale() === base_locale()"
                                          :value="old('question', model_value($listing ?? null, 'question', ''))" placeholder="{{ model_placeholder($listing ?? null, 'question', __('e.g. How do I place an order?')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="answer" :value="__('Answer')"/>
                        <textarea id="answer" name="answer" rows="5" {{ admin_locale() === base_locale() ? 'required' : '' }}
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'answer', __('Type the answer here...')) }}">{{ old('answer', model_value($listing ?? null, 'answer', '')) }}</textarea>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex items-center gap-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" class="sr-only peer" value="1"
                                   {{ old('is_active', isset($listing) ? $listing->is_active : true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{__('Active')}}</span>
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
