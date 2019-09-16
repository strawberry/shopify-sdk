<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Shipping;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Models\Shipping\Fulfillment;
use Strawberry\Shopify\Rest\Resources\Orders\OrderResource;

final class FulfillmentResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Fulfillment::class;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = OrderResource::class;

    /**
     * A list of the child resources.
     *
     * @var array
     */
    protected $childResources = [
        'events' => FulfillmentEventResource::class,
    ];

    /**
     * Mark a fulfillment as complete.
     */
    public function complete(int $id): Fulfillment
    {
        $response = $this->client->post(
            $this->uri("{$id}/complete")
        );

        return $this->toModel($response);
    }

    /**
     * Mark a fulfillment as open.
     */
    public function open(int $id): Fulfillment
    {
        $response = $this->client->post(
            $this->uri("{$id}/open")
        );

        return $this->toModel($response);
    }

    /**
     * Cancel a fulfillment.
     */
    public function cancel(int $id): Fulfillment
    {
        $response = $this->client->post(
            $this->uri("{$id}/cancel")
        );

        return $this->toModel($response);
    }
}
