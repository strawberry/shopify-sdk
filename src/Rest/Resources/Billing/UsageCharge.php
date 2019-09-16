<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\UsageCharge;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\ChildResource;

final class UsageChargeResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = RecurringApplicationChargeResource::class;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = UsageCharge::class;
}
