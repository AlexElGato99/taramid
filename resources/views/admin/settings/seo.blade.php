<div class="max-w-3xl space-y-8">

    <div>
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Homepage SEO')}}</h3>

        <div class="space-y-4">
            <div>
                <x-form.label for="seo_title" :value="__('Meta Title')"/>
                <x-form.input id="seo_title" name="seo_title" type="text" class="mt-1 block w-full"
                              :value="old('seo_title', admin_value('seo_title', ''))"
                              placeholder="{{ admin_placeholder('seo_title', __('e.g. Taramide Cosmetics - Natural Moroccan Beauty Products')) }}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('50-60 characters recommended. Appears in browser tab and search results.')}}</p>
            </div>

            <div>
                <x-form.label for="seo_description" :value="__('Meta Description')"/>
                <textarea id="seo_description" name="seo_description" rows="3"
                          class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="{{ admin_placeholder('seo_description', __('Brief description of your website for search results...')) }}">{{ old('seo_description', admin_value('seo_description', '')) }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('150-160 characters recommended. Shown below your title in search results.')}}</p>
            </div>

            <div>
                <x-form.label for="seo_keywords" :value="__('Meta Keywords')"/>
                <x-form.input id="seo_keywords" name="seo_keywords" type="text" class="mt-1 block w-full"
                              :value="old('seo_keywords', admin_value('seo_keywords', ''))"
                              placeholder="{{ admin_placeholder('seo_keywords', __('e.g. organic cosmetics, argan oil, moroccan beauty, natural skincare')) }}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Comma-separated keywords related to your business.')}}</p>
            </div>
        </div>
    </div>

    <hr class="border-gray-100 dark:border-gray-800">

    <div>
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Social Media Sharing (Open Graph)')}}</h3>

        <div class="space-y-4">
            <div>
                <x-form.label for="og_title" :value="__('OG Title')"/>
                <x-form.input id="og_title" name="og_title" type="text" class="mt-1 block w-full"
                              :value="old('og_title', admin_value('og_title', ''))"
                              placeholder="{{ admin_placeholder('og_title', __('Leave empty to use Meta Title')) }}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Title shown when sharing on Facebook, LinkedIn, etc.')}}</p>
            </div>

            <div>
                <x-form.label for="og_description" :value="__('OG Description')"/>
                <textarea id="og_description" name="og_description" rows="2"
                          class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="{{ admin_placeholder('og_description', __('Leave empty to use Meta Description')) }}">{{ old('og_description', admin_value('og_description', '')) }}</textarea>
            </div>

            <div>
                <x-form.label for="og_image" :value="__('OG Image')"/>
                @if(config('settings.og_image'))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . config('settings.og_image')) }}" alt="OG Image" class="h-24 rounded-lg border border-gray-200 dark:border-gray-700">
                    </div>
                @endif
                <input type="file" name="og_image" accept="image/*"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Recommended: 1200x630px. Shown when sharing your site on social media.')}}</p>
            </div>
        </div>
    </div>

    <hr class="border-gray-100 dark:border-gray-800">

    <div>
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Business Information (Schema.org)')}}</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">{{__('Used for rich search results and Google Knowledge Panel.')}}</p>

        <div class="space-y-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <x-form.label for="schema_business_name" :value="__('Business Name')"/>
                    <x-form.input id="schema_business_name" name="schema_business_name" type="text" class="mt-1 block w-full"
                                  :value="old('schema_business_name', config('settings.schema_business_name', ''))"
                                  placeholder="{{__('e.g. Taramide Cosmetics')}}"/>
                </div>
                <div>
                    <x-form.label for="schema_business_type" :value="__('Business Type')"/>
                    <select id="schema_business_type" name="schema_business_type"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @foreach(['Organization', 'LocalBusiness', 'Store', 'OnlineStore', 'BeautySalon', 'HealthAndBeautyBusiness'] as $type)
                            <option value="{{ $type }}" {{ config('settings.schema_business_type', 'Organization') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <x-form.label for="schema_email" :value="__('Contact Email')"/>
                    <x-form.input id="schema_email" name="schema_email" type="email" class="mt-1 block w-full"
                                  :value="old('schema_email', config('settings.schema_email', ''))"
                                  placeholder="{{__('contact@example.com')}}"/>
                </div>
                <div>
                    <x-form.label for="schema_phone" :value="__('Phone Number')"/>
                    <x-form.input id="schema_phone" name="schema_phone" type="text" class="mt-1 block w-full"
                                  :value="old('schema_phone', config('settings.schema_phone', ''))"
                                  placeholder="{{__('+212 600 000 000')}}"/>
                </div>
            </div>

            <div>
                <x-form.label for="schema_address" :value="__('Address')"/>
                <x-form.input id="schema_address" name="schema_address" type="text" class="mt-1 block w-full"
                              :value="old('schema_address', admin_value('schema_address', ''))"
                              placeholder="{{ admin_placeholder('schema_address', __('Street, City, Country')) }}"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <x-form.label for="schema_founding_date" :value="__('Founding Year')"/>
                    <x-form.input id="schema_founding_date" name="schema_founding_date" type="text" class="mt-1 block w-full"
                                  :value="old('schema_founding_date', config('settings.schema_founding_date', ''))"
                                  placeholder="{{__('e.g. 2020')}}"/>
                </div>
                <div>
                    <x-form.label for="schema_price_range" :value="__('Price Range')"/>
                    <x-form.input id="schema_price_range" name="schema_price_range" type="text" class="mt-1 block w-full"
                                  :value="old('schema_price_range', config('settings.schema_price_range', ''))"
                                  placeholder="{{__('e.g. $$')}}"/>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-gray-100 dark:border-gray-800">

    <div>
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">{{__('Verification & Analytics')}}</h3>

        <div class="space-y-4">
            <div>
                <x-form.label for="google_verification" :value="__('Google Search Console Verification')"/>
                <x-form.input id="google_verification" name="google_verification" type="text" class="mt-1 block w-full"
                              :value="old('google_verification', config('settings.google_verification', ''))"
                              placeholder="{{__('Content value from meta tag, e.g. abc123...')}}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Paste only the content value from Google\'s verification meta tag.')}}</p>
            </div>

            <div>
                <x-form.label for="google_analytics" :value="__('Google Analytics ID')"/>
                <x-form.input id="google_analytics" name="google_analytics" type="text" class="mt-1 block w-full"
                              :value="old('google_analytics', config('settings.google_analytics', ''))"
                              placeholder="{{__('e.g. G-XXXXXXXXXX')}}"/>
            </div>
        </div>
    </div>

</div>
