<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Events;

use Strawberry\Shopify\Models\Events\Event;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class EventResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Event::class;
}
