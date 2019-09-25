<?php

namespace Strawberry\Shopify\Tests\Stubs\Resources;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\Stubs\Models\ModelStub;

final class ResourceStub extends Resource
{
    use Concerns\CountsResource,
        Concerns\CreatesResource,
        Concerns\DeletesResource,
        Concerns\FindsResource,
        Concerns\ListsResource,
        Concerns\UpdatesResource;

    /** @var string */
    protected $model = ModelStub::class;
}
