<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\Metafield;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\ChildResource;

final class MetafieldResource extends ChildResource
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
    protected $model = Metafield::class;
}
