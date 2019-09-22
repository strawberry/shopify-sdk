<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentService;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class FulfillmentServiceResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = FulfillmentService::class;
}