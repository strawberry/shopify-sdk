<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Plus;

use Strawberry\Shopify\Models\Model;

/**
 * @property  bool  $account_owner
 * @property  string  $bio
 * @property  string  $email
 * @property  string  $first_name
 * @property  int  $id
 * @property  string  $im
 * @property  string  $last_name
 * @property  array  $permissions
 * @property  array  $phone
 * @property  bool  $receive_announcements
 * @property  string  $screen_name
 * @property  string  $url
 * @property  string  $locale
 * @property  string  $user_type
 *
 * @see https://help.shopify.com/en/api/reference/plus/user#properties-2019-07
 */
final class User extends Model
{
}
