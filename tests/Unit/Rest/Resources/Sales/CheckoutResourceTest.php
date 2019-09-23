<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\Checkout;
use Strawberry\Shopify\Rest\Resources\Sales\CheckoutResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CheckoutResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Checkout::class;

    /** @var string */
    protected $resourceClass = CheckoutResource::class;

    /** @var string */
    protected $dataPath = 'sales/checkout';
}
