<?php

namespace Strawberry\Shopify\Rest;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface;

final class Client
{
    /** @var ClientInterface */
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Create a new instance of the client, set up with the credentials for
     * a public Shopify application.
     */
    public static function forPublicApp(array $config): self
    {
        $httpClient = new GuzzleHttpClient([
            'base_uri' => "{$config['store_uri']}/admin/api/{$config['version']}/",
            'headers' => [
                'X-Shopify-Access-Token' => $config['access_token'],
            ],
        ]);

        return new self($httpClient);
    }

    /**
     * Create a new instance of the client, set up with the credentials for
     * a private Shopify application.
     */
    public static function forPrivateApp(array $config): self
    {
        $httpClient = new GuzzleHttpClient([
            'base_uri' => "{$config['store_uri']}/admin/api/{$config['version']}/",
            'auth' => [
                $config['api_key'],
                $config['api_password'],
            ],
        ]);

        return new self($httpClient);
    }
}