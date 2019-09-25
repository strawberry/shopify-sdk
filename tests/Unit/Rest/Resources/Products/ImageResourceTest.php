<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Image;
use Strawberry\Shopify\Rest\Resources\Products\ImageResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ImageResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Image::class;

    /** @var string */
    protected $resourceClass = ImageResource::class;

    /** @var string */
    protected $dataPath = 'products/image';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'products/123456789/images.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(632910392);

        $this->assertRequest('GET', 'products/123456789/images/632910392.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'products/123456789/images.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            632910392,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'products/123456789/images/632910392.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(632910392);

        $this->assertRequest('DELETE', 'products/123456789/images/632910392.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent(123456789)->count();

        $this->assertRequest('GET', 'products/123456789/images/count.json');
        $this->assertSame(2, $response);
    }
}
