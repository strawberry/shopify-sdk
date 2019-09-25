<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class OrderResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Order::class;

    /** @var string */
    protected $resourceClass = OrderResource::class;

    /** @var string */
    protected $dataPath = 'orders/order';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(450789469);

        $this->assertRequest('GET', 'orders/450789469.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            450789469,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'orders/450789469.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(450789469);

        $this->assertRequest('DELETE', 'orders/450789469.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'orders/count.json');
        $this->assertSame(1, $response);
    }

    public function testClose(): void
    {
        $this->queue(200, [], $this->response('close'));

        $response = $this->resource->close(450789469);

        $this->assertRequest('POST', 'orders/450789469/close.json');
        $this->assertModel($response);
    }

    public function testOpen(): void
    {
        $this->queue(200, [], $this->response('open'));

        $response = $this->resource->open(450789469);

        $this->assertRequest('POST', 'orders/450789469/open.json');
        $this->assertModel($response);
    }

    public function testCancel(): void
    {
        $this->queue(200, [], $this->response('cancel'));

        $response = $this->resource->cancel(
            450789469,
            $this->request('cancel')
        );

        $this->assertRequest('POST', 'orders/450789469/cancel.json');
        $this->assertModel($response);
    }
}
