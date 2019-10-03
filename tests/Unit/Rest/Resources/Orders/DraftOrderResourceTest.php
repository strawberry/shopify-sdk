<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\DraftOrder;
use Strawberry\Shopify\Models\Orders\DraftOrderInvoice;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\Orders\DraftOrderResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DraftOrderResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = DraftOrder::class;

    /** @var string */
    protected $resourceClass = DraftOrderResource::class;

    /** @var string */
    protected $dataPath = 'orders/draft_order';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('metafields', MetafieldResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'draft_orders.json');
        $this->assertCollection($response, 5);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(994118539);

        $this->assertRequest('GET', 'draft_orders/994118539.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('draft_order');
        $this->assertRequest('POST', 'draft_orders.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            994118539,
            $this->request('update')
        );

        $this->assertPostKey('draft_order');
        $this->assertRequest('PUT', 'draft_orders/994118539.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(994118539);

        $this->assertRequest('DELETE', 'draft_orders/994118539.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'draft_orders/count.json');
        $this->assertSame(5, $response);
    }

    public function testSendInvoice(): void
    {
        $this->queue(200, [], $this->response('send_invoice'));

        $response = $this->resource->sendInvoice(994118539);

        $this->assertPostKey('draft_order_invoice');
        $this->assertRequest('POST', 'draft_orders/994118539/send_invoice.json');
        $this->assertInstanceOf(DraftOrderInvoice::class, $response);
    }

    public function testCustomizedSendInvoice(): void
    {
        $this->queue(200, [], $this->response('send_invoice'));

        $response = $this->resource->sendInvoice(
            994118539,
            $this->request('send_invoice')
        );

        $this->assertPostKey('draft_order_invoice');
        $this->assertRequest('POST', 'draft_orders/994118539/send_invoice.json');
        $this->assertInstanceOf(DraftOrderInvoice::class, $response);
    }

    public function testComplete(): void
    {
        $this->queue(200, [], $this->response('complete'));

        $response = $this->resource->complete(994118539);

        $this->assertRequest('PUT', 'draft_orders/994118539/complete.json');
        $this->assertModel($response);
    }

    public function testCompleteAndMarkPaymentAsPending(): void
    {
        $this->queue(200, [], $this->response('complete'));

        $response = $this->resource->complete(994118539, true);

        $this->assertRequest('PUT', 'draft_orders/994118539/complete.json?payment_pending=true');
        $this->assertModel($response);
    }
}
