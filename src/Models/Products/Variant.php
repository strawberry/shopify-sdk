<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $barcode
 * @property  float  $compare_at_price
 * @property  Carbon  $created_at
 * @property  string  $fulfillment_service
 * @property  int  $grams
 * @property  int  $id
 * @property  int  $image_id
 * @property  int  $inventory_item_id
 * @property  string  $inventory_management
 * @property  string  $inventory_policy
 * @property  int  $inventory_quantity
 * @property  int  $old_inventory_quantity
 * @property  int  $inventory_quantity_adjustment
 * @property  int  $option1
 * @property  array  $presentment_prices
 * @property  int  $position
 * @property  float  $price
 * @property  int  $product_id
 * @property  bool  $requires_shipping
 * @property  string  $sku
 * @property  bool  $taxable
 * @property  string  $tax_code
 * @property  string  $title
 * @property  Carbon  $updated_at
 * @property  int  $weight
 * @property  string  $weight_unit
 *
 * @see https://help.shopify.com/en/api/reference/products/product-variant#properties-2019-07
 */
final class Variant extends Model
{
}
