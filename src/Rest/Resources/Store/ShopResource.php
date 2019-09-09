<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Strawberry\Shopify\Models\Shop;
use Strawberry\Shopify\Rest\Resources\Resource;

final class ShopResource extends Resource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Retrieves the shop's configuration.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/shop#show-2019-07
     */
    public function get(array $fields = []): Shop
    {
        $response = $this->client->get('shop.json', [
            'fields' => implode(',', $fields),
        ]);

        return $this->toModel($response);
    }
}
