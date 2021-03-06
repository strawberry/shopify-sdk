<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Orders;

use Strawberry\Shopify\Models\Orders\Refund;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class RefundResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Refund::class;

    /**
     * Calculates a refund.
     */
    public function calculate(array $data): Refund
    {
        $response = $this->client->post(
            $this->uri('calculate'),
            $this->prepareJson($data, 'refund')
        );

        return $this->toModel($response);
    }
}
