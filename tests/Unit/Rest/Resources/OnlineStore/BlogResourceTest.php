<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Blog;
use Strawberry\Shopify\Rest\Resources\OnlineStore\BlogResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BlogResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Blog::class;

    /** @var string */
    protected $resourceClass = BlogResource::class;

    /** @var string */
    protected $dataPath = 'online_store/blog';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'blogs.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(998730532);

        $this->assertRequest('GET', 'blogs/998730532.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'blogs.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            998730532,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'blogs/998730532.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(998730532);

        $this->assertRequest('DELETE', 'blogs/998730532.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'blogs/count.json');
        $this->assertSame(2, $response);
    }
}
