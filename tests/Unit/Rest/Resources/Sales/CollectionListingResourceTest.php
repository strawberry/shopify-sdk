<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\CollectionListing;
use Strawberry\Shopify\Rest\Resources\Sales\CollectionListingResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CollectionListingResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CollectionListing::class;

    /** @var string */
    protected $resourceClass = CollectionListingResource::class;

    /** @var string */
    protected $dataPath = 'sales/collection_listing';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'collection_listings.json');
        $this->assertCollection($response, 4);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(841564295);

        $this->assertRequest('GET', 'collection_listings/841564295.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            841564295,
            $this->request('create')
        );

        $this->assertRequest('PUT', 'collection_listings/841564295.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(841564295);

        $this->assertRequest('DELETE', 'collection_listings/841564295.json');
        $this->assertNull($response);
    }

    public function testProductIds(): void
    {
        $this->queue(200, [], $this->response('product_ids'));

        $response = $this->resource->productIds(841564295);

        $this->assertRequest('GET', 'collection_listings/841564295/product_ids.json');
        $this->assertSame([632910392], $response);
    }
}
