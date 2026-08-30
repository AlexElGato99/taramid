<div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100 dark:border-gray-800">
    <h3 class="text-lg text-gray-700 dark:text-gray-200 font-medium">{{__('Google Analytics Configuration')}}</h3>
    @if(config('analytics.property_id') && file_exists(config('analytics.service_account_credentials_json')))
        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{__('Connected')}}
        </span>
    @else
        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            {{__('Not Configured')}}
        </span>
    @endif
</div>

<div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
    <div class="flex gap-3">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-medium text-blue-900 dark:text-blue-200 mb-2">{{__('Setup Instructions')}}</h4>
            <ol class="text-sm text-blue-800 dark:text-blue-300 space-y-1 list-decimal list-inside">
                <li>{{__('Go to')}} <a href="https://console.cloud.google.com" target="_blank" class="underline hover:text-blue-600">Google Cloud Console</a></li>
                <li>{{__('Create a new project or select an existing one')}}</li>
                <li>{{__('Enable the Google Analytics Data API for your project')}}</li>
                <li>{{__('Create a Service Account and download the JSON key file')}}</li>
                <li>{{__('Add the service account email to your GA4 property with Viewer permissions')}}</li>
                <li>{{__('Copy your GA4 Property ID from Analytics → Admin → Property Settings')}}</li>
                <li>{{__('Upload the JSON key file and enter the Property ID below')}}</li>
            </ol>
            <a href="https://analytics.google.com/analytics/web/" target="_blank" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm mt-3">
                <span>{{__('Open Google Analytics')}}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10">
    <div class="col-span-12 lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="ANALYTICS_PROPERTY_ID" :value="__('Google Analytics 4 Property ID')"/>
            <x-form.input id="ANALYTICS_PROPERTY_ID" name="ANALYTICS_PROPERTY_ID" type="text" class="mt-1 block w-full"
                          value="{{ old('ANALYTICS_PROPERTY_ID', config('analytics.property_id')) }}"
                          placeholder="{{__('e.g., 123456789')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{__('Find this in Google Analytics: Admin → Property Settings → Property ID')}}
                @if(config('analytics.property_id'))
                    <span class="text-green-600 dark:text-green-400 font-medium ml-2">✓ {{__('Currently set')}}</span>
                @endif
            </p>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="GA_MEASUREMENT_ID" :value="__('GA4 Measurement ID (Tracking Code)')"/>
            <x-form.input id="GA_MEASUREMENT_ID" name="GA_MEASUREMENT_ID" type="text" class="mt-1 block w-full"
                          value="{{ old('GA_MEASUREMENT_ID', config('services.google.ga_measurement_id', env('GA_MEASUREMENT_ID'))) }}"
                          placeholder="{{__('e.g., G-XXXXXXXXXX')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{__('Find this in GA4: Admin → Data Streams → your stream → Measurement ID')}}
                @if(config('services.google.ga_measurement_id', env('GA_MEASUREMENT_ID')))
                    <span class="text-green-600 dark:text-green-400 font-medium ml-2">✓ {{__('Tracking active')}}</span>
                @endif
            </p>
        </div>
    </div>
    <div class="col-span-12">
        <div class="mb-5">
            <x-form.label for="GOOGLE_P12" :value="__('Service Account JSON Key File')"/>
            <x-form.file id="GOOGLE_P12" name="GOOGLE_P12" type="file" accept=".json" class="mt-1 block w-full" placeholder="{{__('Upload JSON file')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{__('Upload the JSON key file from your Google Cloud Service Account')}}
                @if(file_exists(config('analytics.service_account_credentials_json')))
                    <span class="text-green-600 dark:text-green-400 font-medium ml-2">✓ {{__('File uploaded:')}} {{ basename(config('analytics.service_account_credentials_json')) }}</span>
                @endif
            </p>
        </div>
    </div>
</div>

@if(config('analytics.property_id') && file_exists(config('analytics.service_account_credentials_json')))
<div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
    <div class="flex gap-3">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-medium text-green-900 dark:text-green-200 mb-1">{{__('Google Analytics is Active')}}</h4>
            <p class="text-sm text-green-800 dark:text-green-300">{{__('Your dashboard is now receiving real-time visitor data and analytics from Google Analytics.')}}</p>
            <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 text-sm mt-2">
                <span>{{__('View Analytics Dashboard')}}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif
