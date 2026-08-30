<style>
    .paygate-checkbox {
        appearance: none;
        -webkit-appearance: none;
        width: 1.15rem;
        height: 1.15rem;
        min-width: 1.15rem;
        border: 2px solid #d1d5db;
        border-radius: 0.25rem;
        cursor: pointer;
        position: relative;
        transition: all 0.2s;
    }
    .dark .paygate-checkbox {
        border-color: #4b5563;
    }
    .paygate-checkbox:checked {
        background-color: #2563eb;
        border-color: #2563eb;
    }
    .paygate-checkbox:checked::after {
        content: '';
        position: absolute;
        left: 4px;
        top: 1px;
        width: 5px;
        height: 9px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    .paygate-radio {
        appearance: none;
        -webkit-appearance: none;
        width: 1.15rem;
        height: 1.15rem;
        min-width: 1.15rem;
        border: 2px solid #d1d5db;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        transition: all 0.2s;
    }
    .dark .paygate-radio {
        border-color: #4b5563;
    }
    .paygate-radio:checked {
        border-color: #2563eb;
    }
    .paygate-radio:checked::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: #2563eb;
        transform: translate(-50%, -50%);
    }
</style>

{{-- PayGate --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ 
    expanded: false,
    providerMode: '{{ old('paygate_provider_mode', config('settings.paygate_provider_mode', 'all')) }}',
    singleProvider: '{{ old('paygate_single_provider', config('settings.paygate_single_provider', 'rampnetwork')) }}',
    providers: {{ json_encode(old('paygate_providers', json_decode(config('settings.paygate_providers', '["rampnetwork","moonpay","transak"]'), true))) }}
}">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="paygate" name="paygate" value="active"
                       :checked="config('settings.paygate') == 'active' ? true : false"/>
        <span class="flex-1">
            PayGate.to
            <span class="ml-2 text-xs text-gray-400 dark:text-gray-500">(Cards, Apple Pay, Google Pay, Crypto)</span>
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="paygate_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="paygate_tab_name" name="paygate_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('paygate_tab_name', config('settings.paygate_tab_name', 'PayGate')) }}"
                                  placeholder="PayGate"/>
                </div>
                <div>
                    <x-form.label for="paygate_heading" :value="__('Heading')"/>
                    <x-form.input id="paygate_heading" name="paygate_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('paygate_heading', config('settings.paygate_heading', 'PayGate Cryptocurrency Payment')) }}"
                                  placeholder="PayGate Cryptocurrency Payment"/>
                </div>
            </div>
            <div>
                <x-form.label for="paygate_description" :value="__('Description')"/>
                <x-form.input id="paygate_description" name="paygate_description" type="text" class="mt-1 block w-full"
                              value="{{ old('paygate_description', config('settings.paygate_description', 'Secure and instant crypto payment processing')) }}"
                              placeholder="Secure and instant crypto payment processing"/>
            </div>

            <div class="lg:col-span-12">
                <x-form.label for="paygate_wallet_address" :value="__('Polygon USDC Wallet Address')"/>
                <div class="relative">
                    <x-form.input id="paygate_wallet_address" name="paygate_wallet_address" type="text"
                                  class="mt-1 block w-full font-mono text-sm"
                                  value="{{ old('paygate_wallet_address', config('settings.paygate_wallet_address')) }}"
                                  placeholder="0x1234567890abcdef1234567890abcdef12345678"/>
                    @if(config('settings.paygate_wallet_address'))
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Your Polygon network wallet address for USDC payments (must start with 0x)
                </p>
            </div>

            <div>
                <x-form.label :value="__('Provider Mode')"/>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                           :class="providerMode === 'all' ? 'border-gray-800 dark:border-gray-300' : ''"
                           :style="providerMode === 'all' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : ''">
                        <input type="radio" name="paygate_provider_mode" value="all" 
                               :checked="providerMode === 'all'"
                               @change="providerMode = 'all'"
                               class="paygate-radio">
                        <div class="ml-3">
                            <div class="font-medium text-gray-900 dark:text-gray-100">All Providers</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Enable all 20 payment providers for customers</div>
                        </div>
                    </label>
                    <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                           :class="providerMode === 'single' ? 'border-gray-800 dark:border-gray-300' : ''"
                           :style="providerMode === 'single' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : ''">
                        <input type="radio" name="paygate_provider_mode" value="single" 
                               :checked="providerMode === 'single'"
                               @change="providerMode = 'single'"
                               class="paygate-radio">
                        <div class="ml-3">
                            <div class="font-medium text-gray-900 dark:text-gray-100">Single Provider</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Use only one payment provider</div>
                        </div>
                    </label>
                    <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                           :class="providerMode === 'custom' ? 'border-gray-800 dark:border-gray-300' : ''"
                           :style="providerMode === 'custom' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : ''">
                        <input type="radio" name="paygate_provider_mode" value="custom" 
                               :checked="providerMode === 'custom'"
                               @change="providerMode = 'custom'"
                               class="paygate-radio">
                        <div class="ml-3">
                            <div class="font-medium text-gray-900 dark:text-gray-100">Custom Providers</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Select specific providers you want to enable</div>
                        </div>
                    </label>
                </div>
            </div>

            <div x-show="providerMode === 'single'" x-transition>
                <x-form.label for="paygate_single_provider" :value="__('Select Provider')"/>
                <select id="paygate_single_provider" 
                        name="paygate_single_provider" 
                        x-model="singleProvider"
                        class="mt-2 block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm"
                        style="border-color: #2563eb50; accent-color: #2563eb;"
                        onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px #2563eb20';"
                        onblur="this.style.borderColor='#2563eb50'; this.style.boxShadow='none';">
                    @foreach(['rampnetwork' => 'Ramp Network', 'moonpay' => 'MoonPay', 'transak' => 'Transak', 'mercuryo' => 'Mercuryo', 'banxa' => 'Banxa', 'onramper' => 'Onramper', 'stripe' => 'Stripe', 'wert' => 'Wert.io', 'guardarian' => 'Guardarian', 'particle' => 'Particle Network', 'alchemypay' => 'Alchemy Pay', 'utorg' => 'Utorg', 'transfi' => 'Transfi', 'changenow' => 'ChangeNOW', 'sardine' => 'Sardine', 'unlimit' => 'Unlimit', 'simpleswap' => 'SimpleSwap', 'bitnovo' => 'Bitnovo', 'revolut' => 'Revolut', 'paybis' => 'Paybis'] as $key => $name)
                        <option value="{{ $key }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div x-show="providerMode === 'custom'" x-transition>
                <x-form.label :value="__('Select Custom Providers')"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 mb-3">Choose which payment providers you want to enable</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @php
                        $availableProviders = [
                            'rampnetwork' => ['name' => 'Ramp Network', 'desc' => 'Cards, Bank Transfer'],
                            'moonpay' => ['name' => 'MoonPay', 'desc' => 'Cards, Apple Pay, Google Pay'],
                            'transak' => ['name' => 'Transak', 'desc' => 'Cards, Bank Transfer'],
                            'mercuryo' => ['name' => 'Mercuryo', 'desc' => 'Cards'],
                            'banxa' => ['name' => 'Banxa', 'desc' => 'Cards, Bank Transfer'],
                            'onramper' => ['name' => 'Onramper', 'desc' => 'Multiple Methods'],
                            'stripe' => ['name' => 'Stripe', 'desc' => 'Cards, Wallets'],
                            'wert' => ['name' => 'Wert.io', 'desc' => 'Cards, Apple Pay'],
                            'guardarian' => ['name' => 'Guardarian', 'desc' => 'Cards, Bank Transfer'],
                            'particle' => ['name' => 'Particle Network', 'desc' => 'Web3 Wallets'],
                            'alchemypay' => ['name' => 'Alchemy Pay', 'desc' => 'Cards, Bank Transfer'],
                            'utorg' => ['name' => 'Utorg', 'desc' => 'Cards, Apple Pay'],
                            'transfi' => ['name' => 'Transfi', 'desc' => 'Cards, Local Methods'],
                            'changenow' => ['name' => 'ChangeNOW', 'desc' => 'Crypto Exchange'],
                            'sardine' => ['name' => 'Sardine', 'desc' => 'Cards, ACH'],
                            'unlimit' => ['name' => 'Unlimit', 'desc' => 'Cards, Local Methods'],
                            'simpleswap' => ['name' => 'SimpleSwap', 'desc' => 'Crypto Exchange'],
                            'bitnovo' => ['name' => 'Bitnovo', 'desc' => 'Cards, Vouchers'],
                            'revolut' => ['name' => 'Revolut', 'desc' => 'Bank Transfer, Cards'],
                            'paybis' => ['name' => 'Paybis', 'desc' => 'Cards, Bank Transfer']
                        ];
                    @endphp
                    @foreach($availableProviders as $key => $provider)
                        <label class="relative flex items-start p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                               :class="providers.includes('{{ $key }}') ? 'border-gray-800 dark:border-gray-300' : ''"
                               :style="providers.includes('{{ $key }}') ? 'border-color: #2563eb !important; background-color: #2563eb10;' : ''">
                            <input type="checkbox" 
                                   name="paygate_providers[]" 
                                   value="{{ $key }}"
                                   :checked="providers.includes('{{ $key }}')"
                                   @change="providers.includes('{{ $key }}') ? providers = providers.filter(p => p !== '{{ $key }}') : providers.push('{{ $key }}')"
                                   class="paygate-checkbox mt-0.5">
                            <div class="ml-3 flex-1">
                                <div class="font-medium text-sm text-gray-900 dark:text-gray-100">{{ $provider['name'] }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $provider['desc'] }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    <span x-show="providers.length === 0" class="text-amber-600 dark:text-amber-400">Select at least one provider</span>
                    <span x-show="providers.length > 0" style="color: #2563eb;" x-text="providers.length + ' provider(s) selected'"></span>
                </p>
            </div>

        </div>
    </div>
</div>

{{-- Card (Stripe / PayPal) --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ expanded: false }">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="card_enabled" name="card_enabled" value="active"
                       :checked="(config('settings.stripe') == 'active' || config('settings.paypal') == 'active') ? true : false"/>
        <span class="flex-1">
            {{__('Card Payment')}}
            <span class="ml-2 text-xs text-gray-400 dark:text-gray-500">(Stripe / PayPal)</span>
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="card_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="card_tab_name" name="card_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('card_tab_name', config('settings.card_tab_name', 'Card')) }}"
                                  placeholder="Card"/>
                </div>
                <div>
                    <x-form.label for="card_heading" :value="__('Heading')"/>
                    <x-form.input id="card_heading" name="card_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('card_heading', config('settings.card_heading', 'Credit/Debit Card Payment')) }}"
                                  placeholder="Credit/Debit Card Payment"/>
                </div>
            </div>
            <div>
                <x-form.label for="card_description" :value="__('Description')"/>
                <x-form.input id="card_description" name="card_description" type="text" class="mt-1 block w-full"
                              value="{{ old('card_description', config('settings.card_description', 'Pay securely with Stripe or PayPal')) }}"
                              placeholder="Pay securely with Stripe or PayPal"/>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="card_feature_1" :value="__('Feature 1')"/>
                    <x-form.input id="card_feature_1" name="card_feature_1" type="text" class="mt-1 block w-full"
                                  value="{{ old('card_feature_1', config('settings.card_feature_1', '')) }}"
                                  placeholder="{{__('e.g. Instant activation')}}"/>
                </div>
                <div>
                    <x-form.label for="card_feature_2" :value="__('Feature 2')"/>
                    <x-form.input id="card_feature_2" name="card_feature_2" type="text" class="mt-1 block w-full"
                                  value="{{ old('card_feature_2', config('settings.card_feature_2', '')) }}"
                                  placeholder="{{__('e.g. Secure payment')}}"/>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="card_feature_3" :value="__('Feature 3')"/>
                    <x-form.input id="card_feature_3" name="card_feature_3" type="text" class="mt-1 block w-full"
                                  value="{{ old('card_feature_3', config('settings.card_feature_3', '')) }}"
                                  placeholder="{{__('e.g. Money-back guarantee')}}"/>
                </div>
                <div></div>
            </div>

            <hr class="border-gray-100 dark:border-gray-800">
            <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Gateway Credentials')}}</p>

            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Stripe</span>
                    <x-form.switch type="checkbox" id="stripe" name="stripe" value="active"
                                   :checked="config('settings.stripe') == 'active' ? true : false"/>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <x-form.label for="stripe_key" :value="__('Stripe Public Key')"/>
                        <x-form.input id="stripe_key" name="stripe_key" type="text" class="mt-1 block w-full font-mono text-xs"
                                      value="{{ old('stripe_key', config('settings.stripe_key')) }}"
                                      placeholder="pk_..."/>
                    </div>
                    <div>
                        <x-form.label for="stripe_secret_key" :value="__('Stripe Secret Key')"/>
                        <x-form.input id="stripe_secret_key" name="stripe_secret_key" type="password" class="mt-1 block w-full font-mono text-xs"
                                      value="{{ old('stripe_secret_key', config('settings.stripe_secret_key')) }}"
                                      placeholder="sk_..."/>
                    </div>
                </div>
                <div>
                    <x-form.label for="stripe_signing_secret" :value="__('Stripe Webhook Signing Secret')"/>
                    <x-form.input id="stripe_signing_secret" name="stripe_signing_secret" type="password" class="mt-1 block w-full font-mono text-xs"
                                  value="{{ old('stripe_signing_secret', config('settings.stripe_signing_secret')) }}"
                                  placeholder="whsec_..."/>
                </div>
            </div>

            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">PayPal</span>
                    <x-form.switch type="checkbox" id="paypal" name="paypal" value="active"
                                   :checked="config('settings.paypal') == 'active' ? true : false"/>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <x-form.label for="paypal_client_id" :value="__('PayPal Client ID')"/>
                        <x-form.input id="paypal_client_id" name="paypal_client_id" type="text" class="mt-1 block w-full font-mono text-xs"
                                      value="{{ old('paypal_client_id', config('settings.paypal_client_id')) }}"
                                      placeholder="AX..."/>
                    </div>
                    <div>
                        <x-form.label for="paypal_secret" :value="__('PayPal Secret')"/>
                        <x-form.input id="paypal_secret" name="paypal_secret" type="password" class="mt-1 block w-full font-mono text-xs"
                                      value="{{ old('paypal_secret', config('settings.paypal_secret')) }}"
                                      placeholder="EL..."/>
                    </div>
                </div>
                <div>
                    <x-form.label for="paypal_webhook_id" :value="__('PayPal Webhook ID')"/>
                    <x-form.input id="paypal_webhook_id" name="paypal_webhook_id" type="text" class="mt-1 block w-full font-mono text-xs"
                                  value="{{ old('paypal_webhook_id', config('settings.paypal_webhook_id')) }}"
                                  placeholder="WH-..."/>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bank Transfer --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ expanded: false }">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="bank" name="bank" value="active"
                       :checked="config('settings.bank') == 'active' ? true : false"/>
        <span class="flex-1">
            {{__('Bank Transfer')}}
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="bank_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="bank_tab_name" name="bank_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_tab_name', config('settings.bank_tab_name', 'Bank Transfer')) }}"
                                  placeholder="Bank Transfer"/>
                </div>
                <div>
                    <x-form.label for="bank_heading" :value="__('Heading')"/>
                    <x-form.input id="bank_heading" name="bank_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_heading', config('settings.bank_heading', 'Direct Bank Transfer')) }}"
                                  placeholder="Direct Bank Transfer"/>
                </div>
            </div>
            <div>
                <x-form.label for="bank_description" :value="__('Description')"/>
                <x-form.input id="bank_description" name="bank_description" type="text" class="mt-1 block w-full"
                              value="{{ old('bank_description', config('settings.bank_description', 'Transfer to our bank account and upload proof')) }}"
                              placeholder="Transfer to our bank account and upload proof"/>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="bank_feature_1" :value="__('Feature 1')"/>
                    <x-form.input id="bank_feature_1" name="bank_feature_1" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_feature_1', config('settings.bank_feature_1', '')) }}"
                                  placeholder="{{__('e.g. No processing fees')}}"/>
                </div>
                <div>
                    <x-form.label for="bank_feature_2" :value="__('Feature 2')"/>
                    <x-form.input id="bank_feature_2" name="bank_feature_2" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_feature_2', config('settings.bank_feature_2', '')) }}"
                                  placeholder="{{__('e.g. Verified within 24h')}}"/>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="bank_feature_3" :value="__('Feature 3')"/>
                    <x-form.input id="bank_feature_3" name="bank_feature_3" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_feature_3', config('settings.bank_feature_3', '')) }}"
                                  placeholder="{{__('e.g. Secure transfer')}}"/>
                </div>
                <div></div>
            </div>

            <hr class="border-gray-100 dark:border-gray-800">
            <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Bank Details')}}</p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="bank_name" :value="__('Bank Name')"/>
                    <x-form.input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_name', config('settings.bank_name')) }}"
                                  placeholder="{{__('Your Bank Name')}}"/>
                </div>
                <div>
                    <x-form.label for="bank_account_name" :value="__('Account Name')"/>
                    <x-form.input id="bank_account_name" name="bank_account_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_account_name', config('settings.bank_account_name')) }}"
                                  placeholder="{{__('Your Account Name')}}"/>
                </div>
                <div>
                    <x-form.label for="bank_account_number" :value="__('Account Number')"/>
                    <x-form.input id="bank_account_number" name="bank_account_number" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_account_number', config('settings.bank_account_number')) }}"
                                  placeholder="{{__('XXXX-XXXX-XXXX')}}"/>
                </div>
                <div>
                    <x-form.label for="bank_iban" :value="__('IBAN')"/>
                    <x-form.input id="bank_iban" name="bank_iban" type="text" class="mt-1 block w-full"
                                  value="{{ old('bank_iban', config('settings.bank_iban')) }}"
                                  placeholder="{{__('IBAN NUMBER')}}"/>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- WhatsApp --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ expanded: false }">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="whatsapp_enabled" name="whatsapp_enabled" value="active"
                       :checked="config('settings.whatsapp_enabled') == 'active' ? true : false"/>
        <span class="flex-1">
            WhatsApp
            <span class="ml-2 text-xs text-gray-400 dark:text-gray-500">({{__('Contact via WhatsApp')}})</span>
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="whatsapp_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="whatsapp_tab_name" name="whatsapp_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('whatsapp_tab_name', config('settings.whatsapp_tab_name', 'WhatsApp')) }}"
                                  placeholder="WhatsApp"/>
                </div>
                <div>
                    <x-form.label for="whatsapp_heading" :value="__('Heading')"/>
                    <x-form.input id="whatsapp_heading" name="whatsapp_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('whatsapp_heading', config('settings.whatsapp_heading', 'WhatsApp Payment')) }}"
                                  placeholder="WhatsApp Payment"/>
                </div>
            </div>
            <div>
                <x-form.label for="whatsapp_description" :value="__('Description')"/>
                <x-form.input id="whatsapp_description" name="whatsapp_description" type="text" class="mt-1 block w-full"
                              value="{{ old('whatsapp_description', config('settings.whatsapp_description', 'Contact us directly via WhatsApp to complete your payment')) }}"
                              placeholder="Contact us directly via WhatsApp to complete your payment"/>
            </div>
            <div>
                <x-form.label for="whatsapp_number" :value="__('WhatsApp Number')"/>
                <x-form.input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full"
                              value="{{ old('whatsapp_number', config('settings.whatsapp_number')) }}"
                              placeholder="{{__('e.g. 46701234567 (with country code, no +)')}}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('International format without + sign')}}</p>
            </div>
            <div>
                <x-form.label for="whatsapp_message" :value="__('Info Text')"/>
                <x-form.textarea id="whatsapp_message" name="whatsapp_message"
                                 placeholder="{{__('Text shown to customer before they click the WhatsApp button')}}">{{ old('whatsapp_message', config('settings.whatsapp_message', 'Click the button below to start a WhatsApp conversation with our team. We will guide you through the payment process.')) }}</x-form.textarea>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div>
                    <x-form.label for="whatsapp_feature_1" :value="__('Feature 1')"/>
                    <x-form.input id="whatsapp_feature_1" name="whatsapp_feature_1" type="text" class="mt-1 block w-full"
                                  value="{{ old('whatsapp_feature_1', config('settings.whatsapp_feature_1', 'Instant response')) }}"
                                  placeholder="{{__('Instant response')}}"/>
                </div>
                <div>
                    <x-form.label for="whatsapp_feature_2" :value="__('Feature 2')"/>
                    <x-form.input id="whatsapp_feature_2" name="whatsapp_feature_2" type="text" class="mt-1 block w-full"
                                  value="{{ old('whatsapp_feature_2', config('settings.whatsapp_feature_2', 'Personal support')) }}"
                                  placeholder="{{__('Personal support')}}"/>
                </div>
                <div>
                    <x-form.label for="whatsapp_feature_3" :value="__('Feature 3')"/>
                    <x-form.input id="whatsapp_feature_3" name="whatsapp_feature_3" type="text" class="mt-1 block w-full"
                                  value="{{ old('whatsapp_feature_3', config('settings.whatsapp_feature_3', 'Multiple payment options')) }}"
                                  placeholder="{{__('Multiple payment options')}}"/>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Telegram --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ expanded: false }">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="telegram_enabled" name="telegram_enabled" value="active"
                       :checked="config('settings.telegram_enabled') == 'active' ? true : false"/>
        <span class="flex-1">
            Telegram
            <span class="ml-2 text-xs text-gray-400 dark:text-gray-500">({{__('Contact via Telegram')}})</span>
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="telegram_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="telegram_tab_name" name="telegram_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('telegram_tab_name', config('settings.telegram_tab_name', 'Telegram')) }}"
                                  placeholder="Telegram"/>
                </div>
                <div>
                    <x-form.label for="telegram_heading" :value="__('Heading')"/>
                    <x-form.input id="telegram_heading" name="telegram_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('telegram_heading', config('settings.telegram_heading', 'Telegram Payment')) }}"
                                  placeholder="Telegram Payment"/>
                </div>
            </div>
            <div>
                <x-form.label for="telegram_description" :value="__('Description')"/>
                <x-form.input id="telegram_description" name="telegram_description" type="text" class="mt-1 block w-full"
                              value="{{ old('telegram_description', config('settings.telegram_description', 'Get instant support via Telegram for your payment')) }}"
                              placeholder="Get instant support via Telegram for your payment"/>
            </div>
            <div>
                <x-form.label for="telegram_username" :value="__('Telegram Username')"/>
                <x-form.input id="telegram_username" name="telegram_username" type="text" class="mt-1 block w-full"
                              value="{{ old('telegram_username', config('settings.telegram_username')) }}"
                              placeholder="{{__('e.g. YourBotName (without @)')}}"/>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{__('Username without the @ sign')}}</p>
            </div>
            <div>
                <x-form.label for="telegram_message" :value="__('Info Text')"/>
                <x-form.textarea id="telegram_message" name="telegram_message"
                                 placeholder="{{__('Text shown to customer before they click the Telegram button')}}">{{ old('telegram_message', config('settings.telegram_message', 'Message us on Telegram and our team will assist you with the payment process immediately.')) }}</x-form.textarea>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div>
                    <x-form.label for="telegram_feature_1" :value="__('Feature 1')"/>
                    <x-form.input id="telegram_feature_1" name="telegram_feature_1" type="text" class="mt-1 block w-full"
                                  value="{{ old('telegram_feature_1', config('settings.telegram_feature_1', 'Fast response time')) }}"
                                  placeholder="{{__('Fast response time')}}"/>
                </div>
                <div>
                    <x-form.label for="telegram_feature_2" :value="__('Feature 2')"/>
                    <x-form.input id="telegram_feature_2" name="telegram_feature_2" type="text" class="mt-1 block w-full"
                                  value="{{ old('telegram_feature_2', config('settings.telegram_feature_2', 'Secure messaging')) }}"
                                  placeholder="{{__('Secure messaging')}}"/>
                </div>
                <div>
                    <x-form.label for="telegram_feature_3" :value="__('Feature 3')"/>
                    <x-form.input id="telegram_feature_3" name="telegram_feature_3" type="text" class="mt-1 block w-full"
                                  value="{{ old('telegram_feature_3', config('settings.telegram_feature_3', 'Flexible payment methods')) }}"
                                  placeholder="{{__('Flexible payment methods')}}"/>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Payment Link --}}
<div class="rounded-lg border shadow-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 px-5 divide-y divide-gray-100 mb-2" x-data="{ expanded: false }">
    <div class="py-5 px-1 font-medium text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <x-form.switch type="checkbox" id="payment_link_enabled" name="payment_link_enabled" value="active"
                       :checked="config('settings.payment_link_enabled') == 'active' ? true : false"/>
        <span class="flex-1">
            {{__('Payment Link')}}
            <span class="ml-2 text-xs text-gray-400 dark:text-gray-500">({{__('Custom payment form')}})</span>
        </span>
        <button type="button" @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
            <svg x-show="!expanded" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <svg x-show="expanded" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
        </button>
    </div>
    <div x-show="expanded" x-collapse>
        <div class="px-1 py-5 border-t border-gray-100 dark:border-gray-800 space-y-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <x-form.label for="payment_link_tab_name" :value="__('Tab Name')"/>
                    <x-form.input id="payment_link_tab_name" name="payment_link_tab_name" type="text" class="mt-1 block w-full"
                                  value="{{ old('payment_link_tab_name', config('settings.payment_link_tab_name', 'Payment Link')) }}"
                                  placeholder="Payment Link"/>
                </div>
                <div>
                    <x-form.label for="payment_link_heading" :value="__('Heading')"/>
                    <x-form.input id="payment_link_heading" name="payment_link_heading" type="text" class="mt-1 block w-full"
                                  value="{{ old('payment_link_heading', config('settings.payment_link_heading', 'Pay via Payment Link')) }}"
                                  placeholder="Pay via Payment Link"/>
                </div>
            </div>
            <div>
                <x-form.label for="payment_link_description" :value="__('Description')"/>
                <x-form.input id="payment_link_description" name="payment_link_description" type="text" class="mt-1 block w-full"
                              value="{{ old('payment_link_description', config('settings.payment_link_description', 'Submit your details and we will process your payment')) }}"
                              placeholder="Submit your details and we will process your payment"/>
            </div>

            <hr class="border-gray-100 dark:border-gray-800">
            <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{__('Required Fields')}}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{__('Select which fields the buyer must fill in at checkout')}}</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                       style="{{ config('settings.payment_link_field_name') == 'active' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : '' }}">
                    <input type="checkbox" name="payment_link_field_name" value="active" class="paygate-checkbox"
                           {{ config('settings.payment_link_field_name') == 'active' ? 'checked' : '' }}>
                    <div class="ml-3">
                        <div class="font-medium text-sm text-gray-900 dark:text-gray-100">{{__('Full Name')}}</div>
                    </div>
                </label>
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                       style="{{ config('settings.payment_link_field_email') == 'active' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : '' }}">
                    <input type="checkbox" name="payment_link_field_email" value="active" class="paygate-checkbox"
                           {{ config('settings.payment_link_field_email') == 'active' ? 'checked' : '' }}>
                    <div class="ml-3">
                        <div class="font-medium text-sm text-gray-900 dark:text-gray-100">{{__('Email Address')}}</div>
                    </div>
                </label>
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                       style="{{ config('settings.payment_link_field_phone') == 'active' ? 'border-color: #2563eb !important; background-color: #2563eb10;' : '' }}">
                    <input type="checkbox" name="payment_link_field_phone" value="active" class="paygate-checkbox"
                           {{ config('settings.payment_link_field_phone') == 'active' ? 'checked' : '' }}>
                    <div class="ml-3">
                        <div class="font-medium text-sm text-gray-900 dark:text-gray-100">{{__('Phone Number')}}</div>
                    </div>
                </label>
            </div>

            <hr class="border-gray-100 dark:border-gray-800">

            <div>
                <x-form.label for="payment_link_button_text" :value="__('Submit Button Text')"/>
                <x-form.input id="payment_link_button_text" name="payment_link_button_text" type="text" class="mt-1 block w-full"
                              value="{{ old('payment_link_button_text', config('settings.payment_link_button_text', 'Submit Order')) }}"
                              placeholder="Submit Order"/>
            </div>
            <div>
                <x-form.label for="payment_link_message" :value="__('Info Text')"/>
                <x-form.textarea id="payment_link_message" name="payment_link_message"
                                 placeholder="{{__('Text shown to customer above the form')}}">{{ old('payment_link_message', config('settings.payment_link_message', 'Fill in the required details below and submit your order. Our team will contact you with payment instructions.')) }}</x-form.textarea>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div>
                    <x-form.label for="payment_link_feature_1" :value="__('Feature 1')"/>
                    <x-form.input id="payment_link_feature_1" name="payment_link_feature_1" type="text" class="mt-1 block w-full"
                                  value="{{ old('payment_link_feature_1', config('settings.payment_link_feature_1', 'Secure checkout')) }}"
                                  placeholder="{{__('Secure checkout')}}"/>
                </div>
                <div>
                    <x-form.label for="payment_link_feature_2" :value="__('Feature 2')"/>
                    <x-form.input id="payment_link_feature_2" name="payment_link_feature_2" type="text" class="mt-1 block w-full"
                                  value="{{ old('payment_link_feature_2', config('settings.payment_link_feature_2', 'Instant confirmation')) }}"
                                  placeholder="{{__('Instant confirmation')}}"/>
                </div>
                <div>
                    <x-form.label for="payment_link_feature_3" :value="__('Feature 3')"/>
                    <x-form.input id="payment_link_feature_3" name="payment_link_feature_3" type="text" class="mt-1 block w-full"
                                  value="{{ old('payment_link_feature_3', config('settings.payment_link_feature_3', 'Multiple payment methods')) }}"
                                  placeholder="{{__('Multiple payment methods')}}"/>
                </div>
            </div>
        </div>
    </div>
</div>
