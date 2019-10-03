<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Customers;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\Invitation;
use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class CustomerResource extends Resource
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
    protected $model = Customer::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'addresses' => AddressResource::class,
    ];

    /**
     * Searches for customers that match a supplied query.
     *
     * @return mixed
     */
    public function search(string $query, array $options = [])
    {
        $response = $this->client->get(
            $this->uri('search'),
            array_merge($options, ['query' => $query])
        );

        return $this->toCollection($response);
    }

    /**
     * Generate an account activation URL for a customer whose
     * account is not yet enabled.
     */
    public function createActivationUrl(int $id): string
    {
        $response = $this->client->post(
            $this->uri("{$id}/account_activation_url")
        );

        return $this->data($response, 'account_activation_url');
    }

    /**
     * Sends an account invite to a customer.
     */
    public function sendInvite(int $id, array $data = []): Invitation
    {
        $response = $this->client->post(
            $this->uri("{$id}/send_invite"),
            $this->prepareJson($data, 'customer_invite')
        );

        return $this->toModel(
            $response,
            'customer_invite',
            Invitation::class
        );
    }

    /**
     * Retrieves all orders belonging to a customer
     *
     * @return mixed
     */
    public function orders(int $id)
    {
        $response = $this->client->get(
            $this->uri("{$id}/orders")
        );

        return $this->toCollection(
            $response,
            'orders',
            Order::class
        );
    }
}
