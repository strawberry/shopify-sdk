<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\ProductListing;
use Strawberry\Shopify\Rest\Resources\Sales\ProductListingResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ProductListingResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ProductListing::class;

    /** @var string */
    protected $resourceClass = ProductListingResource::class;

    /** @var string */
    protected $dataPath = 'sales/product_listing';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'product_listings.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(921728736);

        $this->assertRequest('GET', 'product_listings/921728736.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            921728736,
            $this->request('create')
        );

        $this->assertPostKey('product_listing');
        $this->assertRequest('PUT', 'product_listings/921728736.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(921728736);

        $this->assertRequest('DELETE', 'product_listings/921728736.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'product_listings/count.json');
        $this->assertSame(2, $response);
    }

    public function testProductIds(): void
    {
        $this->queue(200, [], $this->response('product_ids'));

        $response = $this->resource->productIds();

        $this->assertRequest('GET', 'product_listings/product_ids.json');
        $this->assertSame([
            921728736,
            632910392,
        ], $response);
    }
}
