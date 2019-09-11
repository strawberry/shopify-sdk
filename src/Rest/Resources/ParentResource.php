<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources;

use RuntimeException;
use Strawberry\Shopify\Rest\Resource;

abstract class ParentResource extends Resource
{
    /**
     * A list of the child resources for this resource.
     *
     * @var array
     */
    protected $childResources = [];

    protected function hasChildResource(string $key): bool
    {
        return array_key_exists($key, $this->childResources);
    }

    /**
     * Returns an instance of the given child resource with the given key.
     */
    protected function getChildResource(string $key): ChildResource
    {
        $resource = $this->childResources[$key];

        return new $resource($this->client);
    }

    /**
     * Dynamically returns an instance of a requested child resource.
     *
     * @throws RuntimeException
     */
    public function __call(string $method, array $params)
    {
        if (! $this->hasChildResource($method)) {
            throw new RuntimeException("Child resource {$method} does not exist.");
        }

        return tap($this->getChildResource($method))->setParentId(array_pop($params));
    }
}
