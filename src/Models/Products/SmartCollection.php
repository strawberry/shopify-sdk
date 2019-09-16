<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $body_html
 * @property  string  $handle
 * @property  int  $id
 * @property  object  $image
 * @property  Carbon  $published_at
 * @property  string  $published_scope
 * @property  array  $rules
 * @property  bool  $disjunctive
 * @property  string  $sort_order
 * @property  string  $template_suffix
 * @property  string  $title
 * @property  Carbon  $updated_at
 * @property  int  $products_manually_sorted_count
 *
 * @see https://help.shopify.com/en/api/reference/products/smartcollection#properties-2019-07
 */
final class SmartCollection extends Model
{
}
