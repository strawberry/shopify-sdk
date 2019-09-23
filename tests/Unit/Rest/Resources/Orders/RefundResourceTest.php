<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Refund;
use Strawberry\Shopify\Rest\Resources\Orders\RefundResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class RefundResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Refund::class;

    /** @var string */
    protected $resourceClass = RefundResource::class;

    /** @var string */
    protected $dataPath = 'orders/refund';
}
