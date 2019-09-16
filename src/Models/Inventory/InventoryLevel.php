<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Inventory;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $available
 * @property  int  $inventory_item_id
 * @property  int  $location_id
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/inventory/inventorylevel#properties-2019-07
 */
final class InventoryLevel extends Model
{
}
