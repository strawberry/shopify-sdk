<?php

namespace Strawberry\Shopify;

use Illuminate\Support\ServiceProvider;

final class ShopifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/shopify.php' => config_path('shopify.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->app->bind(Shopify::class, function () {
            return new Shopify(config('shopify.credentials'));
        });
    }
}
