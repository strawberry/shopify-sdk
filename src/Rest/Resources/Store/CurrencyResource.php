<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Currency;
use Strawberry\Shopify\Rest\Concerns\ListsResource;
use Strawberry\Shopify\Rest\Resource;

final class CurrencyResource extends Resource
{
    use ListsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Currency::class;
}
