@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Certificates Section')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the header text for the Certifications section')}}</p>
        </div>

        <x-admin.lang-select section="cert-section"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.cert-section.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="cert_badge" :value="__('Badge Text')"/>
                            <x-form.input id="cert_badge" name="cert_badge" type="text" class="mt-1 block w-full"
                                          :value="old('cert_badge', admin_value('cert_badge', 'Quality Guarantees'))" placeholder="{{ admin_placeholder('cert_badge', __('e.g. Quality Guarantees')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="cert_heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="cert_heading_line1" name="cert_heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('cert_heading_line1', admin_value('cert_heading_line1', 'Certifications that'))" placeholder="{{ admin_placeholder('cert_heading_line1', __('First line')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="cert_heading_line2" :value="__('Heading Line 2')"/>
                            <x-form.input id="cert_heading_line2" name="cert_heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('cert_heading_line2', admin_value('cert_heading_line2', 'prove our commitment'))" placeholder="{{ admin_placeholder('cert_heading_line2', __('Second line')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="cert_description" :value="__('Description')"/>
                        <textarea id="cert_description" name="cert_description" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('cert_description', __('Section description')) }}">{{ old('cert_description', admin_value('cert_description', 'Our products undergo the most rigorous controls, validated by independent national and international organizations.')) }}</textarea>
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
