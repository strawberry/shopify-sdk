<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Rest\Resource;

trait HasParent
{
    /**
     * Set the resource's parent ID.
     */
    public function setParentId(int $id): void
    {
        $this->parentId = $id;
    }

    /**
     * Fluently set the resource's parent ID.
     *
     * @return $this
     */
    public function parent(int $id)
    {
        $this->setParentId($id);

        return $this;
    }

    /**
     * Return an instance of the parent class.
     */
    protected function getParentInstance(): Resource
    {
        $parent = $this->parent;

        return new $parent($this->client);
    }

    /**
     * Build the URI for a request to the Shopify resource.
     */
    protected function uri(string $uri = ''): string
    {
        $uri = parent::uri($uri);

        return $this->getParentInstance()->uri('/' . $uri);
    }
}
