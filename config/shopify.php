<?php

return [
    /*
     * This is where the credentials for connecting to your Shopify API
     * should be placed.
     */
    'credentials' => [
        'version' => '2019-07',
        'store' => env('SHOPIFY_STORE_URL'),
        'api_key' => env('SHOPIFY_API_KEY'),
        'api_password' => env('SHOPIFY_API_PASSWORD'),
        'access_token' => env('SHOPIFY_ACCESS_TOKEN'),
    ],
];
