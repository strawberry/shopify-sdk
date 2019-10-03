<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Misc;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Misc\Engagement;
use Strawberry\Shopify\Models\Misc\MarketingEvent;
use Strawberry\Shopify\Rest\Resources\Misc\MarketingEventResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class MarketingEventResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = MarketingEvent::class;

    /** @var string */
    protected $resourceClass = MarketingEventResource::class;

    /** @var string */
    protected $dataPath = 'misc/marketing_event';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'marketing_events.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(998730532);

        $this->assertRequest('GET', 'marketing_events/998730532.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('marketing_event');
        $this->assertRequest('POST', 'marketing_events.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            998730532,
            $this->request('update')
        );

        $this->assertPostKey('marketing_event');
        $this->assertRequest('PUT', 'marketing_events/998730532.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(998730532);

        $this->assertRequest('DELETE', 'marketing_events/998730532.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'marketing_events/count.json');
        $this->assertSame(1, $response);
    }

    public function testEngagements(): void
    {
        $this->queue(200, [], $this->response('engagements'));

        $response = $this->resource->engagements(
            998730532,
            $this->request('engagements')
        );

        $this->assertPostKey('engagements');
        $this->assertRequest('POST', 'marketing_events/998730532/engagements.json');
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertContainsOnlyInstancesOf(Engagement::class, $response);
    }
}
