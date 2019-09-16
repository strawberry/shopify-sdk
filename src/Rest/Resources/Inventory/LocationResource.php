<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Inventory;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Models\Inventory\Location;
use Strawberry\Shopify\Models\Inventory\InventoryLevel;

final class LocationResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Retrieves a list of inventory levels for a location.
     */
    public function inventoryLevels(int $id): Collection
    {
        $response = $this->client->get(
            $this->uri("{$id}/inventory_levels")
        );

        return $this->toCollection(
            $response,
            'inventory_levels',
            InventoryLevel::class
        );
    }
}
