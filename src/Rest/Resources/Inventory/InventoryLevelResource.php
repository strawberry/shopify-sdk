<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryLevel;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class InventoryLevelResource extends Resource
{
    use Concerns\ListsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = InventoryLevel::class;

    /**
     * Adjusts the inventory level of an inventory item at a single location.
     */
    public function adjust(
        int $item,
        int $location,
        int $adjustment
    ): InventoryLevel {
        $response = $this->client->post($this->uri('adjust'), [
            'inventory_item_id' => $item,
            'location_id' => $location,
            'available_adjustment' => $adjustment,
        ]);

        return $this->toModel($response);
    }

    /**
     * Deletes an inventory level of an inventory item at a location.
     */
    public function delete(int $item, int $location): void
    {
        $this->client->delete($this->uri(), [], [
            'inventory_item_id' => $item,
            'location_id' => $location,
        ]);
    }

    /**
     * Sets the inventory level for an inventory item at a location. If the
     * specified location is not connected, it will be automatically
     * connected first.
     *
     * @see  https://help.shopify.com/en/api/reference/inventory/inventorylevel#inventory-levels-and-fulfillment-service-locations
     */
    public function connect(
        int $item,
        int $location,
        bool $relocate_if_necessary = false
    ): InventoryLevel {
        $response = $this->client->post($this->uri('connect'), [
            'inventory_item_id' => $item,
            'location_id' => $location,
            'relocate_if_necessary' => $relocate_if_necessary,
        ]);

        return $this->toModel($response);
    }

    /**
     * Sets the inventory level for an inventory item at a location. If the
     * specified location is not connected, it will be automatically
     * connected first.
     *
     * @see  https://help.shopify.com/en/api/reference/inventory/inventorylevel#inventory-levels-and-fulfillment-service-locations
     */
    public function set(
        int $item,
        int $location,
        int $available,
        bool $disconnect_if_necessary = false
    ): InventoryLevel {
        $response = $this->client->post($this->uri('connect'), [
            'inventory_item_id' => $item,
            'location_id' => $location,
            'available' => $available,
            'disconnect_if_necessary' => $disconnect_if_necessary,
        ]);

        return $this->toModel($response);
    }
}
