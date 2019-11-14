<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\Metafield;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class MetafieldResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Metafield::class;

    /** @var array */
    protected $parentResources = [
        [ProductResource::class, 632910392],
    ];

    /** @var string */
    protected $resourceClass = MetafieldResource::class;

    /** @var string */
    protected $dataPath = 'misc/metafield';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'products/632910392/metafields.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(721389482);

        $this->assertRequest('GET', 'products/632910392/metafields/721389482.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('metafield');
        $this->assertRequest('POST', 'products/632910392/metafields.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            721389482,
            $this->request('update')
        );

        $this->assertPostKey('metafield');
        $this->assertRequest('PUT', 'products/632910392/metafields/721389482.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(721389482);

        $this->assertRequest('DELETE', 'products/632910392/metafields/721389482.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'products/632910392/metafields/count.json');
        $this->assertSame(1, $response);
    }
}
