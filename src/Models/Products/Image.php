<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  int  $position
 * @property  int  $product_id
 * @property  array  $variant_ids
 * @property  string  $src
 * @property  int  $width
 * @property  int  $height
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/products/product-image#properties-2019-07
 */
final class Image extends Model
{
}
