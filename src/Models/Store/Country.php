<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Store;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $code
 * @property  int  $id
 * @property  string  $name
 * @property  array  $provinces
 * @property  float  $tax
 *
 * @see https://help.shopify.com/en/api/reference/store-properties/country#properties-2019-07
 */
final class Country extends Model
{
    /**
     * The attributes that should be cast to the given type.
     */
    protected $casts = [
        'id' => 'int',
        'tax' => 'float',
    ];

    /**
     * The attributes that should be cast to arrays of the given type.
     *
     * @var array
     */
    protected $castArrays = [
        'provinces' => Province::class,
    ];
}
