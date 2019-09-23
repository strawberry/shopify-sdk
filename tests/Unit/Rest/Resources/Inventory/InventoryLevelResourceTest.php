<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryLevel;
use Strawberry\Shopify\Rest\Resources\Inventory\InventoryLevelResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class InventoryLevelResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = InventoryLevel::class;

    /** @var string */
    protected $resourceClass = InventoryLevelResource::class;

    /** @var string */
    protected $dataPath = 'inventory/inventory_level';
}
