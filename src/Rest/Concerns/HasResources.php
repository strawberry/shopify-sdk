<?php

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Rest\Resources\Resource;
use Strawberry\Shopify\Rest\Resources\ShopResource;

trait HasResources
{
    /**
     * Cached resource instances to save creating new instances each time
     * a resource is accessed.
     * @var array
     */
    private $resourceCache = [];

    /**
     * Returns a resource instance from the cache. If no instance exists
     * already, then we create a new instance and add that to the cache.
     */
    private function getResourceInstance(string $resource): Resource
    {
        if (! isset($this->resourceCache[$resource])) {
            $this->resourceCache[$resource] = new $resource($this);
        }

        return $this->resourceCache[$resource];
    }
}