<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use Strawberry\Shopify\Http\Client;

abstract class ChildResource extends Resource
{
    /**
     * The ID of the parent resource.
     *
     * @var int|string
     */
    protected $parentId;

    /**
     * The parent instance.
     *
     * @var Resource
     */
    protected $parent;

    /**
     * @param  int|string  $parentId
     */
    public function __construct(Client $client, Resource $parent, $parentId)
    {
        parent::__construct($client);

        $this->parent = $parent;
        $this->parentId = $parentId;
    }

    /**
     * Build the URI for a request to the Shopify resource.
     */
    protected function uri(string $uri = ''): string
    {
        $uri = substr(parent::uri($uri), 0, -5);

        return $this->parent->uri("/{$this->parentId}/{$uri}");
    }
}
