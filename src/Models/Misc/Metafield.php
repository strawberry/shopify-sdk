<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Misc;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  string|null  $description
 * @property  int  $id
 * @property  string  $key
 * @property  string  $namespace
 * @property  int  $owner_id
 * @property  string  $owner_resource
 * @property  mixed  $value
 * @property  string  $value_type
 *
 * @see https://help.shopify.com/en/api/reference/metafield#properties-2019-07
 */
final class Metafield extends Model
{
}
