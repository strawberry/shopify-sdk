<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryItem;
use Strawberry\Shopify\Rest\Resources\Inventory\InventoryItemResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class InventoryItemResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = InventoryItem::class;

    /** @var string */
    protected $resourceClass = InventoryItemResource::class;

    /** @var string */
    protected $dataPath = 'inventory/inventory_item';
}
