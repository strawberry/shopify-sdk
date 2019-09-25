<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Strawberry\Shopify\Exceptions\ClientException;

final class GuzzleClientFactory
{
    /**
     * Create a new client instance based on the configuration provided.
     *
     * @param  array  $config
     *
     * @return ClientInterface
     *
     * @throws ClientException
     */
    public function make(array $config): ClientInterface
    {
        if ($this->isPrivateApp($config)) {
            return $this->forPrivateApp($config);
        }

        if ($this->isPublicApp($config)) {
            return $this->forPublicApp($config);
        }

        throw ClientException::credentialsNotSet();
    }

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
     * Determine whether we're connecting to the Shopify API with
     * public application credentials.
     */
    private function isPublicApp(array $config): bool
    {
        return isset($config['access_token']);
    }

    /**
     * Determine whether we're connecting to the Shopify API with
     * private application credentials.
     */
    private function isPrivateApp(array $config): bool
    {
        return isset($config['api_key'], $config['api_password']);
    }

    /**
     * Creates the API URL from the configuration.
     */
    private function getApiUrl(array $config): string
    {
        return "https://{$config['store_uri']}/admin/api/{$config['version']}/";
    }
}
