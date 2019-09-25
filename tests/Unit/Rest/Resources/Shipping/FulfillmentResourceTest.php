<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\Fulfillment;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class FulfillmentResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Fulfillment::class;

    /** @var string */
    protected $resourceClass = FulfillmentResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'orders/123456789/fulfillments.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(450789469);

        $this->assertRequest('GET', 'orders/123456789/fulfillments/450789469.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/123456789/fulfillments.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            450789469,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'orders/123456789/fulfillments/450789469.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent(123456789)->count();

        $this->assertRequest('GET', 'orders/123456789/fulfillments/count.json');
        $this->assertSame(1, $response);
    }

    public function testComplete(): void
    {
        $this->queue(201, [], $this->response('complete'));

        $response = $this->resource->withParent(123456789)->complete(255858046);

        $this->assertRequest('POST', 'orders/123456789/fulfillments/255858046/complete.json');
        $this->assertModel($response);
    }

    public function testOpen(): void
    {
        $this->queue(201, [], $this->response('open'));

        $response = $this->resource->withParent(123456789)->open(255858046);

        $this->assertRequest('POST', 'orders/123456789/fulfillments/255858046/open.json');
        $this->assertModel($response);
    }

    public function testCancel(): void
    {
        $this->queue(201, [], $this->response('cancel'));

        $response = $this->resource->withParent(123456789)->cancel(255858046);

        $this->assertRequest('POST', 'orders/123456789/fulfillments/255858046/cancel.json');
        $this->assertModel($response);
    }
}
