<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Product;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\Products\ImageResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductVariantResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ProductResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Product::class;

    /** @var string */
    protected $resourceClass = ProductResource::class;

    /** @var string */
    protected $dataPath = 'products/product';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('images', ImageResource::class);
        $this->assertChild('metafields', MetafieldResource::class);
        $this->assertChild('variants', ProductVariantResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'products.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(632910392);

        $this->assertRequest('GET', 'products/632910392.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('product');
        $this->assertRequest('POST', 'products.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            632910392,
            $this->request('update')
        );

        $this->assertPostKey('product');
        $this->assertRequest('PUT', 'products/632910392.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(632910392);

        $this->assertRequest('DELETE', 'products/632910392.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'products/count.json');
        $this->assertSame(2, $response);
    }
}
