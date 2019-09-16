<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Store;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $title
 * @property  string  $body
 * @property  string  $url
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/store-properties/policy#properties-2019-07
 */
final class Policy extends Model
{
}
