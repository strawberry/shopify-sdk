<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Billing;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $confirmation_url
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $name
 * @property  float  $price
 * @property  string  $return_url
 * @property  string  $status
 * @property  bool|null  $test
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/billing/applicationcharge#properties-2019-07
 */
final class ApplicationCharge extends Model
{
}
