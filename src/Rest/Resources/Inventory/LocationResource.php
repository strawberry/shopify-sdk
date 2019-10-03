<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Inventory;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Inventory\InventoryLevel;
use Strawberry\Shopify\Models\Inventory\Location;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

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
     *
     * @return mixed
     */
    public function inventoryLevels(int $id)
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
