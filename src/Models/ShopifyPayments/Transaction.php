<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\ShopifyPayments;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  string  $type
 * @property  bool  $test
 * @property  int  $payout_id
 * @property  string  $payout_status
 * @property  string  $payout_currency
 * @property  float  $amount
 * @property  float  $fee
 * @property  int  $source_id
 * @property  string  $source_type
 * @property  int  $source_order_id
 * @property  Carbon  $processed_at
 *
 * @see https://help.shopify.com/en/api/reference/shopify_payments/transaction#properties-2019-07
 */
final class Transaction extends Model
{
}
