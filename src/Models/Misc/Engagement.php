<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Misc;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $occured_on
 * @property  Carbon  $fetched_at
 * @property  int|null  $views_count
 * @property  int|null  $impressions_count
 * @property  int|null  $clicks_count
 * @property  int|null  $favorites_count
 * @property  int|null  $comments_count
 * @property  int|null  $shares_count
 * @property  float  $ad_spend
 * @property  string|null  $currency_code
 * @property  bool  $is_cumulative
 * @property  int|null  $unsubscribes_count
 * @property  int|null  $complaints_count
 * @property  int|null  $fails_count
 * @property  int|null  $sends_count
 * @property  int|null  $unique_views_count
 * @property  int|null  $unique_clicks_count
 * @property  float|null  $utc_offset
 *
 * @see https://help.shopify.com/en/api/reference/marketingevent?api[version]=2019-07#engagements-2019-07
 */
final class Engagement extends Model
{
}
