<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Customers;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\SavedSearch;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class SavedSearchResource extends Resource
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
     * @return mixed
     */
    public function run(int $id, array $options = [])
    {
        $response = $this->client->get(
            $this->uri("{$id}/customers"),
            $options
        );

        return $this->toCollection($response, 'customers', Customer::class);
    }

    public function singularResourceKey(): string
    {
        return 'customer_saved_search';
    }

    public function routeKey(): string
    {
        return 'customer_saved_searches';
    }
}
