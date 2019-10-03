<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Refund;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Rest\Resources\Orders\RefundResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class RefundResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Refund::class;

    /** @var array */
    protected $parentResources = [
        [OrderResource::class, 450789469],
    ];

    /** @var string */
    protected $resourceClass = RefundResource::class;

    /** @var string */
    protected $dataPath = 'orders/refund';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders/450789469/refunds.json');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(509562969);

        $this->assertRequest('GET', 'orders/450789469/refunds/509562969.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('refund');
        $this->assertRequest('POST', 'orders/450789469/refunds.json');
        $this->assertModel($response);
    }

    public function testCalculate(): void
    {
        $this->queue(201, [], $this->response('calculate'));

        $response = $this->resource->calculate(
            $this->request('calculate')
        );

        $this->assertPostKey('refund');
        $this->assertRequest('POST', 'orders/450789469/refunds/calculate.json');
        $this->assertModel($response);
    }
}
