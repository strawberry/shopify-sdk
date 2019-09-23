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
}