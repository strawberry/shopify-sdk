<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class VariantResource extends Resource
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
    protected $model = Variant::class;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = ProductResource::class;
}
