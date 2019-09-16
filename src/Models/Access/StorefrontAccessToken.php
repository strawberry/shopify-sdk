<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Access;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  string  $access_token
 * @property  string  $access_scope
 * @property  Carbon  $created_at
 * @property  string  $title
 *
 * @see https://help.shopify.com/en/api/reference/access/storefrontaccesstoken#properties-2019-07
 */
final class StorefrontAccessToken extends Model
{
}
