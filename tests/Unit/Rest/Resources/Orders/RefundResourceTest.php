<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Refund;
use Strawberry\Shopify\Rest\Resources\Orders\RefundResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class RefundResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Refund::class;

    /** @var string */
    protected $resourceClass = RefundResource::class;

    /** @var string */
    protected $dataPath = 'orders/refund';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'orders/123456789/refunds.json');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(509562969);

        $this->assertRequest('GET', 'orders/123456789/refunds/509562969.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/123456789/refunds.json');
        $this->assertModel($response);
    }

    public function testCalculate(): void
    {
        $this->queue(201, [], $this->response('calculate'));

        $response = $this->resource->withParent(123456789)->calculate(
            $this->request('calculate')
        );

        $this->assertRequest('POST', 'orders/123456789/refunds/calculate.json');
        $this->assertModel($response);
    }
}
