<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Page;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\OnlineStore\PageResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PageResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Page::class;

    /** @var string */
    protected $resourceClass = PageResource::class;

    /** @var string */
    protected $dataPath = 'online_store/page';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('metafields', MetafieldResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'pages.json');
        $this->assertCollection($response, 4);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(131092082);

        $this->assertRequest('GET', 'pages/131092082.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('page');
        $this->assertRequest('POST', 'pages.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            131092082,
            $this->request('update')
        );

        $this->assertPostKey('page');
        $this->assertRequest('PUT', 'pages/131092082.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(131092082);

        $this->assertRequest('DELETE', 'pages/131092082.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'pages/count.json');
        $this->assertSame(4, $response);
    }
}
