<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\SmartCollection;
use Strawberry\Shopify\Rest\Resources\Products\SmartCollectionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class SmartCollectionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = SmartCollection::class;

    /** @var string */
    protected $resourceClass = SmartCollectionResource::class;

    /** @var string */
    protected $dataPath = 'products/smart_collection';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'smart_collections.json');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(482865238);

        $this->assertRequest('GET', 'smart_collections/482865238.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('smart_collection');
        $this->assertRequest('POST', 'smart_collections.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            482865238,
            $this->request('update')
        );

        $this->assertPostKey('smart_collection');
        $this->assertRequest('PUT', 'smart_collections/482865238.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(482865238);

        $this->assertRequest('DELETE', 'smart_collections/482865238.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'smart_collections/count.json');
        $this->assertSame(1, $response);
    }

    public function testOrder(): void
    {
        $this->queue(200);

        $response = $this->resource->order(482865238, [921728736, 632910392]);

        $this->assertRequest('PUT', 'smart_collections/482865238/order.json?products[0]=921728736&products[1]=632910392');
        $this->assertNull($response);
    }

    public function testOrderUpdateSortOrder(): void
    {
        $this->queue(200);

        $response = $this->resource->order(482865238, [], 'alpha-desc');

        $this->assertRequest('PUT', 'smart_collections/482865238/order.json?sort_order=alpha-desc');
        $this->assertNull($response);
    }

    public function testOrderManuallyOrderProductsAndUpdateSortOrder(): void
    {
        $this->queue(200);

        $response = $this->resource->order(
            482865238,
            [921728736, 632910392],
            'alpha-desc'
        );

        $this->assertRequest('PUT', 'smart_collections/482865238/order.json?products[0]=921728736&products[1]=632910392&sort_order=alpha-desc');
        $this->assertNull($response);
    }
}
