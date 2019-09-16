<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\ShopifyPayments;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  string  $status
 * @property  Carbon  $date
 * @property  string  $currency
 * @property  float  $amount
 *
 * @see https://help.shopify.com/en/api/reference/shopify_payments/payout#properties-2019-07
 */
final class Payout extends Model
{
}
