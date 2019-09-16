<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Customers;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $name
 * @property  string  $query
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/customers/customersavedsearch#properties-2019-07
 */
final class SavedSearch extends Model
{
}
