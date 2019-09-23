<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class OrderResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Order::class;

    /** @var string */
    protected $resourceClass = OrderResource::class;

    /** @var string */
    protected $dataPath = 'orders/order';
}
