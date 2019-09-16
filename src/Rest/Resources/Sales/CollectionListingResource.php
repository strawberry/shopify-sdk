<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Sales\CollectionListing;

final class CollectionListingResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\DeletesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = CollectionListing::class;

    /**
     * Retrieve product_ids that are published to a collection_id
     */
    public function productIds(int $id, array $options = []): array
    {
        $response = $this->client->get(
            $this->uri("{$id}/product_ids"),
            $options
        );

        return $this->data($response, 'product_ids');
    }

    /**
     * Create a collection listing to publish a collection to your app.
     *
     * @param Arrayable|array  $data
     */
    public function create(int $id, $data): CollectionListing
    {
        $response = $this->client->put(
            $this->uri((string) $id),
            $this->prepareJson($data, 'collection_listing')
        );

        return $this->toModel($response);
    }
}
