<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryItem;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class InventoryItemResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\UpdatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = InventoryItem::class;
}
