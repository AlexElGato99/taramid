@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Process Section')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the header text for the Our Process section')}}</p>
        </div>

        <x-admin.lang-select section="process-section"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.process-section.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="process_badge" :value="__('Badge Text')"/>
                            <x-form.input id="process_badge" name="process_badge" type="text" class="mt-1 block w-full"
                                          :value="old('process_badge', admin_value('process_badge', 'Our Process'))" placeholder="{{ admin_placeholder('process_badge', __('e.g. Our Process')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="process_heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="process_heading_line1" name="process_heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('process_heading_line1', admin_value('process_heading_line1', 'From plant to bottle,'))" placeholder="{{ admin_placeholder('process_heading_line1', __('First line')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="process_heading_line2" :value="__('Heading Line 2')"/>
                            <x-form.input id="process_heading_line2" name="process_heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('process_heading_line2', admin_value('process_heading_line2', 'a unique expertise'))" placeholder="{{ admin_placeholder('process_heading_line2', __('Second line')) }}"/>
                        </div>
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
