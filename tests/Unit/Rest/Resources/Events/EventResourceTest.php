<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Events;

use Strawberry\Shopify\Models\Events\Event;
use Strawberry\Shopify\Rest\Resources\Events\EventResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class EventResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Event::class;

    /** @var string */
    protected $resourceClass = EventResource::class;

    /** @var string */
    protected $dataPath = 'events/event';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'events.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(677313116);

        $this->assertRequest('GET', 'events/677313116.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'events/count.json');
        $this->assertSame(1, $response);
    }
}
