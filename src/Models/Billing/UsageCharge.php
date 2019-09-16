<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Billing;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  string  $description
 * @property  int  $id
 * @property  float  $price
 * @property  int  $recurring_application_charge_id
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/billing/usagecharge#properties-2019-07
 */
final class UsageCharge extends Model
{
}
