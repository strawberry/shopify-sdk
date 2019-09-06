<?php

declare(strict_types=1);

namespace Strawberry\Shopify;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Factories\GuzzleClientFactory;
use Strawberry\Shopify\Rest\Client;

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
        $this->app->bind(Client::class, function () {
            return new Client($this->makeHttpClient());
        });
    }

    /**
     * Returns a Guzzle Client instance based on the type of
     * Shopify application required.
     *
     * @throws ClientException
     */
    private function makeHttpClient(): ClientInterface
    {
        $config = config('shopify.credentials');
        $factory = $this->app->make(GuzzleClientFactory::class);

        if ($this->isPrivateApp($config)) {
            return $factory->forPrivateApp($config);
        }

        if ($this->isPublicApp($config)) {
            return $factory->forPublicApp($config);
        }

        throw ClientException::credentialsNotSet();
    }

    /**
     * Determine whether we're connecting to the Shopify API with
     * private application credentials.
     */
    private function isPrivateApp(array $config): bool
    {
        if (empty($config['api_key'])) {
            return false;
        }

        if (empty($config['api_password'])) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether we're connecting to the Shopify API with
     * public application credentials.
     */
    private function isPublicApp(array $config): bool
    {
        return ! empty($config['access_token']);
    }
}
