<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Payout;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments\PayoutResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PayoutResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Payout::class;

    /** @var string */
    protected $resourceClass = PayoutResource::class;

    /** @var string */
    protected $dataPath = 'shopify_payments/payout';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'shopify_payments/payouts.json');
        $this->assertCollection($response, 5);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get_with_options'));

        $response = $this->resource->get([
            'status' => 'won'
        ]);

        $this->assertRequest('GET', 'shopify_payments/payouts.json?status=won');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(623721858);

        $this->assertRequest('GET', 'shopify_payments/payouts/623721858.json');
        $this->assertModel($response);
    }
}
