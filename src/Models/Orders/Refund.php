<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string|null  $note
 * @property  array  $order_adjustments
 * @property  Carbon  $processed_at
 * @property  Collection  $refund_line_items
 * @property  bool  $restock
 * @property  Collection  $transactions
 * @property  int  $user_id
 *
 * @see https://help.shopify.com/en/api/reference/orders/refund#properties-2019-07
 */
final class Refund extends Model
{
}
