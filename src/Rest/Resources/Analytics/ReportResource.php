<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Analytics;

use Strawberry\Shopify\Models\Analytics\Report;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class ReportResource extends Resource
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
    protected $model = Report::class;
}
