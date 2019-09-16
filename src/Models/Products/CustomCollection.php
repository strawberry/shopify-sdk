<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $body_html
 * @property  string  $handle
 * @property  object  $image
 * @property  int  $id
 * @property  bool  $published
 * @property  Carbon  $published_at
 * @property  string  $published_scope
 * @property  string  $sort_order
 * @property  string  $template_suffix
 * @property  string  $title
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/products/customcollection#properties-2019-07
 */
final class CustomCollection extends Model
{
}
