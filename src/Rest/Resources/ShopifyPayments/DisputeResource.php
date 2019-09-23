<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Dispute;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class DisputeResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Dispute::class;

    /**
     * The prefix for the URI.
     *
     * @var string
     */
    protected $uriPrefix = 'shopify_payments/';
}
