<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Province;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class ProvinceResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\UpdatesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Province::class;
}
