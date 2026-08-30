<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10">
    <div class="col-span-12">
        <div class="mb-5">
            <x-form.label for="MAIL_HOST" :value="__('SMTP Host')"/>
            <x-form.input id="MAIL_HOST" name="MAIL_HOST" type="text" class="mt-1 block w-full"
                          value="{{ old('MAIL_HOST', env('MAIL_HOST')) }}"
                          placeholder="{{__('SMTP Host')}}"/>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_HOST" :value="__('SMTP Username')"/>
            <x-form.input id="MAIL_HOST" name="MAIL_USERNAME" type="text" class="mt-1 block w-full"
                          value="{{ old('MAIL_USERNAME', env('MAIL_USERNAME')) }}"
                          placeholder="{{__('SMTP Username')}}"/>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_PASSWORD" :value="__('SMTP Password')"/>
            <x-form.input id="MAIL_PASSWORD" name="MAIL_PASSWORD" type="text" class="mt-1 block w-full"
                          value="{{ old('MAIL_PASSWORD', env('MAIL_PASSWORD')) }}"
                          placeholder="{{__('SMTP Password')}}"/>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_PORT" :value="__('SMTP Port')"/>
            <x-form.input id="MAIL_PORT" name="MAIL_PORT" type="text" class="mt-1 block w-full"
                          value="{{ old('MAIL_PORT', env('MAIL_PORT')) }}"
                          placeholder="{{__('SMTP Port')}}"/>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_ENCRYPTION" :value="__('SMTP Encryption')"/>
            <x-form.select name="MAIL_ENCRYPTION">

                <option value="">{{__('Choose')}}</option>
                <option value="ssl" @if(env('MAIL_ENCRYPTION') == 'ssl') selected="true" @endif>SSL</option>
                <option value="tls" @if(env('MAIL_ENCRYPTION') == 'tls') selected="true" @endif>TLS</option>
            </x-form.select>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_FROM_ADDRESS" :value="__('From Email Address')"/>
            <x-form.input id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" type="email" class="mt-1 block w-full"
                          value="{{ old('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS')) }}"
                          placeholder="{{__('From Email Address')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Email address that appears as sender')}}</p>
        </div>
    </div>
    <div class="col-span-6">
        <div class="mb-5">
            <x-form.label for="MAIL_FROM_NAME" :value="__('From Name')"/>
            <x-form.input id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" type="text" class="mt-1 block w-full"
                          value="{{ old('MAIL_FROM_NAME', env('MAIL_FROM_NAME')) }}"
                          placeholder="{{__('From Name')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Name that appears as sender')}}</p>
        </div>
    </div>
    <div class="col-span-12">
        <div class="mb-5">
            <x-form.label for="to_email" :value="__('Contact e-mail address')"/>
            <x-form.input id="to_email" name="to_email" type="text" class="mt-1 block w-full"
                          value="{{ old('to_email', config('settings.to_email')) }}"
                          placeholder="{{__('Contact e-mail address')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Email address where contact form messages will be sent')}}</p>
        </div>
    </div>
    <div class="col-span-12">
        <div class="mb-5">
            <x-form.label for="order_notification_email" :value="__('Order Notification Email')"/>
            <x-form.input id="order_notification_email" name="order_notification_email" type="email" class="mt-1 block w-full"
                          value="{{ old('order_notification_email', config('settings.order_notification_email')) }}"
                          placeholder="{{__('e.g. your-personal@gmail.com')}}"/>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{__('Personal email (Gmail, Hotmail, etc.) that will receive new order notifications')}}</p>
        </div>
    </div>
</div>
