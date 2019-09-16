<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Customers;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  bool  $accepts_marketing
 * @property  Carbon  $accepts_marketing_updated_at
 * @property  array  $addresses
 * @property  string  $currency
 * @property  Carbon  $created_at
 * @property  Address  $default_address
 * @property  string  $email
 * @property  string  $first_name
 * @property  int  $id
 * @property  string  $last_name
 * @property  int  $last_order_id
 * @property  string  $last_order_name
 * @property  array  $metafield
 * @property  string  $marketing_opt_in_level
 * @property  string|null  $multipass_identifier
 * @property  string  $note
 * @property  int  $orders_count
 * @property  string  $phone
 * @property  string  $state
 * @property  string  $tags
 * @property  bool  $tax_exempt
 * @property  array  $tax_exemptions
 * @property  float  $total_spent
 * @property  Carbon  $updated_at
 * @property  bool  $verified_email
 *
 * @see https://help.shopify.com/en/api/reference/customers/customer#properties-2019-07
 */
final class Customer extends Model
{
    /**
     * The attributes that should be cast to the given type.
     */
    protected $casts = [
        'default_address' => Address::class,
    ];

    /**
     * The attributes that should be cast to the given type.
     */
    protected $castArrays = [
        'addresses' => Address::class,
    ];
}
