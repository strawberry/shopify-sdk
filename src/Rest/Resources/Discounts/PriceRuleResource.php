<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\PriceRule;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class PriceRuleResource extends Resource
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
    protected $model = PriceRule::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'batches' => BatchResource::class,
        'discountCodes' => DiscountCodeResource::class,
    ];
}
