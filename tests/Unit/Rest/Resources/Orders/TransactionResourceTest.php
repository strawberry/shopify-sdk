<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Transaction;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Rest\Resources\Orders\TransactionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class TransactionResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Transaction::class;

    /** @var array */
    protected $parentResources = [
        [OrderResource::class, 450789469],
    ];

    /** @var string */
    protected $resourceClass = TransactionResource::class;

    /** @var string */
    protected $dataPath = 'orders/transaction';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'orders/450789469/transactions.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(284138680);

        $this->assertRequest('GET', 'orders/450789469/transactions/284138680.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/450789469/transactions.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'orders/450789469/transactions/count.json');
        $this->assertSame(3, $response);
    }
}
