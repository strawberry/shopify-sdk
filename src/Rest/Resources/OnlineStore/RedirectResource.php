<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\OnlineStore\Redirect;

final class RedirectResource extends Resource
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
    protected $model = Redirect::class;
}
