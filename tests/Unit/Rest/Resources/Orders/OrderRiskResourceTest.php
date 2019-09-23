<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\OrderRisk;
use Strawberry\Shopify\Rest\Resources\Orders\OrderRiskResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class OrderRiskResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = OrderRisk::class;

    /** @var string */
    protected $resourceClass = OrderRiskResource::class;

    /** @var string */
    protected $dataPath = 'orders/order_risk';
}
