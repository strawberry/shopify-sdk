<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Discounts;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $allocation_method
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  string  $customer_selection
 * @property  Carbon  $ends_at
 * @property  array  $entitled_country_ids
 * @property  array  $entitled_product_ids
 * @property  array  $entitled_variant_ids
 * @property  int  $id
 * @property  bool  $once_per_customer
 * @property  array  $prerequisite_customer_ids
 * @property  object  $prerequisite_quantity_range
 * @property  array  $prerequisite_saved_search_ids
 * @property  object  $prerequisite_shipping_price_range
 * @property  object  $prerequisite_subtotal_range
 * @property  Carbon  $starts_at
 * @property  string  $target_selection
 * @property  string  $target_type
 * @property  string  $title
 * @property  int  $usage_limit
 * @property  array  $prerequisite_product_ids
 * @property  array  $prerequisite_variant_ids
 * @property  array  $prerequisite_collection_ids
 * @property  int  $value
 * @property  string  $value_type
 * @property  object  $prerequisite_to_entitlement_quantity_ratio
 * @property  int  $allocation_limit
 *
 * @see https://help.shopify.com/en/api/reference/discounts/pricerule#properties-2019-07
 */
final class PriceRule extends Model
{
}
