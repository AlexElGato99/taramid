@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('FAQ Section')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the header text for the FAQ section')}}</p>
        </div>

        <x-admin.lang-select section="faq-section"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.faq-section.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="faq_badge" :value="__('Badge Text')"/>
                            <x-form.input id="faq_badge" name="faq_badge" type="text" class="mt-1 block w-full"
                                          :value="old('faq_badge', admin_value('faq_badge', 'FAQ'))" placeholder="{{ admin_placeholder('faq_badge', __('e.g. FAQ')) }}"/>
                        </div>
                        <div class="lg:col-span-8">
                            <x-form.label for="faq_heading" :value="__('Heading')"/>
                            <x-form.input id="faq_heading" name="faq_heading" type="text" class="mt-1 block w-full"
                                          :value="old('faq_heading', admin_value('faq_heading', 'Frequently asked questions'))" placeholder="{{ admin_placeholder('faq_heading', __('Section heading')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="faq_description" :value="__('Description')"/>
                        <textarea id="faq_description" name="faq_description" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('faq_description', __('Section description')) }}">{{ old('faq_description', admin_value('faq_description', '')) }}</textarea>
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
