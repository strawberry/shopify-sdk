<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductVariantResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class ProductVariantResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Variant::class;

    /** @var array */
    protected $parentResources = [
        [ProductResource::class, 632910392],
    ];

    /** @var string */
    protected $resourceClass = ProductVariantResource::class;

    /** @var string */
    protected $dataPath = 'products/variant';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('metafields', MetafieldResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'products/632910392/variants.json');
        $this->assertCollection($response, 4);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('variant');
        $this->assertRequest('POST', 'products/632910392/variants.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(808950810);

        $this->assertRequest('DELETE', 'products/632910392/variants/808950810.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'products/632910392/variants/count.json');
        $this->assertSame(4, $response);
    }
}
