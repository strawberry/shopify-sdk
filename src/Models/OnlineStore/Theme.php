<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $name
 * @property  bool  $previewable
 * @property  bool  $processing
 * @property  string  $role
 * @property  int|null  $theme_store_id
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/online-store/theme#properties-2019-07
 */
final class Theme extends Model
{
}
