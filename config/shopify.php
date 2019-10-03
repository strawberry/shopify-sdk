<?php

return [
    /*
     * This is where the credentials for connecting to your Shopify API
     * should be placed.
     */
    'credentials' => [
        'version' => '2019-07',
        'store_uri' => env('SHOPIFY_STORE_URI'),
        'api_key' => env('SHOPIFY_API_KEY'),
        'api_password' => env('SHOPIFY_API_PASSWORD'),
        'access_token' => env('SHOPIFY_ACCESS_TOKEN'),
    ],

    'shared_secret' => env('SHOPIFY_SHARED_SECRET'),

    /**
     * You can swap out models for your own implementation by mapping them
     * here. The key should be original class name with the value being
     * the FQCN for your own implementation.
     */
    'models' => [
        // Strawberry\Shopify\Models\Store\Shop::class => Acme\Shop::class,
    ],

    /**
     * Collections can be set to either the default PHP array, or a model
     * that accepts an array of items as its constructor argument such
     * as Illuminate\Support\Collection.
     */
    'collection' => 'array',
];
