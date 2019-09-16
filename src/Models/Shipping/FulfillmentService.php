<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Shipping;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $callback_url
 * @property  string  $format
 * @property  string  $handle
 * @property  bool  $inventory_management
 * @property  int  $location_id
 * @property  string  $name
 * @property  mixed|null  $provider_id
 * @property  bool  $requires_shipping_method
 * @property  bool  $tracking_support
 *
 * @see https://help.shopify.com/en/api/reference/shipping-and-fulfillment/fulfillmentservice#properties-2019-07
 */
final class FulfillmentService extends Model
{
}
