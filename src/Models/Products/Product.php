<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $body_html
 * @property  Carbon  $created_at
 * @property  string  $handle
 * @property  int  $id
 * @property  Collection  $images
 * @property  array  $options
 * @property  string  $products
 * @property  Carbon|null  $published_at
 * @property  string  $published_scope
 * @property  string  $tags
 * @property  string  $template_suffix
 * @property  string  $title
 * @property  string  $metafields_global_title_tag
 * @property  string  $metafields_global_description_tag
 * @property  Carbon  $updated_at
 * @property  Variants  $images
 * @property  string  $vendor
 *
 * @see https://help.shopify.com/en/api/reference/products/product#properties-2019-07
 */
final class Product extends Model
{
}
