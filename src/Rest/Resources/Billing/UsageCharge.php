<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\UsageCharge;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class UsageCharge extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = UsageCharge::class;
}
