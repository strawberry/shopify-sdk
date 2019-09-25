<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class ProductVariantResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\CreatesResource,
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
