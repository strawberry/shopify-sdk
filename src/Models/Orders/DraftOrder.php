<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  int  $order_id
 * @property  string  $name
 * @property  Customer  $customer
 * @property  Address  $shipping_address
 * @property  Address  $billing_address
 * @property  string|null  $note
 * @property  array  $note_attributes
 * @property  string  $email
 * @property  string  $currency
 * @property  Carbon  $invoice_sent_at
 * @property  string  $invoice_url
 * @property  Collection  $line_items
 * @property  array  $shipping_line
 * @property  string  $tags
 * @property  bool  $tax_exempt
 * @property  array  $tax_exemptions
 * @property  array  $tax_lines
 * @property  array  $applied_discount
 * @property  bool  $taxes_included
 * @property  float  $total_tax
 * @property  float  $subtotal_price
 * @property  float  $total_price
 * @property  Carbon|null  $completed_at
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  string  $status
 *
 * @see https://help.shopify.com/en/api/reference/orders/draftorder#properties-2019-07
 */
final class DraftOrder extends Model
{
}
