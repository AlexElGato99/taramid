@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Contact Section')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the content of the Contact section on the homepage')}}</p>
        </div>

        <x-admin.lang-select section="contact-section"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.contact-section.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Section Header')}}</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="contact_badge" :value="__('Badge Text')"/>
                            <x-form.input id="contact_badge" name="contact_badge" type="text" class="mt-1 block w-full"
                                          :value="old('contact_badge', admin_value('contact_badge', 'Contact Us'))" placeholder="{{ admin_placeholder('contact_badge', __('e.g. Contact Us')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="contact_heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="contact_heading_line1" name="contact_heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('contact_heading_line1', admin_value('contact_heading_line1', 'Let\'s talk about'))" placeholder="{{ admin_placeholder('contact_heading_line1', __('First line')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="contact_heading_line2" :value="__('Heading Line 2')"/>
                            <x-form.input id="contact_heading_line2" name="contact_heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('contact_heading_line2', admin_value('contact_heading_line2', 'your project'))" placeholder="{{ admin_placeholder('contact_heading_line2', __('Second line')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="contact_description" :value="__('Description')"/>
                        <textarea id="contact_description" name="contact_description" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('contact_description', __('Section description')) }}">{{ old('contact_description', admin_value('contact_description', 'Distributor, professional or individual — our team is at your disposal for any order or partnership.')) }}</textarea>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Contact Details')}}</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-6">
                            <x-form.label for="contact_phone" :value="__('Phone(s)')"/>
                            <x-form.input id="contact_phone" name="contact_phone" type="text" class="mt-1 block w-full"
                                          :value="old('contact_phone', config('settings.contact_phone', '+212 661 436 621'))" placeholder="+212 661 436 621, +212 600 000 000"/>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Separate multiple phone numbers with commas')}}</p>
                        </div>
                        <div class="lg:col-span-6">
                            <x-form.label for="contact_email" :value="__('Email(s)')"/>
                            <x-form.input id="contact_email" name="contact_email" type="text" class="mt-1 block w-full"
                                          :value="old('contact_email', config('settings.contact_email', 'ste.taramide@gmail.com'))" placeholder="email1@example.com, email2@example.com"/>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Separate multiple emails with commas')}}</p>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="contact_address" :value="__('Address')"/>
                        <textarea id="contact_address" name="contact_address" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('contact_address', __('Full address')) }}">{{ old('contact_address', admin_value('contact_address', "Ksar Ousroutou, Sidi Aayad\nEr-rich, Midelt, Maroc")) }}</textarea>
                    </div>

                    <div>
                        <x-form.label for="contact_manager" :value="__('Manager Name')"/>
                        <x-form.input id="contact_manager" name="contact_manager" type="text" class="mt-1 block w-full max-w-sm"
                                      :value="old('contact_manager', admin_value('contact_manager', 'Ayoub Sabbane'))" placeholder="{{ admin_placeholder('contact_manager', __('Manager name')) }}"/>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Form Settings')}}</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="contact_form_title" :value="__('Form Title')"/>
                            <x-form.input id="contact_form_title" name="contact_form_title" type="text" class="mt-1 block w-full"
                                          :value="old('contact_form_title', admin_value('contact_form_title', 'Send a message'))" placeholder="{{ admin_placeholder('contact_form_title', __('e.g. Send a message')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="contact_button_text" :value="__('Button Text')"/>
                            <x-form.input id="contact_button_text" name="contact_button_text" type="text" class="mt-1 block w-full"
                                          :value="old('contact_button_text', admin_value('contact_button_text', 'Send Message'))" placeholder="{{ admin_placeholder('contact_button_text', __('e.g. Send Message')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="contact_success_message" :value="__('Success Message')"/>
                        <textarea id="contact_success_message" name="contact_success_message" rows="2"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('contact_success_message', __('Message shown after form submission')) }}">{{ old('contact_success_message', admin_value('contact_success_message', 'Your message has been sent successfully. We will get back to you as soon as possible.')) }}</textarea>
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
