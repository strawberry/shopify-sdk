<?php

namespace Strawberry\Shopify\Rest\Resources;

use Strawberry\Shopify\Models\Shop;

class ShopResource extends Resource
{
    public function get(array $fields = []): Shop
    {
        $response = $this->client->get('shop.json');
    }
}
