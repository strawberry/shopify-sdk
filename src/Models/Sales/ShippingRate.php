<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $id
 * @property  float  $price
 * @property  string  $title
 * @property  object  $checkout
 * @property  bool  $phone_required
 * @property  mixed  $delivery_range
 * @property  string  $handle
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/checkout#shipping_rates-2019-07
 */
final class ShippingRate extends Model
{
}
