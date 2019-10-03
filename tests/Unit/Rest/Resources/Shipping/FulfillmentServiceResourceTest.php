<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentService;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentServiceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class FulfillmentServiceResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = FulfillmentService::class;

    /** @var string */
    protected $resourceClass = FulfillmentServiceResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment_service';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'fulfillment_services.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(755357713);

        $this->assertRequest('GET', 'fulfillment_services/755357713.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('fulfillment_service');
        $this->assertRequest('POST', 'fulfillment_services.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            755357713,
            $this->request('update')
        );

        $this->assertPostKey('fulfillment_service');
        $this->assertRequest('PUT', 'fulfillment_services/755357713.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(755357713);

        $this->assertRequest('DELETE', 'fulfillment_services/755357713.json');
        $this->assertNull($response);
    }
}
