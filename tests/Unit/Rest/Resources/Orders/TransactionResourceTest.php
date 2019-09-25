<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Transaction;
use Strawberry\Shopify\Rest\Resources\Orders\TransactionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class TransactionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Transaction::class;

    /** @var string */
    protected $resourceClass = TransactionResource::class;

    /** @var string */
    protected $dataPath = 'orders/transaction';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'orders/123456789/transactions.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(284138680);

        $this->assertRequest('GET', 'orders/123456789/transactions/284138680.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'orders/123456789/transactions.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent(123456789)->count();

        $this->assertRequest('GET', 'orders/123456789/transactions/count.json');
        $this->assertSame(3, $response);
    }
}
