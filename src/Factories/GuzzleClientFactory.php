<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

final class GuzzleClientFactory
{
    /**
     * Create a new instance of the client, set up with the credentials for
     * a public Shopify application.
     */
    public function forPublicApp(array $config): ClientInterface
    {
        return new Client([
            'base_uri' => $this->getApiUrl($config),
            'headers' => [
                'X-Shopify-Access-Token' => $config['access_token'],
            ],
        ]);
    }

    /**
     * Create a new instance of the client, set up with the credentials for
     * a private Shopify application.
     */
    public function forPrivateApp(array $config): ClientInterface
    {
        return new Client([
            'base_uri' => $this->getApiUrl($config),
            'auth' => [
                $config['api_key'],
                $config['api_password'],
            ],
        ]);
    }

    /**
     * Creates the API URL from the configuration.
     */
    private function getApiUrl(array $config): string
    {
        return "https://{$config['store_uri']}/admin/api/{$config['version']}/";
    }
}
