<?php

declare(strict_types=1);

namespace Strawberry\Shopify;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Strawberry\Shopify\Exceptions\SdkException;
use Strawberry\Shopify\Factories\CollectionFactory;
use Strawberry\Shopify\Factories\GuzzleClientFactory;
use Strawberry\Shopify\Rest\Client;
use Strawberry\Shopify\Services\VerificationService;

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
        $this->app->bind(VerificationService::class, function () {
            return new VerificationService(config('shopify.shared_secret'));
        });

        $this->app->bind(Client::class, function () {
            return new Client($this->makeHttpClient());
        });

        ModelFactory::configure(config('shopify.models'));

        CollectionFactory::configure(config('shopify.collection'));
    }

    /**
     * Returns a Guzzle Client instance based on the type of
     * Shopify application required.
     *
     * @throws SdkException
     */
    private function makeHttpClient(): ClientInterface
    {
        $config = config('shopify.credentials');
        $factory = $this->app->make(GuzzleClientFactory::class);

        return $factory->make($config);
    }
}
