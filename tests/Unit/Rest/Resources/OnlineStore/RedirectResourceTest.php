<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Redirect;
use Strawberry\Shopify\Rest\Resources\OnlineStore\RedirectResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class RedirectResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Redirect::class;

    /** @var string */
    protected $resourceClass = RedirectResource::class;

    /** @var string */
    protected $dataPath = 'online_store/redirect';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'redirects.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(668809255);

        $this->assertRequest('GET', 'redirects/668809255.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'redirects.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            668809255,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'redirects/668809255.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(668809255);

        $this->assertRequest('DELETE', 'redirects/668809255.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'redirects/count.json');
        $this->assertSame(3, $response);
    }
}
