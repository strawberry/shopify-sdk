<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\ResourceProxy;
use Strawberry\Shopify\Tests\TestCase;

final class ResourceProxyTest extends TestCase
{
    /** @test */
    public function it_forwards_call_onto_child_resource(): void
    {
        $resource = $this->mock(Resource::class);
        $child = $this->mock(ChildResource::class);
        $proxy = new ResourceProxy($resource, 123456789);

        $resource->shouldReceive('getChild')
            ->with('child')
            ->andReturn($child);

        $child->shouldReceive('parent')
            ->with(123456789)
            ->andReturn($child);

        $proxy->child();
    }
}
