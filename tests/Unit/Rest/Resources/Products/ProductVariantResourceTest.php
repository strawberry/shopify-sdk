<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\Resources\Products\ProductVariantResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ProductVariantResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Variant::class;

    /** @var string */
    protected $resourceClass = ProductVariantResource::class;

    /** @var string */
    protected $dataPath = 'products/variant';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'products/123456789/variants.json');
        $this->assertCollection($response, 4);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'products/123456789/variants.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(808950810);

        $this->assertRequest('DELETE', 'products/123456789/variants/808950810.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent(123456789)->count();

        $this->assertRequest('GET', 'products/123456789/variants/count.json');
        $this->assertSame(4, $response);
    }
}
