<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Strawberry\Shopify\Models\Model;

/**
 * @property  bool  $cause_cancel
 * @property  int  $checkout_id
 * @property  bool  $display
 * @property  int  $id
 * @property  string  $merchant_message
 * @property  string  $message
 * @property  int  $order_id
 * @property  string  $recommendation
 * @property  float  $score
 * @property  string  $source
 *
 * @see https://help.shopify.com/en/api/reference/orders/order-risk#properties-2019-07
 */
final class OrderRisk extends Model
{
}
