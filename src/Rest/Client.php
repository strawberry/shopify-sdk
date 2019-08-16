<?php

namespace Strawberry\Shopify\Rest;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Http\Client as HttpClient;
use Strawberry\Shopify\Rest\Concerns\HasResources;
use Strawberry\Shopify\Rest\Resources\ShopResource;

/**
 * @method  ShopResource  shop(?integer id)
 */
class Client
{
    use HasResources;

    /** @var HttpClient */
    private $httpClient;

    /**
     * A list of the registered resources for each client.
     *
     * @var array
     */
    protected $resources = [
        'shop' => ShopResource::class,
    ];

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = new HttpClient($httpClient);
    }

    /**
     * Magic method for loading the resources.
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $params)
    {
        if ($resource = $this->getResourceClass($method)) {
            return $this->getResourceInstance($resource);
        }

        throw new BadMethodCallException("Method [{$method}] does not exist on class [" . static::class . "]");
    }

    /**
     * Create a new instance of the client, set up with the credentials for
     * a public Shopify application.
     */
    public static function forPublicApp(array $config): self
    {
        $httpClient = new GuzzleClient([
            'base_uri' => "https://{$config['store_uri']}/admin/api/{$config['version']}/",
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
            'base_uri' => "https://{$config['store_uri']}/admin/api/{$config['version']}/",
            'auth' => [
                $config['api_key'],
                $config['api_password'],
            ],
        ]);

        return new self($httpClient);
    }
}