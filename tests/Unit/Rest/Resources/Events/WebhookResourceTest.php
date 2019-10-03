<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Events;

use Strawberry\Shopify\Models\Events\Webhook;
use Strawberry\Shopify\Rest\Resources\Events\WebhookResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class WebhookResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Webhook::class;

    /** @var string */
    protected $resourceClass = WebhookResource::class;

    /** @var string */
    protected $dataPath = 'events/webhook';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'webhooks.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(677313116);

        $this->assertRequest('GET', 'webhooks/677313116.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'webhooks/count.json');
        $this->assertSame(2, $response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('webhook');
        $this->assertRequest('POST', 'webhooks.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            4759306,
            $this->request('update')
        );

        $this->assertPostKey('webhook');
        $this->assertRequest('PUT', 'webhooks/4759306.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(4759306);

        $this->assertRequest('DELETE', 'webhooks/4759306.json');
        $this->assertNull($response);
    }
}
