<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Access;

use Strawberry\Shopify\Models\Access\StorefrontAccessToken;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class StorefrontAccessTokenResource extends Resource
{
    use Concerns\CreatesResource,
        Concerns\ListsResource,
        Concerns\DeletesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = StorefrontAccessToken::class;
}
