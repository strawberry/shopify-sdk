<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Sales;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\ChildResource;
use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Sales\Payment;

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
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = CheckoutResource::class;
}
