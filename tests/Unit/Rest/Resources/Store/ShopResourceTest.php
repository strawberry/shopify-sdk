<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Rest\Resources\Store\ShopResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ShopResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Shop::class;

    /** @var string */
    protected $resourceClass = ShopResource::class;

    /** @var string */
    protected $dataPath = 'store/shop';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'shop.json');
        $this->assertModel($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get(['fields' => 'id']);

        $this->assertRequest('GET', 'shop.json?fields=id');
        $this->assertModel($response);
    }
}
