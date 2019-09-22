<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use BadMethodCallException;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Rest\Client;
use Strawberry\Shopify\Rest\ResourceProxy;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;
use Strawberry\Shopify\Tests\TestCase;

final class ClientTest extends TestCase
{
    /** @var Client */
    private $client;

    public function setUpTestCase(): void
    {
        $this->client = new Client(new GuzzleClient());
    }

    public function testReturnsResource(): void
    {
        $resource = $this->client->countries();

        $this->assertInstanceOf(CountryResource::class, $resource);
    }

    public function testThrowsExceptionForUndefinedResource(): void
    {
        $this->expectException(BadMethodCallException::class);

        $this->client->undefinedResource();
    }

    public function testReturnsProxyForResourceWithChildren(): void
    {
        $proxy = $this->client->country(123456789);

        $this->assertInstanceOf(ResourceProxy::class, $proxy);
    }
}
