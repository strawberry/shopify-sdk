<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\ScriptTag;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ScriptTagResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ScriptTagResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ScriptTag::class;

    /** @var string */
    protected $resourceClass = ScriptTagResource::class;

    /** @var string */
    protected $dataPath = 'online_store/script_tag';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'script_tags.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(596726825);

        $this->assertRequest('GET', 'script_tags/596726825.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('script_tag');
        $this->assertRequest('POST', 'script_tags.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            596726825,
            $this->request('update')
        );

        $this->assertPostKey('script_tag');
        $this->assertRequest('PUT', 'script_tags/596726825.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(596726825);

        $this->assertRequest('DELETE', 'script_tags/596726825.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'script_tags/count.json');
        $this->assertSame(2, $response);
    }
}
