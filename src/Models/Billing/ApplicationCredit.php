<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Billing;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $description
 * @property  int  $id
 * @property  float  $amount
 * @property  bool|null  $test
 *
 * @see https://help.shopify.com/en/api/reference/billing/applicationcredit#properties-2019-07
 */
final class ApplicationCredit extends Model
{
}
