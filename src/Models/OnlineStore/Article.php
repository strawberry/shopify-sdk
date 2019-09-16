<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $author
 * @property  int  $blog_id
 * @property  string  $body_html
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $handle
 * @property  array  $image
 * @property  bool  $published
 * @property  Carbon  $published_at
 * @property  string  $summary_html
 * @property  string  $tags
 * @property  string|null  $template_suffix
 * @property  string  $title
 * @property  Carbon  $updated_at
 * @property  int  $user_id
 *
 * @see https://help.shopify.com/en/api/reference/online-store/article#properties-2019-07
 */
final class Article extends Model
{
}
