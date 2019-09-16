<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $commentable
 * @property  Carbon  $created_at
 * @property  string|null  $feedburner
 * @property  string|null  $feedburner_location
 * @property  string  $handle
 * @property  int  $id
 * @property  string  $tags
 * @property  string  $template_suffix
 * @property  string  $title
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/online-store/blog#properties-2019-07
 */
final class Blog extends Model
{
}
