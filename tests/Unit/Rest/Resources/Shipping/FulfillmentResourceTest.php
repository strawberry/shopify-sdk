<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\Fulfillment;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentEventResource;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class FulfillmentResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Fulfillment::class;

    /** @var array */
    protected $parentResources = [
        [OrderResource::class, 450789469],
    ];

    /** @var string */
    protected $resourceClass = FulfillmentResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('events', FulfillmentEventResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders/450789469/fulfillments.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(450789469);

        $this->assertRequest('GET', 'orders/450789469/fulfillments/450789469.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('fulfillment');
        $this->assertRequest('POST', 'orders/450789469/fulfillments.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            450789469,
            $this->request('update')
        );

        $this->assertPostKey('fulfillment');
        $this->assertRequest('PUT', 'orders/450789469/fulfillments/450789469.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'orders/450789469/fulfillments/count.json');
        $this->assertSame(1, $response);
    }

    public function testComplete(): void
    {
        $this->queue(201, [], $this->response('complete'));

        $response = $this->resource->complete(255858046);

        $this->assertRequest('POST', 'orders/450789469/fulfillments/255858046/complete.json');
        $this->assertModel($response);
    }

    public function testOpen(): void
    {
        $this->queue(201, [], $this->response('open'));

        $response = $this->resource->open(255858046);

        $this->assertRequest('POST', 'orders/450789469/fulfillments/255858046/open.json');
        $this->assertModel($response);
    }

    public function testCancel(): void
    {
        $this->queue(201, [], $this->response('cancel'));

        $response = $this->resource->cancel(255858046);

        $this->assertRequest('POST', 'orders/450789469/fulfillments/255858046/cancel.json');
        $this->assertModel($response);
    }
}
