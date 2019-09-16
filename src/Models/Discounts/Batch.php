<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Discounts;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  int  $price_rule_id
 * @property  Carbon|null  $started_at
 * @property  Carbon|null  $completed_at
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  string  $status
 * @property  int  $codes_count
 * @property  int  $imported_count
 * @property  int  $failed_count
 *
 * @see https://help.shopify.com/en/api/reference/discounts/discountcode#batch_create-2019-07
 */
final class Batch extends Model
{
}
