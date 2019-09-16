<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Inventory;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  float  $cost
 * @property  string  $country_code_of_origin
 * @property  array  $country_harmonized_system_codes
 * @property  Carbon  $created_at
 * @property  int  $harmonized_system_code
 * @property  int  $id
 * @property  string  $province_code_of_origin
 * @property  string  $sku
 * @property  bool  $tracked
 * @property  Carbon  $updated_at
 * @property  bool  $requires_shipping
 *
 * @see https://help.shopify.com/en/api/reference/inventory/inventoryitem#properties-2019-07
 */
final class InventoryItem extends Model
{
}
