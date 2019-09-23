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
}
