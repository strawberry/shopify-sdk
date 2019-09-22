<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Customers;

use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class AddressResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource;

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
    protected $model = Address::class;

    /**
     * Performs bulk operations for multiple customer addresses.
     */
    public function bulk(array $ids, string $operation, array $data = []): void
    {
        $this->client->put($this->uri('set'), $data, [
            'address_ids' => $ids,
            'operation' => $operation,
        ]);
    }

    /**
     * Helper method for deleting addresses en-masse.
     */
    public function deleteMultiple(array $ids): void
    {
        $this->bulk($ids, 'destroy');
    }

    /**
     * Sets the default address for a customer.
     */
    public function default(int $id): Address
    {
        $response = $this->client->put(
            $this->uri("{$id}/default")
        );

        return $this->toModel($response);
    }

    public function routeKey(): string
    {
        return 'addresses';
    }

    public function singularResourceKey(): string
    {
        return 'customer_address';
    }
}
