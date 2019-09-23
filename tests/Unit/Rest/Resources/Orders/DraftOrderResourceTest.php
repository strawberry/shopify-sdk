<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\DraftOrder;
use Strawberry\Shopify\Rest\Resources\Orders\DraftOrderResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DraftOrderResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = DraftOrder::class;

    /** @var string */
    protected $resourceClass = DraftOrderResource::class;

    /** @var string */
    protected $dataPath = 'orders/draft_order';
}
