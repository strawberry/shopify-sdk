<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentResource;

final class OrderResource extends Resource
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
    protected $model = Order::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'fulfillments' => FulfillmentResource::class,
        'refunds' => RefundResource::class,
        'risks' => OrderRiskResource::class,
        'transactions' => TransactionResource::class,
    ];

    /**
     * Closes an order.
     */
    public function close(int $id): Order
    {
        $response = $this->client->post($this->uri("{$id}/close"));

        return $this->toModel($response);
    }

    /**
     * Re-opens an order.
     */
    public function open(int $id): Order
    {
        $response = $this->client->post($this->uri("{$id}/open"));

        return $this->toModel($response);
    }

    /**
     * Cancels an order.
     */
    public function cancel(int $id, array $data): Order
    {
        $response = $this->client->post(
            $this->uri("{$id}/cancel"),
            $data
        );

        return $this->toModel($response);
    }
}
