<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Resource;

final class ChildResourceTest extends TestCase
{
    /** @test */
    public function it_fluently_sets_the_parent_id(): void
    {
        $resource = $this->childResource();

        $this->assertSame($resource, $resource->withParent(123456789));
        $this->assertSame(123456789, $resource->getParentId());
    }

    /** @test */
    public function it_builds_uri_correctly(): void
    {
        $resource = $this->childResource()->withParent(123456789);

        $this->assertSame('parent/123456789/child.json', $resource->buildUri());
        $this->assertSame('parent/123456789/child/one-level.json', $resource->buildUri('one-level'));
        $this->assertSame('parent/123456789/child/multiple/levels.json', $resource->buildUri('multiple/levels'));
    }

    private function childResource(): ChildResource
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        return new ChildResourceTestChildResourceStub($client);
    }
}

final class ChildResourceTestChildResourceStub extends ChildResource
{
    protected $parent = ChildResourceTestResourceStub::class;

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function buildUri(string $uri = ''): string
    {
        return $this->uri($uri);
    }

    public function pluralResourceKey(): string
    {
        return 'child';
    }
}


final class ChildResourceTestResourceStub extends Resource
{
    public function pluralResourceKey(): string
    {
        return 'parent';
    }
}
