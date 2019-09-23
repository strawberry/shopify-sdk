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
}
