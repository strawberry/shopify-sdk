<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $collection_id
 * @property  string  $body_html
 * @property  array  $default_product_image
 * @property  array  $image
 * @property  string  $handle
 * @property  Carbon  $published_at
 * @property  string  $title
 * @property  string  $sort_order
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/collectionlisting#properties-2019-07
 */
final class CollectionListing extends Model
{
}
