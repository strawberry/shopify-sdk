<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Analytics;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $category
 * @property  int  $id
 * @property  string  $name
 * @property  string  $shopify_ql
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/analytics/report#properties-2019-07
 */
final class Report extends Model
{
}
