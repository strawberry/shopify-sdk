<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $article_id
 * @property  string  $author
 * @property  int  $blog_id
 * @property  string  $body
 * @property  string  $body_html
 * @property  Carbon  $created_at
 * @property  string  $email
 * @property  int  $id
 * @property  string  $ip
 * @property  Carbon  $published_at
 * @property  string  $status
 * @property  Carbon  $updated_at
 * @property  string  $user_agent
 *
 * @see https://help.shopify.com/en/api/reference/online-store/comment#properties-2019-07
 */
final class Comment extends Model
{
}
