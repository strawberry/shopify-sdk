<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Concerns;

use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Concerns\HasParent;
use Strawberry\Shopify\Rest\Contracts\HasChildren;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;

final class HasParentTest extends TestCase
{
    /** @test */
    public function it_sets_the_parent_id(): void
    {
        $hasParent = new HasParentStub;
        $hasParent->setParentId(12345);

        $this->assertSame(12345, $hasParent->getParentId());
    }

    /** @test */
    public function it_fluently_sets_the_parent_id(): void
    {
        $hasParent = new HasParentStub;

        $this->assertSame($hasParent, $hasParent->parent(12345));
        $this->assertSame(12345, $hasParent->getParentId());
    }
}

class HasParentStub
{
    use HasParent;

    private $parentId;

    public function __construct()
    {
        $guzzle = Mockery::mock(GuzzleClient::class);
        $this->client = new Client($guzzle);
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }
}
