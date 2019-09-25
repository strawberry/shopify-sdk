<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\Payment;
use Strawberry\Shopify\Rest\Resources\Sales\PaymentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PaymentResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Payment::class;

    /** @var string */
    protected $resourceClass = PaymentResource::class;

    /** @var string */
    protected $dataPath = 'sales/payment';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent('7yjf4v2we7gamku6a6h7tvm8h3mmvs4x')->get();

        $this->assertRequest('GET', 'checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments.json');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent('7yjf4v2we7gamku6a6h7tvm8h3mmvs4x')->find(25428999);

        $this->assertRequest('GET', 'checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments/25428999.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent('7yjf4v2we7gamku6a6h7tvm8h3mmvs4x')->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent('7yjf4v2we7gamku6a6h7tvm8h3mmvs4x')->count();

        $this->assertRequest('GET', 'checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments/count.json');
        $this->assertSame(1, $response);
    }
}
