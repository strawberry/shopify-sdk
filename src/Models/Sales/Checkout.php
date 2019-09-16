<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Models\Customers\Address;

/**
 * @property  string  $applied_discount
 * @property  Address  $billing_address
 * @property  bool  $buyer_accepts_marketing
 * @property  Carbon  $created_at
 * @property  string  $currency
 * @property  int  $customer_id
 * @property  string   $discount_code
 * @property  Collection  $gift_cards
 * @property  Collection  $line_items
 * @property  Order  $order
 * @property  float  $payment_due
 * @property  string  $payment_url
 * @property  string  $phone
 * @property  string  $presentment_currency
 * @property  bool  $requires_shipping
 * @property  int|null  $reservation_time
 * @property  int  $reservation_time_left
 * @property  Address  $shipping_address
 * @property  string  $shipping_line
 * @property  object  $shipping_rate
 * @property  string  $source_name
 * @property  float  $subtotal_price
 * @property  array  $tax_lines
 * @property  bool  $taxes_included
 * @property  string  $token
 * @property  float  $total_price
 * @property  float  $total_tax
 * @property  Carbon  $updated_at
 * @property  int  $user_id
 * @property  string  $web_url
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/checkout#properties-2019-07
 */
final class Checkout extends Model
{
}
