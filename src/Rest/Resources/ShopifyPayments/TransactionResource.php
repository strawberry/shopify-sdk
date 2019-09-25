<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Transaction;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

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
    protected $uriPrefix = 'shopify_payments/balance/';
}
