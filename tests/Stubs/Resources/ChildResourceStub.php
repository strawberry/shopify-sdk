<?php

namespace Strawberry\Shopify\Tests\Stubs\Resources;

use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns\CreatesResource;
use Strawberry\Shopify\Tests\Stubs\Models\ModelStub;

final class ChildResourceStub extends ChildResource
{
    use CreatesResource;

    /** @var string */
    protected $model = ModelStub::class;

    /** @var string */
    protected $parent = ResourceStub::class;

    public function getParentId(): int
    {
        return $this->parentId;
    }
}
