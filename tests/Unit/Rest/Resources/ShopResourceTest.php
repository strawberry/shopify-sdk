<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Resources\Store\ShopResource;

final class ShopResourceTest extends TestCase
{
    /** @test */
    public function it_gets_shop_data(): void
    {
        $resource = new ShopResource($this->client(new MockHandler([
            new Response(200, [], $this->data('data/responses/shop/get.json'))
        ])));

        $shop = $resource->get();

        $this->assertInstanceOf(Shop::class, $shop);
        $this->assertSame(1234567890, $shop->id);
    }

    /** @test */
    public function it_gets_shop_data_and_only_returns_specified_fields(): void
    {
        $resource = new ShopResource($this->client(new MockHandler([
            new Response(200, [], $this->data('data/responses/shop/get_limited_fields.json'))
        ])));

        $shop = $resource->get(['id', 'name']);

        $this->assertInstanceOf(Shop::class, $shop);
        $this->assertSame(1234567890, $shop->id);
        $this->assertSame('Strawberry', $shop->name);
        $this->assertNull($shop->domain);
    }

    private function client(MockHandler $handler): Client
    {
        $guzzleClient = new GuzzleClient([
            'handler' => $handler
        ]);

        return new Client($guzzleClient);
    }

    private function data(string $file): string
    {
        return file_get_contents($this->base . $file);
    }
}
