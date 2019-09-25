<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\OrderRisk;
use Strawberry\Shopify\Rest\Resources\Orders\OrderRiskResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class OrderRiskResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = OrderRisk::class;

    /** @var string */
    protected $resourceClass = OrderRiskResource::class;

    /** @var string */
    protected $dataPath = 'orders/order_risk';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'orders/123456789/risks.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(284138680);

        $this->assertRequest('GET', 'orders/123456789/risks/284138680.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/123456789/risks.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            284138680,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'orders/123456789/risks/284138680.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(284138680);

        $this->assertRequest('DELETE', 'orders/123456789/risks/284138680.json');
        $this->assertNull($response);
    }
}
