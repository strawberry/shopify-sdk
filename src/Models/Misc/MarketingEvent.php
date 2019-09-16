<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Misc;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $remote_id
 * @property  string  $event_type
 * @property  string  $marketing_channel
 * @property  bool  $paid
 * @property  string  $referring_domain
 * @property  float  $budget
 * @property  string  $currency
 * @property  string  $budget_type
 * @property  Carbon  $started_at
 * @property  Carbon  $scheduled_to_end_at
 * @property  Carbon  $ended_at
 * @property  array  $marketing_event
 * @property  string  $description
 * @property  string  $manage_url
 * @property  string  $preview_url
 * @property  array  $marketed_resources
 *
 * @see https://help.shopify.com/en/api/reference/marketingevent#properties-2019-07
 */
final class MarketingEvent extends Model
{
}
