<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Sales\Checkout;
use Strawberry\Shopify\Models\Sales\ShippingRate;
use Strawberry\Shopify\Rest\Resources\Sales\CheckoutResource;
use Strawberry\Shopify\Rest\Resources\Sales\PaymentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CheckoutResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Checkout::class;

    /** @var string */
    protected $resourceClass = CheckoutResource::class;

    /** @var string */
    protected $dataPath = 'sales/checkout';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('payments', PaymentResource::class);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('checkout');
        $this->assertRequest('POST', 'checkouts.json');
        $this->assertModel($response);
    }

    public function testComplete(): void
    {
        $this->queue(201, [], $this->response('complete'));

        $response = $this->resource->complete('b490a9220cd14d7344024f4874f640a6');

        $this->assertRequest('POST', 'checkouts/b490a9220cd14d7344024f4874f640a6/complete.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find('b490a9220cd14d7344024f4874f640a6');

        $this->assertRequest('GET', 'checkouts/b490a9220cd14d7344024f4874f640a6.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            'b490a9220cd14d7344024f4874f640a6',
            $this->request('update')
        );

        $this->assertPostKey('checkout');
        $this->assertRequest('PUT', 'checkouts/b490a9220cd14d7344024f4874f640a6.json');
        $this->assertModel($response);
    }

    public function testShippingRates(): void
    {
        $this->queue(200, [], $this->response('shipping_rates'));

        $response = $this->resource->shippingRates('b490a9220cd14d7344024f4874f640a6');

        $this->assertRequest('GET', 'checkouts/b490a9220cd14d7344024f4874f640a6/shipping_rates.json');
        $this->assertIsArray($response);
        $this->assertContainsOnlyInstancesOf(ShippingRate::class, $response);
    }
}
