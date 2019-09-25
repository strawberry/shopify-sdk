<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\AbandonedCheckout;
use Strawberry\Shopify\Rest\Resources\Orders\AbandonedCheckoutResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class AbandonedCheckoutResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = AbandonedCheckout::class;

    /** @var string */
    protected $resourceClass = AbandonedCheckoutResource::class;

    /** @var string */
    protected $dataPath = 'orders/abandoned_checkout';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'checkouts.json');
        $this->assertCollection($response, 7);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'checkouts/count.json');
        $this->assertSame(7, $response);
    }
}
