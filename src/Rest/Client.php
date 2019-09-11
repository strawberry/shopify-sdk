<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Http\Client as HttpClient;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;
use Strawberry\Shopify\Rest\Resources\Store\ShopResource;

/**
 * @method  CountryResource  shop(?integer id)
 * @method  ShopResource  shop(?integer id)
 */
final class Client
{
    /**
     * The HTTP client for making requests to the API.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Cached resource instances to save creating new instances each time
     * a resource is accessed.
     *
     * @var array
     */
    private $resourceCache = [];

    /**
     * A list of the registered resources for each client.
     *
     * @var array
     */
    protected $resources = [
        'countries' => CountryResource::class,
        'shop' => ShopResource::class,
    ];

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->httpClient = new HttpClient($guzzleClient);
    }

    /**
     * Get a resource classname by the given key.
     */
    protected function getResourceClass(string $key): ?string
    {
        return $this->resources[$key] ?? null;
    }

    /**
     * Returns a resource instance from the cache. If no instance exists
     * already, then we create a new instance and add that to the cache.
     */
    protected function getResourceInstance(string $resource): Resource
    {
        if (! isset($this->resourceCache[$resource])) {
            $this->resourceCache[$resource] = new $resource($this->httpClient);
        }

        return $this->resourceCache[$resource];
    }

    /**
     * Magic method for loading the resources.
     *
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $params)
    {
        if ($resource = $this->getResourceClass($method)) {
            return $this->getResourceInstance($resource);
        }

        throw new BadMethodCallException(
            "Method [{$method}] does not exist on class [" . self::class . "]"
        );
    }
}
