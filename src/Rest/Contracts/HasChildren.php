<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Contracts;

use Strawberry\Shopify\Rest\Contracts\HasParent;

interface HasChildren
{
    /**
     * Determine whether the resource has a child with the given key.
     */
    public function hasChild(string $key): bool;

    /**
     * Return an instance of the child resource with the given key.
     */
    public function getChild(string $key): HasParent;
}
