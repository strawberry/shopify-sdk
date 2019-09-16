<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Str;
use Strawberry\Shopify\Http\Client as HttpClient;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;
use Strawberry\Shopify\Rest\Resources\Store\CurrencyResource;
use Strawberry\Shopify\Rest\Resources\Store\PolicyResource;
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
    private $resources = [
        'countries' => CountryResource::class,
        'currencies' => CurrencyResource::class,
        'policies' => PolicyResource::class,
        'shop' => ShopResource::class,
    ];

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->httpClient = new HttpClient($guzzleClient);
    }

    /**
     * Determine whether the given resource exists.
     */
    private function hasResource(string $key): bool
    {
        return array_key_exists($key, $this->resources);
    }

    /**
     * Determine whether the given key should be proxied.
     */
    private function shouldBeProxied(string $key): bool
    {
        $resource = Str::plural($key);

        return $this->hasResource($resource);
    }

    /**
     * Returns a resource instance from the cache. If no instance exists
     * already, then we create a new instance and add that to the cache.
     */
    private function getResourceInstance(string $key): Resource
    {
        $resource = $this->resources[$key];

        if (! isset($this->resourceCache[$resource])) {
            $this->resourceCache[$resource] = new $resource($this->httpClient);
        }

        return $this->resourceCache[$resource];
    }

    /**
     * Returns a proxy instance for the given resource.
     */
    private function getProxyInstance(string $key, array $params): ResourceProxy
    {
        return new ResourceProxy(
            $this->getResourceInstance(Str::plural($key)),
            $params[0]
        );
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
        if ($this->hasResource($method)) {
            return $this->getResourceInstance($method);
        }

        if ($this->shouldBeProxied($method)) {
            return $this->getProxyInstance($method, $params);
        }

        throw new BadMethodCallException(
            "Method [{$method}] does not exist on class [" . self::class . "]"
        );
    }
}
