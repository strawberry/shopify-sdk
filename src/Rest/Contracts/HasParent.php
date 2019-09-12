<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Contracts;

interface HasParent
{
    /**
     * Set the resource's parent ID.
     */
    public function setParentId(int $id): void;

    /**
     * Fluently set the resource's parent ID.
     *
     * @return $this
     */
    public function parent(int $id);
}
