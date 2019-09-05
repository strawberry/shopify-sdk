<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use BadMethodCallException;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Rest\Client;
use Strawberry\Shopify\Rest\Resources\ShopResource;
use Strawberry\Shopify\Tests\TestCase;

final class ClientTest extends TestCase
{
    /** @test */
    public function it_throws_exception_for_nonexistent_resources(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $this->expectException(BadMethodCallException::class);

        $client->nonexistentResource();
    }

    /** @test */
    public function it_returns_resource_instances(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $resource = $client->shop();

        $this->assertInstanceOf(ShopResource::class, $resource);
    }
}
