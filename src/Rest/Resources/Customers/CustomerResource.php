<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Customers;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\Invitation;
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
     * Searches for customers that match a supplied query.
     */
    public function search(string $query, array $options = []): Collection
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
    public function sendInvite(int $id, array $options): Invitation
    {
        $response = $this->client->post(
            $this->uri("{$id}/send_invite"),
            $this->prepareJson($options, 'customer_invite')
        );

        return new Invitation($this->data($response, 'customer_invite'));
    }

    /**
     * Retrieves all orders belonging to a customer
     *
     * @todo This needs to have the model type set to Order.
     */
    public function orders(int $id): Collection
    {
        $response = $this->client->get(
            $this->uri("{$id}/orders")
        );

        return $this->toCollection($response, 'orders');
    }
}
