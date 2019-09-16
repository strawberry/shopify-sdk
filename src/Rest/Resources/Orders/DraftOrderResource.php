<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Orders;

use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\Orders\DraftOrder;
use Strawberry\Shopify\Models\Orders\DraftOrderInvoice;

final class DraftOrderResource extends Resource
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
    protected $model = DraftOrder::class;

    /**
     * Sends an invoice for the draft order.
     */
    public function sendInvoice(int $id): DraftOrderInvoice
    {
        $response = $this->client->post(
            $this->uri("{$id}/send_invoice")
        );

        return $this->toModel(
            $response,
            'draft_order_invoice',
            DraftOrderInvoice::class
        );
    }

    /**
     * Completes a draft order.
     */
    public function complete(int $id, bool $pending = false): DraftOrder
    {
        $response = $this->client->put(
            $this->uri("{$id}/complete"),
            [],
            ['payment_pending' => $pending]
        );

        return $this->toModel($response);
    }
}
