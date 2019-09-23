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
}
