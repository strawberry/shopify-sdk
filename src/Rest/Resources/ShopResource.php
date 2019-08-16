<?php

namespace Strawberry\Shopify\Rest\Resources;

use Strawberry\Shopify\Models\Shop;

class ShopResource extends Resource
{
    /**
     * The model that represents this resource.
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
