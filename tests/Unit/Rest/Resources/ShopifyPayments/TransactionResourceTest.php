<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Transaction;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments\TransactionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class TransactionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Transaction::class;

    /** @var string */
    protected $resourceClass = TransactionResource::class;

    /** @var string */
    protected $dataPath = 'shopify_payments/transaction';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'shopify_payments/balance/transactions.json');
        $this->assertCollection($response, 29);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get_with_options'));

        $response = $this->resource->get([
            'since_id' => 699519474,
            'last_id' => 699519476,
        ]);

        $this->assertRequest('GET', 'shopify_payments/balance/transactions.json?since_id=699519474&last_id=699519476');
        $this->assertCollection($response, 1);
    }
}
