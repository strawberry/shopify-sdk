<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\CustomCollection;
use Strawberry\Shopify\Rest\Resources\Products\CustomCollectionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CustomCollectionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CustomCollection::class;

    /** @var string */
    protected $resourceClass = CustomCollectionResource::class;

    /** @var string */
    protected $dataPath = 'products/custom_collection';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'custom_collections.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(841564295);

        $this->assertRequest('GET', 'custom_collections/841564295.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('custom_collection');
        $this->assertRequest('POST', 'custom_collections.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            841564295,
            $this->request('update')
        );

        $this->assertPostKey('custom_collection');
        $this->assertRequest('PUT', 'custom_collections/841564295.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(841564295);

        $this->assertRequest('DELETE', 'custom_collections/841564295.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'custom_collections/count.json');
        $this->assertSame(3, $response);
    }
}
