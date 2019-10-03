<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Sales\Checkout;
use Strawberry\Shopify\Models\Sales\ShippingRate;
use Strawberry\Shopify\Rest\Resource;

final class CheckoutResource extends Resource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Checkout::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'payments' => PaymentResource::class,
    ];

    /**
     * Creates a checkout.
     *
     * @param  Arrayable|array  $data
     */
    public function create($data): Checkout
    {
        $response = $this->client->post(
            $this->uri(),
            $this->prepareJson($data, 'checkout')
        );

        return $this->toModel($response);
    }

    /**
     * Completes a checkout.
     */
    public function complete(string $token): Checkout
    {
        $response = $this->client->post(
            $this->uri("{$token}/complete")
        );

        return $this->toModel($response);
    }

    /**
     * Retrieve an existing checkout.
     */
    public function find(string $token, array $options = []): Checkout
    {
        $response = $this->client->get(
            $this->uri($token),
            $options
        );

        return $this->toModel($response);
    }

    /**
     * Modifies an existing checkout.
     */
    public function update(string $token, array $data): Checkout
    {
        $response = $this->client->put(
            $this->uri($token),
            $this->prepareJson($data, 'checkout')
        );

        return $this->toModel($response);
    }

    /**
     * Retrieves a list of available shipping rates for the specified checkout.
     *
     * @return mixed
     */
    public function shippingRates(string $token)
    {
        $response = $this->client->get(
            $this->uri("{$token}/shipping_rates")
        );

        return $this->toCollection(
            $response,
            'shipping_rates',
            ShippingRate::class
        );
    }
}
