<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Balance;
use Strawberry\Shopify\Rest\Resource;

final class BalanceResource extends Resource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Balance::class;

    /**
     * The prefix for the URI.
     *
     * @var string
     */
    protected $uriPrefix = 'shopify_payments/';

    /**
     * Retrieves the account's current balance.
     */
    public function get(): Balance
    {
        $response = $this->client->get($this->uri());

        return $this->toModel($response);
    }

    public function routeKey(): string
    {
        return 'balance';
    }
}
