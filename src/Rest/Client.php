<?php

namespace Strawberry\Shopify\Rest;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Http\Client as HttpClient;
use Strawberry\Shopify\Rest\Concerns\HasResources;

class Client
{
    use HasResources;

    /** @var HttpClient */
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = new HttpClient($httpClient);
    }

    /**
     * Create a new instance of the client, set up with the credentials for
     * a public Shopify application.
     */
    public static function forPublicApp(array $config): self
    {
        $httpClient = new GuzzleClient([
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
        $httpClient = new GuzzleClient([
            'base_uri' => "{$config['store_uri']}/admin/api/{$config['version']}/",
            'auth' => [
                $config['api_key'],
                $config['api_password'],
            ],
        ]);

        return new self($httpClient);
    }
}