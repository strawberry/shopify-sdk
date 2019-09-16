<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Models\Customers\Customer;

/**
 * @property  string  $abandoned_checkout_url
 * @property  Address  $billing_address
 * @property  bool  $buyer_accepts_marketing
 * @property  string  $cart_token
 * @property  Carbon|null  $closed_at
 * @property  Carbon|null  $completed_at
 * @property  Carbon  $created_at
 * @property  string  $currency
 * @property  Customer  $customer
 * @property  string   $customer_locale
 * @property  int|null  $device_id
 * @property  Collection  $discount_codes
 * @property  string  $email
 * @property  string  $gateway
 * @property  int  $id
 * @property  string  $landing_site
 * @property  Collection  $line_items
 * @property  int  $location_id
 * @property  string|null  $note
 * @property  string  $phone
 * @property  string  $presentment_currency
 * @property  string  $referring_site
 * @property  Address  $shipping_address
 * @property  array  $shipping_lines
 * @property  string  $source_name
 * @property  float  $subtotal_price
 * @property  array  $tax_lines
 * @property  bool  $taxes_included
 * @property  string  $token
 * @property  float  $total_discounts
 * @property  float  $total_line_items_price
 * @property  float  $total_price
 * @property  float  $total_tax
 * @property  int  $total_weight
 * @property  Carbon  $updated_at
 * @property  int  $user_id
 *
 * @see https://help.shopify.com/en/api/reference/orders/abandoned-checkouts#properties-2019-07
 */
final class AbandonedCheckout extends Model
{
}
