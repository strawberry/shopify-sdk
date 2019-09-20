<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $app_id
 * @property  Address  $billing_address
 * @property  string  $browser_ip
 * @property  bool  $buyer_accepts_marketing
 * @property  string  $cancel_reason
 * @property  Carbon|null  $cancelled_at
 * @property  string  $cart_token
 * @property  array  $client_details
 * @property  Carbon|null  $closed_at
 * @property  Carbon  $created_at
 * @property  string  $currency
 * @property  Customer  $customer
 * @property  string  $customer_locale
 * @property  array  $discount_applications
 * @property  array  $discount_codes
 * @property  string  $email
 * @property  string  $financial_status
 * @property  Collection  $fulfillments
 * @property  string  $fulfillment_status
 * @property  string  $gateway
 * @property  int  $id
 * @property  string  $landing_site
 * @property  Collection  $line_items
 * @property  int  $location_id
 * @property  string  $name
 * @property  string|null  $note
 * @property  array  $note_attributes
 * @property  int  $number
 * @property  int  $order_number
 * @property  array  $payment_details
 * @property  array  $payment_gateway_names
 * @property  string  $phone
 * @property  string  $presentment_currency
 * @property  Carbon  $processed_at
 * @property  string  $processing_method
 * @property  string  $referring_site
 * @property  array  $refunds
 * @property  Address  $shipping_address
 * @property  array  $shipping_lines
 * @property  string  $source_name
 * @property  float  $subtotal_price
 * @property  array  $subtotal_price_set
 * @property  string  $tags
 * @property  array  $tax_lines
 * @property  bool  $taxes_included
 * @property  bool  $test
 * @property  string  $token
 * @property  float  $total_discounts
 * @property  array  $total_discounts_set
 * @property  float  $total_line_items_price
 * @property  array  $total_line_items_price_set
 * @property  float  $total_price
 * @property  array  $total_price_set
 * @property  float  $total_tax
 * @property  array  $total_tax_set
 * @property  float  $total_tip_received
 * @property  int  $total_weight
 * @property  Carbon  $updated_at
 * @property  int  $user_id
 * @property  int  $order_status_url
 *
 * @see https://help.shopify.com/en/api/reference/orders/order#properties-2019-07
 */
final class Order extends Model
{
}
