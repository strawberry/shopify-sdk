<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Orders;

use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\Orders\AbandonedCheckout;

final class AbandonedCheckoutResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = AbandonedCheckout::class;
}
