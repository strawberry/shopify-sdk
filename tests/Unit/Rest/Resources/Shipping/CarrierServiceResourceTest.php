<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\CarrierService;
use Strawberry\Shopify\Rest\Resources\Shipping\CarrierServiceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CarrierServiceResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CarrierService::class;

    /** @var string */
    protected $resourceClass = CarrierServiceResource::class;

    /** @var string */
    protected $dataPath = 'shipping/carrier_service';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'carrier_services.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(1036894963);

        $this->assertRequest('GET', 'carrier_services/1036894963.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('carrier_service');
        $this->assertRequest('POST', 'carrier_services.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            1036894963,
            $this->request('update')
        );

        $this->assertPostKey('carrier_service');
        $this->assertRequest('PUT', 'carrier_services/1036894963.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(1036894963);

        $this->assertRequest('DELETE', 'carrier_services/1036894963.json');
        $this->assertNull($response);
    }
}
