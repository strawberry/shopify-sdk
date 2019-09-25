<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Misc;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  int  $order_id
 * @property  float  $amount
 * @property  int  $user_id
 * @property  bool  $test
 * @property  Carbon  $processed_at
 * @property  string  $remote_reference
 * @property  object  $payment_details
 * @property  string  $payment_method
 *
 * @see https://help.shopify.com/en/api/reference/tendertransaction#properties-2019-07
 */
final class TenderTransaction extends Model
{
}
