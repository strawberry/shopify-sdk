<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\OrderRisk;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Rest\Resources\Orders\OrderRiskResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class OrderRiskResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = OrderRisk::class;

    /** @var array */
    protected $parentResources = [
        [OrderResource::class, 450789469],
    ];

    /** @var string */
    protected $resourceClass = OrderRiskResource::class;

    /** @var string */
    protected $dataPath = 'orders/order_risk';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders/450789469/risks.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(284138680);

        $this->assertRequest('GET', 'orders/450789469/risks/284138680.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/450789469/risks.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            284138680,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'orders/450789469/risks/284138680.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(284138680);

        $this->assertRequest('DELETE', 'orders/450789469/risks/284138680.json');
        $this->assertNull($response);
    }
}
