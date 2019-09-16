<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Plus;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $api_client_id
 * @property  float  $balance
 * @property  string  $code
 * @property  Carbon  $created_at
 * @property  string  $currency
 * @property  int  $currency_id
 * @property  Carbon|null  $disabled_at
 * @property  Carbon  $expires_on
 * @property  int  $id
 * @property  float  $initial_value
 * @property  string  $last_characters
 * @property  int  $line_item_id
 * @property  string|null  $note
 * @property  int  $order_id
 * @property  string  $template_suffix
 * @property  int  $user_id
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/plus/giftcard#properties-2019-07
 */
final class GiftCard extends Model
{
}
