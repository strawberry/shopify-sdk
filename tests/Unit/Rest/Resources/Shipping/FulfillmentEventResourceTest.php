<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentEvent;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentEventResource;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class FulfillmentEventResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = FulfillmentEvent::class;

    /** @var array */
    protected $parentResources = [
        [OrderResource::class, 450789469],
        [FulfillmentResource::class, 255858046],
    ];

    /** @var string */
    protected $resourceClass = FulfillmentEventResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment_event';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders/450789469/fulfillments/255858046/events.json');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(944956392);

        $this->assertRequest('GET', 'orders/450789469/fulfillments/255858046/events/944956392.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->response('create')
        );

        $this->assertRequest('POST', 'orders/450789469/fulfillments/255858046/events.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(944956394);

        $this->assertRequest('DELETE', 'orders/450789469/fulfillments/255858046/events/944956394.json');
        $this->assertNull($response);
    }
}
