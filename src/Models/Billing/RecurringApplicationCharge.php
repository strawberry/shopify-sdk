<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Billing;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon|null  $activated_on
 * @property  Carbon|null  $billing_on
 * @property  Carbon|null  $cancelled_on
 * @property  float  $capped_amount
 * @property  string  $confirmation_url
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $name
 * @property  float  $price
 * @property  string  $return_url
 * @property  string  $status
 * @property  string  $terms
 * @property  bool|null  $test
 * @property  Carbon|null  $trial_ends_on
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/billing/recurringapplicationcharge#properties-2019-07
 */
final class RecurringApplicationCharge extends Model
{
}
