<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Balance;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments\BalanceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BalanceResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Balance::class;

    /** @var string */
    protected $resourceClass = BalanceResource::class;

    /** @var string */
    protected $dataPath = 'shopify_payments/balance';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'shopify_payments/balance.json');
        $this->assertModel($response);
    }
}
