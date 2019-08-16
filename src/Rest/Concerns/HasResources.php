<?php

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Rest\Resources\Resource;

trait HasResources
{
    /**
     * Cached resource instances to save creating new instances each time
     * a resource is accessed.
     *
     * @var array
     */
    private $resourceCache = [];

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
    protected function getResourceInstance(string $resource, array $params = []): Resource
    {
        if (! isset($this->resourceCache[$resource])) {
            $this->resourceCache[$resource] = new $resource(
                $this->httpClient, ...$params
            );
        }

        return $this->resourceCache[$resource];
    }
}