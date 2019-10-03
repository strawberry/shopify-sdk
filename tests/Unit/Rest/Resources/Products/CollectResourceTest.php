<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Collect;
use Strawberry\Shopify\Rest\Resources\Products\CollectResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CollectResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Collect::class;

    /** @var string */
    protected $resourceClass = CollectResource::class;

    /** @var string */
    protected $dataPath = 'products/collect';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'collects.json');
        $this->assertCollection($response, 4);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(841564295);

        $this->assertRequest('GET', 'collects/841564295.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('collect');
        $this->assertRequest('POST', 'collects.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(841564295);

        $this->assertRequest('DELETE', 'collects/841564295.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'collects/count.json');
        $this->assertSame(4, $response);
    }
}
