<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Sales\ProductListing;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class ProductListingResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\DeletesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = ProductListing::class;

    /**
     * Retrieve product_ids that are published to a collection_id
     *
     * @return int[]
     */
    public function productIds(array $options = []): array
    {
        $response = $this->client->get($this->uri('product_ids'), $options);

        return $this->data($response, 'product_ids');
    }

    /**
     * Create a collection listing to publish a collection to your app.
     *
     * @param Arrayable|array  $data
     */
    public function create(int $id, $data): ProductListing
    {
        $response = $this->client->put(
            $this->uri((string) $id),
            $this->prepareJson($data, 'product_listing')
        );

        return $this->toModel($response);
    }
}
