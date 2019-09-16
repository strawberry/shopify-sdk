<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Inventory;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  bool  $active
 * @property  string  $address1
 * @property  string  $address2
 * @property  string  $city
 * @property  string  $country
 * @property  string  $country_code
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  bool  $legacy
 * @property  string  $name
 * @property  string  $phone
 * @property  string  $province
 * @property  string  $province_code
 * @property  Carbon  $updated_at
 * @property  string  $zip
 *
 * @see https://help.shopify.com/en/api/reference/inventory/location#properties-2019-07
 */
final class Location extends Model
{
}
