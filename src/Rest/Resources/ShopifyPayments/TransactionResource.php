<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\ShopifyPayments\Transaction;

final class TransactionResource extends Resource
{
    use Concerns\ListsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * The prefix for the URI.
     *
     * @var string
     */
    protected $uriPrefix = 'shopify_payments/';
}
