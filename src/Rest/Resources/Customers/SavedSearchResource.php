<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Customers;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\SavedSearch;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class SavedSearchResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource,
        Concerns\CountsResource;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = CustomerResource::class;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = SavedSearch::class;

    /**
     * Retrieves all customers returned by a customer saved search.
     *
     * @todo This needs to have the model type set to Customer.
     */
    public function run(int $id, array $options = []): Collection
    {
        $response = $this->client->get(
            $this->uri("{$id}/customers"),
            $options
        );

        return $this->toCollection($response, 'customers', Customer::class);
    }
}
