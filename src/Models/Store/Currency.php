<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Store;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $currency
 * @property  Carbon  $rate_updated_at
 * @property  bool  $enabled
 *
 * @see https://help.shopify.com/en/api/reference/store-properties/currency#properties-2019-07
 */
final class Currency extends Model
{
}
