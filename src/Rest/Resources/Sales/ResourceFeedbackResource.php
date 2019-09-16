<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Sales\ResourceFeedback;

final class ResourceFeedbackResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\CreatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = ResourceFeedback::class;
}
