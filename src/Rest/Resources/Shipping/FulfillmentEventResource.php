<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentEvent;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class FulfillmentEventResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\DeletesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = FulfillmentEvent::class;

    public function routeKey(): string
    {
        return 'events';
    }

    public function postKey(): string
    {
        return 'event';
    }
}
