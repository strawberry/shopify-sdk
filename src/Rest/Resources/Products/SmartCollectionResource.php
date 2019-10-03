<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\SmartCollection;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;

final class SmartCollectionResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = SmartCollection::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'metafields' => MetafieldResource::class,
    ];

    public function order(int $id, array $products = [], ?string $order = null): void
    {
        $options = array_filter([
            'products' => $products,
            'sort_order' => $order,
        ]);

        $this->client->put($this->uri("{$id}/order"), [], $options);
    }
}
