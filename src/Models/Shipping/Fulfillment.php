<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Shipping;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  Collection  $line_items
 * @property  int  $location_id
 * @property  string  $name
 * @property  bool  $notify_customer
 * @property  int  $order_id
 * @property  object  $receipt
 * @property  string  $service
 * @property  string  $shipment_status
 * @property  string  $status
 * @property  string  $tracking_company
 * @property  array  $tracking_numbers
 * @property  array  $tracking_urls
 * @property  Carbon  $updated_at
 * @property  string  $variant_inventory_management
 *
 * @see https://help.shopify.com/en/api/reference/shipping-and-fulfillment/fulfillment#properties-2019-07
 */
final class Fulfillment extends Model
{
}
