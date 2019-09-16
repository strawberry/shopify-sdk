<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Products;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $collection_id
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  int  $position
 * @property  int  $product_id
 * @property  string  $sort_value
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/products/collect#properties-2019-07
 */
final class Collect extends Model
{
}
