<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  float  $amount
 * @property  string  $authorization
 * @property  Carbon  $created_at
 * @property  string  $currency
 * @property  int  $device_id
 * @property  string  $error_code
 * @property  string  $gateway
 * @property  int  $id
 * @property  string  $kind
 * @property  int  $location_id
 * @property  string  $message
 * @property  int  $order_id
 * @property  array  $payment_details
 * @property  int  $parent_id
 * @property  Carbon  $processed_at
 * @property  array  $receipt
 * @property  string  $source_name
 * @property  string  $status
 * @property  bool  $test
 * @property  int  $user_id
 * @property  array  $currency_exchange_adjustment
 *
 * @see https://help.shopify.com/en/api/reference/orders/transaction#properties-2019-07
 */
final class Transaction extends Model
{
}
