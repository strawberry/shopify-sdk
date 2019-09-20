<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\Batch;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class BatchResource extends ChildResource
{
    use Concerns\CreatesResource,
        Concerns\ListsResource,
        Concerns\FindsResource;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = PriceRuleResource::class;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Batch::class;
}
