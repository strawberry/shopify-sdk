<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $product_id
 * @property  string  $body_html
 * @property  Carbon  $created_at
 * @property  string  $handle
 * @property  array  $images
 * @property  array  $options
 * @property  string  $product_type
 * @property  Carbon  $published_at
 * @property  string  $tags
 * @property  string  $title
 * @property  Carbon  $updated_at
 * @property  Collection  $variants
 * @property  string  $vendor
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/productlisting#properties-2019-07
 */
final class ProductListing extends Model
{
}
