<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $author
 * @property  string  $body_html
 * @property  Carbon  $created_at
 * @property  string  $handle
 * @property  int  $id
 * @property  Carbon  $published_at
 * @property  int  $shop_id
 * @property  string  $template_suffix
 * @property  string  $title
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/online-store/page#properties-2019-07
 */
final class Page extends Model
{
}
