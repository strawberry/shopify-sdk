<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Country;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

/**
 * @method  ProvinceResource  provinces(?integer id)
 */
final class CountryResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * A list of the child resources for this resource.
     *
     * @var string[]
     */
    protected $childResources = [
        'provinces' => ProvinceResource::class,
    ];
}
