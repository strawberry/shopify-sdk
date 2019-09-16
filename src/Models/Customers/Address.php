<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Customers;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $address1
 * @property  string  $address2
 * @property  string  $city
 * @property  string  $country
 * @property  string  $country_code
 * @property  string  $country_name
 * @property  string  $company
 * @property  string  $first_name
 * @property  string  $last_name
 * @property  string  $name
 * @property  string  $phone
 * @property  string  $province
 * @property  string  $province_code
 * @property  string  $zip
 *
 * @see https://help.shopify.com/en/api/reference/customers/customer-address#properties-2019-07
 */
final class Address extends Model
{
}
