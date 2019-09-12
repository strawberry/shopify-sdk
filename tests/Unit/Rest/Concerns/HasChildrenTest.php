<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Concerns;

use Mockery;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Contracts\HasParent;
use Strawberry\Shopify\Rest\Concerns\HasChildren;
use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Rest\Resources\Store\ProvinceResource;

final class HasChildrenTest extends TestCase
{
    /** @test */
    public function it_has_a_child_with_a_given_key(): void
    {
        $stub = new HasChildrenStub();

        $this->assertTrue($stub->hasChild('provinces'));
        $this->assertFalse($stub->hasChild('foo'));
    }

    /** @test */
    public function it_throws_exception_when_getting_instance_of_nonexistent_child(): void
    {
        $this->expectException(ClientException::class);

        $stub = new HasChildrenStub();

        $stub->getChild('foo');
    }

    /** @test */
    public function it_returns_an_instance_of_a_child(): void
    {
        $stub = new HasChildrenStub();

        $this->assertInstanceOf(ProvinceResource::class, $stub->getChild('provinces'));
    }

    /** @test */
    public function it_returns_child_from_function_call_with_parent_value_set(): void
    {
        $hasChildren = $this->mock(HasChildrenStub::class)->makePartial();
        $hasParent = $this->mock(HasParent::class);

        $hasChildren->shouldReceive('getChild')
            ->with('provinces')
            ->andReturn($hasParent);

        $hasParent->shouldReceive('parent')
            ->with(1)
            ->andReturn($hasParent);

        $resource = $hasChildren->provinces(1);

        $this->assertSame($hasParent, $resource);
    }
}

class HasChildrenStub
{
    use HasChildren;

    protected $children = [
        'provinces' => ProvinceResource::class,
    ];

    public function __construct()
    {
        $guzzle = Mockery::mock(GuzzleClient::class);
        $this->client = new Client($guzzle);
    }
}
