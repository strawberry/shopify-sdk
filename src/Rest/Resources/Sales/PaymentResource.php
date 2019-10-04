<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Strawberry\Shopify\Models\Sales\Payment;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class PaymentResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Start a session by creating a credit card and retrieving
     * a single-use session ID
     *
     * @param  Arrayable|array  $data
     */
    public function startSession($data): string
    {
        $json = $this->prepareJson($data, 'credit_card');

        $response = $this->client->post(
            'https://elb.deposit.shopifycs.com/sessions', $json
        );

        return Arr::get($response->getContent(), 'id');
    }
}
