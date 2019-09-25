<?php

namespace Strawberry\Shopify\Tests\Stubs\Resources;

use Strawberry\Shopify\Rest\Resource;

final class ResourceWithChildrenStub extends Resource
{
    /** @var string[] */
    protected $childResources = [
        'child' => ChildResourceStub::class,
    ];
}
