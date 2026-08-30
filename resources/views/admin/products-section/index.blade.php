@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Products Section')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the header text for the Products / Our Range section')}}</p>
        </div>

        <x-admin.lang-select section="products-section"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.products-section.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="products_badge" :value="__('Badge Text')"/>
                            <x-form.input id="products_badge" name="products_badge" type="text" class="mt-1 block w-full"
                                          :value="old('products_badge', admin_value('products_badge', 'Our Range'))" placeholder="{{ admin_placeholder('products_badge', __('e.g. Our Range')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="products_heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="products_heading_line1" name="products_heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('products_heading_line1', admin_value('products_heading_line1', 'Pure extracts'))" placeholder="{{ admin_placeholder('products_heading_line1', __('First line')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="products_heading_line2" :value="__('Heading Line 2')"/>
                            <x-form.input id="products_heading_line2" name="products_heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('products_heading_line2', admin_value('products_heading_line2', 'from nature'))" placeholder="{{ admin_placeholder('products_heading_line2', __('Second line')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="products_description" :value="__('Description')"/>
                        <textarea id="products_description" name="products_description" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('products_description', __('Section description')) }}">{{ old('products_description', admin_value('products_description', 'All our products are sourced from plants harvested within 100 km of Midelt.')) }}</textarea>
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
