<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $attachment
 * @property  string  $content_type
 * @property  Carbon  $created_at
 * @property  string  $key
 * @property  string  $public_url
 * @property  int  $size
 * @property  int  $theme_id
 * @property  Carbon  $updated_at
 * @property  string  $value
 *
 * @see https://help.shopify.com/en/api/reference/online-store/asset#properties-2019-07
 */
final class Asset extends Model
{
}
