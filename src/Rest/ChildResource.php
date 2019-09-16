<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

abstract class ChildResource extends Resource
{
    /**
     * The ID of the parent resource.
     *
     * @var int|string
     */
    protected $parentId;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent;

    /**
     * Set the resource's parent ID.
     *
     * @param  int|string  $id
     */
    public function setParentId($id): void
    {
        $this->parentId = $id;
    }

    /**
     * Fluently set the resource's parent ID.
     *
     * @param  int|string  $id
     *
     * @return $this
     */
    public function parent($id)
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
        $uri = substr(parent::uri($uri), 0, -5);

        return $this->getParentInstance()->uri("/{$this->parentId}/{$uri}");
    }
}
