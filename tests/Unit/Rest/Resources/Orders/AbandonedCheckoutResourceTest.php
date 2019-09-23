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
}
