<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\ApplicationCredit;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class ApplicationCreditResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = ApplicationCredit::class;
}
