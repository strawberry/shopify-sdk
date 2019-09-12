<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Rest\Contracts\HasParent;

trait HasChildren
{
    /**
     * Determine whether the resource has a child with the given key.
     */
    public function hasChild(string $key): bool
    {
        return array_key_exists($key, $this->children);
    }

    /**
     * Return an instance of the child resource with the given key.
     *
     * @throws ClientException
     */
    public function getChild(string $key): HasParent
    {
        if (! $this->hasChild($key)) {
            throw ClientException::childDoesntExist(get_class($this), $key);
        }

        $resource = $this->children[$key];

        return new $resource($this->client);
    }

    /**
     * Dynamically returns an instnace of the requested child resource and sets
     * the resource's parent ID.
     */
    public function __call(string $method, array $params): HasParent
    {
        return $this->getChild($method)->parent($params[0]);
    }
}
