<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use Mockery\MockInterface;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\ResourceProxy;

final class ResourceProxyTest extends TestCase
{
    /** @var Resource|MockInterface */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->resource = $this->mock(Resource::class);
        $this->childResource = $this->mock(ChildResource::class);
    }

    public function testCallIsForwardedToChild(): void
    {
        $proxy = new ResourceProxy($this->resource, 123456789);

        $this->resource->shouldReceive('getChild')
            ->with('childResource', 123456789)
            ->andReturn($this->childResource);

        $proxy->childResource();
    }
}
