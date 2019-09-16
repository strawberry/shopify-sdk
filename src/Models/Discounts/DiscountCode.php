<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Discounts;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $code
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  int  $id
 * @property  int  $price_rule_id
 * @property  int  $usage_count
 *
 * @see https://help.shopify.com/en/api/reference/discounts/discountcode#properties-2019-07
 */
final class DiscountCode extends Model
{
}
