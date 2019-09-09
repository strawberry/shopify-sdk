<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources;

abstract class ChildResource extends Resource
{
    /**
     * The ID for the parent resource.
     *
     * @var int
     */
    protected $parentId;

    /**
     * The FQCN for the parent resource class.
     *
     * @var string
     */
    protected $parentResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model;

    /** @return $this */
    public function parent(int $id): self
    {
        $this->parentId = $id;

        return $this;
    }

    /**
     * Build the URI for a request to the Shopify resource.
     */
    protected function uri(string $uri = ''): string
    {
        $resource = (new $this->parentResource);

        return $resource->uri("/{$this->parentId}/" . parent::uri($uri));
    }
}
