<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Rest\Resources\Store\ShopResource;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Tests\TestCase;

final class ShopResourceTest extends TestCase
{
    use MocksRequests;

    /** @var MockHandler */
    private $mockHandler;

    /** @var ShopResource */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->resource = new ShopResource($client);
    }

    public function testGet(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->response('shop/get'))
        );

        $response = $this->resource->get();

        $this->assertInstanceOf(Shop::class, $response);
        $this->assertSame(690933842, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('shop.json', (string) $request->getUri());
    }

    public function testGetWithOptions(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->response('shop/get'))
        );

        $this->resource->get(['fields' => 'id']);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame(
            'shop.json?fields=id',
            (string) $request->getUri()
        );
    }
}