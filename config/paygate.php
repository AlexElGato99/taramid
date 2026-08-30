<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PayGate.to Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for PayGate.to payment gateway integration.
    | PayGate.to allows you to accept credit/debit cards (Visa, MasterCard, Maestro),
    | Apple Pay, Google Pay, and bank transfers with instant USDC payouts.
    |
    | Documentation: https://documenter.getpostman.com/view/14826208/2sA3Bj9aBi
    |
    */

    /*
    | API Base URL
    | Default: https://api.paygate.to
    */
    'api_url' => env('PAYGATE_API_URL', 'https://api.paygate.to'),

    /*
    | Checkout Base URL
    | Default: https://checkout.paygate.to
    */
    'checkout_url' => env('PAYGATE_CHECKOUT_URL', 'https://checkout.paygate.to'),

    /*
    | USDC Wallet Address (Polygon Network)
    | This is your merchant wallet where USDC payouts will be sent instantly
    | Must be a valid Polygon (MATIC) network wallet address starting with 0x
    */
    'wallet_address' => env('PAYGATE_WALLET_ADDRESS'),

    /*
    | Default Currency
    | Supported: USD, EUR, GBP, etc.
    */
    'currency' => env('PAYGATE_CURRENCY', 'USD'),

    /*
    | Callback URL
    | PayGate will send payment notifications to this URL
    | This is automatically constructed but can be overridden
    */
    'callback_url' => env('PAYGATE_CALLBACK_URL', '/paygate/callback'),

    /*
    | Success Return URL
    | Users are redirected here after successful payment
    */
    'success_url' => env('PAYGATE_SUCCESS_URL', '/paygate/success'),

    /*
    | Cancel Return URL
    | Users are redirected here if they cancel payment
    */
    'cancel_url' => env('PAYGATE_CANCEL_URL', '/paygate/cancel'),

    /*
    | API Request Timeout (seconds)
    | How long to wait for PayGate API responses
    */
    'timeout' => env('PAYGATE_TIMEOUT', 30),

    /*
    | Enable/Disable PayGate.to
    | Set to false to disable PayGate payments
    */
    'enabled' => env('PAYGATE_ENABLED', true),

    /*
    | Minimum Payment Amount (USD)
    | Card payments have a minimum of $5 USD
    | Bank transfers minimum varies by region
    */
    'minimum_amount' => [
        'card' => 5.00,
        'bank_transfer' => 10.00,
    ],

    /*
    | Logging
    | Enable detailed logging for debugging
    */
    'debug' => env('PAYGATE_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Multi-Provider Mode Settings
    |--------------------------------------------------------------------------
    |
    | Multi-provider mode allows customers to choose between multiple payment
    | providers (Ramp Network, Moonpay, Transak, etc.) at checkout.
    |
    | Endpoint: https://checkout.paygate.to/pay.php
    |
    */

    /*
    | Payment Provider Mode
    | Options: 'single' (ramp.network only) or 'multi' (multiple providers)
    | Default: 'multi'
    */
    'provider_mode' => env('PAYGATE_PROVIDER_MODE', 'multi'),

    /*
    | Custom Checkout Domain
    | Use your own domain for white-labeled checkout
    | Default: checkout.paygate.to
    */
    'checkout_domain' => env('PAYGATE_CHECKOUT_DOMAIN', 'checkout.paygate.to'),

    /*
    |--------------------------------------------------------------------------
    | White-Labeling Options (Optional)
    |--------------------------------------------------------------------------
    |
    | Customize the PayGate checkout page with your branding
    |
    */

    /*
    | Logo URL
    | Full URL to your company logo (displayed at top of checkout)
    | Example: https://yourdomain.com/logo.png
    */
    'logo_url' => env('PAYGATE_LOGO_URL', null),

    /*
    | Background URL
    | Full URL to background image for checkout page
    | Example: https://yourdomain.com/background.jpg
    */
    'background_url' => env('PAYGATE_BACKGROUND_URL', null),

    /*
    | Theme
    | Checkout page theme
    | Options: 'light', 'dark'
    */
    'theme' => env('PAYGATE_THEME', 'dark'),

    /*
    | Button Color
    | Hex color code for primary buttons
    | Example: #FF5733
    */
    'button_color' => env('PAYGATE_BUTTON_COLOR', null),

    /*
    |--------------------------------------------------------------------------
    | Currency Exchange Rates
    |--------------------------------------------------------------------------
    | Update these rates periodically to ensure accurate conversions
    | Last updated: January 2026
    |
    */
    'exchange_rates' => [
        'SEK' => env('PAYGATE_RATE_SEK', 0.096),  // Swedish Krona
        'EUR' => env('PAYGATE_RATE_EUR', 1.10),   // Euro
        'GBP' => env('PAYGATE_RATE_GBP', 1.27),   // British Pound
        'NOK' => env('PAYGATE_RATE_NOK', 0.095),  // Norwegian Krone
        'DKK' => env('PAYGATE_RATE_DKK', 0.147),  // Danish Krone
        'CHF' => env('PAYGATE_RATE_CHF', 1.16),   // Swiss Franc
        'CAD' => env('PAYGATE_RATE_CAD', 0.74),   // Canadian Dollar
        'AUD' => env('PAYGATE_RATE_AUD', 0.66),   // Australian Dollar
        'JPY' => env('PAYGATE_RATE_JPY', 0.0069), // Japanese Yen
    ],
];
