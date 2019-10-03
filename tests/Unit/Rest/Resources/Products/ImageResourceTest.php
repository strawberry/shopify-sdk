<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Image;
use Strawberry\Shopify\Rest\Resources\Products\ImageResource;
use Strawberry\Shopify\Rest\Resources\Products\ProductResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class ImageResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Image::class;

    /** @var array */
    protected $parentResources = [
        [ProductResource::class, 632910392],
    ];

    /** @var string */
    protected $resourceClass = ImageResource::class;

    /** @var string */
    protected $dataPath = 'products/image';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'products/632910392/images.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(632910392);

        $this->assertRequest('GET', 'products/632910392/images/632910392.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('image');
        $this->assertRequest('POST', 'products/632910392/images.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            632910392,
            $this->request('update')
        );

        $this->assertPostKey('image');
        $this->assertRequest('PUT', 'products/632910392/images/632910392.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(632910392);

        $this->assertRequest('DELETE', 'products/632910392/images/632910392.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'products/632910392/images/count.json');
        $this->assertSame(2, $response);
    }
}
