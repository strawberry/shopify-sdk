<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Shipping;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $address1
 * @property  string  $address2
 * @property  string  $city
 * @property  string  $country
 * @property  Carbon  $created_at
 * @property  Carbon  $estimated_delivery_at
 * @property  int  $fulfillment_id
 * @property  Carbon  $happened_at
 * @property  int  $id
 * @property  float  $latitude
 * @property  float  $longitude
 * @property  string  $message
 * @property  int  $order_id
 * @property  string  $province
 * @property  int  $shop_id
 * @property  string  $status
 * @property  Carbon  $updated_at
 * @property  string  $zip
 *
 * @see https://help.shopify.com/en/api/reference/shipping-and-fulfillment/fulfillmentevent#properties-2019-07
 */
final class FulfillmentEvent extends Model
{
}
