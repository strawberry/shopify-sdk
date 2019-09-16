<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use Strawberry\Shopify\Exceptions\ClientException;

class ResourceProxy
{
    /**
     * The resource class to be proxied.
     *
     * @var Resource
     */
    private $resourceClass;

    /**
     * The ID of the parent resource.
     *
     * @var int|string
     */
    private $resourceId;

    public function __construct(Resource $resourceClass, $resourceId)
    {
        $this->resourceClass = $resourceClass;
        $this->resourceId = $resourceId;
    }

    /**
     * Forward the call onto the child resource.
     *
     * @throws ClientException
     */
    public function __call(string $method, array $params): ChildResource
    {
        return $this->resourceClass->getChild($method)->parent($this->resourceId);
    }
}
