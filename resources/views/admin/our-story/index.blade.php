@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Our Story')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the Our Story / About section on the homepage')}}</p>
        </div>

        <x-admin.lang-select section="our-story"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.our-story.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="story_badge" :value="__('Badge Text')"/>
                            <x-form.input id="story_badge" name="story_badge" type="text" class="mt-1 block w-full"
                                          :value="old('story_badge', admin_value('story_badge', 'Our Story'))" placeholder="{{ admin_placeholder('story_badge', __('e.g. Our Story')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="story_button_text" :value="__('Button Text')"/>
                            <x-form.input id="story_button_text" name="story_button_text" type="text" class="mt-1 block w-full"
                                          :value="old('story_button_text', admin_value('story_button_text', 'Contact Us'))" placeholder="{{ admin_placeholder('story_button_text', __('e.g. Contact Us')) }}"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="story_button_link" :value="__('Button Link')"/>
                            <x-form.input id="story_button_link" name="story_button_link" type="text" class="mt-1 block w-full"
                                          :value="old('story_button_link', config('settings.story_button_link', '#contact'))" placeholder="{{__('e.g. #contact')}}"/>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-6">
                            <x-form.label for="story_heading_line1" :value="__('Heading Line 1')"/>
                            <x-form.input id="story_heading_line1" name="story_heading_line1" type="text" class="mt-1 block w-full"
                                          :value="old('story_heading_line1', admin_value('story_heading_line1', 'Rooted in the'))" placeholder="{{ admin_placeholder('story_heading_line1', __('First line of heading')) }}"/>
                        </div>
                        <div class="lg:col-span-6">
                            <x-form.label for="story_heading_line2" :value="__('Heading Line 2')"/>
                            <x-form.input id="story_heading_line2" name="story_heading_line2" type="text" class="mt-1 block w-full"
                                          :value="old('story_heading_line2', admin_value('story_heading_line2', 'fertile lands of Morocco'))" placeholder="{{ admin_placeholder('story_heading_line2', __('Second line of heading')) }}"/>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div>
                        <x-form.label for="story_paragraph1" :value="__('Paragraph 1')"/>
                        <textarea id="story_paragraph1" name="story_paragraph1" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('story_paragraph1', __('First paragraph text')) }}">{{ old('story_paragraph1', admin_value('story_paragraph1', '')) }}</textarea>
                    </div>

                    <div>
                        <x-form.label for="story_paragraph2" :value="__('Paragraph 2')"/>
                        <textarea id="story_paragraph2" name="story_paragraph2" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ admin_placeholder('story_paragraph2', __('Second paragraph text')) }}">{{ old('story_paragraph2', admin_value('story_paragraph2', '')) }}</textarea>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div>
                        <x-form.label :value="__('Media Type')"/>
                        <div class="flex gap-6 mt-2">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="story_media_type" value="map"
                                       {{ old('story_media_type', config('settings.story_media_type', 'map')) === 'map' ? 'checked' : '' }}
                                       class="text-blue-600 focus:ring-blue-500"
                                       onchange="document.getElementById('media_map_fields').classList.remove('hidden'); document.getElementById('media_image_fields').classList.add('hidden');">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{__('Google Maps')}}</span>
                            </label>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="story_media_type" value="image"
                                       {{ old('story_media_type', config('settings.story_media_type', 'map')) === 'image' ? 'checked' : '' }}
                                       class="text-blue-600 focus:ring-blue-500"
                                       onchange="document.getElementById('media_image_fields').classList.remove('hidden'); document.getElementById('media_map_fields').classList.add('hidden');">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{__('Image')}}</span>
                            </label>
                        </div>
                    </div>

                    <div id="media_map_fields" class="{{ config('settings.story_media_type', 'map') === 'image' ? 'hidden' : '' }} space-y-4">
                        <div>
                            <x-form.label for="story_map_url" :value="__('Google Maps Embed URL')"/>
                            <x-form.input id="story_map_url" name="story_map_url" type="text" class="mt-1 block w-full"
                                          :value="old('story_map_url', config('settings.story_map_url', ''))" placeholder="{{__('Google Maps embed URL')}}"/>
                            <p class="text-xs text-gray-400 mt-1">{{__('Paste the src URL from a Google Maps embed iframe')}}</p>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                            <div class="lg:col-span-6">
                                <x-form.label for="story_location_title" :value="__('Location Card Title')"/>
                                <x-form.input id="story_location_title" name="story_location_title" type="text" class="mt-1 block w-full"
                                              :value="old('story_location_title', admin_value('story_location_title', 'Moyen-Atlas'))" placeholder="{{ admin_placeholder('story_location_title', __('e.g. Moyen-Atlas')) }}"/>
                            </div>
                            <div class="lg:col-span-6">
                                <x-form.label for="story_location_subtitle" :value="__('Location Card Subtitle')"/>
                                <x-form.input id="story_location_subtitle" name="story_location_subtitle" type="text" class="mt-1 block w-full"
                                              :value="old('story_location_subtitle', admin_value('story_location_subtitle', 'Er-rich, Midelt'))" placeholder="{{ admin_placeholder('story_location_subtitle', __('e.g. Er-rich, Midelt')) }}"/>
                            </div>
                        </div>
                    </div>

                    <div id="media_image_fields" class="{{ config('settings.story_media_type', 'map') !== 'image' ? 'hidden' : '' }} space-y-4">
                        <div>
                            <x-form.label for="story_image" :value="__('Section Image')"/>
                            <input type="file" name="story_image" id="story_image" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                            <p class="text-xs text-gray-400 mt-1">{{__('Recommended aspect ratio 4:5 for best fit')}}</p>
                        </div>
                        @if(config('settings.story_image'))
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{__('Current image:')}}</p>
                            <img src="{{ asset('storage/' . config('settings.story_image')) }}" alt="" class="h-32 rounded-lg object-cover">
                        </div>
                        @endif
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    @foreach([1, 2, 3] as $f)
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4 items-end">
                        <div class="lg:col-span-4">
                            <x-form.label for="story_feature{{ $f }}_label" :value="__('Feature :n Label', ['n' => $f])"/>
                            <x-form.input id="story_feature{{ $f }}_label" name="story_feature{{ $f }}_label" type="text" class="mt-1 block w-full"
                                          :value="old('story_feature'.$f.'_label', admin_value('story_feature'.$f.'_label', ''))" placeholder="{{ admin_placeholder('story_feature'.$f.'_label', __('e.g. Natural')) }}"/>
                        </div>
                        <div class="lg:col-span-5">
                            <x-form.label for="story_feature{{ $f }}_icon" :value="__('Feature :n Icon (SVG)', ['n' => $f])"/>
                            <input type="file" name="story_feature{{ $f }}_icon" id="story_feature{{ $f }}_icon" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        </div>
                        <div class="lg:col-span-3">
                            @if(config('settings.story_feature'.$f.'_icon'))
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('storage/' . config('settings.story_feature'.$f.'_icon')) }}" alt="" class="h-8 w-8">
                                    <span class="text-xs text-gray-400">{{__('Current')}}</span>
                                </div>
                            @else
                                <span class="text-xs text-gray-400">{{__('Using default icon')}}</span>
                            @endif
                        </div>
                    </div>
                    @if($f < 3)
                    <hr class="border-gray-50 dark:border-gray-800/50">
                    @endif
                    @endforeach

                    <hr class="border-gray-100 dark:border-gray-800">

                    <x-form.primary class="max-w-xs w-full">
                        {{__('Save changes')}}
                    </x-form.primary>
                </div>
            </form>
        </div>
    </div>
@endsection
