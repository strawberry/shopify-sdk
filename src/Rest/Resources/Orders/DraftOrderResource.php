<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\DraftOrder;
use Strawberry\Shopify\Models\Orders\DraftOrderInvoice;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;

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
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'metafields' => MetafieldResource::class,
    ];

    /**
     * Sends an invoice for the draft order.
     */
    public function sendInvoice(int $id, array $data = []): DraftOrderInvoice
    {
        $response = $this->client->post(
            $this->uri("{$id}/send_invoice"),
            $this->prepareJson($data, 'draft_order_invoice')
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
        $pending = $pending ? ['payment_pending' => 'true'] : [];

        $response = $this->client->put(
            $this->uri("{$id}/complete"),
            [],
            $pending
        );

        return $this->toModel($response);
    }
}
