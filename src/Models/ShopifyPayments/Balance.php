<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\ShopifyPayments;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $currency
 * @property  float  $amount
 *
 * @see https://help.shopify.com/en/api/reference/shopify_payments/balance#properties-2019-07
 */
final class Balance extends Model
{
}
