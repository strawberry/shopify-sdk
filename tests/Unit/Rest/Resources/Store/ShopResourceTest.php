<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Rest\Resources\Store\ShopResource;
use Strawberry\Shopify\Tests\TestCase;

final class ShopResourceTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var ShopResource */
    private $shop;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->shop = new ShopResource($client);
    }

    public function testGet(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->data('data/responses/shop/get.json'))
        );

        $response = $this->shop->get();

        $this->assertInstanceOf(Shop::class, $response);
        $this->assertSame(1234567890, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('shop.json', (string) $request->getUri());
    }

    public function testGetWithOptions(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->Data('data/responses/shop/get.json'))
        );

        $this->shop->get(['fields' => 'id']);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame(
            'shop.json?fields=id',
            (string) $request->getUri()
        );
    }
}
