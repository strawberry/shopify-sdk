<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Concerns;

final class VariantResource extends Resource
{
    use Concerns\FindsResource,
        Concerns\UpdatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Variant::class;
}
