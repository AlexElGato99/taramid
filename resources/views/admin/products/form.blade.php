@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{__('Back to Products')}}
            </a>
        </div>

        @isset($listing)
            <x-admin.lang-select :fields="(new \App\Models\Product)->translatableFields()"/>
        @endisset

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                {{ isset($listing) ? __('Edit Product') : __('Add Product') }}
            </h2>

            <form method="POST"
                  action="{{ isset($listing) ? route('admin.products.update', $listing->slug) : route('admin.products.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ isset($listing) ? admin_locale() : base_locale() }}">
                @if(isset($listing))
                    @method('PUT')
                @endif

                <div class="space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-12">
                            <x-form.label for="title" :value="__('Title')"/>
                            <x-form.input id="title" name="title" type="text" class="mt-1 block w-full"
                                          :value="old('title', model_value($listing ?? null, 'title', ''))" {{ admin_locale() === base_locale() ? 'required' : '' }} placeholder="{{ model_placeholder($listing ?? null, 'title', __('e.g. Rosemary Essential Oil')) }}"/>
                            <x-form.error class="mt-2" :messages="$errors->get('title')"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-4">
                            <x-form.label for="category_id" :value="__('Category')"/>
                            <select id="category_id" name="category_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">{{__('-- No Category --')}}</option>
                                @foreach(\App\Models\Category::ordered()->get() as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $listing->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="sort_order" :value="__('Sort Order')"/>
                            <x-form.input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                          :value="old('sort_order', $listing->sort_order ?? 0)" placeholder="0"/>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="badge" :value="__('Badge')"/>
                            <x-form.input id="badge" name="badge" type="text" class="mt-1 block w-full"
                                          :value="old('badge', model_value($listing ?? null, 'badge', ''))" placeholder="{{ model_placeholder($listing ?? null, 'badge', __('e.g. New Arrival')) }}"/>
                        </div>
                    </div>

                    <div>
                        <x-form.label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'description', __('Product description')) }}">{{ old('description', model_value($listing ?? null, 'description', '')) }}</textarea>
                        <x-form.error class="mt-2" :messages="$errors->get('description')"/>
                    </div>

                    <div>
                        <x-form.label for="how_to_use" :value="__('How To Use')"/>
                        <textarea id="how_to_use" name="how_to_use" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'how_to_use', __('How to use this product')) }}">{{ old('how_to_use', model_value($listing ?? null, 'how_to_use', '')) }}</textarea>
                    </div>

                    <div>
                        <x-form.label for="ingredients" :value="__('Ingredients')"/>
                        <textarea id="ingredients" name="ingredients" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'ingredients', __('List of ingredients')) }}">{{ old('ingredients', model_value($listing ?? null, 'ingredients', '')) }}</textarea>
                    </div>

                    <div>
                        <x-form.label for="general_instructions" :value="__('General Instructions')"/>
                        <textarea id="general_instructions" name="general_instructions" rows="3"
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                  placeholder="{{ model_placeholder($listing ?? null, 'general_instructions', __('Storage, precautions, etc.')) }}">{{ old('general_instructions', model_value($listing ?? null, 'general_instructions', '')) }}</textarea>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-6">
                            <x-form.label for="tag1" :value="__('Tag 1')"/>
                            <x-form.input id="tag1" name="tag1" type="text" class="mt-1 block w-full"
                                          :value="old('tag1', model_value($listing ?? null, 'tag1', ''))" placeholder="{{ model_placeholder($listing ?? null, 'tag1', __('e.g. Herbalism')) }}"/>
                        </div>
                        <div class="lg:col-span-6">
                            <x-form.label for="tag2" :value="__('Tag 2')"/>
                            <x-form.input id="tag2" name="tag2" type="text" class="mt-1 block w-full"
                                          :value="old('tag2', model_value($listing ?? null, 'tag2', ''))" placeholder="{{ model_placeholder($listing ?? null, 'tag2', __('e.g. Organic')) }}"/>
                        </div>
                    </div>

                    <div x-data="{
                        buttons: {{ json_encode(old('action_buttons', $listing->action_buttons ?? [
                            ['icon' => 'email', 'text' => 'Order Via Email', 'value' => ''],
                            ['icon' => 'whatsapp', 'text' => 'Order Via WhatsApp', 'value' => '']
                        ])) }}
                    }">
                        <x-form.label :value="__('Action Buttons')"/>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{__('Configure the action buttons shown on the product detail page.')}}</p>

                        <template x-for="(btn, index) in buttons" :key="index">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-3">
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300" x-text="'Button ' + (index + 1)"></span>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-3">
                                    <div class="lg:col-span-3">
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{__('Icon')}}</label>
                                        <select x-model="btn.icon"
                                                :name="'action_buttons[' + index + '][icon]'"
                                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                            <option value="email">{{__('Email')}}</option>
                                            <option value="whatsapp">{{__('WhatsApp')}}</option>
                                            <option value="phone">{{__('Phone')}}</option>
                                            <option value="cart">{{__('Cart')}}</option>
                                            <option value="link">{{__('Link')}}</option>
                                        </select>
                                    </div>
                                    <div class="lg:col-span-4">
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{__('Button Text')}}</label>
                                        <input type="text" x-model="btn.text"
                                               :name="'action_buttons[' + index + '][text]'"
                                               class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                               placeholder="{{__('e.g. Order Via Email')}}">
                                    </div>
                                    <div class="lg:col-span-5">
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{__('Value')}}</label>
                                        <input type="text" x-model="btn.value"
                                               :name="'action_buttons[' + index + '][value]'"
                                               class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm"
                                               :placeholder="btn.icon === 'whatsapp' ? '{{__('WhatsApp number e.g. 212600000000')}}' : btn.icon === 'phone' ? '{{__('Phone number')}}' : btn.icon === 'email' ? '{{__('Email or leave empty for contact page')}}' : '{{__('URL')}}'">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div>
                        <x-form.label :value="__('Product Images')"/>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{__('Upload all product images here. Click the star to set the primary image used on listings and cards.')}}</p>

                        @if(isset($listing))
                            @php
                                $allExisting = [];
                                if ($listing->image && !in_array($listing->image, $listing->gallery ?? [])) {
                                    $allExisting[] = $listing->image;
                                }
                                if ($listing->gallery) {
                                    $allExisting = array_merge($allExisting, $listing->gallery);
                                }
                                $primaryImage = $listing->image;
                            @endphp
                            @if(count($allExisting))
                                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-3 mb-4">
                                    @foreach($allExisting as $imgIndex => $img)
                                        <div class="relative group aspect-square">
                                            <img src="{{ asset('storage/' . $img) }}" alt="" class="w-full h-full rounded-lg object-cover bg-gray-50 dark:bg-gray-800">
                                            <label class="absolute top-1.5 left-1.5 z-10 cursor-pointer" title="{{__('Set as primary')}}">
                                                <input type="radio" name="primary_image" value="{{ $img }}" class="sr-only peer" @checked($img === $primaryImage)>
                                                <span class="flex items-center justify-center w-7 h-7 rounded-full transition-all
                                                             peer-checked:bg-blue-500 peer-checked:text-white peer-checked:shadow-md
                                                             bg-black/30 text-white/70 hover:bg-blue-400 hover:text-white">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                                                </span>
                                            </label>
                                            <label class="absolute top-1.5 right-1.5 z-10 cursor-pointer" title="{{__('Remove')}}">
                                                <input type="checkbox" name="remove_gallery[]" value="{{ $img }}" class="sr-only peer">
                                                <span class="flex items-center justify-center w-7 h-7 rounded-full transition-all
                                                             peer-checked:bg-red-500 peer-checked:text-white
                                                             bg-black/30 text-white/70 hover:bg-red-400 hover:text-white
                                                             opacity-0 group-hover:opacity-100 peer-checked:opacity-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            {{ isset($listing) ? __('Add more images. Max 5MB each.') : __('The first image will be the primary. Max 5MB each.') }}
                        </p>
                        <x-form.error class="mt-2" :messages="$errors->get('images')"/>
                        <x-form.error class="mt-2" :messages="$errors->get('images.*')"/>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800">

                    <div class="flex items-center gap-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer"
                                   @if(old('is_featured', $listing->is_featured ?? false)) checked @endif>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:after:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Featured (highlighted card)')}}</span>
                        </label>

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
