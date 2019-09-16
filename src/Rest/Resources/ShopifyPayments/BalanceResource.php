<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

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
     * Retrieves the account's current balance.
     */
    public function get(): Balance
    {
        $response = $this->client->get(
            $this->uri('shopify_payments/balance')
        );

        return $this->toModel($response);
    }
}
